@extends('admin.layout')
@section('title',trans('subCats.add_title'))

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{{trans('assets.home')}}" href="{{ Url('/') }}/admin">{{trans('assets.home')}}</a></li>
        <li class="breadcrumb-item"><a title="{{trans('subCats.subCats')}}" href="{{ Url('/') }}/admin/categories/{{request()->cat_id}}">/ {{trans('subCats.subCats')}}</a></li>
        <li class="breadcrumb-item active"> / {{trans('subCats.add_title')}}</li>
    </ol>
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-plus"></i>{!! trans('subCats.add_title') !!}
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            {!! Form::open(['action'=>'App\Http\Controllers\Dashboard\SubCategoriesCtrl@store','class'=>'form-horizontal','files'=>true]) !!}
            @include('admin.category.sub._form',['type'=>'add'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
