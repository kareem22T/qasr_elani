@extends('admin.layout')
@section('title',trans('subCats.edit_title'))

@section('content')

    <!-- BEGIN PAGE CONTENT-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{{trans('assets.home')}}" href="{{ Url('/') }}/admin">{{trans('assets.home')}}</a></li>
        <li class="breadcrumb-item"><a title="{{trans('subCats.subCats')}}" href="{{ Url('/') }}/admin/categories/{{$subCategory->category_id}}">/ {{trans('subCats.subCats')}}</a></li>
        <li class="breadcrumb-item active"> / {!! trans('subCats.edit_title') !!}: {{ $subCategory['name_'.Session::get('local')] }}</li>
    </ol>
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit"></i>{!! trans('subCats.edit_title') !!}
                : {{ $subCategory['name_'.Session::get('local')] }}
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            {!! Form::model($subCategory,['class'=>'form-horizontal','method'=>'PATCH','action'=>['App\Http\Controllers\Dashboard\SubCategoriesCtrl@update',$subCategory->id],'files'=>true])!!}
            @include('admin.category.sub._form',['type'=>'edit'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
