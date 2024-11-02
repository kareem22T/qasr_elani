@extends('admin.layout')
@section('title',trans('notify.title'))
@section('content')
    <div>
        <a href="{{Url('/')}}/admin/pushNotifications/create" class="btn blue btn-circle"><i class="fa fa-plus"></i> {!! trans('assets.AddNew') !!}</a>
    </div>
    <br>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} / </a></li>
        <li class="breadcrumb-item active">  {!!trans('notify.title') !!}
        </li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            @if(\App\Models\Notification::whereType(0)->count() > 0)
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe" aria-hidden="true"></i>
                            {!! trans('notify.title') !!}
                        </div>
                    </div>

                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="myTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{!! trans('notify.body_ar') !!}</th>
                                <th>{!! trans('notify.body_en') !!}</th>
                                <th>{!! trans('notify.admin_id') !!}</th>
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
                "ajax": "{{Url('admin/pushNotifications/dataTable')}}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'body_ar', name: 'body_ar'},
                    {data: 'body_en', name: 'body_en'},
                    {data: 'admin_id', name: 'admin_id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'control', name: ''}
                ], "language": {
                    url: "{{(Session::get('local') !== 'en') ? 'https://cdn.datatables.net/plug-ins/1.10.13/i18n/Arabic.json':''}}"
                },
                "aoColumnDefs": [
                    {'bSortable': false, 'aTargets': [5]}
                ],
            });
        })
    </script>

@endsection

@endsection
