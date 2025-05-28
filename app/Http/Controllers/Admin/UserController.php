<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $allUsers = User::getAllUsers(isset($_GET["id"]) ? $_GET["id"] : null);
        return view("admin/users/index", compact("allUsers"));
    }

    public function create()
    {
        return view("admin/user/create");
    }

    public function store(Request $request)
    {
        User::userCreate($request);
        return to_route("userIndex");
    }

    public function edit(Request $request)
    {
        User::userUpdate($request->post());
        return to_route("userIndex");
    }
}
