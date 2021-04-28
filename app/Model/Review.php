<?php

namespace App\Model;

use App\User;
use App\Model\Product;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
  protected $guarded = [];

  public function User()
  {
      return $this->belongsTo(User::class);
  }
  public function Product()
  {
      return $this->belongsTo(Product::class);
  }

}
