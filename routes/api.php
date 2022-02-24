<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\DishController;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\RestaurantResource;
use App\Http\Resources\DishResource;
use App\Http\Resources\ClientResource;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Dish;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:sanctum'], function () {
    /**
     * Restaurants
     */
    Route::get('/restaurants', function () {
        return RestaurantResource::collection(Restaurant::paginate(10));
    });
    Route::get('restaurants/{id}', function ($id) {
        return new RestaurantResource(Restaurant::findOrFail($id));
    });
    Route::put('restaurants/', [RestaurantController::class, 'apiStore']);
    Route::delete('restaurants/{restaurant}', [RestaurantController::class, 'apiDelete']);

    /**
     * Dishes
     */
    Route::get('dishes/{id}', function ($id) {
        return new DishResource(Dish::findOrFail($id));
    });
    Route::get('dishes/category/{id}', [DishController::class, 'apiDishesByCategory']);
    Route::put('restaurants/{id}/dish', [DishController::class, 'apiStoreDish']);
    Route::delete('dishes/{dish}', [DishController::class, 'apiDeleteDish']);

    /**
     * Clients
     */
    Route::get('/clients/{dni}', function ($dni) {
        return new ClientResource(User::where('dni', $dni)->get());
    });
    Route::get('/clients/{dni}/orders', [ClientController::class, 'apiOrders']);
    Route::get('/clients/{dni}/orders/{id}', [ClientController::class, 'apiOrder']);
    /**
     * Categories
     */
    Route::get('/categories', function () {
        return CategoryResource::collection(Category::all());
    });
});
