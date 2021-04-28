<?php

namespace App\Http\Controllers\Web;

use App\Model\Cart;
use App\Model\Coupon;
use App\Model\CouponProduct;
use App\Model\Favourite;
use App\Model\OfferProduct;
use App\Model\Order;
use App\Model\OrderProduct;
use App\Model\OrderShip;
use App\Model\Product;
use App\Model\ReturnProduct;
use App\Model\User;
use App\Model\UserInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CartController extends Controller
{
  public function carts()
  {
    if (Session::has('cart')) {
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);
      $list = '';
      $productIds = [];
      $productQtys = [];

      if ($cart->items == null) {
        Session::forget('cart');
        $cart->totalPrice = 0;
        $cart->totalQty = 0;
        $data['items'] = '<tr> <td style="width: 30%"> <p class="bg-danger btn btn-danger btn-block text-center">No Items found </p> </td> </tr>';
        $data['totalAmount'] = 0;
        $data['totalItem'] = 0;
        $data['isEmpty'] = true;

        return json_encode($data);
      } else {
        $output = '';
        $bags = '';
        $bagsm = '';
        $sl = 0;
        $totalPrice = 0;
        foreach ($cart->items as $tid => $info) {
          $productIds[$sl]['product_id'] = $info['item']['product_id'];
          $qty = $info['item']['qty'];
          $productQtys[$sl]['qty'] = $qty;

          $name = $info['item']['name'];
          $img = $info['item']['img'] ? $info['item']['img'] : 'images/default.png';

          $product = Product::query()->findOrFail($info['item']['product_id']);

          if ($product->sell_price != null) {
            $price = $product->sell_price;
          } else {
            $price = $product->regular_price;
          }
          $output .= '
            <li class="product-image-name d-flex justify-content-start flex-row py-3">
            <img src="' . asset('storage') . '/' . $img . '" class="img-fluid cb-i minicart-product-image">
              <div>
                <p class="product-name-price">
                  <span class="product_name-det">' . Str::limit($product->name, 20, '...') . '</span>
                  <span class="stockout' . $product->id . ' d-none"></span>
                  <br>
                  <span class="product-cart-price">
                  <span class="pricei">৳</span>' . $price . '</span> |
                  <span class="product-qt">Qty:
                      <span
                          class="item-count qty' . $product->id . '"
                          data-id="' . $product->id . '"
                          data-qty=' . $info['item']['qty'] . '
                      "> ' . $info['item']['qty'] . ' </span>
                  </span>
                </p>
                <div class="rt-a">
                  <button class="add-to-cart plus-btn btn m-0 mx-1 mx-md-0 plus-item"
                          data-id="' . $product->id . '">
                      <i class="ion-plus-round"></i>
                  </button>

                  <button class="cartMinus minus-btn btn  m-0 mx-1 mx-md-0 minus-item"
                          data-id="' . $product->id . '">
                      <i class="ion-minus-round"></i>
                  </button>

                  <button class="destroyItem btn delete-btn  m-0 mx-1 mx-md-0 delete-item"
                          data-id="' . $product->id . '">
                      <i class="ion-trash-a"></i>
                  </button>
                </div>
              </div>
            </li>
            ';

          $bags .= '
                <tr>
                  <td class="fb-product-remove">
                    <a href="#" class="destroyItem btn delete-btn  m-0 mx-1 mx-md-0 delete-item"
                          data-id="' . $product->id . '">
                          <i class="fa fa-times"></i>
                    </a>
                  </td>
                  <td class="fb-product-thumbnail">
                    <a href="#">
                        <img src="' . asset('storage') . '/' . $img . '" alt="FB\'s Product Image" class="img-fluid" style="max-height: 60px">
                    </a>
                  </td>
                  <td class="fb-product-name">
                    <a href="#">' . $product->name . '</a>
                  </td>
                  <td class="fb-product-price"><span class="amount">' . $price . '</span></td>
                  <td class="quantity">
                      <label>Quantity</label>
                      <div class="cart-plus-minus">
                          <input class="item-count cart-plus-minus-box qty' . $product->id . '"
                                data-id="' . $product->id . '"
                                data-qty=' . $info['item']['qty'] . ' value="' . $info['item']['qty'] . '" type="text">

                          <div class="dec qtybutton cartMinus btn-minus minus-item"
                                data-id="' . $product->id . '">
                                <i class="fa fa-angle-down"></i>
                          </div>
                          <div class="inc qtybutton add-to-cart plus-btn m-0 mx-1 mx-md-0 plus-item"
                                data-id="' . $product->id . '">
                                <i class="fa fa-angle-up"></i>
                          </div>
                      </div>
                  </td>
                  <td class="product-subtotal"><span class="amount">&#2547; ' . $price * $qty . '</span></td>
              </tr>';


          $bagsm .=
            "<div class='confirm__mobile-content'>
                <div class='row'>
                    <div class='col-4 col-md-4'>
                        <div class='confirm__mobile-product'>
                            <img src='" . $img . "' class='img-fluid vcartimg'>
                        </div>
                    </div>
                    <div class='col-8 col-md-8'>
                        <div class='mobile__product-count float-right'>
                            <h6 class='mobile__product-title'>" . $product->name . "</h6>
                            <p class='mobile__product-price'>
                                <span>
                                    <span class='font-weight-bold'> price :</span>
                                    <span class='font-weight-bold pricei'>৳</span>" . $product->price . "
                                </span>
                                <span class='stockout" . $product->id . " d-none pcount'></span>
                            </p>
                            <div>
                                <button class='cartMinus btn btn-minus minus-item'
                                        data-id='" . $product->id . "'>
                                        <i class='fas fa-minus'></i>
                                </button>
                                <input data-id='" . $product->id . "' value='' class='qty" . $product->id . "'/>
                                <button class='add-to-cart btn btn-plus plus-item'
                                        data-id='" . $product->id . "'>
                                       <i class='fas fa-plus'></i>
                                </button>
                            </div>
                            <p class='mobile__product-total'>Total:
                                <span class='font-weight-bold pricei'>৳</span>" . $price * $qty . "
                            </p>
                        </div>
                    </div>
                </div>
            </div>";
          $totalPrice = $totalPrice + $price * $qty;
          $sl++;
        }
        $data['items'] = $output;
        $data['show_bag'] = $bags;
        $data['bagsm'] = $bagsm;
        $data['totalAmount'] = $totalPrice;
        $data['totalItem'] = count($cart->items);
        $data['products'] = $productIds;
        $data['qtys'] = $productQtys;
        $data['isEmpty'] = false;
        //        dd($data);
        return json_encode($data);
      }
    } else {
      Session::forget('cart');
      $data['items'] = '<tr>
                                <td style="width: 30%">
                                    <p class="bg-danger btn btn-danger btn-block text-center">
                                        No Items found
                                    </p>
                                </td>
                             </tr>';
      $data['totalAmount'] = 0;
      $data['totalItem'] = 0;
      $data['isEmpty'] = true;
      return json_encode($data);
    }
  }

  public function updateCart(Request $request)
  {
    $id = $request->product_id;

    if (Session::has('cart')) {
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);

      $cart->updateCart($id);
      session()->put('cart', $cart);
    }
    return json_encode(['success' => true]);
  }

  public function isCartEmpty()
  {
    if (session()->has('cart')) {
      $cart = new Cart(session()->get('cart'));
      $data['success'] = ($cart->totalPrice < 0 ? 1 : 0);
      return json_encode($data);
    }
  }/* Method End*/

  public function removeItem(Request $request)
  {
    $id = $request->product_id;
    if (Session::has('cart')) {
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);
      $cart->remove($id);
      $request->session()->put('cart', $cart);
    }
    return json_encode(['success' => true]);
  }

  public function visitCart()
  {
    $data['info'] = $this->info;
    $data['slider'] = Slider::all();
    $data['tours'] = Tour::orderBy('created_at', 'desc')->limit(9)->get();

    $data['carts'] = Session::get('cart');
    return view('frontend.pages.tour-cart')->with($data);
  }

  public function store(Request $request)
  {
    // dd($request->all);
    $id = $request->product_id;
    $pro_qty = Product::query()->findOrFail($id)->stock;
    $sold_qty = Product::query()->findOrFail($id)->stock_out;

    if ($pro_qty < $sold_qty + $request->qty) {
      return $data = 0;
    }
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    $cart->add($request->except('_token'), $id);
    $request->session()->put('cart', $cart);

    return json_encode(['success' => 1]);
  }

  public function order_product()
  {
    if (Session::has('cart')) {
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);

      if (count($cart->items) < 1) {
        return redirect()->route('/');
      } else {
        if (Auth::id()) {
          $data['info'] = UserInfo::query()->where('user_id', Auth::id())->first();
          $data['user'] = User::query()->findOrFail(Auth::id());
          return view('front.pages.checkout2')->with($data);
        }
        return view('front.pages.checkout1');
      }
    } else {
      return redirect()->route('/');
    }
  }

  public function locationStore(Request $request)
  {
    // dd($request->all());
    $request->session()->put('locationStore', $request->except('_token'));
    return redirect()->back();
  }

  public function order_check()
  {
    return view('front.pages.order-3');
  }

  public function get_coupon(Request $request)
  {
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);

    if ($cart->items != null) {
      $totalDiscount = 0;

      $coupon = Coupon::query()
        ->where('code', $request->code)
        ->where('expire_at', '>', date('Y-m-d h:i:s'))
        ->first();
      if ($coupon) {
        foreach ($cart->items as $product) {
          $coupon_discount = CouponProduct::query()
            ->where('coupon_id', $coupon->id)
            ->where('product_id', $product['item']['product_id'])
            ->first();
          if ($coupon_discount) {
            $isExists = Order::query()->where('user_id', auth()->id())
              ->where('coupon_id', $coupon->id)
              ->exists();

            $total = session('cart')->totalPrice;

            if ($isExists) {
              $discount = '\'<span class="text-danger text-bold">Sorry, Coupon already used! You Have No Discount</span>';
            } else {
              $totalDiscount += ($coupon->discount ?? 0);
            }
          }
        }
        $coupon_id = $coupon->id;
        if ($totalDiscount != 0) {
          $discount = '<span class="text-primary text-bold">Congratulation! You have BDT ৳ ' . $totalDiscount . ' Coupon Discount.</span>';
          $total = $total - $totalDiscount;
        }
      } else {
        $coupon_id = '';
        $totalDiscount = 0;
        $total = session('cart')->totalPrice;
        $discount = '\'<span class="text-danger text-bold">Sorry, Coupon Is Wrong! You Have No Discount</span>';
      }
    }

    if (session()->has('cart')) {
      $request->session()->put('coupon', ['discount' => $discount, 'discount_amount' => $totalDiscount, 'afterDiscount_total' => $total, 'coupon_id' => $coupon_id]);
    }

    $result = '';
    $result .= '
                <table class="table table-responsive table-bordered table-striped">
                    <td>' . $discount . '</td>
                    <td class="text-success text-bold text-center" width="">Total Price: ' . $total . '</td>
                </table>
        ';
    return $result;
  }

  /*public function paymentPage(){
      return view('front.pages.order-4');
  }
  */

  public function confirmOrder(Request $request)
  {
    /*$this->validate($request, [
        'mobile' => 'required|max:11',
        'district' => 'required|string',
        'thana' => 'required|string',
        'area' => 'required|string',
    ]);*/

    $user_id = Auth::user();
    // dd(session('locationStore'));
    //$address = session('locationStore');

    $orderNo = 'HdEx-' . substr(md5(time()), 0, 6);
    $isValid = Order::query()->where('order_no', $orderNo)->first();
    if (!$isValid) {
      $orderNo . '1';
    }
    $cart = '';

    if (Session::has('cart')) {
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);
    }

    if (Session::has('coupon')) {
      $coupon = session('coupon');
    } else {
      $coupon['discount'] = 0;
      $coupon['coupon_id'] = '';
    }
    //dd($coupon);
    $order = Order::query()->create([
      'order_no' => $orderNo,
      'user_id' => Auth::id(),
      'total' => $cart->totalPrice,
      'qty' => $cart->totalQty, // qty as item
      'discount' => $coupon['discount'],
      'coupon_id' => $coupon['coupon_id'],
    ]);
    Session::forget('coupon');

    $address['user_id'] = $user_id->id;
    $address['order_id'] = $order->id;
    $address['mobile'] = $request->mobile;
    $address['district'] = $request->district;
    $address['thana'] = $request->thana;
    $address['address'] = $request->address;

    OrderShip::query()->create($address); /* SHipping information saved */

    /* order Product Summary */
    foreach ($cart->items as $key => $info) {
      $product = Product::query()->findOrFail($info['item']['product_id']);

      $IsOffer = OfferProduct::query()
        ->where('product_id', $product->id)
        ->where('expire', '>', date('Y-m-d h:i:s'))
        ->first();

      if ($IsOffer != null) {
        $price = $IsOffer->offer_price;
      } else {
        $price = $product->price;
      }

      OrderProduct::query()->create([
        'order_id' => $order->id,
        'product_id' => $info['item']['product_id'],
        'qty' => $info['item']['qty'],
        'price' => $price,
        'status' => 0
      ]);
      $cart->remove($info['item']['product_id']);
      $request->session()->put('cart', $cart);
    }
    /* order Product Summary Exit */

    return redirect()->route('cart.delivery_method', $order->order_no);
  }

  public function delivery_method($order_no)
  {
    return view('front.pages.checkout-ex', compact('order_no'));
  }

  public function placeOrder($id)
  {
    $id = $id;
    session()->flash('success', 'Order successfully Placed.');
    return view('front.pages.checkout3', compact('id'));
  }


  public function cancel_order($id)
  {
    $product = OrderProduct::query()->findOrFail($id);
    $order = Order::query()->findOrFail($product->order_id);

    return view('front.pages.cancel', compact('product', 'order'));
  }

  public function confirm_cancel(Request $request)
  {
    $data = $request->except('reason', 'op_reasion');
    $data['reason'] = $request->reason . ',' . $request->op_reasion;
    $data['user_id'] = Auth::id();
    ReturnProduct::query()->create($data);
    return redirect()->route('user.profile');
  }

  public function remove_cancel($id)
  {
    $pro = ReturnProduct::query()->findOrFail($id);
    $pro->delete();
    return redirect()->route('user.profile');
  }


  public function favourite(Request $request)
  {
    $id = $request->product_id;
    $user_id = Auth::id();
    $isExists = Favourite::query()
      ->where('user_id', $user_id)
      ->where('product_id', $id)
      ->first();
    if ($isExists != null) {
      $isExists->delete();
      $res['status'] = 'deleted' . $isExists->product_id;
    } else {
      $data['user_id'] = $user_id;
      $data['product_id'] = $id;
      $fav = Favourite::query()->create($data);
      $res['status'] = 'added' . $fav->product_id;
    }
    $res['items'] = Favourite::query()
      ->where('user_id', $user_id)
      ->where('product_id', $id)
      ->get();
    return $res;
  }

  public function favourite_storage(Request $request)
  {
    $id = $request->product_id;
    $user_id = Auth::id();
    $isExists = Favourite::query()
      ->where('user_id', $user_id)
      ->where('product_id', $id)
      ->first();
    if ($isExists == null) {
      $data['user_id'] = $user_id;
      $data['product_id'] = $id;
      $fav = Favourite::query()->create($data);
      $res['status'] = 'added' . $fav->product_id;
    }
    $res['items'] = Favourite::query()
      ->where('user_id', $user_id)
      ->where('product_id', $id)
      ->get();
    return $res;
  }
}
