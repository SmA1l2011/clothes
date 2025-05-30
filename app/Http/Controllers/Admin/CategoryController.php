<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

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

    public function store(CategoryRequest $request)
    {
        Category::categoryCreate($request->validated());
        return to_route("categoryIndex");
    }

    public function edit(int $id)
    {
        $category = Category::getAllCategories($id);
        return view("admin/categories/edit", compact("category"));
    }

    public function update(CategoryRequest $request, $id)
    {
        Category::categoryUpdate($request->validated(), $id);
        return to_route("categoryIndex");
    }

    public function delete($id)
    {
        Category::categoryDelete($id);
        return back();
    }
}
