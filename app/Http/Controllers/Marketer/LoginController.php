<?php

namespace App\Http\Controllers\Marketer;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected $marketer;

    function __construct()
    {
        $this->marketer = Auth::guard('marketers');
    }

    public function getShowMarketer()
    {
        if ($this->marketer->check() == false) {
            return view('marketer-dashboard.login');
        }
        return redirect()->intended(route('marketer.dashboard'));
    }

    public function postMarketerLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone'    => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['scode' => 401, 'errors' => $validator->errors()->all()], 202);
        }
        if ($this->marketer->attempt(['phone' => $request->phone, 'password' => $request->password], $request->remember)) {
            return response()->json(['scode' => 202, 'msg' => ["successfully logged in , redirecting please wait ..."]], 202);
        }

        return response()->json(['scode' => 401, 'errors' => ["Wrong phone or password ."]], 202);
    }

    public function marketerLogout()
    {
        $this->marketer->logout();
        return redirect()->to(route('marketer.getLogin'));
    }
}
