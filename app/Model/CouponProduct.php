<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CouponProduct extends Model
{
    protected $fillable = ['coupon_id', 'product_id'];

    public function Coupon(){
      return $this->belongsTo(Coupon::class);
    }

    public function Product(){
      return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
