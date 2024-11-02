@extends('admin.layout')
@section('title' , trans('grb.title'))
@section('content')
    <div>
        <a href="{{Url('/')}}/admin/groups/create" class="btn blue btn-circle"><i
                class="fa fa-plus"></i> {!! trans('assets.AddNew') !!}</a>
    </div>
    <br>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} / </a></li>
        <li class="breadcrumb-item active">  {!!trans('grb.title') !!}
        </li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            @if(\App\Models\Group::count() > 0)
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                            {!! trans('grb.title') !!}
                        </div>
                    </div>

                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="myTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{!! trans('grb.name') !!}</th>
                                <th>{!! trans('grb.add_date') !!}</th>
                                <th>{!! trans('grb.take_action') !!}</th>
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
                order: [[0, 'desc']],
                ajax: "{{Url('admin/groups/dataTable')}}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'control', name: 'control'},
                ], "language": {
                    url: "{{(Session::get('local') !== 'en') ? 'https://cdn.datatables.net/plug-ins/1.10.13/i18n/Arabic.json':''}}"
                },
                "aoColumnDefs": [
                    {'bSortable': false, 'aTargets': [3]}
                ],
            });

        });
    </script>


@endsection

@endsection
