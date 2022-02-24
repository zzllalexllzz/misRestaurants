<?php

use App\Http\Livewire\Client\CartComponent;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DeliverymanController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * CLIENTS (accesible for all registered users)
 */
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('main', [MainController::class, 'indexMain'])->name('main');
    Route::get('restaurants', [MainController::class, 'indexRestaurants'])->name('restaurants');
    Route::get('restaurant/{id}', [MainController::class, 'showRestaurant']);
    Route::get('dishes/{id}', [MainController::class, 'indexDishes']);
    Route::get('dish/{id}', [MainController::class, 'showDish']);
    Route::get('categories/{category}', [MainController::class, 'showDishByCategory']);
    Route::view('categories', 'client.categories')->name('categories');
    Route::view('orders', 'client.orders')->name('orders');

    Route::view('cart/checkout', 'client.cart')->name('checkout');
    Route::get('cart/add/{id}', [CartComponent::class, 'add']); // Livewire
    Route::get('invoice/{id}', [InvoiceController::class, 'show']);
});

/**
 * INTRANET
 */
Route::group(['middleware' => 'auth', 'prefix' => 'intranet'], function () {

    /**
     * ALL INTRANET USERS
     */
    Route::group(['middleware' => 'intranetRoles'], function () {
        Route::view('/dashboard', 'intranet.dashboard')->name('intranet');
        Route::get('orders/{restaurant}', [OrderController::class, 'indexByRestaurant']);
        Route::get('orders/detail/{order}', [OrderController::class, 'show']);
        Route::resource('restaurants', RestaurantController::class);
    });

    /**
     * ONLY ADMIN ROLE
     */
    Route::group(['middleware' => 'role:admin'], function () {
        Route::get('clients/{client}/delete', [ClientController::class, 'destroy']);
        Route::get('clients', [ClientController::class, 'index']);
        Route::resource('clients', ClientController::class);

        Route::get('deliverymen/{deliveryman}/delete', [DeliverymanController::class, 'destroy']);
        Route::resource('deliverymen', DeliverymanController::class);
    });

    /**
     * DELIVERYMAN ROLE
     */
    Route::group(['middleware' => 'role:deliveryman'], function () {
        Route::resource('orders', OrderController::class);
    });

    /**
     * RMANAGER ROLE
     */
    Route::group(['middleware' => 'role:rmanager'], function () {
        Route::get('restaurants/{restaurant}/delete', [RestaurantController::class, 'destroy']);
        Route::get('dishes/{restaurant}', [DishController::class, 'index'])->name('dishes');
        Route::get('dishes/{dish}/delete', [DishController::class, 'destroy']);
        Route::resource('dishes', DishController::class);

        Route::get('categories/{category}/delete', [CategoryController::class, 'destroy']);
        Route::resource('categories', CategoryController::class);
    });
});
