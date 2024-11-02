<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;

class LoginCtrl extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    protected $admin;

    function __construct()
    {
        $this->admin = Auth::guard('admins');
    }

    public function getShowAdmin()
    {

        if ($this->admin->check() == false) {

            return view('admin.login');
        }

        return redirect()->intended('/admin');

    }

    public function postAdminLogin(Request $bag)
    {
        if ($this->admin->check() == true) {
            return false;
        }
        $validator = Validator::make($bag->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['scode' => 401, 'errors' => $validator->errors()->all()], 202);
        }

        if ($this->admin->attempt(['email' => $bag->email, 'password' => $bag->password])) {
            return response()->json(['scode' => 202, 'msg' => ["successfully logged in , redirecting please wait ..."]], 202);
        }

        return response()->json(['scode' => 401, 'errors' => ["Wrong Email or Password ."]], 202);

    }

    public function adminLogout()
    {
        if ($this->admin->check() == true) {
            $this->admin->logout();
            return redirect()->to(Url('/') . '/admin/login');
        }
        return redirect()->to(Url('/') . '/admin/login');
    }


}
