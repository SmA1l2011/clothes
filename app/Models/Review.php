<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $table = 'reviews';
    public $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     */
    public $fillable = [
        'product_id',
        'customer_id',
        'rating',
        'comment',
    ];
}
