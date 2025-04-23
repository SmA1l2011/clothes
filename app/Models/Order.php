<?php

namespace App\Models;

use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table = 'orders';
    public $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     */
    public $fillable = [
        'product_id',
        'customer_id',
        'count',
        'total',
    ];
    
    public static function getAllOrders()
    {
        return DB::table("orders")->get();
    }

    public static function ordersCreate($data)
    {
        DB::table("orders")->insert([
            "product_id" => $data["product_id"],
            "user_id" => $data["user_id"],
            "count" => $data["count"],
            "price" => $data["price"],
            "created_at" => now(),
            "updated_at" => now(),
        ]);
    }
}