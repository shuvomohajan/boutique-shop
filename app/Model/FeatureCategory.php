<?php

namespace App\Model;

use App\Model\Category;
use Illuminate\Database\Eloquent\Model;

class FeatureCategory extends Model
{
    protected $guarded = [];

    public function Category()
    {
      return $this->belongsTo(Category::class);
    }
}

