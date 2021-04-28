<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    Protected $fillable = [
        'icon', 'name', 'details', 'status'
    ];

    public function Products()
    {
        return $this->hasMany(Product::class);
    }
}
