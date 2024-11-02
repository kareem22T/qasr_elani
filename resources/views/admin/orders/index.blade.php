@extends('admin.layout')
@section('title',trans('orders.manageOrders'))
@section('content')
    <!-- BEGIN PAGE CONTENT-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
        <li class="breadcrumb-item active">{!! trans('orders.manageOrders') !!} </li>
    </ol>

    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">

        @if(\App\Models\Order::count() > 0)
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-sp"></i> {!! trans('orders.manageOrders') !!}
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                        </div>
                    </div>

                    <div class="portlet-body text-center">
                        <table class="table table-striped table-bordered table-hover" id="myTable"
                               style="overflow: scroll">
                            <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>{!! trans('orders.order_num') !!}</th>
                                <th>{!! trans('orders.username') !!}</th>
                                <th>{!! trans('orders.status') !!}</th>
                                <th>{!! trans('orders.date_creation') !!}</th>
                                <th>{!! trans('orders.control') !!}</th>
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
    </div>
    <br>

@section('inlineJS')
    <script>
        $(document).ready(function () {
            var table = $('#myTable').DataTable({
                "order": [[0, 'desc']],
                "ajax": "{{Url('admin/orders/dataTable')}}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'number', name: 'number'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'control', name: ''}
                ], "language": {
                    url: "{{(Session::get('local') !== 'en') ? 'https://cdn.datatables.net/plug-ins/1.10.13/i18n/Arabic.json':''}}"
                },
                "aoColumnDefs": [
                    {'bSortable': false, 'aTargets': []}
                ],
            });
        })
    </script>

@endsection

@endsection
