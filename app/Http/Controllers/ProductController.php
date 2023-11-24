<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = (new ProductService)->getProduct($request);

        return response()->json([
            'success' => true,
            'data' => ProductResource::collection($products)->response()->getData(true),
        ], 200);
    }

    public function store(ProductRequest $request)
    {
        return (new ProductService())->store($request->toArray());
    }

    public function show($productId) 
    {
        $product = Product::find($productId);

        if (!$product)
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);


        return response()->json([
                'success' => true,
                'data' => new ProductResource($product),
            ], 200);
    }

    public function update(ProductUpdateRequest $request, $productId)
    {
        return (new ProductService())->update($request->toArray(), $productId);
    }

    public function destroy($productId)
    {
        return (new ProductService)->destroy($productId);
    }
}
