<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategorySection extends Model
{
    protected $guarded = [];
    public function Category()
    {
      return $this->belongsTo(Category::class);
    }
}
