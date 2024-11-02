@extends('admin.layout')
@section('title',trans('categories.categoriesDetails'))

@section('content')

    <div class="container-fluid">
        <!-- BEGIN PAGE CONTENT-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a title="{!! trans('assets.home') !!}"
                                           href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
            <li class="breadcrumb-item"><a title=""
                                           href="{{ Url('/')}}/admin/categories ">{!! trans('categories.categories') !!} </a></li>
            <li class="breadcrumb-item active"> / {!! trans('categories.categoriesDetails') !!} : {{ $cat['name_'.$lang] }} </li>
        </ol>
        <!-- BEGIN PAGE CONTENT-->
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus"></i> {!! trans('categories.categoriesDetails') !!} : {{ $cat['name_'.$lang] }}
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-hover">
                    <thead>

                    <tr class="text-center">
                        <th>
                            @if($cat->img != "")
                                <img class="img-circle " width="200" height="200" src="{{Url('/')}}/uploads/categories/{{$cat->img}}"
                                     alt="">
                            @else
                                <img src="{{Url('/')}}/back/assets/global/img/person.png" alt=""
                                     style="width: 200px; height: 150px;">
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <th>ID #</th>
                        <th>{{ $cat->id }}</th>
                    </tr>
                    <tr>
                        <th>{!! trans('categories.name_ar') !!}</th>
                        <th>{{ $cat->name_ar }}</th>
                    </tr>
                    <tr>
                        <th>{!! trans('categories.name_en') !!}</th>
                        <th>{{ $cat->name_en }}</th>
                    </tr>

                    <tr>
                        <th>{!! trans('categories.statusActive') !!}</th>
                        <th>@if($cat->isActive == 0)
                                <small class="text-danger"> {!! trans('categories.block') !!}</small>
                            @elseif ($cat->activation_code == 1)
                                <small class="text-success"> {!! trans('categories.actived') !!}</small>
                            @endif
                        </th>
                    </tr>

                    <tr>
                        <th>{!! trans('categories.add_date') !!}</th>
                        <th>{{ $cat->created_at }}</th>
                    </tr>

                    <tr>
                        <th>{!! trans('categories.lastEdit') !!}</th>
                        <th>{{ $cat->updated_at }}</th>
                    </tr>

                    <tr>
                        <th>{!! trans('categories.countSub') !!}</th>
                        <th>20</th>
                    </tr>

                    </thead>
                </table>
            </div>
        </div>
    </div>

@endsection
