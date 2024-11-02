@extends('admin.layout')
@section('title',trans('products.addNew'))
@section('content')

    <!-- BEGIN PAGE CONTENT-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{!! trans('assets.home') !!}"
                                       href="{{ Url('/') }}/admin"> {!! trans('assets.home') !!}/</a></li>
        <li class="breadcrumb-item"><a title="{{trans('products.products')}}"
                                       href="{{ Url('/') }}/admin/products">{{trans('products.products')}} /</a></li>
        <li class="breadcrumb-item active">{{trans('products.addNew')}} </li>

    </ol>
    <!-- BEGIN PAGE CONTENT-->

    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-plus"></i>{{trans('products.addNew')}}
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            {!! Form::open(['action'=>'App\Http\Controllers\Dashboard\ProductsCtrl@store','class'=>'form-horizontal','files'=>true]) !!}
            @include('admin.products._form',['type'=>'add'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
