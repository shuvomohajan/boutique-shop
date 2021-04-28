<?php

namespace App;

use App\Model\Product;
use App\Model\Review;
use App\Model\ShippingAddress;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image', 'cover_image', 'mobile', 'phone', 'about', 'type', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Product_author()
    {
        return $this->hasMany(Product::class,'author_id','id');
    }
    public function Product_publisher()
    {
        return $this->hasMany(Product::class,'publisher_id','id');
    }

    public function ShippingAddress()
    {
        return $this->hasMany(ShippingAddress::class);
    }
    public function Reviews()
    {
        return $this->hasMany(Review::class);
    }
}
