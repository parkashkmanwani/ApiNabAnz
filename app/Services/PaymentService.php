<?php

declare(strict_types=1);

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;
use Illuminate\Http\Request;
use Exception;

class PaymentService extends BaseService
{
    /**
     * Pay with NAB
     *
     * @param array $data
     *
     * @return array
     */
    public function payWithNAB(array $data): array
    {
        try {
            $response = Http::withHeaders([
                "Content-Type" => "text/xml;charset=utf-8"
            ])->send("POST", env('NAB_API'), [
                "body" => '<?xml version="1.0" encoding="UTF-8"?>
                        <from>
                        <card_number>'.$data['credit_card_number'].'</card_number>
                        <card_name>'.$data['credit_card_name'].'</card_name>
                        <cvv>'.$data['cvv'].'</cvv>
                        </from>
                        <amount>'.$data['amount'].'</amount>
                        <merchant_id>'.env('NAB_MERCHANT_ID').'</merchant_id>
                        <merchant_key>'.env('NAB_MERCHANT_KEY').'</merchant_key>'
            ]);
            if ($response->status() == 200)
                return $this->sendSuccessResponse($response);
            else
            return $this->sendFailureResponse($response->reason(), $response->getCode());
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return $this->sendFailureResponse($e->getMessage(), 406);
        }
    }

    /**
     * Pay with ANZ
     *
     * @param array $data
     *
     * @return array
     */
    public function payWithANZ(array $data): array
    {
        try {
            $client = new Client([
                'headers' => [ 'Content-Type' => 'application/json' ]
            ]);

            $response = $client->post(env('ANZ_API'),
                ['body' => json_encode(
                    [
                        'from' => [
                            'card_number' => $data['credit_card_number'],
                            'card_name' => $data['credit_card_name'],
                            'cvv' => $data['cvv']
                        ],
                        'amount' => $data['amount'],
                        'merchant_id' => env('ANZ_MERCHANT_ID'),
                        'merchant_key' => env('ANZ_MERCHANT_KEY')
                    ]
                )]
            );

            if ($response->getStatusCode() == 200)
                return $this->sendSuccessResponse($response);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return $this->sendFailureResponse($e->getMessage(), 406);
        }
    }
}
