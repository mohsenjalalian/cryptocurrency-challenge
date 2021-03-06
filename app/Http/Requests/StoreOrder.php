<?php

namespace App\Http\Requests;

use App\Repositories\CurrencyRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class StoreOrder extends FormRequest
{
    private $currencyRepository;

    /**
     * StoreOrder constructor.
     * @param CurrencyRepository $currencyRepository
     */
    public function __construct(CurrencyRepository $currencyRepository)
    {
        parent::__construct();
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'source_currency' => 'required',
            'destination_currency' => 'required',
            'amount' => 'required|numeric',
            'tracking_code' => 'required'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'tracking_code' => Str::uuid()->toString(),
        ]);
    }

    /**
     * @param array $validatedData
     * @return array
     */
    public function prepareForStoring(array $validatedData)
    {
        $sourceCurrency = $this->currencyRepository->findOneBy(
            'symbol',
            $validatedData['source_currency'],
            ['id']
        );
        $destinationCurrency = $this->currencyRepository->findOneBy(
            'symbol',
            $validatedData['destination_currency'],
            ['id']
        );

        $validatedData['source_currency_id'] = $sourceCurrency->id;
        $validatedData['destination_currency_id'] = $destinationCurrency->id;

        $lastSourcePrice = Redis::hgetall('currency_id:'.$validatedData['source_currency_id']);
        $lastDestinationPrice = Redis::hgetall('currency_id:'.$validatedData['destination_currency_id']);

        $validatedData = calculateResultAmount($validatedData, $lastSourcePrice, $lastDestinationPrice);

        unset($validatedData['source_currency']);
        unset($validatedData['destination_currency']);

        return $validatedData;
    }
}
