<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class CouponsCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            ifHasAccess(11);
            return $next($request);
        });
    }

    public function index()
    {
        return view('admin.coupons.index');
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request, Coupon $coupon)
    {
        $this->validate($request, $coupon->rules());
        $coupon = $coupon->create($request->all());
        if ($request->send_notifications == 1 && $coupon->is_active == 1) {
            $replace = ['code' => $coupon->code, 'percent' => $coupon->percent, 'date_from' => $coupon->date_from, 'date_to' => $coupon->date_to];
            pushNotification('new_promo_code_added', $replace, User::whereActivationCode(1)->get(), 2, 0,0,Auth::guard('admins')->user()->id);
        }
        return setRedirectWithMsg('create', 'admin/coupons');
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $this->validate($request, $coupon->rules('edit', $coupon->id));
        $coupon->update($request->all());
        return setRedirectWithMsg('update', 'admin/coupons');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return setRedirectWithMsg('delete', 'admin/coupons');
    }

    public function dataTable()
    {
        $coupons = Coupon::select('id', 'code', 'percent', 'date_from', 'date_to', 'is_active', 'created_at')->get();

        return DataTables::of($coupons)
            ->editColumn('control', function ($model) {
                $all = '<a href="' . url('/admin/coupons/' . $model->id . '/edit') . '" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></a> ';
                $all .= '<a href="' . url('/admin/coupons/' . $model->id . '/delete') . '" class="btn btn-danger btn-circle conf" id="deleteUser"><i class="fa fa-trash-o"></i></a>';
                return $all;
            })->editColumn('percent', function ($model) {
                return $model->percent . ' %';
            })->editColumn('is_active', function ($model) {
                if ($model->is_active == 0) {
                    $all = '<button class="btn btn-danger btn-circle"> <i class="fa fa-ban"></i>' . trans('categories.block') . '</button> ';
                } else if ($model->is_active == 1) {
                    $all = '<button class="btn btn-success btn-circle"> <i class="fa fa-check"></i>' . trans('categories.actived') . '</button> ';
                }
                return $all;
            })->rawColumns(['control', 'is_active'])->make(true);
    }
}
