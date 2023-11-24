<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactUsInquiryResource;
use App\Models\ContactUsInquiry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactUsInquiryController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->per_page ?? 10;

        $contactUsInquiries = ContactUsInquiry::when($request->has('type'), function($query) use ($request) {
                                                    $query->where('type', $request->type);                                    
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
                                                        $q1->where('first_name', 'LIKE', '%' . $request->search . '%')
                                                            ->orWhere('last_name', 'LIKE', '%' . $request->search . '%')
                                                            ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                                                            ->orWhere('company_name', 'LIKE', '%' . $request->search . '%')
                                                            ->orWhere('product_name', 'LIKE', '%' . $request->search . '%');
                                                    });
                                                })
                                                ->orderByDesc('created_at')->paginate($per_page);

        return response()->json([
            'success' => true,
            'data' => ContactUsInquiryResource::collection($contactUsInquiries)->response()->getData(true),
        ], 200);
    }

    public function destroy($contactUsInquiryId)
    {
        $contactUsInquiry = ContactUsInquiry::find($contactUsInquiryId);

        if (!$contactUsInquiry)
            return response()->json([
                'success' => false,
                'message' => 'Inquiry not found',
            ], 404);

        DB::beginTransaction();

        try {
            $contactUsInquiry->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Inquiry deleted',
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
