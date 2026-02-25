<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\CustomerController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Product Routes - Single source for all products
Route::prefix('products')->name('products.')->group(function () {
    // Products index page (grid view of all products)
    Route::get('/', [ProductController::class, 'index'])->name('index');
    
    // Single product page (with size selection)
    Route::get('/{slug}', [ProductController::class, 'show'])->name('show');
});
Route::get('/olfactory-family/{family}', [App\Http\Controllers\ProductController::class, 'byOlfactoryFamily'])->name('olfactory.family');
// Keep these for backward compatibility or redirect them
Route::get('/shop', function() {
    return redirect()->route('products.index');
})->name('shop.index');

Route::get('/decants', function() {
    return redirect()->route('products.index', ['type' => 'decant']);
})->name('products.decants');

Route::get('/full-bottles', function() {
    return redirect()->route('products.index', ['type' => 'full']);
})->name('products.full-bottles');

// Brand routes (optional)
Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/brands/{slug}', [BrandController::class, 'show'])->name('brands.show');

//search perfumes
Route::get('/search', [SearchController::class, 'search'])->name('search');

//contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// Other pages
Route::view('/about', 'about')->name('about');
//faq page
Route::get('/faq', function () {
    return view('faq');
})->name('faq');
// Shipping & Returns
Route::get('/shipping', function () {
    return view('shipping');
})->name('shipping');

// Privacy Policy
Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

// Checkout routes
Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
//admin routes
Route::prefix('admin')->group(function () {

    // Admin login page
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');

    // Protected dashboard
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        // Orders
        Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
        Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.update-status');

        // Products
        Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products');
        Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
        Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');
        Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');

        // Brands
        Route::get('/brands', [AdminBrandController::class, 'index'])->name('admin.brands');
        Route::get('/brands/create', [AdminBrandController::class, 'create'])->name('admin.brands.create');
        Route::post('/brands', [AdminBrandController::class, 'store'])->name('admin.brands.store');
        Route::get('/brands/{brand}/edit', [AdminBrandController::class, 'edit'])->name('admin.brands.edit');
        Route::put('/brands/{brand}', [AdminBrandController::class, 'update'])->name('admin.brands.update');
        Route::delete('/brands/{brand}', [AdminBrandController::class, 'destroy'])->name('admin.brands.destroy');

        // Customers & Payments
        Route::get('/customers', [CustomerController::class, 'index'])->name('admin.customers');
        Route::get('/payments', [OrderController::class, 'payments'])->name('admin.payments');
    });
});