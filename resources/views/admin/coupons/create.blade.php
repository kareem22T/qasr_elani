@extends('admin.layout')
@section('title',trans('coupons.addNew'))
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{!! trans('assets.home') !!}" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
        <li class="breadcrumb-item"><a title="{!! trans('coupons.title') !!}" href="{{ Url('/')}}/admin/coupons ">{!! trans('coupons.title') !!} </a></li>
        <li class="breadcrumb-item active"> / {!! trans('coupons.addNew') !!} </li>
    </ol>
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-plus"></i>{!! trans('coupons.addNew') !!}
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            {!! Form::open(['action'=>'App\Http\Controllers\Dashboard\CouponsCtrl@store','class'=>'form-horizontal']) !!}
            @include('admin.coupons._form',['type'=>'add'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
