@extends('admin.layout')
@section('title',trans('admins.edit'))
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{!! trans('assets.home') !!}" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
        <li class="breadcrumb-item"><a title="{!! trans('admins.title') !!}" href="{{ Url('/')}}/admin/admins "> {!! trans('admins.title') !!} </a></li>
        <li class="breadcrumb-item active"> / {!! trans('admins.edit') !!}: {{ $admin->name }}</li>
    </ol>

    <div class="col-lg-12 col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit"></i>
                    {!! trans('admins.edit') !!}: {{ $admin->name }}
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body">

                {!! Form::model($admin,['method' => 'PATCH', 'action' => ['App\Http\Controllers\Dashboard\AdminsCtrl@update',$admin->id], 'class' => 'form-horizontal','files'=>true]) !!}
                @include('admin.admins._form',['type'=>'edit'])
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
