<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $allProducts = Product::getAllProducts();
        $allReviews = Review::getAllReviews(null, $_GET);
        return view("admin/reviews/index", compact("allReviews", "allProducts"));
    }

    public function store(Request $request)
    {
        Review::reviewApprove($request["id"], $request["is_active"]);
        return to_route("adminReviewIndex");
    }
}
