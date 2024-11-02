@extends('admin.layout')
@section('title',trans('grb.edit'))
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{!! trans('assets.home') !!}" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
        <li class="breadcrumb-item"><a title="{!! trans('grb.title') !!}" href="{{ Url('/')}}/admin/groups "> {!! trans('grb.title') !!} </a></li>
        <li class="breadcrumb-item active"> / {!! trans('grb.edit_group') !!}: {{ $group->name }}</li>
    </ol>

    <div class="container-fluid">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><i class="fa fa-tasks"></i> {!! trans('grb.edit_group') !!}: {{ $group->name }} </div>
                <div class="panel-body">

                    {!! Form::model($group,['method'=>'PATCH','action'=>['App\Http\Controllers\Dashboard\GroupsCtrl@update',$group->id],'class'=>'form-horizontal']) !!}
                    @include('admin.groups._form',['type'=>'edit'])
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
