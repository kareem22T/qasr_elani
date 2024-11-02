<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class SubCategoriesCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            ifHasAccess(7);
            return $next($request);
        });
    }

    public function create(Request $request)
    {
        $categories = Category::pluck((Session::has('local') ? 'name_' . Session::get('local') : 'name_ar'), 'id');
        return view('admin.category.sub.create', compact('request', 'categories'));
    }

    public function store(Request $request, SubCategory $subCategory)
    {
        $this->validate($request, $subCategory->rules('add'));
        $subCategory = $subCategory->create($request->all());
        if ($request->hasFile('image')) {
            $subCategory->addMediaFromRequest('image')->toMediaCollection();
        }
        return setRedirectWithMsg('create', 'admin/categories/' . $request->category_id);
    }

    public function edit(SubCategory $subCategory)
    {
        $categories = Category::pluck((Session::has('local') ? 'name_' . Session::get('local') : 'name_ar'), 'id');
        return View('admin.category.sub.edit', compact('subCategory', 'categories'));
    }

    public function update(Request $request,SubCategory $subCategory)
    {
        $this->validate($request, $subCategory->rules('edit'));
        if ($request->hasFile('image')) {
            $subCategory->clearMediaCollection();
            $subCategory->addMediaFromRequest('image')->toMediaCollection();
        }
        $subCategory->update($request->all());
        return setRedirectWithMsg('update', 'admin/categories/' . $request->category_id);
    }

    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return setRedirectWithMsg('delete', 'admin/categories/' . $subCategory->category_id);
    }

    public function changeStatus(SubCategory $subCategory)
    {
        if ($subCategory->is_active == 0)
            $subCategory->update(['is_active' => 1]);
        else if ($subCategory->is_active == 1)
            $subCategory->update(['is_active' => 0]);
        return setRedirectWithMsg('other', 'admin/categories/' . $subCategory->category_id);

    }

    public function dataTable(Request $request)
    {
        $subCategories = SubCategory::latest()->where('category_id', $request->category_id)->get();
        return DataTables::of($subCategories)->editColumn('control', function ($model) {
            $all = '<a href="' . url('/admin/subCategories/' . $model->id . '/edit') . '"  class="btn btn-info btn-circle" ><i class="fa fa-edit" ></i></a> ';
            $all .= '<a href="' . url('/admin/subCategories/' . $model->id . '/delete') . '" class="btn btn-danger btn-circle conf" ><i class="fa fa-trash-o" ></i></a>';
            return $all;
        })
            ->editColumn('created_at', function ($model) {
                return Carbon::parse($model->created_at)->toDateString();
            })
            ->editColumn('is_active', function ($model) {
                if ($model->is_active == 0) {
                    $all = '<button class="btn btn-danger btn-circle"> <i class="fa fa-ban" aria-hidden="true"></i>' . trans('categories.block') . '</button> ';
                } else if ($model->is_active == 1) {
                    $all = '<button class="btn btn-success btn-circle"> <i class="fa fa-check"></i>' . trans('categories.actived') . '</button> ';
                }
                return $all;
            })
            ->editColumn('img', function ($model) {
                return '<img style="height:50px; width:50px;" src="' . $model->getFirstMediaUrl() . '">';
            })->rawColumns(['control', 'is_active', 'img'])->make(true);
    }


}
