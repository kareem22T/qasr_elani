<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class CitiesCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            ifHasAccess(6);
            return $next($request);
        });
    }

    public function index()
    {
        return View('admin.citiesAndAreas.cities.index');
    }

    public function create()
    {
        return View('admin.citiesAndAreas.cities.create');
    }

    public function store(Request $request, City $city)
    {
        $this->validate($request, $city->rules());
        $city->create($request->all());
        return setRedirectWithMsg('create', 'admin/cities');
    }

    public function show(City $city)
    {
        return View('admin.citiesAndAreas.areas.index', compact('city'));
    }

    public function edit(City $city)
    {
        return view('admin.citiesAndAreas.cities.edit', compact('city'));
    }

    public function update(Request $request, City $city)
    {
        $this->validate($request, $city->rules());
        $city->update($request->all());
        return setRedirectWithMsg('update', 'admin/cities');
    }

    public function destroy(City $city)
    {
        $city->delete();
        return setRedirectWithMsg('delete', 'admin/cities');
    }

    public function dataTable()
    {
        $cities = City::select('id', 'name_ar', 'name_en', 'created_at')->get();
        return DataTables::of($cities)->editColumn('control', function ($model) {
            $all = '<a href="' . url('/admin/cities/' . $model->id) . '" class="btn btn-primary btn-circle"><i class="fa fa-plus"></i></a> ';
            $all .= '<a href="' . url('/admin/cities/' . $model->id . '/edit') . '" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></a> ';
            $all .= '<a href="' . url('/admin/cities/' . $model->id . '/delete') . '" class="btn btn-danger btn-circle conf" id="deleteUser"><i class="fa fa-trash-o"></i></a>';
            return $all;
        })->editColumn('created_at', function ($model) {
            return Carbon::parse($model->created_at)->toDateString();
        })->rawColumns(['control'])->make(true);
    }
}
