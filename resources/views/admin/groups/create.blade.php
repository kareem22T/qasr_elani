@extends('admin.layout')
@section('title',trans('grb.addNew'))
@section('content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{!! trans('assets.home') !!}" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
        <li class="breadcrumb-item"><a title="{!! trans('grb.title') !!}" href="{{ Url('/')}}/admin/groups ">{!! trans('grb.title') !!} </a>
        </li><li class="breadcrumb-item active"> / {!! trans('grb.addNew') !!} </li>
    </ol>


    <div class="container-fluid">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><i class="fa fa-tasks"></i> {!! trans('grb.addNew') !!} </div>
                <div class="panel-body">

                    {!! Form::open(['action'=>'App\Http\Controllers\Dashboard\GroupsCtrl@store','class'=>'form-horizontal']) !!}
                    @include('admin.groups._form',['type'=>'add'])
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
