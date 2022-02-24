<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dish;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    const STATUSES = [
        'received' => 'Received',
        'prepared' => 'Prepared',
        'delivered' => 'Delivered',
        'canceled' => 'Canceled'
    ];

    protected $fillable = [
        'client_id', 'restaurant_id', 'deliveryman_id', 'state'
    ];

    public function getClient()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function getRestaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

    public function getDeliveryman()
    {
        return $this->belongsTo(User::class, 'deliveryman_id');
    }

    public function getDishes()
    {
        return $this->belongsToMany(Dish::class, 'dish_order', 'order_id', 'dish_id')
            ->withPivot('quantity', 'price_total');
    }

    public function getReceivedDishes()
    {
        return '';
    }

    public function getFinishedDishes()
    {
        return '';
    }

    public function getDeliveredDishes()
    {
        return '';
    }

    public function getCanceledDishes()
    {
        return '';
    }
}
