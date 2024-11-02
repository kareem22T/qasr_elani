@extends('admin.layout')
@section('title',trans('products.products'))
@section('content')
    <div>
        <a href="{{Url('/')}}/admin/products/create" class="btn blue btn-circle"><i class="fa fa-plus"></i> {!! trans('assets.AddNew') !!}</a>
    </div>
    <br>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} / </a></li>
        <li class="breadcrumb-item active">  {!!trans('products.products') !!}
        </li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            @if(\App\Models\Product::count() > 0)
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-shopping-cart"></i> {!! trans('products.control') !!}
                        </div>
                    </div>

                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="myTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th  >{!! trans('products.name') !!}</th>
                                <th>{!! trans('products.category') !!}</th>
                                <th>{!! trans('products.sub_category') !!}</th>
                                <th>{!! trans('products.views') !!}</th>
                                <th>{!! trans('products.price_before') !!}</th>
                                <th>{!! trans('products.final_price') !!}</th>
                                <th>{!! trans('products.discount') !!}</th>
                                <th>{!! trans('products.stock') !!}</th>
                                <th>{!! trans('products.is_recommended') !!}</th>
                                <th>{!! trans('products.active_status') !!}</th>
                                <th>{!! trans('products.add_date') !!}</th>
                                <th>{!! trans('products.take_action') !!}</th>
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
                "ajax": "{{Url('admin/products/dataTable')}}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'category', name: 'category'},
                    {data: 'sub_category', name: 'sub_category'},
                    {data: 'views', name: 'views'},
                    {data: 'regular_price', name: 'regular_price'},
                    {data: 'final_price', name: 'final_price'},
                    {data: 'discount', name: 'discount'},
                    {data: 'stock', name: 'stock'},
                    {data: 'is_recommended', name: 'is_recommended'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'control', name: ''}
                ], "language": {
                    url: "{{(Session::get('local') !== 'en') ? 'https://cdn.datatables.net/plug-ins/1.10.13/i18n/Arabic.json':''}}"
                },
                "aoColumnDefs": [
                    {'bSortable': false, 'aTargets': [4, 7]}
                ],
                "pageLength": 50
            });
        })
    </script>

@endsection

@endsection
