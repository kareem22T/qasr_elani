<?php

namespace App\Http\Resources;

use App\Models\MembershipUser;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'   => (int) $this->id,
            'name' => (string) $this['name_' . app()->getLocale()],

            'areas'  => AreaResource::collection($this->whenLoaded('areas')),
        ];
    }
}
