<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StitchingServiceController;
use App\Http\Controllers\Admin\BranchController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::view('demo','admin.demo');
Route::view('/admin/demo', 'admin.demo')->name('admin.demo');

Route::view('/About', 'lvAbout');

// Route ::get('iv_task2',function($name='Rohan'){
//     return $name ;
// });

Route::get('/iv_task2/{name?}', function ($name = 'Rohan') {
    return view('iv_task2', ['name' => $name]);
})->name('iv_task2');




/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Admin Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/dashboard',
        [DashboardController::class, 'index']
    )->name('admin.dashboard');


    /*
    |--------------------------------------------------------------------------
    | Categories
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/categories', [CategoryController::class, 'index'] )->name('admin.categories');

    Route::post('/admin/categories',[CategoryController::class, 'store'])->name('admin.categories.store');

    Route::put(
        '/admin/categories/{category}',
        [CategoryController::class, 'update']
    )->name('admin.categories.update');

    Route::delete(
        '/admin/categories/{category}',
        [CategoryController::class, 'destroy']
    )->name('admin.categories.destroy');


    /*
    |--------------------------------------------------------------------------
    | Fancy Products
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/products',[ProductController::class, 'index'])->name('admin.products');

    Route::post( '/admin/products',[ProductController::class, 'store'] )->name('admin.products.store');

    Route::put( '/admin/products/{product}',[ProductController::class, 'update'] )->name('admin.products.update');

    Route::delete('/admin/products/{product}',[ProductController::class, 'destroy'])->name('admin.products.destroy');


    /*
    |--------------------------------------------------------------------------
    | Stitching Services
    |--------------------------------------------------------------------------
    */

    // List
    Route::get( '/admin/stitching-services',[StitchingServiceController::class, 'index'])->name('admin.stitching-services.index');

    // Create Page
    Route::get('/admin/stitching-services/create',[StitchingServiceController::class, 'create'])->name('admin.stitching-services.create');


    // Store
    Route::post(
        '/admin/stitching-services',
        [StitchingServiceController::class, 'store']
    )->name('admin.stitching-services.store');


    // Edit Page
    Route::get(
        '/admin/stitching-services/{stitchingService}/edit',
        [StitchingServiceController::class, 'edit']
    )->name('admin.stitching-services.edit');


    // Update
    Route::put(
        '/admin/stitching-services/{stitchingService}',
        [StitchingServiceController::class, 'update']
    )->name('admin.stitching-services.update');


    // Delete
    Route::delete(
        '/admin/stitching-services/{stitchingService}',
        [StitchingServiceController::class, 'destroy']
    )->name('admin.stitching-services.destroy');


    /*
    |--------------------------------------------------------------------------
    | Stitching Service Images
    |--------------------------------------------------------------------------
    */

    Route::delete(
        '/admin/stitching-service-images/{id}',
        [StitchingServiceController::class, 'deleteImage']
    )->name('admin.stitching-services.images.delete');


    Route::post(
        '/admin/stitching-service-images/{id}/primary',
        [StitchingServiceController::class, 'setPrimaryImage']
    )->name('admin.stitching-services.images.primary');


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    |
    | Laravel Breeze navigation.blade.php uses these routes.
    |
    */

    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');


    /*
    |--------------------------------------------------------------------------
    | Orders
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/orders',
        function () {
            return view('admin.orders.index');
        }
    )->name('admin.orders');


    /*
    |--------------------------------------------------------------------------
    | Customers
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/customers',
        function () {
            return view('admin.customers.index');
        }
    )->name('admin.customers');


    /*
    |--------------------------------------------------------------------------
    | Reviews
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/reviews',
        function () {
            return view('admin.reviews.index');
        }
    )->name('admin.reviews');


    /*
    |--------------------------------------------------------------------------
    | Messages
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/messages',
        function () {
            return view('admin.messages.index');
        }
    )->name('admin.messages');


    /*
    |--------------------------------------------------------------------------
    | Reports
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/reports',
        function () {
            return view('admin.reports.index');
        }
    )->name('admin.reports');


    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/settings',
        function () {
            return view('admin.settings.index');
        }
    )->name('admin.settings');

    
// demo 

Route::get('/admin/branches', [BranchController::class, 'index'])
    ->name('admin.branches');
    
  

});

 

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';