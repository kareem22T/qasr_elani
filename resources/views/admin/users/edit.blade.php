@extends('admin.layout')
@section('title',trans('users.title').$user->name )

@section('content')
    <div class="container-fluid">
        <!-- BEGIN PAGE CONTENT-->
        <ol class="breadcrumb">

            <li class="breadcrumb-item"><a title="{!! trans('assets.home') !!}" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
            <li class="breadcrumb-item"><a title="" href="{{ Url('/')}}/admin/users "> {!! trans('users.users') !!} </a></li>
            <li class="breadcrumb-item active">  / {!! trans('users.editUser') !!} : {{ $user->name }}</li>

        </ol>
        <!-- BEGIN PAGE CONTENT-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit"></i>{!! trans('users.editUser') !!} : {{ $user->name }}
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body">
                {!! Form::model($user,['method' => 'PATCH', 'action' => ['\App\Http\Controllers\Dashboard\UsersCtrl@update',$user->id], 'class' => 'form-horizontal','files'=>true]) !!}
                @include('admin.users._form',['type'=>'edit'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
