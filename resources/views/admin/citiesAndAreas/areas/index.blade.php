@extends('admin.layout')
@section('title' , trans('areas.title'))
@section('content')
    <div>
        <a href="{!!Url('/')!!}/admin/areas/create?city_id={{@$city->id}}" class="btn blue btn-circle "><i
                class="fa fa-plus"></i> {!! trans('assets.AddNew') !!}</a>
    </div>
    <br>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{{trans('assets.home')}}" href="{{ Url('/') }}/admin">{{trans('assets.home')}}</a></li>
        <li class="breadcrumb-item active"> / {{trans('areas.title')}}</li>
    </ol>

    @if(\App\Models\Area::where('city_id',$city->id)->count() > 0)
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-flag" aria-hidden="true"></i>
                    {{trans('areas.title')}}
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                </div>
            </div>

            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover danger" id="myTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>{!! trans('areas.name_ar') !!}</th>
                        <th>{!! trans('areas.name_en') !!}</th>
                        <th>{!! trans('areas.deliveryPrice') !!}</th>
                        <th>{!! trans('areas.Add_Date') !!}</th>
                        <th>{!! trans('areas.control') !!}</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="alert alert-info">{!! trans('assets.noData') !!}</div>
    @endif


@section('inlineJS')
    <script>
        $(document).ready(function () {

            var table = $('#myTable').DataTable({
                order: [[0, 'desc']],
                ajax: "{!! Url('admin/areas/get/'.$city->id) !!}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name_ar', name: 'name_ar'},
                    {data: 'name_en', name: 'name_en'},
                    {data: 'delivery_price', name: 'delivery_price'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'control', name: 'control'},
                ], "language": {
                    url: "{{(Session::get('local') !== 'en') ? 'https://cdn.datatables.net/plug-ins/1.10.13/i18n/Arabic.json':''}}"
                },
                "aoColumnDefs": [
                    {'bSortable': false, 'aTargets': [5]}
                ],
            });


        }); // End Doument Ready .


    </script>


@endsection


@endsection
