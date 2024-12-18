@extends('admin.layout')
@section('title',trans('products.addNew'))
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{!! trans('assets.home') !!}" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
        <li class="breadcrumb-item"><a title="{!! trans('notify.title') !!}" href="{{ Url('/') }}/admin/pushNotifications">{!! trans('notify.title') !!} /</a></li>
        <li class="breadcrumb-item active">{{trans('notify.addNew')}} </li>

    </ol>

    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-plus"></i>{{trans('notify.addNew')}}
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            {!! Form::open(['action'=>'App\Http\Controllers\Dashboard\PushNotificationsCtrl@store','class'=>'form-horizontal','files'=>true]) !!}
            @include('admin.pushNotifications._form',['type'=>'add'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
