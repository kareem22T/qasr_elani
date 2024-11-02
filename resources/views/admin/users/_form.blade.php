<div class="row">

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('users.username') !!}</label>
        <div class="col-md-6">
            {!! Form::text('name',null,['class'=>'form-control'])!!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('users.email') !!}</label>
        <div class="col-md-6">
            {!! Form::email('email',null,['class'=>'form-control', 'autocomplete'=>'off'])!!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('users.phone_num') !!}</label>
        <div class="col-md-6">
            {!! Form::text('phone',null,['class'=>'form-control'])!!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('users.pass') !!}</label>
        <div class="col-md-6">
            {!! Form::password('password',['class'=>'form-control pass','autocomplete'=>'new-password'])!!}
        </div>
    </div>

    @if(@$type == 'edit' && $user->getFirstMediaUrl('images') != '')
        <div class="form-group">
            <label class="col-md-3 control-label">{{trans('admins.current_image')}}</label>
            <div class="col-md-6-offset-2 ImgProfileStyle">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail">
                        <img src="{{$user->getFirstMediaUrl('images')}}" alt="" style="width: 200px; height: 150px;">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px; height: 150px; ">
                    </div>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('admins.img_profile') !!}</label>
        <div class="col-md-6-offset-2 ImgProfileStyle">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail">
                    <img src="{{Url('/')}}/back/assets/global/img/person.png" alt=""
                         style="width: 200px; height: 150px;">
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px; height: 150px; "></div>
                <div>
                <span class="btn default btn-file">
                <span class="fileinput-new"> {{trans('admins.Select_image')}} </span>
                <span class="fileinput-exists"> {{trans('admins.change')}} </span>
                    <input type="file" name="image"> </span>
                    <a href="javascript:;" class="btn red fileinput-exists"
                       data-dismiss="fileinput"> {{trans('admins.Remove')}} </a>
                </div>
            </div>
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
                    <a href="{{url('/admin/users')}}" class="btn btn-danger btn-block">
                        {!! trans('assets.cancel') !!}
                    </a>
                </div>
            </div>


        </div>
    </div>

</div>

