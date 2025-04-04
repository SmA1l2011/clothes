<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
