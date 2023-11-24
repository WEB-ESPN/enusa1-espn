<?php

namespace App\Services;

use Illuminate\Support\Arr;

use App\Http\Resources\HomeSettingResource;
use App\Models\Brand;
use App\Models\HomeSetting;
use Illuminate\Support\Facades\DB;

class HomeSettingService {
 
    protected $staticKeys = [
        'contact_us',
        'header_title',
        'header_description',
        'header_image',
        'pdf'
    ];

    protected $singleDataOnlyKeys = [
        'header_title',
        'header_description',
        'header_image',
        'pdf'
    ];

    public function store($homeSettingData)
    {
        DB::beginTransaction();
        
        try {
            $input = $homeSettingData->toArray();

            $input['description'] = $homeSettingData->description !== 'null' ? $homeSettingData->description : null;
            $input['content'] = $homeSettingData->content !== 'null' ? $homeSettingData->content : null;
            $input['file_name'] = $homeSettingData->file_name !== 'null' ? $homeSettingData->file_name : null;

            if ($homeSettingData->file('file_name')) {
                $input['file_name'] = handleUploadedImage($homeSettingData->file_name, 'home_setting/');
            }

            $homeSetting = HomeSetting::create($input);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Home Setting created',
                'data' => new HomeSettingResource($homeSetting),
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update($homeSettingData, $homeSettingId)
    {
        $homeSetting = HomeSetting::find($homeSettingId);

        if (!$homeSetting)
            return response()->json([
                'success' => false,
                'message' => 'Home Setting not found',
            ], 404);

        DB::beginTransaction();

        try {
            $oldFile = $homeSetting->file_name;

            $homeSetting->update(
                $this->handleUpdateData($homeSettingData, $oldFile)
            );
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Brand updated',
                'data' => new HomeSettingResource($homeSetting),
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($homeSettingId)
    {
        $homeSetting = HomeSetting::find($homeSettingId);

        if (!$homeSetting)
            return response()->json([
                'success' => false,
                'message' => 'Home Setting not found',
            ], 404);

        if (in_array($homeSetting->key, $this->staticKeys))
            return response()->json([
                'success' => false,
                'message' => "This key is static, can't to delete",
            ], 412);

        DB::beginTransaction();

        try {
            handleDeletedImage($homeSetting->file_name);

            $homeSetting->delete();
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Home Setting deleted',
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function getStaticKeys()
    {
        return $this->staticKeys;
    }

    public function getSingleDataOnlyKeys()
    {
        return $this->singleDataOnlyKeys;
    }

    public function getPaymentMethodData()
    {

    }

    public function getHeaderData($homeSettings)
    {
        return [
            'title' => $homeSettings->where('key', 'header_title')->first() ? $homeSettings->where('key', 'header_title')->first()->content : null,
            'description' => $homeSettings->where('key', 'header_description')->first() ? $homeSettings->where('key', 'header_description')->first()->content : null,
            'image' => $homeSettings->where('key', 'header_image')->first() ? $homeSettings->where('key', 'header_image')->first()->file_name : null,
        ];
    }

    private function handleUpdateData($data, $oldFile = null)
    {
        $input = [];
        
        switch ($data->key) {
            case ('achievement_result'):
                $input['content'] = $data->content ?? null;

                break;
            case ('contact_us'):
                $input['content'] = $data->content ?? null;

                break;
            case ('header_title'):
                $input['content'] = $data->content ?? null;

                break;
            case ('header_description'):
                $input['content'] = $data->content ?? null;

                break;
            case ('header_image'):
                $input['content'] = $data->content ?? null;

                break;
            default:
                $input = $data->toArray();
        
                $input['description'] = $data->description ?? null;
                $input['content'] = $data->content ?? null;
        }

        if ($data->file_name) {
            handleDeletedImage($oldFile);
            $input['file_name'] = handleUploadedImage($data->file_name, 'home_setting/');
        }

        return $input;
    }
}