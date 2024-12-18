@extends('admin.layout')
@section('title',trans('cities.add_title'))
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{!! trans('assets.home') !!}" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
        <li class="breadcrumb-item"><a title="{!! trans('cities.title') !!}" href="{{ Url('/')}}/admin/cities ">{!! trans('cities.title') !!} </a>
        </li>
        <li class="breadcrumb-item active"> / {!! trans('cities.add_title') !!} </li>
    </ol>
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-plus"></i>{!! trans('cities.add_title') !!}
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            {!! Form::open(['action'=>'App\Http\Controllers\Dashboard\CitiesCtrl@store','class'=>'form-horizontal']) !!}
            @include('admin.citiesAndAreas.cities._form',['type'=>'add'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
