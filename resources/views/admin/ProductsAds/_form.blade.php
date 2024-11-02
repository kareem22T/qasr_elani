<div class="row">
    <br>
    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('productsAds.product_name') !!} </label>
        <div class="col-md-6">
            {!! Form::select('product_id', $products, null, ['class' => 'form-control select2', 'id' => 'product_id']) !!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('productsAds.sort') !!}</label>
        <div class="col-md-6">
            {!! Form::number('sort',null,['class'=>'form-control','min' => 1])!!}
        </div>
    </div>

    @if(@$type == 'edit')
        <div class="form-group">
            <label class="col-md-3 control-label">{{trans('admins.current_image')}}</label>
            <div class="col-md-6-offset-2 ImgProfileStyle">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail">
                        <img src="{{$productAd->getFirstMediaUrl()}}" alt="" style="width: 200px; height: 150px;">
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
        <label class="col-md-3 control-label">{!! trans('categories.img') !!}</label>
        <div class="col-md-6-offset-2 ImgProfileStyle">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail">
                    <img src="{{Url('/')}}/back/assets/global/img/no-img.png" alt="" style="width: 200px; height: 150px;">
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px; height: 150px; "></div>
                <div>
                <span class="btn default btn-file">
                <span class="fileinput-new"> {{trans('admins.Select_image')}} </span>
                <span class="fileinput-exists"> {{trans('admins.change')}} </span>
                <input type="hidden" value="" name="">
                    <input type="file" name="image"> </span>
                    <a href="javascript:;" class="btn red fileinput-exists"
                       data-dismiss="fileinput"> {{trans('admins.Remove')}} </a>
                </div>
            </div>
        </div>
    </div>

    <?php $array = [trans('products.not_recommended'), trans('products.recommended')] ?>
    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('productsAds.active_status') !!}</label>
        <div class="col-md-6">
            {!! Form::select('is_active',$array,null,['class'=>'form-control select2'])!!}
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
                    <a href="{{url('/admin/contacts')}}" class="btn btn-danger btn-block">
                        {!! trans('assets.cancel') !!}
                    </a>
                </div>
            </div>


        </div>
    </div>
</div>





