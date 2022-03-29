<?php

namespace Tests\Unit;

use App\Http\Controllers\PayCreditCardController;
use App\Http\Requests\PaymentGatewayRequest;
use App\Services\PaymentService;
use Mockery;
use Tests\TestCase;

class PaymentGatewayUnitTest extends TestCase
{
    /**
     * @test Mocking Anz Payment Gateway
     *
     * Expecting 200 status
     */
    public function MockAnzPaymentGateway(): array
    {
        $mock = Mockery::mock(PaymentService::class);
        $service = new PayCreditCardController($mock);

        $mock->shouldReceive('payWithANZ')->once()->andReturn(['Success', 200]);

        $result = $service->payCard(new PaymentGatewayRequest([
            'credit_card_number' => 1234111112544674,
            'credit_card_name' => 'Test',
            'cvv' => 325,
            'date' => '12/10/2026',
            'amount' => 100,
            'submit' => "anz",
        ]));

        return ['Success', $result->getStatusCode()];
    }

}
