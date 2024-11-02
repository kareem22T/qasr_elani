<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Admin;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Auth;
use Session;


class AdminsCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            ifHasAccess(4);
            return $next($request);
        });
    }

    public function index()
    {
        return view('admin.admins.index');
    }

    public function create()
    {
        $groups = Group::pluck('name', 'id');
        return view('admin.admins.create', compact('groups'));
    }


    public function store(Request $request, Admin $admin)
    {
        $this->validate($request, $admin->rules());
        $admin->create($request->all());
        return setRedirectWithMsg('create', 'admin/admins');
    }

    public function edit(Admin $admin)
    {
        $groups = Group::pluck('name', 'id');
        return view('admin.admins.edit', compact('admin', 'groups'));
    }

    public function update(Request $request, Admin $admin)
    {
        $this->validate($request, $admin->rules('edit', $admin->id));
        $admin->update($request->all());
        return setRedirectWithMsg('update', 'admin/admins');
    }

    public function destroy(Admin $admin)
    {
        if ($admin->id == Auth::guard('admins')->user()->id && $admin->id == 1) {
            alert()->error('You Cant Delete Your Account');
            return redirect()->to(Url('/') . '/' . 'admin/admins')->with(['msg' => 'You Cant Delete Your Account']);
        }
        $admin->delete();
        return setRedirectWithMsg('delete', 'admin/admins');
    }

    public function dataTable()
    {
        $admins = Admin::select('id', 'name', 'email', 'phone', 'group_id', 'created_at')->get();
        return DataTables::of($admins)->editColumn('control', function ($model) {
            $all = '<a href="' . url('/admin/admins/' . $model->id . '/edit') . '"  class="btn btn-info btn-circle"><i class="fa fa-edit"></i></a> ';
            if ($model->id != Auth::guard('admins')->user()->id && $model->id != 1) {
                $all .= '<a href="' . url('/admin/admins/' . $model->id . '/delete') . '"  class="btn btn-danger btn-circle conf"><i class="fa fa-trash-o"></i></a>';
            }
            return $all;
        })->editColumn('group_id', function ($model) {
            return $model->group->name;
        })->rawColumns(['control'])->make(true);
    }
}
