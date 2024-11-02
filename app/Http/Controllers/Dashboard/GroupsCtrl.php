<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Group;
use Validator;
use Yajra\DataTables\Facades\DataTables;

class GroupsCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            ifHasAccess(3);
            return $next($request);
        });
    }

    public function index()
    {
        return view('admin.groups.index');
    }

    public function create()
    {
        return view('admin.groups.create');
    }

    public function store(Request $request,Group $group)
    {
        $this->validate($request, $group->rules());
        $group->create($request->all());
        return setRedirectWithMsg('create', 'admin/groups');
    }

    public function edit(Group $group)
    {
        return view('admin.groups.edit', compact('group'));

    }
    public function update(Request $request,Group $group)
    {
        $this->validate($request, $group->rules());
        $group->update($request->all());
        return setRedirectWithMsg('update', 'admin/groups');
    }
    public function destroy(Group $group)
    {
        $groupAdmins = Admin::whereGroupId($group->id)->get();
        if(count($groupAdmins) > 0){
            return redirect()->to(Url('/') . '/' . 'admin/groups')->with(['msg' => 'You Cant Delete Your Account']);
        }else{
            $group->delete();
            return setRedirectWithMsg('delete', 'admin/groups');
        }
    }

    public function dataTable()
    {
        $groups = Group::select('id', 'name', 'created_at')->get();
        return DataTables::of($groups)
            ->editColumn('control', function ($model) {
                $all  = '<a href="' . url('/admin/groups/' . $model->id . '/edit') . '" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></a> ';
                $all .= '<a href="' . url('/admin/groups/' . $model->id . '/delete') . '" class="btn btn-danger btn-circle conf"><i class="fa fa-trash-o"></i></a>';
                return $all;
            })->rawColumns(['control'])->make(true);
    }
}
