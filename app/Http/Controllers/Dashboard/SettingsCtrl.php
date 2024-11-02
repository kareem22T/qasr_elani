<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App;
use App\Models\Setting;
class SettingsCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            ifHasAccess(2);
            return $next($request);
        });
    }
    public function index()
    {
        $settings = Setting::first();

        return view('admin.settings.settings', compact('settings'));
    }
    public function store(Request $request, Setting $setting)
    {
        $this->validate($request, $setting->rules());
        if ($setting->first() == null){
            $setting = new Setting();
        }else{
            $setting = $setting->first();
        }
        $setting->email             = $request->email;
        $setting->phone             = $request->phone;
        $setting->address           = $request->address;
        $setting->facebook          = $request->facebook;
        $setting->twitter           = $request->twitter;
        $setting->instagram         = $request->instagram;
        $setting->tiktok            = $request->tiktok;
        $setting->percent_added_tax = $request->percent_added_tax;
        $setting->terms_ar          = $request->terms_ar;
        $setting->terms_en          = $request->terms_en;
        $setting->about_us_ar       = $request->about_us_ar;
        $setting->about_us_en       = $request->about_us_en;
        $setting->save();
        return setRedirectWithMsg('create', 'admin/settings');
    }
}
