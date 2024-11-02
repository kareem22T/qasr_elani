@extends('admin.layout')
@section('title',trans('productsAds.edit_title'))

@section('content')

    <!-- BEGIN PAGE CONTENT-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{!! trans('assets.home') !!}" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
        <li class="breadcrumb-item"><a title="{!! trans('productsAds.title') !!}" href="{{ Url('/')}}/admin/productAds "> {!! trans('productsAds.title') !!} </a></li>
        <li class="breadcrumb-item active"> / {!! trans('productsAds.edit_title') !!}: {{ $productAd->product['name_'.Session::get('local')] }}</li>
    </ol>
    <!-- BEGIN PAGE CONTENT-->
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit"></i>{!! trans('productsAds.edit_title') !!}
                : {{ $productAd->product['name_'.Session::get('local')] }}
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            {!! Form::model($productAd,['method' => 'PATCH', 'action' => ['App\Http\Controllers\Dashboard\ProductsAdsController@update',$productAd->id], 'class' => 'form-horizontal','files'=>true]) !!}
            @include('admin.ProductsAds._form',['type'=>'edit'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
