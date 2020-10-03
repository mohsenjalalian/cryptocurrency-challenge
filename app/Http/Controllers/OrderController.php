<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowOrder;
use App\Http\Requests\StoreOrder;
use App\Http\Resources\OrderResource;
use App\Repositories\CurrencyRepository;
use App\Repositories\OrderRepository;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    private $orderRepository;
    private $currencyRepository;

    /**
     * OrderController constructor.
     * @param OrderRepository $orderRepository
     * @param CurrencyRepository $currencyRepository
     */
    public function __construct(
        OrderRepository $orderRepository,
        CurrencyRepository $currencyRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->currencyRepository = $currencyRepository;
    }


    /**
     * @param StoreOrder $request
     * @return JsonResponse
     */
    public function store(StoreOrder $request)
    {
        $validatedData = $request->validated();

        $validatedData = $request->prepareForStoring($validatedData);

        $order = $this->orderRepository->create($validatedData);

        return response()->json(
            [
                'tracking code' => $order->tracking_code
            ],
            Response::HTTP_OK
        );
    }

    /**
     * @param ShowOrder $request
     * @return JsonResponse
     */
    public function show(ShowOrder $request)
    {
        $validatedData = $request->validated();

        $order = $this->orderRepository->findOneBy(
            'tracking_code',
            $validatedData['tracking_code']
        );

        return response()->json(new OrderResource($order));
    }
}
