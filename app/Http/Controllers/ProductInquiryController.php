<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductInquiryResource;
use App\Models\HomeSetting;
use App\Models\ProductInquiry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductInquiryController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->per_page ?? 10;

        $productInquiries = ProductInquiry::when($request->has('payment_method'), function($query) use ($request) {
                                                $query->where('payment_method', $request->payment_method);                                    
                                            })
                                            ->when($request->has('daterange'), function($query) use ($request) {
                                                $query->whereBetween('created_at', [
                                                        Carbon::parse($request->daterange[0])->startOfDay(), 
                                                        Carbon::parse($request->daterange[1])->endOfDay()
                                                    ]
                                                );                                    
                                            })
                                            ->when($request->has('search'), function ($query) use ($request) {
                                                $query->where(function ($q1) use ($request) {
                                                    $q1->where('invoice_number', 'LIKE', '%' . $request->search . '%')
                                                        ->orWhere('first_name', 'LIKE', '%' . $request->search . '%')
                                                        ->orWhere('last_name', 'LIKE', '%' . $request->search . '%')
                                                        ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                                                        ->orWhere('company_name', 'LIKE', '%' . $request->search . '%')
                                                        ->orWhere('product_name', 'LIKE', '%' . $request->search . '%');
                                                });
                                            })
                                            ->orderByDesc('created_at')->paginate($per_page);

        return response()->json([
            'success' => true,
            'data' => [
                'productInquiries' => ProductInquiryResource::collection($productInquiries)->response()->getData(true),
                'paymentMethods' => paymentMethods(),
            ],
        ], 200);
    }

    public function destroy($productInquiryId)
    {
        $productInquiry = ProductInquiry::find($productInquiryId);

        if (!$productInquiry)
            return response()->json([
                'success' => false,
                'message' => 'Product Inquiry not found',
            ], 404);

        DB::beginTransaction();

        try {
            $productInquiry->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Product Inquiry deleted',
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
