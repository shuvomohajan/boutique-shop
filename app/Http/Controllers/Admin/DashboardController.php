<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\CustomProduct;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function customProduct()
    {
        $custom_orders = CustomProduct::latest('id')->get();
        return view('admin.custom_order.index', compact('custom_orders'));
    }
}
