<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CustomerSupport extends Model
{
    protected $fillable = [
      'name',
      'email',
      'service',
      'message'
    ];
}
