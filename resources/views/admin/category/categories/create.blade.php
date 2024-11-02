@extends('admin.layout')
@section('title',trans('categories.addNew'))
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{!! trans('assets.home') !!}"
                                       href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
        <li class="breadcrumb-item"><a title=""
                                       href="{{ Url('/')}}/admin/categories ">{!! trans('categories.categories') !!} </a>
        </li>
        <li class="breadcrumb-item active"> / {!! trans('categories.addNew') !!} </li>
    </ol>
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-plus"></i>{!! trans('categories.addNew') !!}
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            {!! Form::open(['action'=>'App\Http\Controllers\Dashboard\CategoriesCtrl@store','class'=>'form-horizontal','files'=>true]) !!}
            @include('admin.category.categories._form',['type'=>'add'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
