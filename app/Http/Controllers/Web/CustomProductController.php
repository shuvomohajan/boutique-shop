<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\CustomProduct;
use App\Model\ShippingAddress;
use Illuminate\Http\Request;

class CustomProductController extends Controller
{
  public function index()
  {
    return view('website.custom_product');
  }

  public function store(Request $request)
  {
    $request->validate([
      "service"          => ['required', 'string'],
      "front"            => ['nullable', 'string'],
      "back"             => ['nullable', 'string'],
      "sleeve"           => ['nullable', 'string'],
      "hemline"          => ['nullable', 'string'],
      "style"            => ['nullable', 'string'],
      "price"            => ['required', 'string'],
      "note"             => ['nullable', 'string'],
      "shipping_address" => ['required', 'string'],
    ]);

    if ($request->input('shipping_address') == 'new_address') {
      $request->validate([
        'division_id' => 'required|string',
        'city'        => 'required|string',
        'address'     => 'required|string',
        'country'     => 'required|string',
        'area'        => 'required|string',
        'zip'         => 'required|integer',
        'contact'     => 'required|string',
      ]);

      $shippingAddress = ShippingAddress::create([
        'user_id'     => auth()->id(),
        'country'     => 'Bangladesh',
        'division_id' => $request->input('division_id'),
        'city'        => $request->input('city'),
        'address'     => $request->input('address'),
        'area'        => $request->input('area'),
        'zip'         => $request->input('zip'),
        'contact'     => $request->input('contact'),
      ]);
    } else {
      $shippingAddress = ShippingAddress::findOrFail($request->input('shipping_address'));
    }

    CustomProduct::create([
      'user_id'             => auth()->id(),
      'shipping_address_id' => $shippingAddress->id,
      'service'             => $request->input('service'),
      'front'               => $request->input('front'),
      'back'                => $request->input('back'),
      'sleeve'              => $request->input('sleeve'),
      'hemline'             => $request->input('hemline'),
      'style'               => $request->input('style'),
      'price'               => $request->input('price'),
      'note'                => $request->input('note'),
    ]);
    return back()->with('message', 'Custom Silai Product Request Send, Boutique Shop Will Contact You Soon!');
  }


}
