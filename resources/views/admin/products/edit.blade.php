@extends('admin.layout')
@section('title',trans('categories.editCat'))

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{!! trans('assets.home') !!}" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
        <li class="breadcrumb-item"><a title="{{trans('products.products')}}" href="{{ Url('/')}}/admin/products "> {!! trans('products.edit_product') !!} </a></li>
        <li class="breadcrumb-item active"> / {!! trans('products.edit_product') !!}: {{ $product['name_'.Session::get('local')] }}</li>

    </ol>
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit"></i>{!! trans('products.edit_product') !!}: {{ $product['name_'.Session::get('local')] }}
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            {!! Form::model($product,['method' => 'PATCH', 'action' => ['\App\Http\Controllers\Dashboard\ProductsCtrl@update',$product->id], 'class' => 'form-horizontal','files'=>true]) !!}
            @include('admin.products._form',['type'=>'edit'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
