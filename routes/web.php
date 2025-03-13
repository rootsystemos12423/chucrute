<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\AppsController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\CheckoutBuilderController;


Route::get('/', function () {
    return abort('403', 'Working');
});

Route::middleware([
    'auth',
])->group(function () {
    // Rota da dashboard, agora utilizando o controlador
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports');
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders');
    Route::get('/orders/{id}', [OrdersController::class, 'show'])->name('order');
    Route::get('/recover/carts', [OrdersController::class, 'recover_carts'])->name('recover_carts');
    Route::get('/products', [ProductsController::class, 'index'])->name('products');
    Route::prefix('marketing')->group(function () {
        Route::get('/cupons', [MarketingController::class, 'cuponsIndex'])->name('cupons');
        Route::get('/orderbump', [MarketingController::class, 'orderbumpIndex'])->name('orderbump');
        Route::get('/orderbump/create', [MarketingController::class, 'orderbump_create'])->name('orderbump.create');
        Route::post('/orderbump/create/post', [MarketingController::class, 'store_orderbump_info'])->name('orderbump.store');
        Route::get('/upsell', [MarketingController::class, 'upsellIndex'])->name('upsell');
    });
    Route::get('/apps', [AppsController::class, 'index'])->name('apps');
    Route::prefix('apps')->group(function () {
        Route::get('/', [AppsController::class, 'index'])->name('apps');
        Route::get('/shopify', [AppsController::class, 'shopify'])->name('shopify');
    });
    Route::prefix('checkout')->group(function () {
        Route::get('/descontos', [CheckoutController::class, 'indexDescontos'])->name('descontos');
        Route::get('/socialproof', [CheckoutController::class, 'indexProvas'])->name('socialproof');
        Route::get('/pagamento', [CheckoutController::class, 'indexPagamentos'])->name('pagamentos');
        Route::get('/pagamento/{gateway}', [CheckoutController::class, 'indexGatewayConfig'])->name('gatewayconfig');
        Route::post('/store/checkout-discounts', [CheckoutController::class, 'storePaymentDiscounts'])->name('store.checkout.discounts');
    });
    Route::prefix('config')->group(function () {
        Route::get('/geral', [ConfigController::class, 'geralIndex'])->name('configgeral');
        Route::get('/domains', [ConfigController::class, 'dominiosIndex'])->name('dominios');
        Route::post('/store/domain', [ConfigController::class, 'storeDomain'])->name('store.config.domain');
        Route::get('/logistic', [ConfigController::class, 'logisticIndex'])->name('logistic');
        Route::get('/logistic/create', [ConfigController::class, 'LogisticShow'])->name('logistic.show.create');

    });

    Route::prefix('builder')->group(function () {
        Route::get('/personalization/yampi', [CheckoutBuilderController::class, 'yampi'])->name('builder.yampi');
        Route::post('/personalization/reciver', [CheckoutBuilderController::class, 'store_personalization'])->name('builder.store.personalization');
    });

    Route::post('/create/checkout_store', [DashboardController::class, 'create_checkout_store'])->name('create.checkout.store');
    Route::post('/change/checkout_change', [DashboardController::class, 'change_checkout_store'])->name('change.checkout.store');
});

Route::prefix('checkout')->group(function () {
    Route::get('/', [CheckoutController::class, 'show'])->name('show.checkoout');
    Route::get('/redirect/cart/{token}', [CheckoutController::class, 'checkout_redirect_to_link'])->name('redirect.checkoout');
    Route::get('/payment/finalization/{external_reference}', [CheckoutController::class, 'payment_finzalization'])->name('finalization.checkout');
    Route::get('/payment/completed/{external_reference}', [CheckoutController::class, 'payment_complete'])->name('complete.checkout');
});