<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use App\Models\Subcategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($sortBy)
    {
        // $filters = [
        //     "title" => $_GET["title"],
        // ];
        $allSubcategories = Subcategory::getSubcategories();
        $allProducts = Product::getAllProducts($sortBy);
        foreach ($allProducts as $key => $product) {
            $isOk = false;
            foreach (explode(" ", $product->title) as $title) {
                if(strlen($title) > 16 && $isOk === false) {
                    $isOk = true;
                }
            }
            if ($isOk === true) {
                $allProducts[$key]->isScroll = true;
            } else {
                $allProducts[$key]->isScroll = false;
            }
        }
        return view("site/products/index", compact("allProducts", "allSubcategories"));
    }

    public function product(int $id) 
    {
        $product = Product::getProduct($id)[0];
        return view("site/products/product", compact("product"));
    }
}
