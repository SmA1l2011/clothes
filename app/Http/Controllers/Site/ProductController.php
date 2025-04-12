<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use App\Models\Subcategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {   
        if (isset($_GET["sortBy"])) {
            switch ($_GET["sortBy"]) {
                case "title":
                    $sortBy = "title";
                break;
    
                case "price down":
                    $sortBy = "priceD";
                break;
    
                case "price up":
                    $sortBy = "priceU";
                break;
                    
                default:
                    $sortBy = "id";
                break;
            }
        } else {
            $sortBy = "id";
        }
        $filters = [];
        foreach ($_GET as $key => $value) {
            $filters[$key] = $value;
        }
        $allSubcategories = Subcategory::getSubcategories();
        $allProducts = Product::getAllProducts($sortBy, $filters);
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
