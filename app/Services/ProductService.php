<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class ProductService {
 
    public function getProduct($request)
    {
        $per_page = $request->per_page ?? 8;

        return Product::leftJoin('categories', 'products.category_id', '=', 'categories.id')
                            ->select('products.*', 'categories.title AS category_title')
                            ->when($request->has('category_id'), function ($query) use ($request) {
                                $query->where('category_id', $request->category_id);
                            })
                            ->when($request->category_name, function ($query) use ($request) {
                                $query->where('categories.code', $request->category_name);
                            })
                            ->when($request->has('search'), function ($query) use ($request) {
                                $query->where(function ($q1) use ($request) {
                                    $q1->where('products.title', 'LIKE', '%' . $request->search . '%')
                                        ->orWhere('description', 'LIKE', '%' . $request->search . '%');
                                });
                            })
                            ->paginate($per_page);
    }

    public function getProductByCode($productCode)
    {
        return Product::where('code', $productCode)->first();
    }

    public function store(array $productData)
    {
        if (!Category::where('id', $productData['category_id'])->exists())
            return response()->json([
                'success' => false,
                'message' => 'Category not found',
            ], 422);
        
        DB::beginTransaction();
        
        try {
            $productData['description'] = $productData['description'] !== 'null' ? $productData['description'] : null;
            $productData['image'] = handleUploadedImage($productData['image'], 'product/');
            
            $product = Product::create($productData);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Product created',
                'data' => new ProductResource($product),
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(array $productData, $productId)
    {
        $product = Product::find($productId);

        if (!$product)
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);

        DB::beginTransaction();

        try {
            $productData['description'] = isset($productData['description']) ? $productData['description'] : null;

            if (!empty($productData['image'])) {
                handleDeletedImage($product['image']);
                $productData['image'] = handleUploadedImage($productData['image'], 'product/');
            }

            $product->update($productData);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Product updated',
                'data' => new ProductResource($product),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($productId)
    {
        $product = Product::find($productId);

        if (!$product)
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);

        DB::beginTransaction();

        try {
            handleDeletedImage($product->image);
            
            $product->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Product deleted',
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