<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\Activation;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Lang;

class UsersCtrl extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            ifHasAccess(5);
            return $next($request);
        });
    }

    public function index()
    {
        return view('admin.users.index');
    }

    public function create()
    {
        $cities = City::pluck((Session::has('local') ? 'name_' . Session::get('local') : 'name_ar'), 'id');
        return View('admin.users.create', compact('cities'));
    }

    public function store(Request $request, User $user)
    {
        $this->validate($request, $user->rules('add'));
        $activationCode = mt_rand(1000, 9999);
        $request->merge(['activation_code' => $activationCode]);
        $user = $user->create($request->all());
        if ($request->hasFile('image')) {
            $user->addMediaFromRequest('image')->toMediaCollection('images');
        }
        Mail::to($user->email)->send(new Activation($activationCode));
        //_fireSMS($user->phone,Lang::get('emails.codeNum',['code' => $activationCode]));
        return setRedirectWithMsg('create', 'admin/users');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $cities = City::pluck((Session::has('local') ? 'name_' . Session::get('local') : 'name_ar'), 'id');
        return view('admin.users.edit', compact('user', 'cities'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, $user->rules('edit', $user->id));
        if ($request->hasFile('image')) {
            $user->clearMediaCollection('images');
            $user->addMediaFromRequest('image')->toMediaCollection('images');
        }
        $user->update($request->all());
        return setRedirectWithMsg('update', 'admin/users');

    }

    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->delete();
        return response()->json(['result' => true]);
    }

    public function activeUser(User $user)
    {
        if ($user->activation_code != 1)
            $user->update(['activation_code' => 1]);
        return setRedirectWithMsg('other', 'admin/users');

    }


    public function dataTable()
    {
        $users = User::query();

        return DataTables::of($users)
            ->editColumn('control', function ($model) {
                $all = '<a href="' . url('/admin/users/' . $model->id) . '" class="btn btn-primary btn-circle"><i class="fa fa-eye-slash"></i></a> ';
                if ($model->activation_code != 1) {
                    $all .= '<a href="' . url('/admin/users/' . $model->id . '/activeUser') . '" class="btn btn-warning btn-circle"><i class="fa fa-check"></i></a> ';
                }
                $all .= '<a href="' . url('/admin/users/' . $model->id . '/edit') . '" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></a> ';
                $all .= '<a href="' . url('/admin/users/' . $model->id . '/delete') . '" class="btn btn-danger btn-circle" id="delete-user-' . $model->id . ' "><i class="fa fa-trash-o"></i></a>';
                return $all;
            })->editColumn('created_at', function ($model) {
                return Carbon::parse($model->created_at)->toDateString();
            })
            ->editColumn('active', function ($model) {
                if ($model->activation_code == 1) {
                    $all = '<button class="btn btn-success btn-circle"><i class="fa fa-check"></i>' . trans('users.activated') . '</button> ';
                } else {
                    $all = '<button class="btn btn-warning btn-circle"><i class="fa fa-times"></i>' . trans('users.waitingActive') . '</button> ';
                }
                return $all;
            })->rawColumns(['control', 'active'])->make(true);
    }
}
