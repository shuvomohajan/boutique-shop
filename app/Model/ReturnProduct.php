<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReturnProduct extends Model
{
    protected $fillable = [
      'order_id',
      'product_id',
      'user_id',
      'qty',
      'reason',
      'return_amount',
      'date',
      'status'
    ];
}
