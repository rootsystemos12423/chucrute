<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckoutOrder;

class OrdersController extends Controller
{
    public function index(){

        $orders = CheckoutOrder::where('store_id', session('store_id'))->get();
        $count = CheckoutOrder::where('store_id', session('store_id'))->count();

        return view('orders.index', compact('orders', 'count'));
    }

    public function show(){

        return view('orders.show');
    }

    public function recover_carts(){

        return view('orders.cart');
    }
}
