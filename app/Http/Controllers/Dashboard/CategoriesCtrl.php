<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;

class CategoriesCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            ifHasAccess(7);
            return $next($request);
        },['except' => ['getSubCategories']]);
    }

    public function index()
    {
        return view('admin.category.categories.index');
    }

    public function create()
    {
        return view('admin.category.categories.create');
    }

    public function store(Request $request, Category $category)
    {
        $this->validate($request, $category->rules('add'));
        $category = $category->create($request->all());
        if ($request->hasFile('image')) {
            $category->addMediaFromRequest('image')->toMediaCollection();
        }
        return setRedirectWithMsg('create', 'admin/categories');
    }

    public function show(Category $category)
    {
        return View('admin.category.sub.index', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.category.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, $category->rules('edit'));
        if ($request->hasFile('image')) {
            $category->clearMediaCollection();
            $category->addMediaFromRequest('image')->toMediaCollection();
        }
        $category->update($request->all());
        return setRedirectWithMsg('update', 'admin/categories');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return setRedirectWithMsg('delete', 'admin/categories');
    }

    public function getSubCategories(Request $request)
    {
        $category = Category::find($request->category_id);
        if (!$category)
            return response()->json(['status' => 401, 'data' => []], 200);
        return response()->json(['status' => 200, 'data' => $category->subCategories->pluck((Session::has('local') ? 'name_' . Session::get('local') : 'name_ar'), 'id')], 200);
    }

    public function changeStatus(Category $category)
    {
        if ($category->is_active == 0)
            $category->update(['is_active' => 1]);
        else if ($category->is_active == 1)
            $category->update(['is_active' => 0]);
        return setRedirectWithMsg('other', 'admin/categories');
    }

    public function dataTable()
    {
        $categories = Category::select('id', 'name_ar', 'name_en','sort', 'created_at', 'is_active')->get();
        return DataTables::of($categories)->editColumn('control', function ($model) {
            $all  = '<a href="' . url('/admin/categories/' . $model->id ) . '" class="btn btn-primary btn-circle"><i class="fa fa-plus"></i></a> ';
            $all .= '<a href="' . url('/admin/categories/' . $model->id . '/edit') . '" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></a> ';
            $all .= '<a href="' . url('/admin/categories/' . $model->id . '/delete') . '" class="btn btn-danger btn-circle conf" id="deleteUser"><i class="fa fa-trash-o"></i></a>';
            return $all;
        })->editColumn('is_active', function ($model) {
                if ($model->is_active == 0) {
                    $all = '<button class="btn btn-danger btn-circle"> <i class="fa fa-ban"></i>' . trans('categories.block') . '</button> ';
                } else if ($model->is_active == 1) {
                    $all = '<button class="btn btn-success btn-circle"> <i class="fa fa-check"></i>' . trans('categories.actived') . '</button> ';
                }
                return $all;
            })->editColumn('img', function ($model) {
                 return '<img style="height:50px; width:50px;" src="' . $model->getFirstMediaUrl() . '">';
            })->rawColumns(['control', 'is_active', 'img'])->make(true);
    }
}
