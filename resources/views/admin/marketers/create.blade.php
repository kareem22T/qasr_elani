@extends('admin.layout')
@section('title',trans('marketers.title_create'))
@section('content')

    <!-- BEGIN PAGE CONTENT-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{{trans('admins.title')}}"
                                       href="{{ Url('/') }}/admin"> {{trans('admins.home')}} /</a></li>
        <li class="breadcrumb-item"><a title="{!! trans('marketers.title') !!}"
                                       href="{{route('marketers.index')}} "> {!! trans('marketers.title') !!} /</a>
        </li>
        <li class="breadcrumb-item active"> {{trans('marketers.title_create')}} </li>
    </ol>
    <!-- BEGIN PAGE CONTENT-->

    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-plus"></i>{{trans('marketers.title_create')}}
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">

            {!! Form::open(['route' => 'marketers.store','class'=>'form-horizontal','files'=>true]) !!}
            @include('admin.marketers._form',['type'=>'add'])
            {!! Form::close() !!}

        </div>
    </div>
@endsection
