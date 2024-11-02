<div class="row">
    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('coupons.code') !!}</label>
        <div class="col-md-6">
            {!! Form::text('code',null,['class'=>'form-control'])!!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('coupons.percent') !!}</label>
        <div class="col-md-6">
            {!! Form::number('percent',null,['class'=>'form-control','min' => 1,'step' => ".01"])!!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('coupons.date_from') !!}</label>
        <div class="col-md-6">
            {{ Form::date('date_from', null, ['class' => 'form-control']) }}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('coupons.date_to') !!}</label>
        <div class="col-md-6">
            {{ Form::date('date_to', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <?php $array = [trans('products.not_recommended'), trans('products.recommended')] ?>
    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('products.active_status') !!}</label>
        <div class="col-md-6">
            {!! Form::select('is_active',$array,null,['class'=>'form-control select2', 'id' => 'is_active'])!!}
        </div>
    </div>

    @if($type == 'add')
        <div class="form-group">
            <label class="col-md-3 control-label">{!! trans('products.send_notifications') !!}</label>
            <div class="col-md-6">
                {!! Form::select('send_notifications',$array,null,['class'=>'form-control select2'])!!}
            </div>
        </div>
    @endif

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
                    <a href="{{url('/admin/coupons')}}" class="btn btn-danger btn-block">
                        {!! trans('assets.cancel') !!}
                    </a>
                </div>
            </div>
        </div>
    </div>


</div>




