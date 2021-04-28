<?php

namespace App\Http\Controllers\Admin;

use App\Model\Order;
use App\Model\Product;
use App\Model\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['orders'] = Order::all();
      return view('admin.order.index', $data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['order'] = Order::find($id);
        $data['orderProducts'] = OrderProduct::where('order_id',$id)->get();
        // $orderProduct = OrderProduct::where('order_id',$id)->get('product_id')->toArray();

        // $data['products'] = Product::whereIn('id',$orderProduct)->get();
        // dd($products);
        return view('admin.order.show', $data);
        // dd($order);
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
    public function changeStatus(Request $request)
    {
      $order = Order::find($request->id);
      $order->order_status = $request->value;
      $order->save();
       return "success";
    }
    public function changeReturn(Request $request)
    {

      $order = OrderProduct::find($request->id);
      $order->return_status = $request->value;
      if($request->value == 1)
      {
        $order->is_return = 1;
      }elseif($request->value == 2){

        // return $request->qty;
        $order->is_return = 1;
        $product = Product::where('id',$request->product_id)->first();
        $currentOrder = Order::find($request->order_id);
        $currentOrder->total-= ($request->qty*$order->price);
        $product->stock_out -= $request->qty;

        $product->save();
        $currentOrder->save();


      }else{
        $order->is_return = 0;

      }
      $order->save();

      return 'success';
    }
    public function userOrder($id)
    {
      $data['orders'] = Order::where('user_id',$id)->get();
      // dd($userOrders);
      return view('admin.order.index', $data);
    }
}
