<?php use Carbon\Carbon; ?>
@extends('admin.layout')
@section('title',trans('users.userDetails'))

@section('content')

    <!-- BEGIN PAGE CONTENT-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{!! trans('assets.home') !!}"
                                       href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
        <li class="breadcrumb-item"><a title=""
                                       href="{{ Url('/')}}/admin/users ">{!! trans('users.users') !!} </a></li>
        <li class="breadcrumb-item active"> / {!! trans('users.userDetails') !!} : {{ $user->name }} </li>
    </ol>
    <!-- BEGIN PAGE CONTENT-->
    <div class="page-head">
        <div class="profile">
            <div class="tabbable-line tabbable-full-width">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_1_1" data-toggle="tab"
                           aria-expanded="true"> {!! trans('users.userDetails') !!} </a>
                    </li>
                    {{--<li class="">
                        <a href="#tab_1_3" data-toggle="tab" aria-expanded="false"> الطلبات </a>
                    </li>--}}
                    {{--<li class="">
                        <a href="#tab_1_6" data-toggle="tab" aria-expanded="false"> Help </a>
                    </li>--}}
                </ul>
                <div class="tab-content" style="min-height: 500px;">
                    <div class="tab-pane active" id="tab_1_1">
                        <div class="row">
                            @if($user->getFirstMediaUrl('images') != '')
                                <div class="row">
                                    <div class="col-md-4">
                                        <ul class="list-unstyled profile-nav">
                                            <li>
                                                <img src="{{$user->getFirstMediaUrl('images')}}" alt="" style="width: 200px; height: 150px;">


                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6 profile-info">
                                        <h1 class="font-green sbold uppercase">
                                            {{--{!!trans('users.username') !!}--}}
                                            {{ $user->name }}
                                        </h1>
                                        <a href="mailto:{{$user->email }}">
                                            {{--{!! trans('users.email') !!}--}}
                                            {{ $user->email }}
                                        </a>

                                        <ul class="list-inline">
                                            <li>
                                                <i class="fa fa-phone"></i>
                                                {{ $user->phone }}
                                            </li>
                                            <br>
                                            <li>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                {!! trans('users.joinSince') !!}
                                                {{--<th>{!! trans('users.add_date') !!}</th>--}}
                                                {{ Carbon::parse($user->created_at)->toDateString() }}

                                            </li>

                                            <li>
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                                {!! trans('users.lastEdit') !!}
                                                {{ Carbon::parse($user->updated_at)->toDateString() }}
                                            </li>

                                        </ul>
                                    </div>
                                   {{-- <!--end col-md-8-->
                                    <div class="col-md-6">
                                        <div class="portlet sale-summary">
                                            <div class="portlet-title">
                                                <div
                                                    class="caption font-red sbold"> {!! trans('users.QuickStatistics') !!}</div>
                                                <div class="tools ">

                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <span class="sale-num"> {!! @$countTickets !!} </span>
                                                        <span class="sale-info">
                                                               {!! trans('users.tickets') !!}
                                                            <i class="fa fa-img-up"></i>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="sale-num"> {!! @$orders->total() !!} </span>
                                                        <span class="sale-info">
                                                            {!! trans('users.countOrders') !!}
                                                            <i class="fa fa-img-down"></i>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span
                                                            class="sale-num">  {!! @$invoices->where('status',1)->count() !!}</span>
                                                        <span class="sale-info">
                                                            {!! trans('users.invoicesPaid') !!}
                                                            <i class="fa fa-img-down"></i>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span
                                                            class="sale-num"> {!! @$invoices->where('status',0)->count() !!} </span>
                                                        <span class="sale-info">
                                                            {!! trans('users.invoicesUnPaid') !!}
                                                            <i class="fa fa-img-down"></i>
                                                        </span>
                                                    </li>
                                                    </p>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-md-4-->--}}
                                </div>
                                {{--<div class="tabbable-line tabbable-custom-profile">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_11" data-toggle="tab" aria-expanded="true">
                                                {!! trans('users.orders') !!}
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="#tab_1_22" data-toggle="tab" aria-expanded="false">
                                                {!! trans('users.invoices') !!}
                                            </a>
                                        </li>
                                    </ul>

                                    --}}{{-- All Tab Contents  --}}{{--
                                    <div class="tab-content text-center">
                                        <div class="tab-pane active" id="tab_1_11">
                                            <div class="portlet-body text-center">
                                                @if($orders->total() > 0)
                                                    <table
                                                        class="text-center table table-striped table-bordered table-advance table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th class="text-center">
                                                                {!! trans('orders.order_num') !!}
                                                            </th>
                                                            <th class="text-center">
                                                                {!! trans('orders.type') !!}
                                                            </th>
                                                            <th class="hidden-xs text-center">
                                                                {!! trans('orders.subCat') !!}
                                                            </th>
                                                            <th class="hidden-xs text-center">
                                                                {!! trans('orders.date_creation') !!}
                                                            </th>
                                                            <th class="text-center">
                                                                <span>{!! trans('orders.sp') !!}</span>
                                                            </th>

                                                            <th class="hidden-xs text-center">
                                                                {!! trans('orders.status') !!}
                                                            </th>
                                                            <th class="text-center">
                                                                {!! trans('sp.control') !!}
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="text-center">

                                                        <tr>
                                                        {{dd($orders)}}

                                                        @foreach($orders as $order)
                                                            <tr>
                                                                <td>
                                                                    <a href="javascript:;"> {!! $order->id !!} </a>
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <span
                                                                        class="label label-primary">{{($order->type == 0) ? trans('orders.normal') : trans('orders.urgent')}}</span>
                                                                </td>
                                                                <td class="hidden-xs"> {!! $order->getSubCategoryInfo['name_'.Session::get('local')] !!} </td>
                                                                <td class="hidden-xs"> {!! Carbon::parse($order->created_at)->toDateString() !!} </td>
                                                                <td class="hidden-xs">
                                                                    <?php
                                                                    $status = $order->_getCurrentSPObj();
                                                                    ?>
                                                                    @if(!is_null($status['id']) && \App\Http\Controllers\BaseUsersApi::ReturnLastStatusOrder($order->id)['status'] != 6)
                                                                        <a href="{{url('/admin/servicesP/' . $status['id'])}}"
                                                                           class="btn btn-default btn-circle"
                                                                           target="_blank">
                                                                            <span class="badge badge-primary"></span>
                                                                            {{$status['f_name']}}
                                                                        </a>
                                                                    @else
                                                                        {!! trans('orders.notS') !!}
                                                                    @endif

                                                                </td>

                                                                <td>
                                                                    <span class="btn btn-circle"
                                                                          style="color:{{@$order->_handelStatusOrderColor()}}">{{$order->_handelStatusOrder()}}</span>
                                                                </td>
                                                                <td>

                                                                    <a href="{{ url('/admin/Orders/' . $order->id) }}"
                                                                       class="btn btn-warning btn-circle"
                                                                       title="{{trans('orders.viewDetails') }}"><i
                                                                            class="fa fa-eye"></i></a>
                                                                    --}}{{-- <a href="{url('/admin/Orders/assignSP/' . $order->id)}}"
                                                                        class="btn btn-primary btn-circle"
                                                                        title="{{trans('orders.assignSp') }}"><i
                                                                                 class="fa fa-tasks"
                                                                                 aria-hidden="true"></i></a>
 --}}{{--
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            </tr>


                                                        </tbody>
                                                    </table>
                                                    <span class="pagination pull-right">{!! $orders->render() !!}</span>
                                                @else
                                                    <div class="alert alert-info">{!! trans('assets.noData') !!}</div>
                                                @endif

                                            </div>
                                        </div>
                                        <!--tab-Bills -->
                                        <div class="tab-pane" id="tab_1_22">
                                            <div class="tab-pane active" id="tab_1_1_1">
                                                <div class="portlet-body text-center">

                                                    @if($invoices->count() > 0)
                                                        <table
                                                            class="text-center table table-striped table-bordered table-advance table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th class="text-center">
                                                                    {!! trans('bills.InvoiceNum') !!}
                                                                </th>

                                                                <th class="text-center">
                                                                    {!! trans('bills.TotalInvoice') !!}
                                                                </th>

                                                                <th class="text-center">
                                                                    {!! trans('bills.InvoiceStatus.') !!}
                                                                </th>

                                                                <th class="hidden-xs text-center">
                                                                    {!! trans('bills.OrderNumber') !!}
                                                                </th>
                                                                <th class="text-center">
                                                                    {!! trans('bills.ViewDetails') !!}
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody class="text-center">

                                                            @foreach($invoices as $invoice)
                                                                <tr>
                                                                    <td>
                                                                        <span
                                                                            class="label label-primary"> {!! $invoice->id !!}   </span>
                                                                    </td>
                                                                    <td class="hidden-xs">
                                                                        <span class="label label-success">
                                                                            {!! $invoice->amount !!}
                                                                            --}}{{--{!! ($invoice->discount != null) ? ($invoice->amount - ($invoice->amount * ($invoice->discount / 100))) : '_' !!}--}}{{--
                                                                        </span>
                                                                    </td>

                                                                    <td class="hidden-xs">
                                                                        <span
                                                                            class="label {{($invoice->status != 0 ? 'label-success' : 'label-danger') }} label-sm"> {{($invoice->status != 0 ? 'Paid' : 'Unpaid') }}   </span>
                                                                    </td>
                                                                    <td class="hidden-xs"> {!! $invoice->order_id !!} </td>
                                                                    <td>
                                                                        <a href="{{ url('/admin/Bills/' . $invoice->order_id) }}"
                                                                           class="btn btn-warning btn-circle"
                                                                           title="{{trans('bills.ViewDetails')}}"><i
                                                                                class="fa fa-eye"></i></a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                            </tbody>
                                                        </table>
                                                        <span
                                                            class="pagination pull-right">{!! $orders->render() !!}</span>
                                                    @else
                                                        <div
                                                            class="alert alert-info">{!! trans('assets.noData') !!}</div>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        <!--tab-Bills -->
                                    </div>
                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
