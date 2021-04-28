<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    protected $fillable = [
      'product_id', 'tag_id'
    ];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}
