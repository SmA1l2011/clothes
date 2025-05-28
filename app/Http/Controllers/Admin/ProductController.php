<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

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
                if (strlen($title) > 16 && $isOk === false) {
                    $isOk = true;
                }
            }
            if ($isOk === true) {
                $allProducts[$key]->isScroll = true;
            } else {
                $allProducts[$key]->isScroll = false;
            }
        }
        return view("admin/products/index", compact("allProducts", "allSubcategories"));
    }

    public function create()
    {
        $allSubcategories = Subcategory::getSubcategories();
        return view("admin/products/create", compact("allSubcategories"));
    }

    public function store(ProductRequest $request)
    {
        // dd($request->all());
        Product::productCreate($request->validated());
        return to_route("adminProductIndex");
    }

    public function edit(int $id)
    {
        $product = Product::getProduct($id)[0];
        $allSubcategories = Subcategory::getSubcategories();
        return view("admin/products/edit", compact("product", "allSubcategories"));
    }

    public function update(ProductRequest $request, $id)
    {
        Product::productUpdate($request->validated(), $id);
        return to_route("adminProduct", $id);
    }

    public function delete($id)
    {
        Product::productDelete($id);
        return to_route("adminProductIndex");
    }

    public function product(int $id)
    {
        $product = Product::getProduct($id)[0];
        return view("admin/products/product", compact("product"));
    }
}
