<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\IncomingGoods
 *
 * @property int $id
 * @property string $reference_number
 * @property int $product_id
 * @property int $quantity
 * @property string|null $supplier
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon $received_date
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\User $user
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|IncomingGoods newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomingGoods newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomingGoods query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomingGoods whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomingGoods whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomingGoods whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomingGoods whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomingGoods whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomingGoods whereReceivedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomingGoods whereReferenceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomingGoods whereSupplier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomingGoods whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomingGoods whereUserId($value)
 * @method static \Database\Factories\IncomingGoodsFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class IncomingGoods extends Model
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
        'supplier',
        'notes',
        'received_date',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'integer',
        'received_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the product that owns the incoming goods.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the user that recorded the incoming goods.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}