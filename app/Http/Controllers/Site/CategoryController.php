<?php

namespace App\Http\Controllers\Site;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {   
        $allCategories = Category::getAllCategories();
        return view("admin/categories/index", compact("allCategories"));
    }

    public function create()
    {   
        return view("admin/categories/create");
    }

    public function store(Request $request)
    {
        $data = [
            "title" => $request->post("title"),
            "description" => $request->post("description"),
        ];
        Category::categoryCreate($data);
        return to_route("categoryIndex");
    }

    public function edit(int $id)
    {
        $category = Category::getAllCategories($id);
        return view("admin/categories/edit", compact("category"));
    }
    
    public function update(Request $request, $id)
    {   
        $data = [
            "title" => $request->post("title"),
            "description" => $request->post("description"),
        ];
        Category::categoryUpdate($data, $id);
        return to_route("categoryIndex");
    }

    public function delete($id)
    {
        Category::categoryDelete($id);
        return back();
    }
}
