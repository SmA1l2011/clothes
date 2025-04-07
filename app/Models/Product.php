<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = 'products';
    public $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     * 
     */
    public $fillable = [
        'subcategory_id',
        'title',
        'description',
        'price',
        'stock',
    ];

    public static function getAllProducts($sortBy, $filters = []): Collection 
    {
        if ($sortBy == "priceU") {
            return DB::table("products")->get()->sortByDesc("price");
        } else {
            $sortBy = "price";
        }
        return DB::table("products")->get()->sortBy($sortBy);
    }

    public static function getProduct($id): Collection 
    {
        return DB::table("products")->where("id", $id)->get();
    }
}
