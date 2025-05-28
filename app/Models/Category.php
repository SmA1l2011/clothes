<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = 'categories';
    public $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     */
    public $fillable = [
        'name',
        'description',
    ];

    public static function getAllCategories($id = null)
    {
        if (isset($id)) {
            return DB::table("categories")->where('id', $id)->first();
        } else {
            return DB::table("categories")->get();
        }
    }

    public static function categoryCreate($data)
    {
        DB::table("categories")->insert([
            "title" => $data["title"],
            "description" => $data["description"],
            "created_at" => now(),
            "updated_at" => now(),
        ]);
    }

    public static function categoryUpdate($data, $id)
    {
        DB::table("categories")->where('id', $id)->update([
            "title" => $data["title"],
            "description" => $data["description"],
            "updated_at" => now(),
        ]);
    }

    public static function categoryDelete($id)
    {
        DB::table("categories")->where('id', $id)->delete();
    }
}
