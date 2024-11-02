<div class='col-md-12'>
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <i class="fa fa-home"></i>
        {!! Form::label('name', trans('grb.name')) !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group{{ $errors->has('permissions') ? ' has-error' : '' }}">
        <i class="fa fa-tasks"></i>
        {!! Form::label('permissions', trans('grb.per')) !!}
        <div class="raw">

            <br>

            {{-- All Premissions --}}
            <div class="col-md-4">
                {!! Form::checkbox('permissions[]', 0,($type =='edit') ? hasRole(0,$group->permissions): false,['id'=>'all']) !!}
                {!! Form::label('', trans('grb.all')) !!}
            </div>

            <br>
            <hr>

            {{-- Home Page -> 1 --}}
            <div class="hidden col-md-4">
                {!! Form::checkbox('permissions[]', 1,($type =='edit') ? hasRole(1,$group->permissions): false,['class' => 'checkSingle']) !!}
                <i class="fa fa-home"></i>
                {!! Form::label('', trans('sidebar.home')) !!}
            </div>

            {{-- settings -> 2 --}}
            <div class="col-md-4">
                {!! Form::checkbox('permissions[]', 2,($type =='edit') ? hasRole(2,$group->permissions): false,['class' => 'checkSingle']) !!}
                <i class="fa fa-cog"></i>
                {!! Form::label('', trans('sidebar.settings')) !!}
            </div>

            {{-- groups -> 3 --}}
            <div class="col-md-4">
                {!! Form::checkbox('permissions[]', 3,($type =='edit') ? hasRole(3,$group->permissions): false,['class' => 'checkSingle']) !!}
                <i class="fa fa-tasks"></i>
                {!! Form::label('', trans('sidebar.groups')) !!}
            </div>

            {{-- admins -> 4 --}}
            <div class="col-md-4">
                {!! Form::checkbox('permissions[]', 4,($type =='edit') ? hasRole(4,$group->permissions): false,['class' => 'checkSingle']) !!}
                <i class="fa fa-user-secret"></i>
                {!! Form::label('', trans('sidebar.admins')) !!}
            </div>

            {{-- users -> 5 --}}
            <div class="col-md-4">
                {!! Form::checkbox('permissions[]', 5,($type =='edit') ? hasRole(5,$group->permissions): false,['class' => 'checkSingle']) !!}
                <i class="fa fa-users"></i>
                {!! Form::label('', trans('sidebar.manageUsers')) !!}
            </div>

            {{-- 6 => cities & Areas --}}
            <div class="col-md-4">
                {!! Form::checkbox('permissions[]', 6,($type =='edit') ? hasRole(6,$group->permissions): false,['class' => 'checkSingle']) !!}
                <i class="fa fa-flag"></i>
                {!! Form::label('', trans('sidebar.citiesAndAreas')) !!}
            </div>

            {{-- 7 => main Categories Sub Categories --}}
            <div class="col-md-4">
                {!! Form::checkbox('permissions[]', 7,($type =='edit') ? hasRole(7,$group->permissions): false,['class' => 'checkSingle']) !!}
                <i class="fa fa-tasks"></i>
                {!! Form::label('', trans('sidebar.categories')) !!}
            </div>

            {{-- 8 => products --}}
            <div class="col-md-4">
                {!! Form::checkbox('permissions[]', 8,($type =='edit') ? hasRole(8,$group->permissions): false,['class' => 'checkSingle']) !!}
                <i class="fa fa-tasks"></i>
                {!! Form::label('', trans('sidebar.products')) !!}
            </div>

            {{-- 9 => productsAds--}}
            <div class="col-md-4">
                {!! Form::checkbox('permissions[]', 9,($type =='edit') ? hasRole(9,$group->permissions): false,['class' => 'checkSingle']) !!}
                <i class="fa fa-file-image-o" aria-hidden="true"></i>
                {!! Form::label('', trans('sidebar.products_ads')) !!}
            </div>

            {{-- 10 => contact us --}}
            <div class="col-md-4">
                {!! Form::checkbox('permissions[]', 10,($type =='edit') ? hasRole(10,$group->permissions): false,['class' => 'checkSingle']) !!}
                <i class="fa fa-ticket" aria-hidden="true"></i>
                {!! Form::label('', trans('sidebar.contacts')) !!}
            </div>

            {{-- 11 => coupons --}}
            <div class="col-md-4">
                {!! Form::checkbox('permissions[]', 11,($type =='edit') ? hasRole(11,$group->permissions): false,['class' => 'checkSingle']) !!}
                <i class="fa fa-tags" aria-hidden="true"></i>
                {!! Form::label('', trans('sidebar.coupons')) !!}
            </div>

            {{-- 12 => orders --}}
            <div class="col-md-4">
                {!! Form::checkbox('permissions[]', 12,($type =='edit') ? hasRole(12,$group->permissions): false,['class' => 'checkSingle']) !!}
                <i class="fa fa-align-right" aria-hidden="true"></i>
                {!! Form::label('', trans('sidebar.orders')) !!}
            </div>

            {{-- 13 =>  Notifcations --}}
            <div class="col-md-5">
                {!! Form::checkbox('permissions[]', 13,($type =='edit') ? hasRole(13,$group->permissions): false,['class' => 'checkSingle']) !!}
                <i class="fa fa-globe" aria-hidden="true"></i>
                {!! Form::label('', trans('sidebar.notifyCenter')) !!}
            </div>
        </div>
        <small class="text-danger">{{ $errors->first('permissions[]') }}</small>
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
                    <a href="{{url('/admin/groups')}}" class="btn btn-danger btn-block">
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
            $('#all').change(function () {
                $(':checkbox.checkSingle').prop('checked', this.checked);
                $.uniform.update();
            });

            $('.checkSingle').change(function () {
                if ($(':checkbox.checkSingle:checked').length == $(':checkbox.checkSingle').length) {
                    $('#all').prop('checked', true);
                } else {
                    $('#all').prop('checked', false);
                }
                $.uniform.update();
            });
        });
    </script>

@endsection
