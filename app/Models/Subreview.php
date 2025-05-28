<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subreview extends Model
{
    public $table = 'subreviews';
    public $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     */
    public $fillable = [
        'review_id',
        'customer_id',
        'rating',
        'comment',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getAllSubreviews($id = null, $get = [], $is_site = false)
    {
        // $query = DB::table("subreviews")->join("users", "subreviews.user_id", "=", "users.id");
        $query = Subreview::query()->with("user");
        if ($is_site == true) {
            $query->where("subreviews.is_active", true);
        }
        if ($id !== null) {
            $query->where("subreviews.review_id", $id);
        }
        if (isset($get["is_active"]) && $get["is_active"] !== "all") {
            $query->where("subreviews.is_active", $get["is_active"] == "yes" ? true : false);
        }
        if (isset($get["review_id"]) && $get["review_id"] !== "all") {
            $query->where("subreviews.product_id", $get["product_id"]);
        }
        if (isset($get["sortBy"])) {
            $query->orderBy($get["sortBy"], $get["sortBy"] == "rating" ? "desc" : "asc");
        }
        $subreviews = $query->get();
        return $subreviews;
    }

    public static function subreviewCreate($data)
    {
        DB::table("subreviews")->insert([
            "review_id" => $data["review_id"],
            "user_id" => $data["user_id"],
            "rating" => $data["rating"],
            "comment" => $data["comment"],
            "is_active" => false,
            "created_at" => now(),
            "updated_at" => now(),
        ]);
    }

    public static function subreviewApprove($id, $is_active)
    {
        DB::table("subreviews")->where('id', $id)->update([
            "is_active" => $is_active == "approve" ? 1 : 0,
        ]);
    }
}
