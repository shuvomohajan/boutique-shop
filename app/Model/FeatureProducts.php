<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FeatureProducts extends Model
{
    protected $fillable = [
      'product_id','feature_id'
    ];
    public function Features(){
      return $this->belongsTo(Feature::class);
    }

    public function Products(){
      return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
