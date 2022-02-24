<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * Scope the categories by a search.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%' . $search . '%');
    }

    public static function getCategories($restaurantId)
    {
        return DB::table('categories')
            ->join('dishes', 'categories.id', '=', 'dishes.category_id')
            ->select('categories.*')
            ->groupBy('categories.id', 'restaurant_id')
            ->having('restaurant_id', $restaurantId)
            ->get();
    }
}
