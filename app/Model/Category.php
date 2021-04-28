<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'icon','name', 'cover_img', 'description', 'status'
    ];

    public function Products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function Subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

}
