<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\OutgoingGoods
 *
 * @property int $id
 * @property string $reference_number
 * @property int $product_id
 * @property int $quantity
 * @property string|null $customer
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon $shipped_date
 * @property string $status
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\User $user
 * @property-read \App\Models\DeliveryOrder|null $deliveryOrder
 * @property-read \App\Models\Invoice|null $invoice
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|OutgoingGoods newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OutgoingGoods newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OutgoingGoods query()
 * @method static \Illuminate\Database\Eloquent\Builder|OutgoingGoods whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OutgoingGoods whereCustomer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OutgoingGoods whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OutgoingGoods whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OutgoingGoods whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OutgoingGoods whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OutgoingGoods whereReferenceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OutgoingGoods whereShippedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OutgoingGoods whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OutgoingGoods whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OutgoingGoods whereUserId($value)
 * @method static \Database\Factories\OutgoingGoodsFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class OutgoingGoods extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'reference_number',
        'product_id',
        'quantity',
        'customer',
        'notes',
        'shipped_date',
        'status',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'integer',
        'shipped_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the product that owns the outgoing goods.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the user that recorded the outgoing goods.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the delivery order associated with the outgoing goods.
     */
    public function deliveryOrder(): HasOne
    {
        return $this->hasOne(DeliveryOrder::class);
    }

    /**
     * Get the invoice associated with the outgoing goods.
     */
    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }
}