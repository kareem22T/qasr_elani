<?php

namespace App\Http\Resources;

use App\Models\MembershipUser;
use Illuminate\Http\Resources\Json\JsonResource;

class AreaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'             => (int) $this->id,
            'name'           => (string) $this['name_' . app()->getLocale()],
            'delivery_price' => (double) $this->delivery_price,
            'city_id'        => (int) $this->city_id,

            'city' => CityResource::make($this->whenLoaded('city')),
        ];
    }
}
