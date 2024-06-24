<?php

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
class CategoryController extends Controller
{
    
    public function index()
    {
        $categories = Category::paginate(10); // يعرض 10 فئات في الصفحة
        return response()->json($categories);
    }


    public function store(CategoryRequest $request)
    {
        $category = new Category();
        $category->categoryName = $request->categoryName;
        $category->description = $request->description;
        $category->save();

        return response()->json(['message' => 'Category created successfully!', 'category' => $category], 201);
    }

    
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->categoryName = $request->categoryName;
        $category->description = $request->description;
        $category->save();

        return response()->json(['message' => 'Category updated successfully!', 'category' => $category], 200);
    }

    
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully!'], 200);
    }
}

