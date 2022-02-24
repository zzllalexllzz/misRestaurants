<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Dish;
use App\Models\Category;

class MainController extends Controller
{

    /**
     * Display the main page.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMain()
    {
        $dishes = Dish::all();
        return view('client.main', ['dishes' => $dishes]);
    }

    /**
     * Display a listing of the restaurants.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexRestaurants()
    {
        return view('client.restaurants');
    }

    /**
     * Display a listing of the dishes of a restaurant.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDishes($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $dishes = $restaurant->getDishes;
        return view('client.dishes', ['restaurant' => $restaurant->name, 'dishes' => $dishes]);
    }

    /**
     * Display the specified restaurant.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRestaurant($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $dishes = $restaurant->getDishes;
        return view('client.restaurant', ['restaurant' => $restaurant, 'dishes' => $dishes]);
    }

    /**
     * Display the specified dish.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDish($id)
    {
        $dish = Dish::findOrFail($id);
        $restaurant = $dish->getRestaurant;
        return view('client.dish', ['dish' => $dish, 'restaurant' => $restaurant]);
    }

    /**
     * Display the dihes by specified category.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDishByCategory(Category $category)
    {
        $dishes = Dish::where('category_id', $category->id)->paginate(10);
        return view('client.category', ['dishes' => $dishes, 'category' => $category]);
    }
}
