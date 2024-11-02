@extends('admin.layout')
@section('title',trans('marketers.edit'))
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{!! trans('assets.home') !!}"
                                       href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
        <li class="breadcrumb-item"><a title="{!! trans('admins.title') !!}"
                                       href="{{route('marketers.index') }} "> {!! trans('marketers.title') !!} </a>
        </li>
        <li class="breadcrumb-item active"> / {!! trans('marketers.edit') !!} : {{ $marketer->name }}</li>
    </ol>

    <div class="col-lg-12 col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit"></i>
                    {!! trans('marketers.edit') !!} : {{ $marketer->name }}
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body">

                {!! Form::model($marketer,['method' => 'PATCH', 'route' => ['marketers.update', $marketer->id], 'class' => 'form-horizontal','files'=>true]) !!}
                @include('admin.marketers._form',['type'=>'edit'])
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
