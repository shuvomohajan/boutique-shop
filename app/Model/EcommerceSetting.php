<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EcommerceSetting extends Model
{
    protected $fillable = [
      'SSL_ID',
      'SSL_PASSWORD',
      'currency',
      'shipping_cost_dhaka',
      'shipping_cost_outside',
      'tax',
      'delivery_time_dhaka',
      'delivery_time_outside',
      'note',
    ];
}
