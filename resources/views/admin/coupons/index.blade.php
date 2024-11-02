@extends('admin.layout')
@section('title',trans('coupons.title'))
@section('content')
    <div><a href="{{Url('/')}}/admin/coupons/create" class="btn blue btn-circle"><i class="fa fa-plus"></i> {!! trans('assets.AddNew') !!}</a></div>
    <br>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} / </a></li>
        <li class="breadcrumb-item active">  {!!trans('coupons.title') !!}
        </li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            @if(\App\Models\Coupon::count() > 0)
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-tags"></i> {!! trans('coupons.title') !!}
                        </div>
                    </div>

                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="myTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{!! trans('coupons.code') !!}</th>
                                <th>{!! trans('coupons.percent') !!}</th>
                                <th>{!! trans('coupons.date_from') !!}</th>
                                <th>{!! trans('coupons.date_to') !!}</th>
                                <th>{!! trans('coupons.statusActive') !!}</th>
                                <th>{!! trans('coupons.add_date') !!}</th>
                                <th>{!! trans('coupons.takeAction') !!}</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
        </div>
        @else
            <div class="alert alert-info">{!! trans('assets.noData') !!}</div>
        @endif
    </div>
@section('inlineJS')
    <script>
        $(document).ready(function () {
            var table = $('#myTable').DataTable({
                "order": [[0, 'desc']],
                "ajax": "{{Url('admin/coupons/dataTable')}}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'code', name: 'code'},
                    {data: 'percent', name: 'percent'},
                    {data: 'date_from', name: 'date_from'},
                    {data: 'date_to', name: 'date_to'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'control', name: ''}
                ], "language": {
                    url: "{{(Session::get('local') !== 'en') ? 'https://cdn.datatables.net/plug-ins/1.10.13/i18n/Arabic.json':''}}"
                },
                "aoColumnDefs": [
                    {'bSortable': false, 'aTargets': [7]}
                ],
            });
        })
    </script>

@endsection

@endsection
