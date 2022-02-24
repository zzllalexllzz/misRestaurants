<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dish;
use App\Models\Order;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'city', 'phone', 'email', 'latitude', 'longitude', 'user_id', 'photo_path'
    ];

    /**
     * Scope the restaurants by a search.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('city', 'like', '%' . $search . '%');
    }

    public function getDishes()
    {
        return $this->hasMany(Dish::class);
    }

    public function getOrders()
    {
        return $this->hasMany(Order::class);
    }
}
