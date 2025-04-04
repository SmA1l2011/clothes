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

    public static function getAll(): Collection 
    {
        return DB::table("products")->get();
    }
}
