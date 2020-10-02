<?php

namespace App\Console\Commands;

use App\Adapters\ExchangeRates\ExchangeRateHostAdapter;
use App\Models\Currency;
use App\Repositories\CurrencyPriceRepository;
use Illuminate\Console\Command;
use GuzzleHttp\Exception\GuzzleException;

class UpdateCurrencyPrices extends Command
{
    private const CHUNK = 1;
    private $exchangeRateHostAdapter;
    private $currencyPriceRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:currency-prices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currency prices';

    /**
     * UpdateCurrencyPrices constructor.
     * @param ExchangeRateHostAdapter $exchangeRateHostAdapter
     * @param CurrencyPriceRepository $currencyPriceRepository
     */
    public function __construct(
        ExchangeRateHostAdapter $exchangeRateHostAdapter,
        CurrencyPriceRepository $currencyPriceRepository
    )
    {
        parent::__construct();
        $this->exchangeRateHostAdapter = $exchangeRateHostAdapter;
        $this->currencyPriceRepository = $currencyPriceRepository;
    }

    /**
     * @throws GuzzleException
     */
    public function handle()
    {
        $baseCurrency = config('app.base_currency');
        Currency::chunk(self::CHUNK, function ($currencies) use ($baseCurrency) {
            foreach ($currencies as $currency){
                if ($currency->symbol != $baseCurrency) {
                    $price = $this->exchangeRateHostAdapter->convert($currency->symbol, $baseCurrency);

                    if ($price) {
                        $attributes = [
                            'price' => (int)$price,
                            'currency_id' => $currency->id
                        ];

                        $this->currencyPriceRepository->create($attributes);
                    }
                }
            }
        });
    }
}
