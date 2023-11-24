<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactUsInquiryController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HomeSettingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductInquiryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('user/store', [ProfileController::class, 'store']);

Route::group(['prefix' => 'admin', 'middleware' => []], function () {
    Route::post('login', [LoginController::class, 'login']);
    
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::patch('user/update', [ProfileController::class, 'update']);

        Route::post('logout', [LoginController::class, 'logout']);
        
        Route::group(['prefix' => 'categories', 'as' => 'categories.', 'middleware' => []], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/{categoryId}', [CategoryController::class, 'show'])->name('show');
            Route::post('store', [CategoryController::class, 'store'])->name('store');
            Route::patch('/update/{categoryId}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/destroy/{categoryId}', [CategoryController::class, 'destroy'])->name('destroy');
        });
        
        Route::group(['prefix' => 'products', 'as' => 'products.', 'middleware' => []], function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/{productId}', [ProductController::class, 'show'])->name('show');
            Route::post('store', [ProductController::class, 'store'])->name('store');
            Route::patch('/update/{productId}', [ProductController::class, 'update'])->name('update');
            Route::delete('/destroy/{productId}', [ProductController::class, 'destroy'])->name('destroy');
        });
        
        Route::group(['prefix' => 'home-settings', 'as' => 'home-settings.', 'middleware' => []], function () {
            Route::get('/', [HomeSettingController::class, 'index'])->name('index');
            Route::get('/{homeSettingId}', [HomeSettingController::class, 'show'])->name('show');
            Route::post('store', [HomeSettingController::class, 'store'])->name('store');
            Route::patch('/update/{homeSettingId}', [HomeSettingController::class, 'update'])->name('update');
            Route::delete('/destroy/{homeSettingId}', [HomeSettingController::class, 'destroy'])->name('destroy');

            Route::post('/home-settings/download/{link}', function ($link) {
                return 'a';
                return response()->download($link);
            });
        });

        Route::group(['prefix' => 'product-inquiry', 'as' => 'product-inquiry.', 'middleware' => []], function () {
            Route::get('/', [ProductInquiryController::class, 'index'])->name('index');
            Route::delete('/destroy/{productInquiryId}', [ProductInquiryController::class, 'destroy'])->name('destroy');
        });
        
        Route::group(['prefix' => 'contact-us-inquiry', 'as' => 'contact-us-inquiry.', 'middleware' => []], function () {
            Route::get('/', [ContactUsInquiryController::class, 'index'])->name('index');
            Route::delete('/destroy/{productInquiryId}', [ContactUsInquiryController::class, 'destroy'])->name('destroy');
        });
    });
});

Route::group(['prefix' => 'frontend', 'middleware' => []], function () {
    Route::get('home', [FrontEndController::class, 'index']);
    Route::get('categories', [FrontEndController::class, 'getCategories']);
    Route::get('products', [FrontEndController::class, 'getProduct']);
    Route::get('download/{key}', [FrontEndController::class, 'download']);

    Route::get('inquiry/product/{productCode}', [FrontEndController::class, 'inquiry']);
    Route::get('inquiry/custom', [FrontEndController::class, 'inquiryCustom']);

    Route::get('contact-us/get', [FrontEndController::class, 'getContactUs']);

    Route::group(['middleware' => [
        'throttle:3,10',
        'xss-sanitizer'
        ]
    ], function () {
        Route::post('send-product-inquiry', [FrontEndController::class, 'sendProductInquiry']);
        Route::post('send-contact-us-inquiry', [FrontEndController::class, 'sendContactUsInquiry']);
    });
});
