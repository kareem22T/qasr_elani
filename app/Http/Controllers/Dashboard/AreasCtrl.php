<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Category;
use App\Models\City;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class AreasCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            ifHasAccess(6);
            return $next($request);
        });
    }

    public function create(Request $request)
    {
        $cities = City::pluck((Session::has('local') ? 'name_' . Session::get('local') : 'name_ar'), 'id');
        return view('admin.citiesAndAreas.areas.create', compact('request', 'cities'));
    }

    public function store(Request $request, Area $area)
    {
        $this->validate($request, $area->rules());
        $area->create($request->all());
        return setRedirectWithMsg('create', 'admin/cities/' . $request->city_id);
    }

    public function edit(Area $area)
    {
        $cities = City::pluck((Session::has('local') ? 'name_' . Session::get('local') : 'name_ar'), 'id');
        return View('admin.citiesAndAreas.areas.edit', compact('area', 'cities'));
    }

    public function update(Request $request, Area $area)
    {
        $this->validate($request, $area->rules());
        $area->update($request->all());
        return setRedirectWithMsg('update', 'admin/cities/' . $request->city_id);
    }

    public function destroy(Area $area)
    {
        $area->delete();
        return setRedirectWithMsg('delete', 'admin/cities/' . $area->city_id);
    }

    public function dataTable(Request $request)
    {
        $areas = Area::latest()->where('city_id', $request->city_id)->get();
        return DataTables::of($areas)->editColumn('control', function ($model) {
            $all = '<a href="' . url('/admin/areas/' . $model->id . '/edit') . '"  class="btn btn-info btn-circle" ><i class="fa fa-edit" ></i></a> ';
            $all .= '<a href="' . url('/admin/areas/' . $model->id . '/delete') . '" class="btn btn-danger btn-circle conf" ><i class="fa fa-trash-o" ></i></a>';
            return $all;
        })->editColumn('created_at', function ($model) {
            return Carbon::parse($model->created_at)->toDateString();
        })->rawColumns(['control'])->make(true);
    }


}
