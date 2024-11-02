<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label class="col-md-3 control-label">{{trans('admins.name')}} </label>
    <div class="col-md-6">
        {!! Form::text('name',null,['class'=>'form-control'])!!}
    </div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label class="col-md-3 control-label">{{trans('admins.email')}}</label>
    <div class="col-md-6">
        {!! Form::email('email', null, ['class' => 'form-control','placeholder' => 'eg: foo@bar.com','autocomplete'=>'off']) !!}
    </div>
</div>

<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
    <label class="col-md-3 control-label">{{trans('admins.phone')}}</label>
    <div class="col-md-6">
        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label class="col-md-3 control-label">{{trans('admins.password')}}</label>
    <div class="col-md-6">
        {!! Form::input('password','password' ,null, ['class' => 'form-control','autocomplete'=>'new-password']) !!}
        <small class="text-info">{{ (@$type !== 'add') ? trans('admins.leave_blank') : ''}}</small>
    </div>
</div>

<div class="form-group{{ $errors->has('group_id') ? ' has-error' : '' }}">
    <label class="col-md-3 control-label">{{trans('admins.group')}} </label>
    <div class="col-md-6">
        {!! Form::select('group_id', $groups, null, ['id' => 'group_id', 'class' => 'select2 form-control', 'required' => 'required']) !!}
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
                <a href="{{url('/admin/admins')}}" class="btn btn-danger btn-block">
                    {!! trans('assets.cancel') !!}
                </a>
            </div>
        </div>


    </div>
</div>


