<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Division;
use App\Model\ShippingAddress;
use Illuminate\Http\Request;

class ShippingAddressController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $addresses = ShippingAddress::where('user_id', auth()->id())->get();
    return response()->view('admin.shipping_address.index', compact('addresses'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $divisions = Division::all();
    return response()->view('admin.shipping_address.create', compact('divisions'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request)
  {
    $request->validate([
      'country'  => 'required|string',
      'division' => 'required|exists:divisions,id',
      'city'     => 'required|string',
      'area'     => 'required|string',
      'zip'      => 'required|integer',
      'address'  => 'required|string',
      'contact'  => 'nullable|string',
    ]);

    ShippingAddress::create([
      'user_id'     => auth()->id(),
      'country'     => $request->input('country'),
      'division_id' => $request->input('division'),
      'city'        => $request->input('city'),
      'area'        => $request->input('area'),
      'zip'         => $request->input('zip'),
      'address'     => $request->input('address'),
      'contact'     => $request->input('contact'),
    ]);
    return back()->with('Smsg', 'Shipping Address Added Successfully');
  }

  /**
   * Display the specified resource.
   *
   * @param \App\Model\ShippingAddress $shippingAddress
   * @return \Illuminate\Http\Response
   */
  public function show(ShippingAddress $shippingAddress)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $address = ShippingAddress::findOrFail($id);
    $divisions = Division::all();
    return response()->view('admin.shipping_address.edit', compact('address', 'divisions'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(Request $request, $id)
  {
    $address = ShippingAddress::findOrFail($id);

    $request->validate([
      'country'  => 'required|string',
      'division' => 'required|exists:divisions,id',
      'city'     => 'required|string',
      'area'     => 'required|string',
      'zip'      => 'required|integer',
      'address'  => 'required|string',
      'contact'  => 'nullable|string',
    ]);

    $address->update([
      'country'     => $request->input('country'),
      'division_id' => $request->input('division'),
      'city'        => $request->input('city'),
      'area'        => $request->input('area'),
      'zip'         => $request->input('zip'),
      'address'     => $request->input('address'),
      'contact'     => $request->input('contact'),
    ]);
    return back()->with('Smsg', 'Shipping Address Updated Successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param $id
   * @return \Illuminate\Http\RedirectResponse
   * @throws \Exception
   */
  public function destroy($id)
  {
    ShippingAddress::findOrFail($id)->delete();
    return back()->with('Smsg', 'Shipping Address Deleted Successfully');
  }
}
