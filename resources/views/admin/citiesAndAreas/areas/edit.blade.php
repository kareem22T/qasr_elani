@extends('admin.layout')
@section('title',trans('areas.edit_areas'))

@section('content')

    <!-- BEGIN PAGE CONTENT-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{{trans('assets.home')}}" href="{{ Url('/') }}/admin">{{trans('assets.home')}}</a></li>
        <li class="breadcrumb-item"><a title="{{trans('areas.title')}}" href="{{ Url('/') }}/admin/cities/{{$area->city_id}}">/ {{trans('areas.title')}}</a></li>
        <li class="breadcrumb-item active"> / {!! trans('areas.edit_areas') !!}: {{ $area['name_'.Session::get('local')] }}</li>
    </ol>
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit"></i>{!! trans('areas.edit_areas') !!}
                : {{ $area['name_'.Session::get('local')] }}
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            {!! Form::model($area,['class'=>'form-horizontal','method'=>'PATCH','action'=>['\App\Http\Controllers\Dashboard\AreasCtrl@update',$area->id]])!!}
            @include('admin.citiesAndAreas.areas._form',['type'=>'edit'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
