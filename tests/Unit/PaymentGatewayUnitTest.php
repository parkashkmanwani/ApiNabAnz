<?php

namespace Tests\Unit;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Mockery;
use Tests\TestCase;

class PaymentGatewayUnitTest extends TestCase
{
    /**
     * Mocking Anz Payment Gateway
     *
     * Expecting 200 status
     * @return void
     */
    public function MockAnzPaymentGateway(): void
    {
        $mock = Mockery::mock(Client::class);
        $mock->shouldReceive('payCard')->andReturn(new Response($status = 200, $headers = []));

        $response = $this->post('/payCreditCard', [
            'credit_card_number' => 1234111112544674,
            'credit_card_name' => 'Test',
            'cvv' => 325,
            'date' => '12/10/2026',
            'amount' => 100,
            'submit' => "anz",
        ]);

        $response->assertStatus(200);
    }
}
