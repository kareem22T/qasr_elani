@extends('admin.layout')
@section('title' , trans('cities.title'))
@section('content')
    <div>
        <a href="{!!Url('/')!!}/admin/cities/create" class="btn blue btn-circle"><i class="fa fa-plus"></i>
            {!! trans('assets.AddNew') !!}
        </a>
    </div>
    <br>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{!! trans('assets.home') !!}" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} / </a></li>
        <li class="breadcrumb-item active">  {!! trans('cities.title') !!}
        </li>
    </ol>
    <!-- BEGIN PAGE CONTENT-->

    @if(\App\Models\City::count() > 0)
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-flag" aria-hidden="true"></i>
                    {{trans('cities.title')}}
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                </div>
            </div>

            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover danger" id="myTable">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>{!! trans('cities.name_ar') !!}</th>
                            <th>{!! trans('cities.name_en') !!}</th>
                            <th>{!! trans('cities.Add_Date') !!}</th>
                            <th>{!! trans('cities.control') !!}</th>
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
                ajax: "{{Url('admin/cities/dataTable')}}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name_ar', name: 'name_ar'},
                    {data: 'name_en', name: 'name_en'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'control', name: 'control'},
                ], "language": {
                    url: "{{(Session::get('local') !== 'en') ? 'https://cdn.datatables.net/plug-ins/1.10.13/i18n/Arabic.json':''}}"
                },
                "aoColumnDefs": [
                    {'bSortable': false, 'aTargets': [4]}
                ],
            });

        });
    </script>


@endsection


@endsection
