<?php

use App\Model\CompanySetting;
use App\Model\Product;

function companyInfo(): CompanySetting
{
  return CompanySetting::first();
}

function minPrice()
{
  return Product::min('regular_price');
}

function maxPrice()
{
  return Product::max('regular_price');
}
