<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class PushNotificationsCtrl extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            ifHasAccess(13);
            return $next($request);
        });
    }

    public function index()
    {
        return View('admin.pushNotifications.index');
    }

    public function create()
    {
        return view('admin.pushNotifications.create');
    }

    public function store(Request $request, Notification $pushNotification)
    {
        $this->validate($request, $pushNotification->rules());
        pushNotification('general_notification', ['bodyAr' => $request->body_ar, 'bodyEn' => $request->body_en], User::whereActivationCode(1)->get(), 1, 0,0,Auth::guard('admins')->user()->id);
        return setRedirectWithMsg('other', 'admin/pushNotifications');
    }

    public function edit(Notification $pushNotification)
    {
        return view('admin.pushNotifications.edit', compact('pushNotification'));
    }

    public function update(Request $request, Notification $pushNotification)
    {
        $this->validate($request, $pushNotification->rules());
        $request->merge(['admin_id' => Auth::guard('admins')->user()->id]);
        $pushNotification->update($request->all());
        return setRedirectWithMsg('update', 'admin/pushNotifications');
    }

    public function destroy(Notification $pushNotification)
    {
        $pushNotification->delete();
        return setRedirectWithMsg('delete', 'admin/pushNotifications');
    }

    public function dataTable()
    {
        $categories = Notification::whereType(0)->get();
        return DataTables::of($categories)->editColumn('control', function ($model) {
            $all  = '<a href="' . url('/admin/pushNotifications/' . $model->id . '/edit') . '" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></a> ';
            $all .= '<a href="' . url('/admin/pushNotifications/' . $model->id . '/delete') . '" class="btn btn-danger btn-circle conf"><i class="fa fa-trash-o"></i></a>';
            return $all;
        })->editColumn('created_at', function ($model) {
                return Carbon::parse($model->created_at)->toDateString();
        })->editColumn('admin_id', function ($model) {
                return $model->admin->name;
        })
            ->rawColumns(['control'])->make(true);
    }

}
