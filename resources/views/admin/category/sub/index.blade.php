@extends('admin.layout')
@section('title' , trans('subCats.title'))
@section('content')
    <div>
        <a href="{!!Url('/')!!}/admin/subCategories/create?cat_id={{@$category->id}}" class="btn blue btn-circle "><i
                class="fa fa-plus"></i> {!! trans('assets.AddNew') !!}</a>
    </div>
    <br>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="{{trans('assets.home')}}" href="{{ Url('/') }}/admin">{{trans('assets.home')}}</a></li>
        <li class="breadcrumb-item active"> / {{trans('subCats.subCats')}}</li>
    </ol>
    @if(\App\Models\SubCategory::where('category_id',$category->id)->count() > 0)
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-flag" aria-hidden="true"></i>
                    {{trans('subCats.subCats')}}
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                </div>
            </div>

            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover danger" id="myTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>{!! trans('subCats.subCatsAR') !!}</th>
                        <th>{!! trans('subCats.subCatsEn') !!}</th>
                        <th>{!! trans('subCats.sort') !!}</th>
                        <th>{!! trans('categories.img') !!}</th>
                        <th>{!! trans('categories.statusActive') !!}</th>
                        <th>{!! trans('subCats.Add_Date') !!}</th>
                        <th>{!! trans('subCats.control') !!}</th>
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
                ajax: "{!! Url('admin/subCategories/get/'.$category->id) !!}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name_ar', name: 'name_ar'},
                    {data: 'name_en', name: 'name_en'},
                    {data: 'sort', name: 'sort'},
                    {data: 'img', name: 'img'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'control', name: 'control'},
                ], "language": {
                    url: "{{(Session::get('local') !== 'en') ? 'https://cdn.datatables.net/plug-ins/1.10.13/i18n/Arabic.json':''}}"
                },
                "aoColumnDefs": [
                    {'bSortable': false, 'aTargets': [3, 6]}
                ],
            });


        }); // End Doument Ready .


    </script>


@endsection


@endsection
