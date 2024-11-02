@extends('marketer-dashboard.layout')
@section('title','الرصيد')
@section('content')
    <!-- BEGIN PAGE CONTENT-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{{trans('admins.title')}}" href="{{ route('marketer.dashboard') }}"> {{trans('admins.home')}} /</a></li>
        <li class="breadcrumb-item active"> الرصيد</li>
    </ol>

    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info"><h4>الرصيد الحالى هو : {{$balance}}  </h4></div>
        </div>
@endsection
