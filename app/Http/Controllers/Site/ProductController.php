<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function catalog() 
    {
        $allProducts = Product::getAll();
        return view("catalog", compact("allProducts"));
    }
}
