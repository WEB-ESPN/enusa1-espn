<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = (new CategoryService)->getCategories($request);

        return response()->json([
                'success' => true,
                'data' => CategoryResource::collection($categories)->response()->getData(true),
            ], 200);
    }

    public function store(CategoryRequest $request)
    {
        return (new CategoryService)->store($request->toArray());
    }

    public function show($categoryId) 
    {
        $category = (new CategoryService)->getCategoryById($categoryId);

        if (!$category)
            return response()->json([
                'success' => false,
                'message' => 'Category not found',
            ], 404);


        return response()->json([
                'success' => true,
                'data' => new CategoryResource($category),
            ], 200);
    }

    public function update(CategoryUpdateRequest $request, $categoryId)
    {
        return (new CategoryService)->update($request->toArray(), $categoryId);
    }

    public function destroy($categoryId)
    {
        return (new CategoryService)->destroy($categoryId);
    }
}
