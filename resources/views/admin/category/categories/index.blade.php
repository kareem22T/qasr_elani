@extends('admin.layout')
@section('title',trans('categories.categories'))
@section('content')
    <div><a href="{{Url('/')}}/admin/categories/create" class="btn blue btn-circle"><i class="fa fa-plus"></i> {!! trans('assets.AddNew') !!}</a></div>
    <br>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} / </a></li>
        <li class="breadcrumb-item active">  {!!trans('categories.categories') !!}
        </li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            @if(\App\Models\Category::count() > 0)
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-tags"></i> {!! trans('categories.control') !!}
                        </div>
                    </div>

                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="myTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{!! trans('categories.name_ar') !!}</th>
                                <th>{!! trans('categories.name_en') !!}</th>
                                <th>{!! trans('categories.sort') !!}</th>
                                <th>{!! trans('categories.img') !!}</th>
                                <th>{!! trans('categories.statusActive') !!}</th>
                                <th>{!! trans('categories.add_date') !!}</th>
                                <th>{!! trans('categories.takeAction') !!}</th>
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
                "ajax": "{{Url('admin/categories/dataTable')}}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name_ar', name: 'name_ar'},
                    {data: 'name_en', name: 'name_en'},
                    {data: 'sort', name: 'sort'},
                    {data: 'img', name: 'img'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'control', name: ''}
                ], "language": {
                    url: "{{(Session::get('local') !== 'en') ? 'https://cdn.datatables.net/plug-ins/1.10.13/i18n/Arabic.json':''}}"
                },
                "aoColumnDefs": [
                    {'bSortable': false, 'aTargets': [4, 7]}
                ],
            });
        })
    </script>

@endsection

@endsection
