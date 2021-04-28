<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'name', 'status'
    ];

    public function Product()
    {
        return $this->hasMany(Product::class);
    }
}
