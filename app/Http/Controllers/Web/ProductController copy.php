<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Model\Product;
use App\Model\Subject;
use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Review;

class ProductController extends Controller
{
  public function allProducts(Request $request, $for, $id)
  {
    //filtering start
    $category_id = [];
    $subcategory_id = [];
    $language_id = [];
    if (request()->has('price') && request()->price != null) {
      $price = str_replace('৳', '', $request->price);
      $price = explode('-', $price);
      $newMinPrice = $price[0];
      $newMaxPrice = $price[1];
    } else {
      $newMinPrice = Product::min('regular_price');
      $newMaxPrice = Product::max('regular_price');
      $price[0] = $newMinPrice;
      $price[1] = $newMaxPrice;
    }
    if (request()->has('subcategories')) {
      $subcategory_id = request()->get('subcategories');
    }
    if (request()->has('categories')) {
      $category_id = request()->get('categories');
    }
    if (request()->has('languages')) {
      $language_id = request()->get('languages');
    }
    //filtering end

    if ($for === 'publisher' || $for === 'author') {
      $item = User::where(['id' => $id, 'type' => $for])->first();
    } elseif ($for === 'category') {
      $item = Category::findOrFail($id);
      $item->type = 'category';
    } elseif ($for === 'subject') {
      $item = Subject::findOrFail($id);
    } else {
      abort(404);
    }

    $products = Product::where($for . '_id', $id)
      ->when(request()->has('categories'), function ($query) use ($category_id) {
        return $query->whereIn('category_id', $category_id);
      })
      ->when(request()->has('subcategories'), function ($query) use ($subcategory_id) {
        return $query->whereIn('subcategory_id', $subcategory_id);
      })
      ->when(request()->has('languages'), function ($query) use ($language_id) {
        return $query->whereIn('language_id', $language_id);
      })
      ->when(request()->has('sort'), function ($query) {
        if (request()->get('sort') == 'asc' || request()->get('sort') == 'desc') {
          return $query->orderBy('regular_price', request()->get('sort'));
        }
        if (request()->get('sort') == 'latest') {
          return $query->orderBy('year', 'desc');
        }
      })->when(request()->has('price'), function ($query) use ($price) {
        return $query->whereBetween('regular_price', [$price[0], $price[1]]);
      })
      ->paginate(15);
    // dd($item);
    return view('website.shop_left_sidebar', compact('products', 'item', 'category_id', 'subcategory_id', 'language_id', 'newMinPrice', 'newMaxPrice'));
  }

  public function productDetails($id)
  {
    $data['product'] = Product::find($id);
    $data['reviews'] = Review::where('product_id', $id)->orderBy('created_at', 'desc')->paginate(10);
    return view('website.product_details', $data);
  }
}
