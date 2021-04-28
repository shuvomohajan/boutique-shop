<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
  protected $fillable = [
    'image',
    'title',
    'title_mini',
    'button_name',
    'button_link',
  ];
}
