@extends('admin.layout')
@section('title',trans('marketers.title'))
@section('content')
    <div>
        <a href="{{route('marketers.create')}}" class="btn blue btn-circle"><i class="fa fa-plus"></i> {!! trans('marketers.add') !!}</a>
    </div>
    <br>
    <!-- BEGIN PAGE CONTENT-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{{trans('admins.title')}}" href="{{ Url('/') }}/admin"> {{trans('admins.home')}} /</a></li>
        <li class="breadcrumb-item active"> {{trans('marketers.title')}} </li>
    </ol>

    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            @if(\App\Models\Marketer::count() > 0)
                <!-- END EXAMPLE TABLE PORTLET-->
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user-secret" aria-hidden="true"></i>
                            {{trans('marketers.title')}}
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                        </div>
                    </div>

                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover danger" id="myTable">
                            <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>{!! trans('marketers.name') !!}</th>
                                <th>{!! trans('marketers.phone') !!}</th>
                                <th>{!! trans('marketers.referral_code') !!}</th>
                                <th>{!! trans('marketers.is_default') !!}</th>
                                <th>{!! trans('marketers.balance') !!}</th>
                                <th>{!! trans('marketers.Add_Date') !!}</th>
                                <th>{!! trans('marketers.control') !!}</th>

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

        </div>

        <!-- END PAGE CONTENT-->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        @section('inlineJS')
            <script>
                $(document).ready(function () {
                    var table = $('#myTable').DataTable({
                        "order": [[0, 'desc']],
                        "ajax": "{{Url('admin/marketers/dataTable')}}",
                        columns: [
                            {data: 'id', name: 'id'},
                            {data: 'name', name: 'name'},
                            {data: 'phone', name: 'phone'},
                            {data: 'referral_code', name: 'referral_code'},
                            {data: 'is_default', name: 'is_default'},
                            {data: 'balance', name: 'balance'},
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
        <!-- END PAGE LEVEL PLUGINS -->

@endsection
