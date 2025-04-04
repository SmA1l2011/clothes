<?php

namespace App\Models;

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
}
