<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
  protected $fillable = [
    'order_no',
    'total',
    'item',
    'discount',
    'status',
    'delivered_date',
    'ready_date',
    'cancel_date',
    'created_at',
    'updated_at',
    'user_id',
    'coupon_id',
    'currency',
    'payment_method',
    'shipping_address_id'
  ];

  public function User(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function ShippingAddress(): BelongsTo
  {
    return $this->belongsTo(ShippingAddress::class);
  }
  // public function Products(){
  //   return $this->belongsToMany(Product::class);
  // }
}
