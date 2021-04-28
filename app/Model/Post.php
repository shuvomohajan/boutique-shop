<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $fillable = [
    'name',
    'image',
    'details',
    'seo_key_word',
    'category_id',
    'status',
  ];

  public function BlogTags()
  {
    return $this->belongsToMany(BlogTag::class, 'post_blog_tags', 'post_id');
  }

  public function Category()
  {
    return $this->belongsTo(PostCategory::class);
  }
}
