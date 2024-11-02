@extends('admin.layout')
@section('title',trans('areas.add_title'))

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{{trans('assets.home')}}" href="{{ Url('/') }}/admin">{{trans('assets.home')}}</a></li>
        <li class="breadcrumb-item"><a title="{{trans('areas.title')}}" href="{{ Url('/') }}/admin/cities/{{request()->city_id}}">/ {{trans('areas.title')}}</a></li>
        <li class="breadcrumb-item active"> / {{trans('areas.add_areas')}}</li>
    </ol>
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-plus"></i>{!! trans('areas.add_areas') !!}
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            {!! Form::open(['action'=>'\App\Http\Controllers\Dashboard\AreasCtrl@store','class'=>'form-horizontal']) !!}
            @include('admin.citiesAndAreas.areas._form',['type'=>'add'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
