<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\marketer\MarketerCreateRequest;
use App\Http\Requests\Admin\marketer\MarketerUpdateRequest;
use App\Models\Marketer;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class MarketerController extends Controller
{
    /*public function __construct()
    {
        $this->middleware(function ($request, $next) {
            ifHasAccess(9);
            return $next($request);
        });
    }*/

    public function index()
    {
        return View('admin.marketers.index');
    }

    public function create()
    {
        return View('admin.marketers.create');
    }

    public function store(MarketerCreateRequest $request)
    {
        $validated = $request->validated();
        Marketer::create($validated);
        return setRedirectWithMsg('create', 'admin/marketers');
    }

    public function edit(Marketer $marketer)
    {
        return View('admin.marketers.edit', compact('marketer'));
    }

    public function update(MarketerUpdateRequest $request, Marketer $marketer)
    {
        $validated = $request->validated();
        $marketer->update($validated);
        return setRedirectWithMsg('update', 'admin/marketers');
    }

    public function destroy(Marketer $marketer)
    {
        $marketer->delete();
        return setRedirectWithMsg('delete', 'admin/marketers');
    }

    public function resetBalance(Marketer $marketer)
    {
        $marketer->update(['balance' => 0]);
        return setRedirectWithMsg('delete', 'admin/marketers');
    }

    public function dataTable()
    {
        $marketers = Marketer::query();
        return DataTables::of($marketers)
            ->addColumn('control', function ($model) {
                $all = '<a href="' . route('marketers.edit', $model->id) . '" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></a> ';
                if ($model->is_default != 1) {
                    $all .= '<a href="' . url('/admin/marketers/' . $model->id . '/delete') . '" class="btn btn-danger btn-circle conf" id="deleteUser"><i class="fa fa-trash-o"></i></a>';
                }
                if ($model->balance > 0) {
                    $all .= '<a href="' . url('/admin/marketers/' . $model->id . '/resetBalance') . '" class="btn btn-primary conf" data-val="true"><i class="fa fa-money"></i></a>';
                }
                return $all;
            })
            ->editColumn('is_default', function ($model) {
                return $model->is_default == 1 ? trans('marketers.yes') : trans('marketers.no');
            })
            ->editColumn('created_at', function ($model) {
                return Carbon::parse($model->created_at)->toDateString();
            })
            ->rawColumns(['control', 'is_default'])->make(true);
    }
}
