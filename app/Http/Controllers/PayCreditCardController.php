<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

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
     * @param Request $request
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function payCard(Request $request): JsonResponse
    {
        /* Need to validate the Request */
        $validator = Validator::make($request->all(), Payment::getValidationRules());
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        /* Check what payment type */
        if($request->submit == "nab")
        {
            [$data, $statusCode] = $this->paymentService->payWithNAB($request->all());
        }
        else if($request->submit == "anz")
        {
            [$data, $statusCode] = $this->paymentService->payWithANZ($request->all());
        }

        return response()->json($data, $statusCode);
    }
}
