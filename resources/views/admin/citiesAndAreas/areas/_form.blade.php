<div class="row">

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('areas.mainCity') !!} </label>
        <div class="col-md-6">
            {!! Form::select('city_id', $cities, @$request->city_id, ['disabled', 'read-only','class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>

    <input type="hidden" name="city_id" id="city_id">

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('areas.name_ar') !!}</label>
        <div class="col-md-6">
            {!! Form::text('name_ar',null,['class'=>'form-control','maxlength' =>80])!!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('areas.name_en') !!}</label>
        <div class="col-md-6">
            {!! Form::text('name_en',null,['class'=>'form-control','maxlength' =>80])!!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">{!! trans('areas.deliveryPrice') !!}</label>
        <div class="col-md-6">
            {!! Form::number('delivery_price',null,['class'=>'form-control','min' => 1,'step' => ".01"])!!}
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
                    <?php $cityId = $type == 'add' ? @$request->city_id : $area->city_id ?>
                    <a href="{{url('/admin/cities/'.$cityId)}}" class="btn btn-danger btn-block">
                        {!! trans('assets.cancel') !!}
                    </a>
                </div>
            </div>


        </div>
    </div>

</div>

@section('inlineJS')
    <script>
        $(document).ready(function () {
            $('#city_id').val($('select[name="city_id"] option:selected').val());
        });
    </script>
@endsection
