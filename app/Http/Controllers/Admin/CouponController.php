<?php

namespace App\Http\Controllers\Admin;

use App\Model\Coupon;
use App\Model\CouponProduct;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CouponController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\View\View
   */
  public function index()
  {
    $this->checkPermission(['admin', 'coupon.all', 'coupon.add', 'coupon.view', 'coupon.edit', 'coupon.delete']);
    $coupons = Coupon::all();
    return view('admin.coupon.index', compact('coupons'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\View\View
   */
  public function create()
  {
    $this->checkPermission(['admin', 'coupon.all', 'coupon.add']);
    $products = Product::where('status', 1)->get();
    return view('admin.coupon.create', compact('products'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request)
  {
    $this->checkPermission(['admin', 'coupon.all', 'coupon.add']);
    $request->validate([
      'code'         => 'required',
      'product_id'   => 'required|array',
      'product_id.*' => 'required|exists:products,id',
      'discount'     => 'required|integer',
      'expire_at'    => 'nullable|date',
      'status'       => 'required',
    ]);

    $new_coupon = Coupon::create([
      'code'      => $request->input('code'),
      'discount'  => $request->input('discount'),
      'expire_at' => $request->input('expire_at'),
      'status'    => $request->input('status'),
    ]);

    foreach ($request->product_id as $product) {
      CouponProduct::query()->create([
        'coupon_id'  => $new_coupon->id,
        'product_id' => $product
      ]);
    }

    $message = 'Coupon Created Successfully';
    return back()->with('Smsg', $message);
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\View\View
   */
  public function edit(Coupon $coupon)
  {
    $this->checkPermission(['admin', 'coupon.all', 'coupon.edit']);
    $products    = Product::where('status', 1)->get();
    $oldProducts = CouponProduct::where('coupon_id', $coupon->id)->pluck('product_id');
    return view('admin.coupon.edit', compact('coupon', 'products', 'oldProducts'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(Request $request, Coupon $coupon)
  {
    $this->checkPermission(['admin', 'coupon.all', 'coupon.edit']);
    $request->validate([
      'code'         => 'required',
      'product_id'   => 'required|array',
      'product_id.*' => 'required|exists:products,id',
      'discount'     => 'required|integer',
      'expire_at'    => 'nullable|date',
      'status'       => 'required',
    ]);

    // dynamic product in feature
    $oldProducts = CouponProduct::where('coupon_id', $coupon->id)->pluck('product_id')->toArray();
    $newProducts = $request->input('product_id') ?? [];

    if ($oldProducts) {
      $inputProducts = $newProducts;
      $newProducts   = array_diff($inputProducts, $oldProducts);
      $oldDeletes    = array_diff($oldProducts, $inputProducts);
      CouponProduct::query()->whereIn('product_id', $oldDeletes)->delete();
    }

    if ($newProducts) {
      foreach ($newProducts as $product) {
        CouponProduct::create([
          'coupon_id'  => $coupon->id,
          'product_id' => $product,
        ]);
      }
    }

    $coupon->update([
      'code'      => $request->input('code'),
      'discount'  => $request->input('discount'),
      'expire_at' => $request->input('expire_at'),
      'status'    => $request->input('status'),
    ]);

    $message = 'Coupon Updated Successfully';
    return back()->with('Smsg', $message);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param Coupon $coupon
   * @return \Illuminate\Http\RedirectResponse
   * @throws \Exception
   */
  public function destroy(Coupon $coupon)
  {
    $this->checkPermission(['admin', 'coupon.all', 'coupon.delete']);
    $coupon->delete();

    return redirect()->back()->with('Smsg', 'Delete Successfully.');
  }
}
