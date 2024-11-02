@extends('admin.layout')
@section('title',trans('notify.edit'))

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{!! trans('assets.home') !!}" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
        <li class="breadcrumb-item"><a title="{!! trans('notify.title') !!}" href="{{ Url('/') }}/admin/pushNotifications">{!! trans('notify.title') !!} /</a></li>
        <li class="breadcrumb-item active">  {!! trans('notify.edit') !!}: {{ $pushNotification['body_'.Session::get('local')] }}</li>

    </ol>
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit"></i>{!! trans('notify.edit') !!}
                : {{ $pushNotification['body_'.Session::get('local')] }}
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            {!! Form::model($pushNotification,['method' => 'PATCH', 'action' => ['App\Http\Controllers\Dashboard\PushNotificationsCtrl@update',$pushNotification->id], 'class' => 'form-horizontal']) !!}
            @include('admin.pushNotifications._form',['type'=>'edit'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
