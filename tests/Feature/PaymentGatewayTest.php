<?php

namespace Tests\Feature;

use Tests\TestCase;

class PaymentGatewayTest extends TestCase
{
    /**
     * test ANZ Payment gateway with success response
     *
     * Expecting 200 status
     * @return void
     */
    public function testANZPaymentGatewaySuccess()
    {
        $payload = [
            'credit_card_number' => '111111',
            'credit_card_name' => 'Test',
            'cvv' => '123',
            'date' => '11/12/2025',
            'amount' => 10.00,
            'submit' => 'anz',
        ];

        $this->json('POST', 'payCreditCard', $payload)->assertStatus(200);
    }

    /**
     * test ANZ Payment gateway with invalid amount
     *
     * Expecting 400 status
     * @return void
     */
    public function testANZPaymentGatewayInvalidAmount()
    {
        $payload = [
            'credit_card_number' => '111111',
            'credit_card_name' => 'Test',
            'cvv' => '123',
            'date' => '11/12/2025',
            'amount' => "10.00",
            'submit' => 'anz',
        ];

        $this->json('POST', 'payCreditCard', $payload)->assertStatus(422)->assertJsonFragment([
            "amount" => [
                "The amount must be an integer.",
            ],
        ]);
    }

    /**
     * test NAB Payment gateway with success response
     *
     * Expecting 200 status
     * @return void
     */
    public function testNABPaymentGatewaySuccess()
    {
        $payload = [
            'credit_card_number' => '111111',
            'credit_card_name' => 'Test',
            'cvv' => '123',
            'date' => '11/12/2025',
            'amount' => 10.00,
            'submit' => 'nab',
        ];

        $this->json('POST', 'payCreditCard', $payload)->assertStatus(406);
    }

    /**
     * test NAB Payment gateway with failure
     *
     * Expecting 200 status
     * @return void
     */
    public function testNABPaymentGatewayFailure()
    {
        $payload = [
            'credit_card_number' => '111111',
            'credit_card_name' => 'Test',
            'cvv' => '123',
            'date' => '11/12/2025',
            'amount' => 10.00,
            'submit' => 'nab',
        ];

        $this->json('POST', 'payCreditCard', $payload)->assertStatus(406);
    }
}
