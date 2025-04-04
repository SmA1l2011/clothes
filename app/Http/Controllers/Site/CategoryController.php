<?php

namespace App\Http\Controllers\Site;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategories(Request $request)
    {   
        $allCategories = Category::getAll();
        return view("admin/categories/index", compact("allCategories"));
    }

    public function categoryCreate()
    {   
        return view("admin/categories/create");
    }

    public function categoryStore(Request $request)
    {
        $data = [
            "title" => $request->post("title"),
            "description" => $request->post("description"),
        ];
        Category::categoryCreate($data);
        return to_route("categoryIndex");
    }

    public function categoryEdit(int $id)
    {
        $category = Category::getAll($id);
        return view("admin/categories/edit", compact("category"));
    }
    
    public function categoryUpdate(Request $request, $id)
    {   
        $data = [
            "title" => $request->post("title"),
            "description" => $request->post("description"),
        ];
        Category::categoryUpdate($data, $id);
        return to_route("categoryIndex");
    }

    public function categoryDelete($id)
    {
        Category::categoryDelete($id);
        return back();
    }
}
