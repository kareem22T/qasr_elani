<div class="row">
    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('notify.body_ar') !!}</label>
        <div class="col-md-6">
            {!! Form::textarea('body_ar',null,['class'=>'form-control'])!!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('notify.body_en') !!}</label>
        <div class="col-md-6">
            {!! Form::textarea('body_en',null,['class'=>'form-control'])!!}
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
                    <a href="{{url('/admin/pushNotifications')}}" class="btn btn-danger btn-block">
                        {!! trans('assets.cancel') !!}
                    </a>
                </div>
            </div>


        </div>
    </div>
</div>
