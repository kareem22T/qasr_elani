@extends('marketer-dashboard.layout')
@section('title','تفاصيل المنتجات')
@section('content')
    <style>
        table {
            table-layout: fixed;
        }

        td {
            word-wrap: break-word;
        }
    </style>
    <!-- BEGIN PAGE CONTENT-->
    <ol class="breadcrumb">

        <li class="breadcrumb-item"><a title="{!! trans('assets.home') !!}"
                                       href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
        <li class="breadcrumb-item"><a title="{!! trans('products.products') !!}"
                                       href="{{ Url('/')}}/admin/products "> {!! trans('products.products') !!} </a>
        </li>
        <li class="breadcrumb-item active"> / {!! trans('products.products_data') !!}
            : {{ $product['name_'.Session::get('local')] }}</li>

    </ol>

    <h1 class="text-center bold">
        {{trans('products.products_data')}}
    </h1>

    <!-- BEGIN PORTLET-->
    <div class="portlet light bordered" id="myTable">

        <div class="portlet-body">

            <div class="margin-top-10 margin-bottom-10 clearfix">
                <table class="table table-bordered table-striped">

                    <tr>
                        <td>#ID</td>
                        <td>
                            <div id="pulsate-regular" style="padding:5px;"> {!! $product->id !!} </div>
                        </td>
                    </tr>
                    <tr>
                        <td>{{trans('products.name_ar')}}</td>
                        <td>
                            <span class="btn btn-primary btn-circle">
                                 <div>

                                     {{ $product->name_ar }}
                                 </div>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>{{trans('products.name_en')}}</td>
                        <td>
                            <span class="btn btn-primary btn-circle">
                                 <div>

                                     {{ $product->name_en }}
                                 </div>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td> {{trans('products.desc_ar')}}</td>
                        <td>
                            <p class="address">
                                {!! $product->desc_ar !!}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td> {{trans('products.desc_en')}}</td>
                        <td>
                            <p class="address">
                                {!! $product->desc_en !!}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td> {{trans('products.final_price')}}</td>
                        <td>
                            <p class="address">
                                {!! $product->on_sale ? $product->sale_price : $product->regular_price !!}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td> {{trans('products.category')}}</td>
                        <td>
                            <span class="btn btn-primary btn-circle">
                                {{ $product->subCategory->category['name_'.Session::get('local')] }}
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td> {{trans('products.sub_category')}}</td>
                        <td>
                            <span class="btn btn-primary btn-circle">
                                {{ $product->subCategory['name_'.Session::get('local')] }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td> {!! trans('products.add_date') !!} </td>
                        <td>
                            <span class="btn btn-primary btn-circle">
                            {!! $product->created_at !!}
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td> لينك المشاركة</td>
                        <td>
                            <div class="card-body">
                                <input type="text" id="copy_{{ $product->id }}" value="https://becleopatra.vercel.app/product/{{$product->id}}?referral_code= {{auth('marketers')->user()->referral_code}}">
                                <button value="copy" onclick="copyToClipboard('copy_{{ $product->id }}')">Copy!</button>
                        </td>
                    </tr>

                </table>
            </div>
        </div>
        @foreach($product->getMedia() as  $media)
            <a href="{{$media->getFullUrl()}}" target="_blank">
                <img class="img-circle" src="{{$media->getFullUrl()}}" alt="" width="150" height="150">
            </a>
        @endforeach
    </div>
@endsection

<script>
    function copyToClipboard(id) {
        document.getElementById(id).select();
        document.execCommand('copy');
    }
</script>
