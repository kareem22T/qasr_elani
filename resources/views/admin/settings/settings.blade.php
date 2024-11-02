@extends('admin.layout')
@section('title',trans('settings.title'))
@section('content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
        <li class="breadcrumb-item active">{!! trans('settings.title') !!} </li>
    </ol>
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-cog"></i>{!! trans('settings.title') !!}
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            {!! Form::model($settings,['action' => ['App\Http\Controllers\Dashboard\SettingsCtrl@store'], 'class' => 'form-horizontal']) !!}

            <div class="row">

                <div class="form-group">
                    <label class="col-md-3 control-label">{!! trans('settings.email') !!}</label>
                    <div class="col-md-8">
                        {!! Form::email('email',null,['class'=>'form-control'])!!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">{!! trans('settings.phone') !!}</label>
                    <div class="col-md-8">
                        {!! Form::text('phone',null,['class'=>'form-control'])!!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">{!! trans('settings.address') !!}</label>
                    <div class="col-md-8">
                        {!! Form::text('address',null,['class'=>'form-control'])!!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">{!! trans('settings.facebook') !!}</label>
                    <div class="col-md-8">
                        {!! Form::text('facebook',null,['class'=>'form-control'])!!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">{!! trans('settings.twitter') !!}</label>
                    <div class="col-md-8">
                        {!! Form::text('twitter',null,['class'=>'form-control'])!!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">{!! trans('settings.instagram') !!}</label>
                    <div class="col-md-8">
                        {!! Form::text('instagram',null,['class'=>'form-control'])!!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">{!! trans('settings.tiktok') !!}</label>
                    <div class="col-md-8">
                        {!! Form::text('tiktok',null,['class'=>'form-control'])!!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">{!! trans('settings.percent_added_tax') !!}</label>
                    <div class="col-md-8">
                        {!! Form::number('percent_added_tax',null,['class'=>'form-control','step' => "0.01"])!!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">{!! trans('settings.terms_ar') !!}</label>
                    <div class="col-md-8">
                        {!! Form::textarea('terms_ar',null,['class'=>'form-control'])!!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">{!! trans('settings.terms_en') !!}</label>
                    <div class="col-md-8">
                        {!! Form::textarea('terms_en',null,['class'=>'form-control'])!!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">{!! trans('settings.about_us_ar') !!}</label>
                    <div class="col-md-8">
                        {!! Form::textarea('about_us_ar',null,['class'=>'form-control'])!!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">{!! trans('settings.about_us_en') !!}</label>
                    <div class="col-md-8">
                        {!! Form::textarea('about_us_en',null,['class'=>'form-control'])!!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fa fa-check"></i>
                                    {!! trans('assets.save') !!}
                                </button>
                            </div>
                            <div class="col-md-6">
                                <a href="{{url('/admin/settings')}}" class="btn btn-danger btn-block">
                                    {!! trans('assets.cancel') !!}
                                </a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>


@endsection
