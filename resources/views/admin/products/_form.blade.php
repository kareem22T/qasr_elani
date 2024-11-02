<div class="row">

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('products.name_ar') !!}</label>
        <div class="col-md-6">
            {!! Form::text('name_ar',null,['class'=>'form-control'])!!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('products.name_en') !!}</label>
        <div class="col-md-6">
            {!! Form::text('name_en',null,['class'=>'form-control'])!!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('products.desc_ar') !!}</label>
        <div class="col-md-6">
            {!! Form::textarea('desc_ar',null,['rows'=> 10,'class'=>'form-control'])!!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('products.desc_en') !!}</label>
        <div class="col-md-6">
            {!! Form::textarea('desc_en',null,['rows'=> 10,'class'=>'form-control'])!!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('products.stock') !!}</label>
        <div class="col-md-6">
            {!! Form::number('stock',null,['class'=>'form-control','min' => 1])!!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('products.price_before') !!}</label>
        <div class="col-md-6">
            {!! Form::number('regular_price',null,['class'=>'form-control','min' => 1,'step' => ".01"])!!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('products.sale_price') !!}</label>
        <div class="col-md-6">
            {!! Form::number('sale_price',null,['class'=>'form-control','min' => 1,'step' => ".01"])!!}
            <small class="text-warning">{{trans('products.leave_sale_price_blank')}}</small>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('products.cashback') !!}</label>
        <div class="col-md-6">
            {!! Form::number('cashback',0,['class'=>'form-control','step' => ".01"])!!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('products.category') !!}</label>
        <div class="col-md-6">
            {!! Form::select('category_id', $categories, $type == 'add' ? null : $product->subCategory->category_id, ['class' => 'form-control select2', 'id' => 'category_id']) !!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('products.sub_category') !!}</label>
        <div class="col-md-6">
            {!! Form::select('sub_category_id',[],null,['class'=>'form-control select2'])!!}
        </div>
    </div>

    <?php $array = [trans('products.not_recommended'), trans('products.recommended')] ?>
    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('products.is_recommended') !!}</label>
        <div class="col-md-6">
            {!! Form::select('is_recommended',$array,null,['class'=>'form-control select2'])!!}
        </div>
    </div>


    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('products.active_status') !!}</label>
        <div class="col-md-6">
            {!! Form::select('is_active',$array,null,['class'=>'form-control select2'])!!}
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
    <hr>

    <div class="form-group">
        <label class="col-md-2 control-label">
            <button id="addImages" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-plus"></i></button>
        </label>
        <div class="col-md-9" id="imagesWrapper">
            @if($type == 'edit')
                @foreach($product->getMedia() as $i => $media)
                    <div class="col-md-4 mb-3" style="margin-bottom: 50px;">
                        <img class="img-responsive" style="width: 200px; height: 150px;" src="{{$media->getFullUrl()}}">
                        <a style="margin-top: 5px;"
                           href="{{Url('/')}}/admin/products/{{$product->id}}/images/{{$media->id}}/delete"
                           class="btn red fileinput-exists delete"
                           data-dismiss="fileinput"> {{trans('admins.Remove')}} </a>
                    </div>
                @endforeach

            @else
                <div class="col-md-4 mb-3" style="margin-bottom: 50px;">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                            <img src="{{Url('/')}}/back/assets/global/img/no-img.png" alt=""
                                 style="width: 200px; height: 150px;">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"
                             style="width: 200px; height: 150px;">
                        </div>
                        <span class="btn default btn-file">
                                        <span class="fileinput-new"> {{trans('admins.Select_image')}}</span>
                                        <span class="fileinput-exists"> {{trans('admins.change')}}
                                        </span>
                                            <input type="file" name="images[]">
                                        </span>
                        <a href="javascript:;" class="btn red fileinput-exists"
                           data-dismiss="fileinput"> {{trans('admins.Remove')}} </a>
                    </div>
                </div>
            @endif
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
                <a href="{{url('/admin/products')}}" class="btn btn-danger btn-block">
                    {!! trans('assets.cancel') !!}
                </a>
            </div>
        </div>


    </div>
</div>


@section('inlineJS')
    <script>
        $.get('{{Url('/')}}/admin/categories/getSubCategories?category_id=' + $("#category_id option:selected").val(), function (data) {
        }).done(function (data) {
            var myCities = $('select[name="sub_category_id"]');
            myCities.find('option').remove();
            if (data.status != 401) {
                $.each(data.data, function (key, val) {
                    myCities.prop('disabled', false);
                    if (key == "{{@$product->sub_category_id}}") {
                        var $newOption = $("<option selected='selected'></option>").val(key).text(val)
                        myCities.append($newOption).trigger('change');
                    } else {
                        var $newOption = $("<option></option>").val(key).text(val)
                        myCities.append($newOption).trigger('change');
                    }
                });
            } else {
                myCities.prop('disabled', true);
            }
        })
            .fail(function () {
                // alert("error");
            });

        $(document).on('change', 'select[name="category_id"]', function (e) {
            $.get('{{Url('/')}}/admin/categories/getSubCategories?category_id=' + e.target.value, function (data) {
            }).done(function (data) {
                var myCities = $('select[name="sub_category_id"]');
                myCities.find('option').remove();
                if (data.status != 401) {
                    $.each(data.data, function (key, val) {
                        myCities.prop('disabled', false);
                        if (key == "{{@$product->sub_category_id}}") {
                            var $newOption = $("<option selected='selected'></option>").val(key).text(val)
                            myCities.append($newOption).trigger('change');
                        } else {
                            var $newOption = $("<option></option>").val(key).text(val)
                            myCities.append($newOption).trigger('change');
                        }
                    });
                } else {
                    myCities.prop('disabled', true);
                }
            })
                .fail(function () {
                    // alert("error");
                })
        })
        $(document).ready(function () {
            @if($type != 'add')
            var max_fields = 6 - "{{count($product->getMedia())}}";
            @else
            var max_fields = 5; //maximum input boxes allowed
            @endif
            var wrapper = $("#imagesWrapper");
            var add_button = $("#addImages");


            var x = 1; //initlal text box count
            $(add_button).click(function (e) {
                e.preventDefault();
                if (x < max_fields) {
                    x++;
                    $(wrapper).append(
                        '<div class="col-md-4 mb-3" style="margin-bottom: 50px;">' +
                        '<div class="fileinput fileinput-new" data-provides="fileinput">' +
                        '<div class="fileinput-new thumbnail">' +
                        '<img src="{{Url('/')}}/back/assets/global/img/no-img.png" alt="" style="width: 200px; height: 150px;">' +
                        '</div>' +
                        '<div name="img-cat" class="fileinput-preview fileinput-exists thumbnail" style="width: 200px; height: 150px; ">' +
                        '</div>' +
                        '<span class="btn default btn-file">' +
                        '<span class="fileinput-new"> {{trans('admins.Select_image')}}' +
                        '</span>' +
                        ' <span class="fileinput-exists"> {{trans('admins.change')}}' +
                        '</span>' +
                        '<input type="file" name="images[]">' +
                        '</span>' +
                        '<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{trans('admins.Remove')}}' +
                        '</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    );
                }
            });
        });
    </script>

@endsection


