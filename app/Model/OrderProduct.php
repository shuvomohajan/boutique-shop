<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable =[
      'order_id',
      'product_id',
      'qty',
      'price',
      'discount_sell_price'
    ];
    public function Product()
    {
      return $this->belongsTo(Product::class);

    }
}
