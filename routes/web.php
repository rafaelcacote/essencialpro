<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminQuoteController;
use App\Http\Controllers\Admin\AdminPartnerController;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/quem-somos', [PageController::class, 'quemSomos'])->name('quem-somos');
Route::get('/about', fn () => redirect()->route('quem-somos'))->name('about');
Route::get('/service', [PageController::class, 'service'])->name('service');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [QuoteController::class, 'store'])->name('contact.submit');
Route::get('/project', [PageController::class, 'project'])->name('project');
Route::get('/feature', [PageController::class, 'feature'])->name('feature');
Route::get('/team', [PageController::class, 'team'])->name('team');
Route::get('/testimonial', [PageController::class, 'testimonial'])->name('testimonial');
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categoria/{category:slug}', [ProductController::class, 'category'])->name('categories.show');
Route::get('/scan-fit', [PageController::class, 'scanfit'])->name('scanfit');
Route::get('/404', [PageController::class, 'notFound'])->name('404');

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
    });
});
