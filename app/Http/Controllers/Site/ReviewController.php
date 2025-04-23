<?php

namespace App\Http\Controllers\Site;

use App\Models\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(int $id)
    {
        $allReviews = Review::getAllReviews($id, ["sortBy" => "rating"], true);
        return view("site/products/reviews", compact("allReviews"));
    }

    public function store(Request $request)
    {
        $data = [
            "product_id" => $request->post("id"),
            "user_id" => auth()->user()->id,
            "rating" => $request->post("rating"),
            "comment" => $request->post("comment"),
        ];
        Review::reviewCreate($data);
        return to_route("productReviews", $request->post("id"));
    }
}
