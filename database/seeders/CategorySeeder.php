<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    private $categories = [
        'Argentinian', 'Asian', 'BBQ', 'Breakfast', 'Burgers', 'Burritos',
        'Cakes', 'Chicken', 'Chinese', 'Curry', 'Desserts', 'Fast Food',
        'Ice Cream', 'Indian', 'Italian', 'Kebabs', 'Mediterranean', 'Mexican',
        'Moroccan', 'Pasta', 'Pizza', 'Salads', 'Sandwiches',
        'Seafood', 'Spanish', 'Steak', 'Sushi', 'Vegan', 'Vegetarian'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < sizeof($this->categories); $i++) {
            DB::table('categories')->insert([
                'name' => $this->categories[$i],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
