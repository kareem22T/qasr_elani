@extends('marketer-dashboard.layout')
@section('title',trans('dashboard.title'))
@section('content')
    <div class="col-lg-12 col-md-4 col-sm-6 col-xs-12">

        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat yellow">
                <div class="visual">
                    <i class="fa fa-code" aria-hidden="true"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{$marketer->referral_code}}"> {{$marketer->referral_code}}</span>
                        <div class="desc">كود المشاركة</div>
                    </div>
                </div>
                <a class="more" href="{{route('referral-code.index')}}"
                   title="كود المشاركة"> {{trans('dashboard.more')}}
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat purple">
                <div class="visual">
                    <i class="fa fa-money" aria-hidden="true"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{$marketer->balance}}"> {{$marketer->balance}}</span>
                        <div class="desc">الرصيد المتاح</div>
                    </div>
                </div>
                <a class="more" href="{{route('balances.index')}}"
                   title="الرصيد المتاح"> {{trans('dashboard.more')}}
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
