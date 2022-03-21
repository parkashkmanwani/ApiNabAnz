<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentGatewayRequest;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;

class PayCreditCardController extends Controller
{
    /**
     * @var PaymentService
     */
    protected PaymentService $paymentService;

    /**
     * PayCreditCardController Constructor
     *
     * @param PaymentService $paymentService
     *
     */
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     *
     * Pay with NAB or ANZ
     *
     * @param PaymentGatewayRequest $request
     *
     * @return JsonResponse
     */
    public function payCard(PaymentGatewayRequest $request): JsonResponse
    {
        /* Check what payment type */
        if ($request->submit == "nab") {
            [$data, $statusCode] = $this->paymentService->payWithNAB($request->all());
        } else {
            if ($request->submit == "anz") {
                [$data, $statusCode] = $this->paymentService->payWithANZ($request->all());
            }
        }

        return response()->json($data, $statusCode);
    }
}
