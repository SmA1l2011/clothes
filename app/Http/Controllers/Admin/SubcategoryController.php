<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subcategory;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index(int $category_id)
    {   
        $subcategories = Subcategory::getSubcategories($category_id);
        return view("admin/subcategories/index", compact("subcategories"));
    }

    public function create()
    {   
        return view("admin/subcategories/create");
    }

    public function store(Request $request)
    {
        $data = [
            "category_id" => $request->post("category_id"),
            "title" => $request->post("title"),
            "description" => $request->post("description"),
        ];
        Subcategory::subcategoryCreate($data);
        return to_route("subcategoryIndex", $request->post("category_id"));
    }

    public function edit(int $category_id ,int $id)
    {
        $allCategories = Category::getAllCategories();
        $subcategory = Subcategory::getSubcategories(NULL, $id)[0];
        return view("admin/subcategories/edit", compact("allCategories", "subcategory"));
    }
    
    public function update(Request $request, $id)
    {   
        $data = [
            "category_id" => $request->post("category_id"),
            "title" => $request->post("title"),
            "description" => $request->post("description"),
        ];
        Subcategory::subcategoryUpdate($data, $id);
        return to_route("subcategoryIndex", $request->post("oldCategory_id"));
    }

    public function delete(int $id)
    {
        Subcategory::subcategoryDelete($id);
        return back();
    }
}
