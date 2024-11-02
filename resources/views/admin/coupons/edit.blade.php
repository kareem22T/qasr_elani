@extends('admin.layout')
@section('title',trans('categories.editCat'))

@section('content')
    <ol class="breadcrumb">

        <li class="breadcrumb-item"><a title="{!! trans('assets.home') !!}" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
        <li class="breadcrumb-item"><a title="" href="{{ Url('/')}}/admin/categories "> {!! trans('categories.categories') !!} </a></li>
        <li class="breadcrumb-item active"> / {!! trans('categories.editCat') !!}: {{ $coupon->code }}</li>

    </ol>
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit"></i>{!! trans('categories.editCat') !!}
                : {{ $coupon['name_'.Session::get('local')] }}
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            {!! Form::model($coupon,['method' => 'PATCH', 'action' => ['App\Http\Controllers\Dashboard\CouponsCtrl@update',$coupon->id], 'class' => 'form-horizontal','files'=>true]) !!}
            @include('admin.coupons._form',['type'=>'edit'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
