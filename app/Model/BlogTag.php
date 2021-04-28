<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
  protected $fillable = [
    'name'
  ];

  public function Posts()
  {
    return $this->belongsToMany(Post::class, 'post_blog_tags', 'blog_tag_id');
  }
}
