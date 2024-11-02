<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Setting;
use App\Models\Contact;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Validation\Rule;
use Validator;

class SettingsController extends ApiHelpersController
{
    public function aboutUs()
    {
        $aboutUs = Setting::select('about_us_ar', 'about_us_en')->first();
        return response()->api(true, 'successOperation', [], ['content' => $aboutUs['about_us_' . app()->getLocale()]]);
    }

    public function termsAndConditions()
    {
        $terms = Setting::select('terms_ar', 'terms_en')->first();
        return response()->api(true, 'successOperation', [], ['content' => $terms ? $terms['terms_' . app()->getLocale()] : '']);
    }

    public function getSettings()
    {
        $settings = Setting::select('email', 'phone', 'address', 'facebook', 'twitter', 'instagram', 'tiktok')->first();
        return response()->api(true, 'successOperation', [], $settings);
    }

    public function sendContactUs(Request $request)
    {
        $rules = [
            'name'    => ['required'],
            'email'   => ['nullable', 'email'],
            'phone'   => ['required','regex:/(^(0)(7)[0-9]{8}$)/u'],
            'message' => ['required'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        Contact::create($request->all());
        return response()->api(true, 'contactUsSent');
    }
}
