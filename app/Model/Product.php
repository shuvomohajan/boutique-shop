<?php

namespace App\Model;

use App\Model\Format;
use App\Model\Feature;
use App\Model\Subject;
use App\Model\Category;
use App\Model\Language;
use App\Model\ProductTag;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'short_description',
        'full_description',
        'regular_price',
        'sell_price',
        'discount',
        'stock',
        'sku',
        'year',
        'page',
        'category_id',
        'subcategory_id',
        'publisher_id',
        'author_id',
        'subject_id',
        'format_id',
        'language_id',
        'image',
        'gallery',
        'social_image',
        'seo_key_word',
        'status'
    ];

    public function Categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function Subcategories()
    {
        return $this->belongsToMany(Subcategory::class);
    }

    public function Format()
    {
        return $this->belongsTo(Format::class);
    }

    public function Subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function Language()
    {
        return $this->belongsTo(Language::class);
    }

    public function Tags()
    {
        return $this->hasMany(ProductTag::class);
    }

    public function FeatureProducts()
    {
      return $this->belongsToMany(FeatureProducts::class);
    }

    public function Reviews()
    {
        return $this->hasMany(Review::class);
    }
}
