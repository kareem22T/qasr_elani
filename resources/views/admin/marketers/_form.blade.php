<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label class="col-md-3 control-label">{{trans('marketers.name')}} </label>
    <div class="col-md-6">
        {!! Form::text('name',null,['class'=>'form-control'])!!}
    </div>
</div>

<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
    <label class="col-md-3 control-label">{{trans('marketers.address')}} </label>
    <div class="col-md-6">
        {!! Form::text('address',null,['class'=>'form-control'])!!}
    </div>
</div>

<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
    <label class="col-md-3 control-label">{{trans('marketers.phone')}}</label>
    <div class="col-md-6">
        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label class="col-md-3 control-label">{{trans('marketers.password')}}</label>
    <div class="col-md-6">
        {!! Form::input('password','password' ,null, ['class' => 'form-control','autocomplete'=>'new-password']) !!}
        <small class="text-info">{{ (@$type !== 'add') ? trans('marketers.leave_blank') : ''}}</small>
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
                <a href="{{route('marketers.index')}}" class="btn btn-danger btn-block">
                    {!! trans('assets.cancel') !!}
                </a>
            </div>
        </div>


    </div>
</div>


