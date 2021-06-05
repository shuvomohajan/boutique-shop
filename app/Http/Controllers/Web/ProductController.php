<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use App\Model\Review;
use App\Model\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    //filtering end
if ($for === 'category') {
      $item = Category::findOrFail($id);
      $item->type = 'category';
    } elseif ($for === 'subject') {
      $item = Subject::findOrFail($id);
    } else {
      abort(404);
    }
    if ($for === "category") {
      $subProducts = [];
      if (request()->has('subcategories')) {
        $subProducts = DB::table('product_subcategory')->whereIn('subcategory_id', $request->subcategories)->groupBy('product_id')->pluck('product_id');
      }
      $products = Product::join('category_product', 'category_product.product_id', '=', 'products.id')->where('category_product.category_id', $id)
        ->when(request()->has('subcategories'), function ($query) use ($subProducts) {
          return Product::whereIn('id', $subProducts);
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
        })->paginate(15);
    } else {

      $products = Product::where($for . '_id', $id)
        ->when(request()->has('categories'), function ($query) use ($category_id) {
          return $query->join('category_product', 'category_product.product_id', '=', 'products.id')->whereIn('category_product.category_id', $category_id);
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
    }

    return view('website.shop_left_sidebar', compact('products', 'item', 'category_id', 'subcategory_id', 'language_id', 'newMinPrice', 'newMaxPrice'));
  }

  public function productDetails($id)
  {
    $data['product'] = Product::findOrFail($id);
    $data['reviews'] = Review::where('product_id', $id)->orderBy('id', 'desc')->paginate(10);
    return view('website.product_details', $data);
  }
}
