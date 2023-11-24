<?php

use App\Http\Resources\HomeSettingResource;
use App\Models\HomeSetting;
use App\Models\ProductInquiry;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

if (!function_exists('handleUploadedImage')) {
    function handleUploadedImage($image, $folderName)
    {
        $imagePath = null;
        $path = 'images/' . $folderName;

        if (!File::isDirectory($path))
            File::makeDirectory($path, 0777, true, true);
        
        if (!is_null($image)) {
            $fileName = time() . $image->getClientOriginalName();
            Storage::disk('public')->put($path . $fileName, File::get($image));
            $imagePath = 'storage/' . $path . $fileName;
        }

        return $imagePath;
    }
}

if (!function_exists('handleDeletedImage')) {
    function handleDeletedImage($imagePath) 
    {
        if (File::exists($imagePath)) {
            unlink($imagePath);
        }
    }
}

if (!function_exists('handleBulkDeletedImage')) {
    function handleBulkDeletedImage($imagePaths)
    {
        foreach ($imagePaths as $imagePath) {
            handleDeletedImage($imagePath);
        }
    }
}

if (!function_exists('generateInvoiceNumber')) {
    function generateInvoiceNumber()
    {
        $getCount = ProductInquiry::count();

        do {
            $getCount++;
        } while (ProductInquiry::where('invoice_number', 'INV/' . date("Y") . '/' . sprintf("%04d", $getCount + 1))->exists());

        return 'INV/' . date("Y") . '/' . sprintf("%04d", $getCount + 1);
    }
}

if (!function_exists('paymentMethods')) {
    function paymentMethods()
    {
        $paymentMethods = HomeSetting::where('key', 'payment_method')->get();
        return HomeSettingResource::collection($paymentMethods);
    }
}