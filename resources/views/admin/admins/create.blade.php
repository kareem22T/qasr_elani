@extends('admin.layout')
@section('title',trans('admins.title_create'))
@section('content')

    <!-- BEGIN PAGE CONTENT-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{{trans('admins.title')}}" href="{{ Url('/') }}/admin"> {{trans('admins.home')}} /</a></li>
        <li class="breadcrumb-item"><a title="{!! trans('admins.title') !!}" href="{{ Url('/')}}/admin/admins "> {!! trans('admins.title') !!} /</a></li>
        <li class="breadcrumb-item active"> {{trans('admins.title_create')}} </li>
    </ol>
    <!-- BEGIN PAGE CONTENT-->

    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-plus"></i>{{trans('admins.title_create')}}
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">

            {!! Form::open(['action'=>'App\Http\Controllers\Dashboard\AdminsCtrl@store','class'=>'form-horizontal','files'=>true]) !!}
            @include('admin.admins._form',['type'=>'add'])
            {!! Form::close() !!}

        </div>
    </div>
@endsection
