<?php

namespace App\Http\Controllers\Site;

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

    public function subcategoryCreate()
    {   
        // $categories = Category::select("id", "title")->get();
        // return view("admin/subcategories/create", compact("categories"));
        return view("admin/subcategories/create");
    }

    public function subcategoryStore(Request $request)
    {
        $data = [
            "category_id" => $request->post("category_id"),
            "title" => $request->post("title"),
            "description" => $request->post("description"),
        ];
        Subcategory::subcategoryCreate($data);
        return to_route("subcategoryIndex", $request->post("category_id"));
    }

    public function subcategoryEdit(int $category_id ,int $id)
    {
        $allCategories = Category::getAll();
        $subcategory = Subcategory::getSubcategories(NULL, $id)[0];
        return view("admin/subcategories/edit", compact("allCategories", "subcategory"));
    }
    
    public function subcategoryUpdate(Request $request, $id)
    {   
        $data = [
            "category_id" => $request->post("category_id"),
            "title" => $request->post("title"),
            "description" => $request->post("description"),
        ];
        Subcategory::subcategoryUpdate($data, $id);
        return to_route("subcategoryIndex", $request->post("oldCategory_id"));
    }

    public function subcategoryDelete(int $id)
    {
        Subcategory::subcategoryDelete($id);
        return back();
    }
}
