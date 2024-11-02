<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Session;
use Carbon\Carbon;
use Auth;
class OrdersCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            ifHasAccess(12);
            return $next($request);
        });
    }

    public function index()
    {
        return view('admin.orders.index');
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function changeStatus(Request $request, Order $order)
    {
        $this->validate($request, ['status'  => ['required', 'integer', 'between:1,5'], 'reason_for_refused'  => $request->status == 5 ? ['required','string'] : '']);
        $order->update(['status' => $request->status, 'reason_for_refused' => $request->status == 5 ? $request->reason_for_refused : null]);
        $arrEn = [ 1 => 'request accepted', 'request being prepared', 'connecting is in progress', 'request delivered', 'request canceled'];
        $arrAr = [ 1 => 'تم قبول الطلب', 'جاري تحضير الطلب', 'جاري التوصيل', 'تم تسليم الطلب', 'تم الغاء الطلب'];
        $replace = ['order_number' => $order->number, 'status_ar' => $arrAr[$order->status], 'status_en' => $arrEn[$order->status]];
        pushNotification('order_status_changed', $replace, [$order->user], 3, $order->id,1,Auth::guard('admins')->user()->id);
        if ($order->status == 4) {
            $cashback = 0;
            foreach ($order->products as $orderProduct) {
                $product = Product::find($orderProduct->product_id);
                if (isset($product)) {
                    $cashback += $product->cashback * $orderProduct->qty;
                }
            }
            $order->user->marketer->increment('balance', $cashback);
        } else if ($order->status == 5) {
            foreach ($order->products as $orderProduct) {
                Product::find($orderProduct->product_id)->increment('stock', $orderProduct->qty);
            }
        }
        return setRedirectWithMsg('other', 'admin/orders/'.$order->id);
    }

    public function dataTable(Request $request)
    {
        $orders = Order::select('id', 'number', 'status', 'user_address_id', 'user_id','created_at')->get();
        return DataTables::of($orders)
            ->editColumn('control', function ($model) {
                $all  = '<a href="' . url('/admin/orders/' . $model->id) . '" class="btn btn-primary btn-circle" title="' . trans('orders.viewDetails') . '"><i class="fa fa-eye"></i></a>';
                return $all;
            })->editColumn('user_id', function ($model) {
                return '<a href="' . url('/admin/users/' . $model->user->id) . '" class="btn btn-primary btn-circle" target="_blank">' . $model->user->name . '</a> ';
            })->editColumn('status', function ($model) use ($request) {
                return '<span class="btn btn-circle">' . $model->status_string . '</span>';
            })->editColumn('created_at', function ($model) {
                return Carbon::parse($model->created_at)->format('d-m-Y g:i A');
            })->rawColumns(['control', 'user_id', 'status'])->make(true);
    }


}
