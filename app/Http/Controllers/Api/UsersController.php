<?php

namespace App\Http\Controllers\Api;

use App\Mail\Activation;
use App\Models\Marketer;
use App\Models\Pharmacy;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use Lang;

class UsersController extends ApiHelpersController
{
    public function register(Request $request)
    {
        $rules = [
            'name'          => ['required', 'string'],
            'email'         => ['required', 'email', Rule::unique('users')],
            'phone'         => ['required', Rule::unique('users')],
            'password'      => ['required', 'min:8'],
            'image'         => ['nullable','image','mimes:jpeg,png,jpg','max:20480'],
            'referral_code' => ['nullable', 'string', Rule::exists('marketers', 'referral_code')],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        DB::beginTransaction();
        try {
            // $activationCode = mt_rand(1000, 9999);
            // $request->merge(['activation_code' => $activationCode]);
            // $request->merge(['marketer_id'     => isset($request->referral_code) ? Marketer::firstWhere('referral_code', $request->referral_code)->id : Marketer::firstWhere('is_default', 1)->id]);
            // $user = User::create($request->all());
            // if ($request->has('image')){
            //     $user->addMediaFromRequest('image')->toMediaCollection('images');
            // }
            // Mail::to($user->email)->send(new Activation($activationCode));
            //_fireSMS($user->phone,Lang::get('emails.codeNum',['code' =>$activationCode]));
            DB::commit();
            return response()->api(true, 'successRegister', [], ['token' => $user->createToken('userAuth')->plainTextToken]);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->api(false, 'someErrorsHappened', $ex->getMessage());
        }
    }

    public function activeAccount(Request $request)
    {
        $rules = [
            'code'           => ['required', 'numeric', 'digits:4', 'exists:users,activation_code'],
            'device_type'    => ['nullable', 'integer', 'between:0,1'],
            'firebase_token' => ['nullable','string'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        $user = Auth::guard('users')->user();
        if ($user->activation_code != $request->code) {
            return response()->api(false, 'someErrorsHappened', 'activeCodeNotToUser');
        }
        $user->update(['activation_code' => 1, 'firebase_token' => $request->firebase_token, 'device_type' => $request->device_type]);
        $data = array_merge($this->returnUserData($user), ['token' => $user->createToken('userLogin')->plainTextToken]);
        return response()->api(true, 'successLogin', [], $data);
    }

    public function resendActivationCode()
    {
        $user = Auth::guard('users')->user();
        if ($user->activation_code == 1) {
            return response()->api(false, 'someErrorsHappened', 'usrAlreadyActive');
        } else {
            $activationCode = mt_rand(1000, 9999);
            $user->update(['activation_code' => $activationCode]);
            Mail::to($user->email)->send(new Activation($activationCode));
            //_fireSMS($user->phone,Lang::get('emails.codeNum',['code' => $activationCode]));
            return response()->api(true, 'resendCodeSent');
        }
    }

    public function login(Request $request)
    {
        $rules = [
            'email_or_phone' => ['required', 'email'],
            'password'       => ['required', 'min:8'],
            'firebase_token' => ['nullable','string'],
            'device_type'    => ['nullable', 'integer', 'between:0,1'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        //$col = (filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL)) ? 'email' : 'phone';
        $user = User::where('email', $request->email_or_phone)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->api(false, 'someErrorsHappened', 'wrongCredential');
        }
        $data = array_merge($this->returnUserData($user), ['token' => $user->createToken('userLogin')->plainTextToken]);
        if ($user->activation_code == 1) {
            $user->update(['firebase_token' => $request->firebase_token, 'device_type' => $request->device_type]);
            return response()->api(true, 'successLogin',[], $data);
        } else {
            $activationCode = mt_rand(1000, 9999);
            $user->update(['activation_code' => $activationCode]);
            Mail::to($user->email)->send(new Activation($activationCode));
            //_fireSMS($user->phone,Lang::get('emails.codeNum',['code' => $activationCode]));
            return response()->api(true, 'userWaitingActivation', [], $data);
        }
    }

    public function requestPasswordReset(Request $request)
    {
        $rules = [
            'email' => ['required', 'email', 'exists:users,email'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        $user = User::whereEmail($request->email)->first();
        $resetPassCode = mt_rand(1000, 9999);
        $checkIfHasResetBefore = DB::table('password_resets')->whereEmail($user->email)->first();
        if ($checkIfHasResetBefore) {
            DB::table('password_resets')->whereEmail($user->email)->update(['token' => $resetPassCode]);
        } else {
            DB::table('password_resets')->insert(['email' => $user->email, 'token' => $resetPassCode]);
        }
        Mail::to($user->email)->send(new Activation($resetPassCode));
        //_fireSMS($user->phone,Lang::get('emails.resetPasswordCode',['code' => $resetPassCode]));
        return response()->api(true, 'resetCodeSent');
    }

    public function createTokenResetPassword(Request $request)
    {
        $rules = [
            'email'      => ['required', 'email', 'exists:password_resets,email'],
            'reset_code' => ['required', 'numeric', 'min:4', 'exists:password_resets,token'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        $resetCode = DB::table('password_resets')->whereToken($request->reset_code)->whereEmail($request->email)->first();
        $user      = User::whereEmail($resetCode->email)->first();
        DB::table('password_resets')->whereToken($request->reset_code)->delete();
        return response()->api(true, 'successOperation', [], ['token' => $user->createToken('resetPassword', ['role:userResetPassword'])->plainTextToken]);
    }

    public function resetPassword(Request $request)
    {
        $rules = [
            'new_password' => ['required', 'min:8'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        if (!Auth::guard('users')->user()->tokenCan('role:userResetPassword')) {
            return response()->api(false, 'someErrorsHappened', 'tokenNotAllowResetPass');
        }
        $request->merge(['password' => $request->new_password]);
        Auth::guard('users')->user()->update($request->only('password'));
        Auth::guard('users')->user()->currentAccessToken()->delete();
        return response()->api(true, 'passwordUpdated');
    }

    public function getProfile()
    {
        return response()->api(true, 'successOperation', [], $this->returnUserData(Auth::guard('users')->user()));
    }

    public function getSettings()
    {
        $user        = Auth::guard('users')->user();
        $socialLinks = Setting::select('facebook', 'twitter', 'instagram', 'tiktok')->first();
        $data = [];
        $data['name']       = $user ? $user->name : '';
        $data['image']      = $user ? $user->getFirstMediaUrl('images') : '';
        $data['facebook']   = $socialLinks->facebook;
        $data['twitter']    = $socialLinks->twitter;
        $data['instagram']  = $socialLinks->instagram;
        $data['tiktok']     = $socialLinks->tiktok;
        return response()->api(true, 'successOperation', [], $data);
    }

    public function changePassword(Request $request)
    {
        $rules = [
            'old_password' => ['required', 'min:8', 'old_password:' . Auth::guard('users')->user()->password],
            'new_password' => ['required', 'min:8', 'different:old_password'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        $request->merge(['password' => $request->new_password]);
        Auth::guard('users')->user()->update($request->only('password'));
        return response()->api(true, 'passwordUpdated');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::guard('users')->user();
        $rules = [
            'name'           => ['required', 'string'],
            'image'          => ['nullable','image','mimes:jpeg,png,jpg,gif,svg'],
            'device_type'    => ['nullable', 'integer', 'between:0,1'],
            'firebase_token' => ['nullable', 'string'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        $user->update($request->only(['name', 'device_type', 'firebase_token']));
        if ($request->hasFile('image')){
            $user->clearMediaCollection('images');
            $user->addMediaFromRequest('image')->toMediaCollection('images');
        }
        return response()->api(true, 'profileUpdated',[],$this->returnUserData($user));
    }

    public function logout()
    {
        Auth::guard('users')->user()->currentAccessToken()->delete();
        Auth::guard('users')->user()->update(['firebase_token' => null]);
        return response()->api(true, 'logOutSuccess');
    }

    public function updateFirebaseToken(Request $request)
    {
        $rules = [
            'firebase_token' => ['required', 'string'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        Auth::guard('users')->user()->update(['firebase_token' => $request->firebase_token]);
        return response()->api(true, 'successOperation');
    }

    public function changeLanguage(Request $request)
    {
        $rules = [
            'current_lang'    => ['required', 'string', 'in:ar,en'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        Auth::guard('users')->user()->update(['current_lang' => $request->current_lang]);

        return response()->api(true, 'successOperation');
    }

    public function changeNotificationSetting()
    {
        $user = Auth::guard('users')->user();
        $user->update(['send_notifications' => $user->send_notifications ? 0 : 1]);
        return response()->api(true, 'successOperation',[],['send_notifications' => $user->send_notifications]);
    }

    public function notificationsHistory()
    {
        $notificationsHistory =  Auth::guard('users')->user()->notifications()->with('notification')->get();
        $data['send_notifications']  = Auth::guard('users')->user()->send_notifications;
        $data['notifications'] = [];
        foreach ($notificationsHistory as $i => $userNotification) {
            $data['notifications'][$i]['id']          = $userNotification->id;
            $data['notifications'][$i]['body']        = $userNotification->notification['body_' . app()->getLocale()];
            $data['notifications'][$i]['notify_type'] = $userNotification->notification->notify_type;
            $data['notifications'][$i]['redirect_id'] = $userNotification->notification->redirect_id;
            $data['notifications'][$i]['created_at']  = $userNotification->created_at;
        }
        return response()->api(true, 'successOperation',[],$data);
    }


}
