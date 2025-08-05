<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\DeliveryOrder
 *
 * @property int $id
 * @property string $order_number
 * @property int $outgoing_goods_id
 * @property string $customer_name
 * @property string|null $customer_address
 * @property string|null $customer_phone
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $delivery_date
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\OutgoingGoods $outgoingGoods
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereCustomerAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereCustomerPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereDeliveryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereOutgoingGoodsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryOrder whereUpdatedAt($value)
 * @method static \Database\Factories\DeliveryOrderFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class DeliveryOrder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'order_number',
        'outgoing_goods_id',
        'customer_name',
        'customer_address',
        'customer_phone',
        'status',
        'delivery_date',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'delivery_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the outgoing goods that owns the delivery order.
     */
    public function outgoingGoods(): BelongsTo
    {
        return $this->belongsTo(OutgoingGoods::class);
    }
}