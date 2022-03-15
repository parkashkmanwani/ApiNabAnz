<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

/**
 * App\Models\Payment
 */
class Payment extends Model
{
    use HasFactory;

    /**
     * Validation Rules
     *
     *
     * @param string $action
     *
     * @return array
     */
    public static function getValidationRules(string $action = 'post'): array
    {
        switch ($action) {
            case 'post':      //No field allowed except mentioned
            default:
                return [
                    'credit_card_number' => 'required|int',
                    'credit_card_name' => 'required|string',
                    'cvv' => 'required|int',
                    'date' => 'required|date',
                    'amount' => 'required|int'
                ];
        }
    }
}
