<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class CategoriesSubCategoriesController extends ApiHelpersController
{
    public function getAll()
    {
        $categories = Category::Active()->whereHas('subCategories', function ($subCat) {$subCat->where('is_active', 1);})->with(['subCategories' => function ($subCat) {$subCat->where('is_active', 1)->orderBy('sort');}])->orderBy('sort')->get();
        return response()->api(true, 'successOperation', [], CategoryResource::collection($categories));

    }

    public function getSubCategories(Request $request)
    {
        $rules = [
            'category_id' => ['required', 'integer', 'min:1', 'exists:categories,id'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        $category      = Category::find($request->category_id);
        $subCategories = $category->subCategories()->where('is_active', 1)->orderBy('sort')->cursor();
        $data = [];
        if ($subCategories->count()) {
            foreach ($subCategories as $k => $subCategory) {
                $data[$k]['id']   = $subCategory->id;
                $data[$k]['name'] = $subCategory['name_' . app()->getLocale()];
                $data[$k]['logo'] = $subCategory->getFirstMediaUrl();
            }
        }
        return response()->api(true, 'successOperation', [], $data);
    }
}
