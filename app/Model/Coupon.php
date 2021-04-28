<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable =[
      'code',
      'discount',
      'expire_at',
      'status',
    ];

    public function couonProducts(){
      return $this->hasMany(CouponProduct::class);
    }

}
