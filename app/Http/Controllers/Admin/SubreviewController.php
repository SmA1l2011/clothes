<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subreview;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubreviewController extends Controller
{
    public function index(int $id)
    {
        $allSubreviews = Subreview::getAllSubreviews($id, $_GET);
        return view("admin/subreviews/index", compact("allSubreviews"));
    }

    public function store(Request $request)
    {
        Subreview::subreviewApprove($request["id"], $request["is_active"]);
        return to_route("adminSubreviewIndex", $request["review_id"]);
    }
}
