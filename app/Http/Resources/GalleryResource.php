<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'     => $this->id,
            'image'  => $this->getFullUrl(),
        ];
    }
}
