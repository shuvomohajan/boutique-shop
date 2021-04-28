<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
  protected $fillable = [
    'name'
  ];

  public function Posts()
  {
    return $this->hasMany(Post::class, 'category_id', 'id');
  }
}
