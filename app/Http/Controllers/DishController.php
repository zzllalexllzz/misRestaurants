<?php

namespace App\Http\Controllers;

use App\Http\Resources\DishResource;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class DishController extends Controller
{
    private $prefix = 'intranet.dishes.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Restaurant $restaurant)
    {
        return view($this->prefix . 'index', ['restaurant' => $restaurant]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        // $this->authorize('view', $dish);
        return view($this->prefix . 'show', ['dish' => $dish]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        //
    }
    public function apiStoreDish(Request $request, $restaurantId)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $dish = new Dish;
        $dish->category_id = $request->category_id;
        $dish->restaurant_id = $restaurantId;
        $dish->name = $request->name;
        $dish->description = $request->description;
        $dish->photo_path = $request->photo_path;
        $dish->price = $request->price;
        $dish->save();

        return response([
            'dish' => new DishResource($dish),
            'message' => 'Created succesfully'
        ], 201);
    }

    public function apiDeleteDish(Dish $dish)
    {
        $this->authorize('delete', $dish);
        $dish->delete();

        return response(['message' => 'Deleted succesfully'], 200);
    }

    public function apiDishesByCategory($categoryId)
    {
        $dishes = Dish::where('category_id', $categoryId)->get();

        return response(['dishes' => new DishResource($dishes)], 200);
    }
}
