<?php

namespace App\Http\Resources;

use App\Models\MembershipUser;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'   => (int) $this->id,
            'name' => (string) $this['name_' . app()->getLocale()],
            'logo' => (string) $this->getFirstMediaUrl(),

            'sub_categories'  => CategoryResource::collection($this->whenLoaded('subCategories')),
        ];
    }
}
