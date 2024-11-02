<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CityResource;
use App\Models\City;

class CitiesAreasController extends ApiHelpersController
{
    public function index()
    {
        $cities = City::get();
        return response()->api(true, 'successOperation', [], CityResource::collection($cities));
    }

    public function getCitiesHaveAreas()
    {
        $citiesHaveAreas = City::has('areas')->with('areas')->get();
        return response()->api(true, 'successOperation', [], CityResource::collection($citiesHaveAreas));
    }
}
