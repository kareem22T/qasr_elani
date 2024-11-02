@extends('admin.layout')
@section('title',trans('contacts.title'))
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} / </a></li>
        <li class="breadcrumb-item active">  {!! trans('contacts.title') !!}
        </li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            @if(\App\Models\Contact::count() > 0)
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-ticket"></i> {!! trans('contacts.title') !!}
                        </div>
                    </div>

                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="myTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{!! trans('contacts.name') !!}</th>
                                <th>{!! trans('contacts.phone') !!}</th>
                                <th>{!! trans('contacts.message') !!}</th>
                                <th>{!! trans('contacts.status') !!}</th>
                                <th>{!! trans('contacts.notes') !!}</th>
                                <th>{!! trans('contacts.add_date') !!}</th>
                                <th>{!! trans('contacts.control') !!}</th>
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
                "ajax": "{{Url('admin/contacts/dataTable')}}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'message', name: 'message'},
                    {data: 'status', name: 'status'},
                    {data: 'notes', name: 'notes'},
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

@endsection
