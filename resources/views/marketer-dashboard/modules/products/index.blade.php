@extends('marketer-dashboard.layout')
@section('title','المنتجات')
@section('content')
    <!-- BEGIN PAGE CONTENT-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{{trans('admins.title')}}" href="{{ route('marketer.dashboard') }}"> {{trans('admins.home')}} /</a></li>
        <li class="breadcrumb-item active"> المنتجات</li>
    </ol>

    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            @if(\App\Models\Product::StockActive()->count() > 0)
                <!-- END EXAMPLE TABLE PORTLET-->
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-file-image-o" aria-hidden="true"></i>
                            بيانات المنتجات
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
                                <th>{!! trans('products.name') !!}</th>
                                <th>{!! trans('products.category') !!}</th>
                                <th>{!! trans('products.sub_category') !!}</th>
                                <th>{!! trans('products.final_price') !!}</th>
                                <th>{!! trans('products.add_date') !!}</th>
                                <th>{!! trans('products.take_action') !!}</th>
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
                        "ajax": "{{route('products-marketer.dataTable')}}",
                        columns: [
                            {data: 'id', name: 'id'},
                            {data: 'name', name: 'name'},
                            {data: 'category', name: 'category'},
                            {data: 'sub_category', name: 'sub_category'},
                            {data: 'final_price', name: 'final_price'},
                            {data: 'created_at', name: 'created_at'},
                            {data: 'control', name: ''}
                        ], "language": {
                            url: "{{(Session::get('local') !== 'en') ? 'https://cdn.datatables.net/plug-ins/1.10.13/i18n/Arabic.json':''}}"
                        },
                        "aoColumnDefs": [
                            {'bSortable': false, 'aTargets': [6]}
                        ],
                    });
                })
            </script>

        @endsection
        <!-- END PAGE LEVEL PLUGINS -->

@endsection
