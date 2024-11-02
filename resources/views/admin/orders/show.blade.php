@extends('admin.layout')
@section('title',trans('orders.manageOrders'))
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{!! trans('assets.home') !!}"
                                       href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
        <li class="breadcrumb-item"><a title="{!! trans('orders.manageOrders') !!}"
                                       href="{{ Url('/') }}/admin/orders">{!! trans('orders.manageOrders') !!}/</a></li>
        <li class="breadcrumb-item active"> {!! trans('orders.orderDetails') .$order->number!!} </li>
    </ol>

    <div class="portlet light bordered">
        <br>
        <div class="portlet-title">
            {!! Form::model($order,['method'=>'PUT','action'=>['App\Http\Controllers\Dashboard\OrdersCtrl@changeStatus',$order->id],'class'=>'form-horizontal']) !!}
            <?php
            $arrEn = [1 => 'request accepted', 'request being prepared', 'connecting is in progress', 'request delivered', 'request canceled'];
            $arrAr = [1 => 'تم قبول الطلب', 'جاري تحضير الطلب', 'جاري التوصيل', 'تم تسليم الطلب', 'تم الغاء الطلب'];
            $array = app()->getLocale() == 'en' ? $arrEn : $arrAr;
            ?>
            <div class="form-group">
                <label class="col-md-3 control-label">{!! trans('orders.change_order_status') !!}</label>
                <div class="col-md-6">
                    {!! Form::select('status',$array,$order->status,['class'=>'form-control select2', 'id' => 'status'])!!}
                </div>
            </div>
            <div class="form-group" id="reason_for_refused">
                <label class="col-md-3 control-label">{!! trans('orders.reason_for_refused') !!}</label>
                <div class="col-md-6">
                    {!! Form::textarea('reason_for_refused',null,['rows'=> 10,'class'=>'form-control', 'id' => 'reason'])!!}
                </div>
            </div>
            <div class="row" id="actions">
                <div class="col-md-4 col-md-offset-4">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fa fa-check"></i>
                                {!! trans('assets.save') !!}
                            </button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{url('/admin/orders')}}" class="btn btn-danger btn-block">
                                {!! trans('assets.cancel') !!}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
        <div class="portlet-body">
            <h4>
                <a target="_blank" href="{{url('/admin/users/' . $order->user->id)}}"
                   title="{{trans('tic.viewDetails')}}" class="btn btn-default btn-circle" target="_blank">
                    {!! trans('orders.username') . " : " . $order->user->name !!}
                </a>
            </h4>

            <div class="margin-top-10 margin-bottom-10 clearfix">
                <table class="table table-bordered table-striped">
                    <tr>
                        <td> # {!! trans('orders.order_num') !!} </td>
                        <td>
                            <div id="00pulsate-regular" style="padding:5px;"> {!! $order->number !!} </div>
                        </td>
                    </tr>
                    <tr>
                        <td> {!! trans('orders.shipping_address') !!} </td>
                        <td>
                             <span>
                                  <div>
                                          {!! $order->shipping_address !!}
                                  </div>
                             </span>
                        </td>
                    </tr>
                    @if($order->userAddress->notes != null)
                        <tr>
                            <td> {!! trans('orders.shipping_address_notes') !!} </td>
                            <td>
                             <span>
                                  <div>
                                          {!! $order->userAddress->notes !!}
                                  </div>
                             </span>
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td> {!! trans('orders.user_phone') !!} </td>
                        <td>
                             <span>
                                  <div>
                                          {!! $order->user->phone !!}
                                  </div>
                             </span>
                        </td>
                    </tr>
                    @if($order->coupon_code != null && $order->coupon_percent != null)
                        <tr>
                            <td> {!! trans('orders.coupon_code') !!} </td>
                            <td>
                             <span>
                                  <div>
                                          {!! $order->coupon_code !!}
                                  </div>
                             </span>
                            </td>
                        </tr>
                        <tr>
                            <td> {!! trans('orders.coupon_percent') !!} </td>
                            <td>
                             <span>
                                  <div>
                                          {!! $order->coupon_percent . ' %' !!}
                                  </div>
                             </span>
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td> {!! trans('orders.date_creation') !!} </td>
                        <td>
                            <span>
                            <div> {{$order->created_at}} </div>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td> {!! trans('orders.status') !!} </td>
                        <td>
                            <span class="btn btn-circle">
                            <div class="pulsate"
                                 style="!important; padding:5px; color:{{@$order->status}}"> {{$order->status_string}} </div>
                            </span>
                        </td>
                    </tr>
                </table>
                <table class="table table-striped table-bordered table-hover danger" id="myTable">
                    <thead>
                    <th class="text-center">{!! trans('orders.product_id') !!}</th>
                    <th class="text-center">{!! trans('orders.product_name') !!}</th>
                    <th class="text-center">{!! trans('orders.product_image') !!}</th>
                    <th class="text-center"> {!! trans('orders.qty') !!}  </th>
                    <th class="text-center">{!! trans('orders.piece_price') !!}</th>
                    <th class="text-center">{!! trans('orders.quantity_price') !!}</th>
                    </thead>
                    <tbody>
                    @foreach($order->products()->get() as $orderItem)
                        <tr class="text-center">
                            <td>{{$orderItem->product_id}}</td>
                            <td><a target="_blank"
                                   href="{{url('admin/products/'.$orderItem->product_id)}}">{{ $orderItem->product['name_'.Session::get('local')] }}</a>
                            </td>
                            <td><a target="_blank" href="{{url('admin/products/'.$orderItem->product_id)}}"><img
                                        class="img-responsive" src="{{$orderItem->product->getFirstMediaUrl()}}"
                                        style="height: 100px; width: 175px;display:inline-block"></a></td>
                            <td>{{$orderItem->qty}}</td>
                            <td>{{$orderItem->piece_price}}</td>
                            <td>{{$orderItem->quantity_price}}</td>
                        </tr>
                    @endforeach
                    <tr class="text-center">
                        <td colspan="5"> {!! trans('orders.products_price') !!} </td>
                        <td>{{$order->products_price}}  {!! trans('orders.currency') !!}</td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="5"> {!! trans('orders.value_added_tax') !!} </td>
                        <td>{{$order->value_added_tax}}  {!! trans('orders.currency') !!}</td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="5"> {!! trans('orders.delivery_price')  !!} </td>
                        <td>{{$order->delivery_price}}  {!! trans('orders.currency') !!}</td>
                    </tr>
                    @if($order->coupon_discount_money != null)
                        <tr class="text-center">
                            <td colspan="5"> {!! trans('orders.coupon_discount_money')  !!} </td>
                            <td>{{$order->coupon_discount_money}}  {!! trans('orders.currency') !!}</td>
                        </tr>
                    @endif
                    <tr class="text-center">
                        <td colspan="5"> {!! trans('orders.final_price')  !!} </td>
                        <td>{{$order->final_price}}  {!! trans('orders.currency') !!}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('inlineJS')
    <script>
        $(document).ready(function () {
            var selectedVal = $('#status option:selected').val();
            if (selectedVal == 5) {
                $("#reason_for_refused").show();
            } else {
                $("#reason_for_refused").hide();
            }
            $("#status").change(function () {
                val = $(this).val();
                if (val == 5) {
                    $("#reason_for_refused").show();
                } else {
                    $("#reason_for_refused").hide();
                }
            });
            if ("{{$order->status == 5}}") {
                $("#status").prop("disabled", true);
                $('#reason').attr('disabled', 'disabled');
                $("#actions").hide();
            }
        });
    </script>

@endsection

