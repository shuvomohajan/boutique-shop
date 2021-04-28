<?php

namespace App\Http\Controllers\Web;

use App\Model\Cart;
use App\Model\Order;
use App\Model\Coupon;
use App\Model\Product;
use App\Model\OrderProduct;
use App\Model\CouponProduct;
use Illuminate\Http\Request;
use App\Model\ShippingAddress;
use App\Model\EcommerceSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CashController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $isExists = true;
    $user = Auth::user();
    $eSetting = EcommerceSetting::query()->first();
    if ($request->input('shipping_address') == 'new_address') {
      //address form validation
      $request->validate([
        'division_id' => 'required|string',
        'city'        => 'required|string',
        'address'     => 'required|string',
        'country'     => 'required|string',
        'area'        => 'required|string',
        'zip'         => 'required|integer',
        'contact'     => 'required|string',
      ]);

      $request->input('division_id') == 1 ? $shipping_cost = $eSetting->shipping_cost_dhaka : $shipping_cost = $eSetting->shipping_cost_outside;
      $shippingAddress = ShippingAddress::create([
        'user_id'     => $user->id,
        'division_id' => $request->input('division_id'),
        'city'        => $request->input('city'),
        'address'     => $request->input('address'),
        'country'     => 'Bangladesh',
        'area'        => $request->input('area'),
        'zip'         => $request->input('zip'),
        'contact'     => $request->input('contact'),
      ]);
    } else {
      $shippingAddress = ShippingAddress::query()->findOrFail($request->shipping_address);
      $shippingAddress->division_id == 1 ? $shipping_cost = $eSetting->shipping_cost_dhaka : $shipping_cost = $eSetting->shipping_cost_outside;
    }

    // make unique order number
    $orderNo = 'Ebook-' . substr(md5(time()), 0, 6);
    Order::query()->where('order_no', $orderNo)->exists() ? $orderNo .= '1' : null;
    // dd(session()->all(),$request->all(),'asdfas');

    $cart = null;
    if (Session::has('cart')) {
      $cart = new Cart(Session::get('cart'));
    }

    $totalDiscount = 0;
    $couponId = Session::has('coupon') ? Session::get('coupon')['coupon_id'] : '';

    if ($couponId != '' && $coupon = Coupon::query()->find($couponId)) {
      if ($cart != null && $cart->items != null) {
        foreach ($cart->items as $product) {
          $coupon_discount = CouponProduct::query()->where('coupon_id', $coupon->id)->where('product_id', $product['item']['product_id'])->first();
          if ($coupon_discount) {
            $isExists = Order::query()->where('user_id', auth()->id())->where('coupon_id', $coupon->id)->exists();
            if (!$isExists) {
              $totalDiscount += $coupon->discount;
            }
          }
        }
      }
    }

    $totalPrice = 0;
    $productName = '';
    if ($cart != null && $cart->items != null) {
      foreach ($cart->items as $product) {
        $productData = Product::query()->find($product['item']['product_id']);
        $totalPrice = intval($totalPrice) + (intval($product['item']['qty']) * intval($productData->sell_price ?? $productData->regular_price));
        $productName .= $productData->name . ',';
      }
    }

    $final_cost = (($totalPrice - $totalDiscount) + $shipping_cost);

    $post_data = [];
    $post_data['total_amount'] = $final_cost; // You cant not pay less than 10
    $post_data['currency'] = 'BDT';
    $post_data['tran_id'] = $orderNo; // tran_id must be unique

    // CUSTOMER INFORMATION
    $post_data['cus_name'] = $user->name;
    $post_data['cus_email'] = $user->email;
    $post_data['cus_add1'] = $shippingAddress->address;
    $post_data['cus_add2'] = '';
    $post_data['cus_city'] = $shippingAddress->city;
    $post_data['cus_state'] = $shippingAddress->area;
    $post_data['cus_postcode'] = $shippingAddress->zip;
    $post_data['cus_country'] = 'Bangladesh';
    $post_data['cus_phone'] = '8801XXXXXXXXX';
    $post_data['cus_fax'] = '';

    // SHIPMENT INFORMATION
    $post_data['ship_address_id'] = $shippingAddress->id;
    $post_data['ship_name'] = $user->name;
    $post_data['ship_add1'] = $shippingAddress->address;
    $post_data['ship_add2'] = '';
    $post_data['ship_city'] = $shippingAddress->city;
    $post_data['ship_state'] = $shippingAddress->area;
    $post_data['ship_postcode'] = $shippingAddress->zip;
    $post_data['ship_phone'] = $shippingAddress->contact;
    $post_data['ship_country'] = 'Bangladesh';

    $post_data['shipping_method'] = 'NO';
    $post_data['product_name'] = rtrim($productName, ',');
    $post_data['product_category'] = 'Book';
    $post_data['product_profile'] = 'physical-goods';

    $post_data['value_a'] = '';
    $post_data['value_b'] = '';
    $post_data['value_c'] = '';
    $post_data['value_d'] = '';

    $update_product = Order::where('order_no', $post_data['tran_id'])
      ->updateOrInsert([
        'user_id'             => $user->id,
        'coupon_id'           => !$isExists ? $couponId : null,
        'total'               => $post_data['total_amount'],
        'status'              => 'Pending',
        'shipping_address_id' => $post_data['ship_address_id'],
        'order_no'            => $post_data['tran_id'],
        'payment_method'      => 'Cash on Delivery',
        'currency'            => $post_data['currency'],
        'created_at'          => new \DateTime()
      ]);
    $order_id = Order::where('order_no', $post_data['tran_id'])->first()->id;

    if ($cart != null && $cart->items != null) {
      foreach ($cart->items as $product) {
        $productQty = $product['item']['qty'];
        $product = Product::query()->findOrFail($product['item']['product_id']);
        $productDiscount = 0;

        if ($couponId != '' && !$isExists) {
          $productDiscount = $coupon_discount->Coupon->discount;
        }
        OrderProduct::query()->create([
          'order_id'            => $order_id,
          'product_id'          => $product->id,
          'qty'                 => $productQty,
          'price'               => intval($product->sell_price ?? $product->regular_price),
          'discount_sell_price' => intval($product->sell_price ?? $product->regular_price) - intval($productDiscount),
        ]);
      }
    }
    if (session()->has('cart')) {
      session()->forget('cart');
    };

    return redirect(url('/'))->with('message', 'Order Completed Successfully');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
