@extends('admin.layout')
@section('title',trans('cities.edit_title'))

@section('content')
    <ol class="breadcrumb">

        <li class="breadcrumb-item"><a title="{!! trans('assets.home') !!}" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
        <li class="breadcrumb-item"><a title="{!! trans('cities.title') !!}" href="{{ Url('/')}}/admin/cities "> {!! trans('cities.title') !!} </a></li>
        <li class="breadcrumb-item active"> / {!! trans('cities.edit_title') !!}: {{ $city['name_'.Session::get('local')] }}</li>

    </ol>
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit"></i>{!! trans('cities.edit_title') !!}
                : {{ $city['name_'.Session::get('local')] }}
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            {!! Form::model($city,['method' => 'PATCH', 'action' => ['App\Http\Controllers\Dashboard\CitiesCtrl@update',$city->id], 'class' => 'form-horizontal']) !!}
            @include('admin.citiesAndAreas.cities._form',['type'=>'edit'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
