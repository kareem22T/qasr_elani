@extends('admin.layout')
@section('title',trans('productsAds.title'))

@section('content')

    <!-- BEGIN PAGE CONTENT-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{!! trans('assets.home') !!}" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
        <li class="breadcrumb-item"><a title="{!! trans('productsAds.title') !!}" href="{{ Url('/')}}/admin/productAds ">{!! trans('productsAds.title') !!} </a></li>
        <li class="breadcrumb-item active"> / {!! trans('productsAds.addNew') !!} </li>
    </ol>
    <!-- BEGIN PAGE CONTENT-->
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-plus"></i>{!! trans('productsAds.addNew') !!}
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            {!! Form::open(['action'=>'App\Http\Controllers\Dashboard\ProductsAdsController@store','class'=>'form-horizontal','files' => true]) !!}
            @include('admin.ProductsAds._form',['type'=>'add'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
