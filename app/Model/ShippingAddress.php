<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $fillable = [
      'user_id',
      'country',
      'division_id',
      'city',
      'zip',
      'area',
      'address',
      'contact'
    ];

    public function User()
    {
      return $this->belongsTo(User::class);
    }
    public function Division()
    {
      return $this->belongsTo(Division::class);
    }
}
