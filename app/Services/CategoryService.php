<?php

namespace App\Services;

use App\Http\Resources\CategoryResource;
use App\Models\Benefit;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryService {
 
    public function getCategories($request = null)
    {
        $search = $request->search ?? null;
        $per_page = $request->per_page ?? 10;
        
        return Category::when($search, function ($query) use ($search) {
                        $query->where('title', 'LIKE', '%' . $search . '%');
                    })
                    ->paginate($per_page);
    }

    public function getCategoryById($categoryId)
    {
        return Category::find($categoryId);
    }

    public function getCategoryByCode($categoryCode)
    {
        return Category::where('code', $categoryCode)
                    ->first();
    }

    public function store($categoryData)
    {
        DB::beginTransaction();
        
        try {
            $categoryData['image'] = handleUploadedImage($categoryData['image'], 'category/');
            $categoryData['header_image'] = handleUploadedImage($categoryData['header_image'], 'category/');

            $category = Category::create($categoryData);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Category created',
                'data' => new CategoryResource($category),
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update($categoryData, $categoryId)
    {
        $category = Category::find($categoryId);

        if (!$category)
            return response()->json([
                'success' => false,
                'message' => 'Category not found',
            ], 404);

        DB::beginTransaction();

        try {
            if (!empty($categoryData['image'])) {
                handleDeletedImage($category['image']);
                $categoryData['image'] = handleUploadedImage($categoryData['image'], 'category/');
            }

            if (!empty($categoryData['header_image'])) {
                handleDeletedImage($category['header_image']);
                $categoryData['header_image'] = handleUploadedImage($categoryData['header_image'], 'category/');
            }

            $category->update($categoryData);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Category updated',
                'data' => new CategoryResource($category),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($categoryId)
    {
        $category = Category::with('products')->find($categoryId);

        if (!$category)
            return response()->json([
                'success' => false,
                'message' => 'Category not found',
            ], 404);

        DB::beginTransaction();

        try {
            //Delete all Product's image
            handleBulkDeletedImage($category->products->pluck('image'));

            //Delete Category's image
            handleDeletedImage($category->image);
            handleDeletedImage($category->header_image);

            $category->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Industry deleted',
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}