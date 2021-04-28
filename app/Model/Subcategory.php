<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [
        'name', 'category_id', 'icon', 'cover_image', 'status',
    ];

    public function Products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
}
