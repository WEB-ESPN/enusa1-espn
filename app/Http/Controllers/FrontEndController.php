<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsInquiryRequest;
use App\Http\Requests\ProductInquiryRequest;
use App\Http\Resources\CategoryFrontendResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\HomeSettingResource;
use App\Http\Resources\ProductResource;
use App\Mail\ContactUsInquiryMail;
use App\Mail\ProductInquiryMail;
use App\Models\Category;
use App\Models\ContactUsInquiry;
use App\Models\HomeSetting;
use App\Models\Product;
use App\Models\ProductInquiry;
use App\Services\CategoryService;
use App\Services\HomeSettingService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FrontEndController extends Controller
{
    public function index(Request $request)
    {
        $categories = (new CategoryService)->getCategories();
        $latestProducts = Product::limit(4)->latest()->get();
        $homeSettings = HomeSetting::when($request->has('key'), function ($query) use ($request) {
                                        $query->where('key', $request->key);        
                                    })
                                    ->orderBy('title')
                                    ->get();

        return response()->json([
                    'success' => true,
                    'data' => [
                        'homeSettings' => HomeSettingResource::collection($homeSettings)->groupBy('key'),
                        'categories' => CategoryResource::collection($categories),
                        'latestProducts' => ProductResource::collection($latestProducts),
                        'headerData' => (new HomeSettingService)->getHeaderData($homeSettings)
                    ]
                ], 200);
    }

    public function getCategories()
    {
        $categories = (new CategoryService)->getCategories();

        return response()->json([
            'success' => true,
            'data' => CategoryResource::collection($categories),
        ], 200);
    }

    public function getProduct(Request $request)
    {
        $products = (new ProductService)->getProduct($request);

        return response()->json([
            'success' => true,
            'data' => ProductResource::collection($products)->response()->getData(true),
        ], 200);
    }

    public function getContactUs()
    {
        $contactUs = HomeSetting::where('key', 'contact_us')->get();

        $contactUs = [
            "address" => $contactUs->where('title', "address")->first()->content,
            "email" => $contactUs->where('title', "email")->first()->content,
        ];

        return response()->json([
            'success' => true,
            'data' => $contactUs,
        ], 200);
    }

    public function inquiry($productCode)
    {
        $product = (new ProductService)->getProductByCode($productCode);

        if (!$product)
            return response()->json([
                'success' => false,
                'message' => 'Industry not found',
            ], 404);

        $categories = (new CategoryService)->getCategories();
        $paymentMethods = HomeSetting::where('key', 'payment_method')->get();

        return response()->json([
                'success' => true,
                'data' => [
                    'categories' => CategoryFrontendResource::collection($categories),
                    'product' => new ProductResource($product),
                    'paymentMethods' => HomeSettingResource::collection($paymentMethods),
                ]
            ], 200);
    }

    public function inquiryCustom()
    {
        $categories = (new CategoryService)->getCategories();

        return response()->json([
                'success' => true,
                'data' => [
                    'categories' => CategoryFrontendResource::collection($categories),
                ]
            ], 200);
    }

    public function sendProductInquiry(ProductInquiryRequest $request)
    {
        $emailInquiries = HomeSetting::where('key', 'email_inquiry')->get();

        DB::beginTransaction();

        try {
            ProductInquiry::create($request->all());

            if ($emailInquiries) {
                foreach ($emailInquiries->pluck('content') as $recipient) {
                    Mail::to($recipient)->send(new ProductInquiryMail($request->all()));
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Inquiry Submitted',
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function sendContactUsInquiry(ContactUsInquiryRequest $request)
    {
        $emailInquiries = HomeSetting::where('key', 'email_inquiry')->get();

        DB::beginTransaction();

        try {
            ContactUsInquiry::create($request->all());

            if ($emailInquiries) {
                foreach ($emailInquiries->pluck('content') as $recipient) {
                    Mail::to($recipient)->send(new ContactUsInquiryMail($request->all()));
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Inquiry Submitted',
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function download(Request $request, $key)
    {
        $link = HomeSetting::where('key', $key)->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => isset($link) && $link->file_name ? env('VITE_APP_URL') . $link->file_name : null,
        ], 200);
    }
}
