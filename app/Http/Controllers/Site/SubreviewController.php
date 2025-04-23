<?php

namespace App\Http\Controllers\Site;

use App\Models\Subreview;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubreviewController extends Controller
{
    public function index(int $product_id, int $id)
    {
        $allSubreviews = Subreview::getAllSubreviews($id, [], true);
        return view("site/products/subreviews", compact("allSubreviews"));
    }

    public function store(Request $request)
    {
        $data = [
            "review_id" => $request->post("id"),
            "user_id" => auth()->user()->id,
            "rating" => $request->post("rating"),
            "comment" => $request->post("comment"),
        ];
        Subreview::subreviewCreate($data);
        return to_route("subreviewIndex", [$request->post("product_id"), $request->post("id")]);
    }
}
