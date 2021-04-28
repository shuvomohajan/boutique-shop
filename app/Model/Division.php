<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = [
      'name',
      'bn_name',
      'url'
    ];
}
