<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\File;

class HomeSettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $isImageType = $this->checkImage(File::extension($this->file_name));
        
         return [
            "id"          => $this->id,
            "key"         => $this->key,
            "title"       => $this->title,
            "description" => $this->description,
            "content"     => $this->content,
            "file_name"   => $this->file_name ? env('VITE_APP_URL') . $this->file_name : null,
            "isImageType" => $isImageType,
            "created_at"  => $this->created_at,
            "updated_at"  => $this->updated_at
        ];
    }

    private function checkImage($extension)
    {
        if ($extension == "png"
            || $extension == "jpeg"
            || $extension == "jpg"
        ) {
            return true;
        } else {
            return false;
        }
    }
}
