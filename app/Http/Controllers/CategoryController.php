<?php

namespace App\Http\Controllers;

use App\Filters\CategoryFilter;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request){
        $filter = new CategoryFilter();
        $queryItems = $filter->transform($request);

        $category = Category::where($queryItems);
        return new CategoryCollection($category->paginate()->appends($request->query()));
    }

    public function store(StoreCategoryRequest $request){
        Category::create($request->all());
        return response()->json(['message' => "La categoria a sido creada"], 201);
    }

    public function show(Category $category){
        return new CategoryResource($category);
    }

    public function update(UpdateCategoryRequest $request, Category $category){
        $category->update($request->all());
        return response()->json(['message' => "La categoria con el id {$category->id} ha sido actualizado"], 200);
    }

    public function destroy(Category $category){
        $category->delete();
        return response()->json(['message' => "La category con el id {$category->id} ha sido eliminado"], 200);
    }
}
