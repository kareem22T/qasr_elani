@extends('admin.layout')
@section('title' , trans('productsAds.title'))

@section('content')
	<div>
		<a href="{!!Url('/')!!}/admin/productAds/create" class="btn blue btn-circle"><i class="fa fa-plus"></i>
		{!! trans('productsAds.create') !!}
		</a>
	</div>
    <br>
	<!-- BEGIN PAGE CONTENT-->
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a title="{{trans('assets.home')}}"href="{{ Url('/') }}/admin">{{trans('assets.home')}}</a></li>
			<li class="breadcrumb-item active"> / {!! trans('productsAds.title') !!}</li>
		</ol>
	<!-- BEGIN PAGE CONTENT-->

	@if(\App\Models\ProductAd::count() > 0)
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-file-image-o" aria-hidden="true"></i>
					{!! trans('productsAds.title') !!}
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
				</div>
			</div>

			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover danger" id="myTable">
					<thead class="text-center">
						<tr>
							<th># ID </th>
							<th>{!! trans('productsAds.product_name') !!}</th>
							<th>{!! trans('productsAds.img') !!}</th>
							<th>{!! trans('productsAds.sort') !!}</th>
                            <th>{!! trans('productsAds.active_status') !!}</th>
                            <th>{!! trans('productsAds.date') !!}</th>
							<th>{!! trans('productsAds.options') !!}</th>
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
                "order": [[0, 'desc']],
                "ajax": "{{Url('admin/productAds/dataTable')}}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'product_name', name: 'product_name'},
                    {data: 'img', name: 'img'},
                    {data: 'sort', name: 'sort'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'control', name: ''}
                ], "language": {
                    url: "{{(Session::get('local') !== 'en') ? 'https://cdn.datatables.net/plug-ins/1.10.13/i18n/Arabic.json':''}}"
                },
                "aoColumnDefs": [
                    {'bSortable': false, 'aTargets': [2, 6]}
                ],
            });
        });

	</script>


@endsection


@endsection
