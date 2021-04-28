<?php

namespace App\Model;

use App\Model\Product;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = [
      'name','image', 'priority','status'
    ];
    public function FeatureProducts()
    {
      return $this->hasMany(FeatureProducts::class);
    }
}
