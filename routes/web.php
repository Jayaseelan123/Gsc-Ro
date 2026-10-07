<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/products', [FrontendController::class, 'products'])->name('products');
Route::get('/products/{category:slug}', [FrontendController::class, 'categoryProducts'])->name('products.category');
Route::get('/product/{product:slug}', [FrontendController::class, 'productDetails'])->name('product.details');
Route::get('/gallery', [FrontendController::class, 'gallery'])->name('gallery');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/privacy-policy', [FrontendController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-service', [FrontendController::class, 'terms'])->name('terms');

Route::get('/requirement', [FrontendController::class, 'requirement'])->name('requirement');
Route::post('/requirement', [FrontendController::class, 'submitRequirement'])->name('requirement.submit');
Route::post('/contact', [FrontendController::class, 'submitEnquiry'])->name('contact.submit');

// Admin Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Admin Resources
    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/banners', BannerController::class);
    Route::resource('/gallery', GalleryController::class);
    
    // Enquiries
    Route::get('/enquiries', [EnquiryController::class, 'index'])->name('enquiries.index');
    Route::get('/enquiries/{enquiry}', [EnquiryController::class, 'show'])->name('enquiries.show');
    Route::put('/enquiries/{enquiry}', [EnquiryController::class, 'update'])->name('enquiries.update');
    Route::delete('/enquiries/{enquiry}', [EnquiryController::class, 'destroy'])->name('enquiries.destroy');
    
    // Website Settings
    Route::get('/settings', [WebsiteSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [WebsiteSettingController::class, 'update'])->name('settings.update');

    // Profile (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
