<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

/**
 * App\Models\Extdst
 *
 * @OA\Schema (
 *  @OA\Xml (name="Extdst"),
 *  @OA\Property (property="id", type="integer", readOnly="true", example="1"),
 *  @OA\Property (property="reseller_tenant_id", type="integer", example="201"),
 *  @OA\Property (property="dst_num", type="string", example="6142521456"),
 *  @OA\Property (property="dial_timeout", type="integer", example="1"),
 *  @OA\Property (property="reseller_action_id", type="integer", example="10"),
 *  @OA\Property (property="moh_while_ring", type="integer", example="3"),
 *  @OA\Property (property="moh_while_ring_class", type="string", example="sms"),
 *  @OA\Property (property="account_code", readOnly="true", type="string", example="1-201"),
 *  @OA\Property (property="status", readOnly="true", type="boolean", example="1"),
 *  @OA\Property (property="reseller_id", readOnly="true", type="integer", example="1"),
 *  @OA\Property (property="created_at", type="date", readOnly="true", example="2021-11-10T08:49:29.000000Z"),
 *  @OA\Property (property="updated_at", type="date", readOnly="true", example="2021-11-10T08:49:29.000000Z"),
 *  )
 * @property int $id
 * @property int $reseller_id
 * @property int|null $reseller_tenant_id
 * @property int|null $reseller_action_id
 * @property string|null $account_code
 * @property string|null $dst_num
 * @property int|null $dial_timeout
 * @property int|null $moh_while_ring
 * @property string|null $moh_while_ring_class
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Extdst newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Extdst newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Extdst query()
 * @method static \Illuminate\Database\Eloquent\Builder|Extdst whereAccountCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Extdst whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Extdst whereDialTimeout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Extdst whereDstNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Extdst whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Extdst whereMohWhileRing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Extdst whereMohWhileRingClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Extdst whereResellerActionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Extdst whereResellerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Extdst whereResellerTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Extdst whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Extdst whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Database\Factories\ExtdstFactory factory(...$parameters)
 */
class Extdst extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'extdst';
    protected $attributes = [
        'status' => true
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'reseller_id',
        'reseller_tenant_id',
        'reseller_action_id',
        'account_code',
        'dst_num',
        'dial_timeout',
        'moh_while_ring',
        'moh_while_ring_class',
        'status'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    /**
     * Validation Rules
     *
     *
     * @param string $action
     *
     * @return array
     */
    public static function getValidationRules(string $action = 'create'): array
    {
        // List fields that will be allowed within all endpoints.
        // If none passed means nothing allowed.
        $allowedAttributes = ['*' => 'allowed_attributes:dst_num,moh_while_ring,dial_timeout,moh_while_ring_class'];

        switch ($action) {
            case 'update':
                return array_merge($allowedAttributes, [
                    'dst_num' => 'max:255|string',
                    'moh_while_ring' => 'int',
                    'dial_timeout' => 'int',
                    'moh_while_ring_class' => 'max:255|string'
                ]);
            case 'create':      //No field allowed except mentioned
            default:
                return array_merge(['*' => 'allowed_attributes:'], [
                    'dst_num' => 'required|string|max:255',
                    'reseller_action_id' => 'required|int',
                    'dial_timeout' => 'required|int',
                    'moh_while_ring' => 'required|int',
                    'moh_while_ring_class' => 'required|string|max:255'
                ]);
        }
    }
}
