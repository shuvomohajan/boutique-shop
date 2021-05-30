<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomProduct extends Model
{
  protected $guarded = [];

  public function User(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function ShippingAddress(): BelongsTo
  {
    return $this->belongsTo(ShippingAddress::class);
  }
}
