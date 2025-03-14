<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\AppsController;

Route::post('public/shopify/cart', [CheckoutController::class, 'shopify_cart_payload']);
Route::options('public/shopify/cart', [CheckoutController::class, 'shopify_cart_payload']);

Route::post('store/shopify/credentials', [AppsController::class, 'storeShopifyCheckoutStore']);

// DASHBOARD ROUTES
Route::get('dashboard/orderbumps/search', [MarketingController::class, 'list_products_orderbump']);
Route::post('dashboard/logistic/store', [ConfigController::class, 'logistic_store']);


// CHECKOUT ROUTES
Route::post('checkout/customers/personal_data', [CheckoutController::class, 'recive_personal_data']);
Route::post('checkout/customers/receive_customer_shipment_address', [CheckoutController::class, 'receive_customer_shipment_address']);
Route::post('checkout/customers/get_orderbump_list', [CheckoutController::class, 'get_orderbump_list']);
Route::post('checkout/cart/update-quantity', [CheckoutController::class, 'item_update_quantity']);
Route::post('checkout/cart/remove-item', [CheckoutController::class, 'item_remove_item']);
Route::post('checkout/cart/total', [CheckoutController::class, 'cart_total_value']);
Route::post('checkout/customers/select_offer_orderbump', [CheckoutController::class, 'select_offer_orderbump']);
Route::post('checkout/customers/remove_offer_orderbump', [CheckoutController::class, 'remove_offer_orderbump']);
Route::post('checkout/shipment/cep_lookup', [CheckoutController::class, 'cep_lookup']);
Route::post('checkout/list/items', [CheckoutController::class, 'getCartItems']);
Route::post('checkout/list/list_shippiment_methods', [CheckoutController::class, 'list_shippiment_methods']);
Route::post('checkout/recive/recive_selected_shippiment_method', [CheckoutController::class, 'recive_selected_shippiment_method']);
Route::post('checkout/recive/shippiment_data', [CheckoutController::class, 'search_shippiment_data']);
Route::post('checkout/payment/generatePixPayment', [CheckoutController::class, 'generatePixPayment'])->name('generate.pixpayment');      
Route::post('checkout/payment/processCardPayment', [CheckoutController::class, 'processCardPayment']);    
