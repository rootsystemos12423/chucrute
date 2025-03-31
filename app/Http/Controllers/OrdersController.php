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

    public function show($id){

        $order = CheckoutOrder::find($id);

        $order_customer_data = $order->customer_data ? json_decode($order->customer_data, true) : [];
        $order_shipping_data = $order->shipping_data ? json_decode($order->shipping_data, true) : [];

        return view('orders.show', compact('order', 'order_customer_data', 'order_shipping_data'));
    }

    public function recover_carts(){

        return view('orders.cart');
    }
}
