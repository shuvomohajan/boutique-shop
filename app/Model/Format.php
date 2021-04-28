<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    protected $fillable = [
        'name', 'status'
    ];

    public function Product()
    {
        return $this->hasMany(Product::class);
    }
}
