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

    public static function getAllProducts($sortBy = "id", $filters = [])
    {
        $query = Product::query();
        if (!empty($filters["title"])) {
            $query->where("title", "like", "%" . $filters["title"] . "%");
        }
        if (!empty($filters["minPrice"])) {
            $query->where("price", ">=", $filters["minPrice"]);
        } 
        if (!empty($filters["maxPrice"])) {
            $query->where("price", "<=", $filters["maxPrice"]);
        } 
        if (!empty($filters["subcategory"]) && $filters["subcategory"] !== "all") {
            $query->where("subcategory_id", $filters["subcategory"]);
        }
        $query = $query->get();
        if ($sortBy == "priceD") {
            $products = $query->sortBy("price", SORT_REGULAR, "desc");
        } elseif ($sortBy == "priceU") {
            $products = $query->sortBy("price");
        } else {
            $products = $query->sortBy($sortBy);
        }
        return $products;
    }

    public static function productCreate($data)
    {
        DB::table("products")->insert([
            "subcategory_id" => $data["subcategory"],
            "title" => $data["title"],
            "description" => $data["description"],
            "price" => $data["price"],
            "stock" => $data["stock"],
            "created_at" => now(),
            "updated_at" => now(),
        ]);
    }

    public static function productUpdate($data, $id)
    {
        DB::table("products")->where('id', $id)->update([
            "subcategory_id" => $data["subcategory_id"],
            "title" => $data["title"],
            "description" => $data["description"],
            "price" => $data["price"],
            "stock" => $data["stock"],
            "updated_at" => now(),
        ]);
    }

    public static function productDelete($id)
    {
        DB::table("products")->where('id', $id)->delete();
    }

    public static function getProduct($id): Collection 
    {
        return DB::table("products")->where("id", $id)->get();
    }
}
