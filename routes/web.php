<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminPartnerController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminQuoteController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\EasypayWebhookController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/quem-somos', [PageController::class, 'quemSomos'])->name('quem-somos');
Route::get('/about', fn () => redirect()->route('quem-somos'))->name('about');
Route::get('/service', [PageController::class, 'service'])->name('service');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/politica-de-envios-e-entregas', [PageController::class, 'shippingPolicy'])->name('shipping-policy');
Route::get('/trocas-devolucoes-reembolsos', [PageController::class, 'returnsPolicy'])->name('returns-policy');
Route::get('/termos-e-condicoes', [PageController::class, 'terms'])->name('terms');
Route::get('/politica-de-privacidade', [PageController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/personalizacao', [PageController::class, 'personalization'])->name('personalization');
Route::get('/suporte', [PageController::class, 'support'])->name('support');
Route::post('/contact', [QuoteController::class, 'store'])->name('contact.submit');
Route::get('/pedir-orcamento', [PageController::class, 'quote'])->name('quote');
Route::get('/procurar', [PageController::class, 'search'])->name('search');
Route::get('/acompanhar-pedido', [PageController::class, 'trackOrder'])->name('orders.track');
Route::get('/lista-de-desejos', [PageController::class, 'wishlist'])->name('wishlist');
Route::get('/categoria-placeholder/{slug}', [PageController::class, 'categoryPlaceholder'])->name('category.placeholder');
Route::get('/project', [PageController::class, 'project'])->name('project');
Route::get('/feature', [PageController::class, 'feature'])->name('feature');
Route::get('/team', [PageController::class, 'team'])->name('team');
Route::get('/testimonial', [PageController::class, 'testimonial'])->name('testimonial');
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categoria/{category:slug}', [ProductController::class, 'category'])->name('categories.show');
Route::get('/scan-fit', [PageController::class, 'scanfit'])->name('scanfit');
Route::get('/404', [PageController::class, 'notFound'])->name('404');

Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/items', [CartController::class, 'store'])->name('cart.items.store');
Route::patch('/cart/items/{item}', [CartController::class, 'update'])->name('cart.items.update');
Route::delete('/cart/items/{item}', [CartController::class, 'destroy'])->name('cart.items.destroy');
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

// Webhook do easypay — sem autenticação nem CSRF (excluído em bootstrap/app.php)
Route::post('/webhook/easypay', [EasypayWebhookController::class, 'handle'])->name('webhook.easypay');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout.create');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/pagamento/retorno/{order}', [CheckoutController::class, 'paymentReturn'])->name('checkout.payment.return');
    Route::get('/checkout/pagamento/falha/{order}', [CheckoutController::class, 'paymentFailure'])->name('checkout.payment.failure');
    Route::get('/checkout/pagamento/cancelado/{order}', [CheckoutController::class, 'paymentCancel'])->name('checkout.payment.cancel');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

    Route::get('/minha-conta', [AccountController::class, 'dashboard'])->name('dashboard');
    Route::get('/minha-conta/pedidos', [AccountController::class, 'orders'])->name('account.orders');
    Route::get('/minha-conta/pedidos/{order}', [AccountController::class, 'showOrder'])->name('account.orders.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('products', AdminProductController::class)->except(['show']);
        Route::resource('categories', AdminCategoryController::class)->except(['show']);
        Route::resource('quotes', AdminQuoteController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::resource('partners', AdminPartnerController::class)->except(['show']);
        Route::resource('orders', AdminOrderController::class)->only(['index', 'show', 'update', 'destroy']);
    });
});

require __DIR__ . '/auth.php';
