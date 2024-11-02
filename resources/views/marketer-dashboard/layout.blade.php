<html dir="{{Session::get('local') !== 'en' ? 'rtl' : 'ltr'}}">
<head>
    <meta charset="utf-8"/>
    <title style="background-color: #ff4003">Becleopatra | @yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    {!! Html::style('back/assets/global/plugins/font-awesome/css/font-awesome.min.css') !!}
    {!! Html::style('back/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') !!}
    {!! Html::style('back/assets/global/plugins/uniform/css/uniform.default.css') !!}
    @if(Session::get('local') !== 'en')
        {!! Html::style('back/assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css') !!}
        {!! Html::style('back/assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css') !!}
    @else
        {!! Html::style('back/assets/global/plugins/bootstrap/css/bootstrap.min.css') !!}
        {!! Html::style('back/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') !!}
    @endif
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! Html::style('back/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') !!}
    {!! Html::style('back/assets/global/plugins/morris/morris.css') !!}
    {!! Html::style('back/assets/global/plugins/fullcalendar/fullcalendar.min.css') !!}
    {!! Html::style('back/assets/global/plugins/jqvmap/jqvmap/jqvmap.css') !!}
    {{-- File Input --}}
    {!! Html::style('back/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}

    @if(Session::get('local') !== 'en')

        {{--<link href="https://fonts.googleapis.com/css?family=Reem+Kufi" rel="stylesheet">--}}
        <!-- BEGIN THEME GLOBAL STYLES -->
        {!! Html::style('back/assets/global/css/components-rtl.css')!!}
        {!! Html::style('back/assets/global/css/plugins-rtl.min.css') !!}
        <!-- BEGIN THEME GLOBAL STYLES -->
        {!! Html::style('back/assets/layouts/layout4/css/layout-rtl.min.css') !!}
        {!! Html::style('back/assets/layouts/layout4/css/themes/light-rtl.min.css') !!}
        {!! Html::style('back/assets/pages/css/profile-2-rtl.css') !!}
        {!! Html::style('back/assets/layouts/layout4/css/custom-rtl.min.css') !!}
    @else
        <link href="https://fonts.googleapis.com/css?family=Sansita" rel="stylesheet">
        <!-- BEGIN THEME GLOBAL STYLES -->
        {!! Html::style('back/assets/global/css/components.css')!!}
        {!! Html::style('back/assets/global/css/plugins.min.css') !!}
        <!-- BEGIN THEME GLOBAL STYLES -->
        {!! Html::style('back/assets/layouts/layout4/css/layout.min.css') !!}
        {!! Html::style('back/assets/layouts/layout4/css/themes/light.min.css') !!}
        {!! Html::style('back/assets/pages/css/profile-2.css') !!}
        {!! Html::style('back/assets/layouts/layout4/css/custom.min.css') !!}
    @endif
    <!-- END THEME LAYOUT STYLES -->
    {{--<link rel="shortcut icon" href="favicon.ico"/>--}}

    {!! Html::style('back/datatable/global/plugins/select2/select2.css') !!}
    {!! Html::style('back/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
    {!! Html::style('back/datatable/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css') !!}
    {!! Html::style('back/datatable/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css') !!}
    {!! Html::style('back/datatable/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') !!}
    {!! Html::style('back/assets/global/plugins/select2/css/select2.min.css') !!}
    {!! Html::style('back/assets/global/plugins/select2/css/select2-bootstrap.min.css') !!}
    {!! Html::style('back/assets/global/plugins/selectize-master/css/selectize.css') !!}

    <!-- Start Sweet Alert Library Css File -->
    {!! Html::style('back/assets/global/sweetAlert/sweetalert.css') !!}
    <!-- End Sweet Alert Library Css File -->

    {!! Html::style('back/assets/global/plugins/SmartWizard/dist/css/smart_wizard.css') !!}
    {!! Html::style('back/assets/global/plugins/SmartWizard/dist/css/smart_wizard_theme_arrows.css') !!}


    <!-- Start Sweet Alert Library Js File [ Just For load sweet Alert Functions before check session check  ]-->
    {!! Html::script('back/assets/global/plugins/jquery.min.js') !!}
    {!! Html::script('back/assets/global/sweetAlert/sweetalert.min.js') !!}
    <!-- End Sweet Alert Library Js File -->

    @yield('styles')
</head>
<!-- END HEAD -->

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo"
      style="font-family: 'Open Sans', sans-serif;">

<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            {{-- <a href="{{Url('/').'/admin'}}">
                 <img src="{{url('logo.jpg')}}" class="logo-default img-responsive" style="margin-top: 10px !important;">
             </a>--}}

            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse"> </a>

        <div class="page-actions">

        </div>
        <div class="page-top">

            <div class="top-menu">
                @include('marketer-dashboard.layouts._topMenu')
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"></div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">

    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <ul class="page-sidebar-menu page-sidebar-menu-compact" data-keep-expanded="false"
                data-auto-scroll="true" data-slide-speed="200">

                <!-- Home Page  -->
                <li class="start {{Request::is('marketer') ? 'active' : ''}}">
                    <a href="{{route('marketer.dashboard')}}">
                        <i class="fa fa-home"></i>
                        <span class="title">{!! trans('sidebar.home') !!} </span>
                    </a>
                </li>
                <!-- Home Page  -->
                <li class="{{Request::is('marketer/products*') ? 'active' : ''}}">
                    <a href="{{route('products-marketer.index')}}">
                        <i class="fa fa-file-image-o" aria-hidden="true"></i>
                        <span class="title">المنتجات</span>
                    </a>
                </li>
                <li class="{{Request::is('marketer/referral-code*') ? 'active' : ''}}">
                    <a href="{{route('referral-code.index')}}">
                        <i class="fa fa-code" aria-hidden="true"></i>
                        <span class="title">كود المشاركة</span>
                    </a>
                </li>
                <li class="{{Request::is('marketer/balances*') ? 'active' : ''}}">
                    <a href="{{route('balances.index')}}">
                        <i class="fa fa-money" aria-hidden="true"></i>
                        <span class="title">الرصيد</span>
                    </a>
                </li>
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            {{-- @if (Session::has('sweet_alert.alert'))
                 <script>
                     swal({!! Session::get('sweet_alert.alert') !!});
                 </script>
                 <?php
                 Session::forget('sweet_alert.alert');
                 Session::save();
                 ?>
             @endif--}}
            {{--@include('sweet::alert')--}}
            <?php Session::forget('sweet_alert.alert'); ?>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>{!! trans('assets.error') !!}</strong><br><br>
                    <ul>
                        @foreach ($errors->all() as  $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br>
            @endif
            @yield('content')
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    {{--<div class="page-footer-inner">
        2018 &copy; <a href="http://sawa4.com.eg/" target="_blank" style="color: #000">Development By SAWA - 4 </a> |
        Fix3onSystem V - 1.0 .
    </div>--}}
    <div class="scroll-to-top">
        <i class="fa fa-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
<!--[if lt IE 9]>
{!! Html::script('back/assets/global/plugins/respond.min.js') !!}
{!! Html::script('back/assets/global/plugins/excanvas.min.js') !!}
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
{!! Html::script('back/assets/global/plugins/jquery.min.js') !!}
{!! Html::script('back/assets/global/plugins/jquery.validate.js') !!}
{!! Html::script('back/assets/global/plugins/bootstrap/js/bootstrap.min.js') !!}
{{--{!! Html::script('back/assets/global/plugins/js.cookie.min.js') !!}--}}
{{--{!! Html::script('back/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') !!}--}}
{!! Html::script('back/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') !!}
{{--{!! Html::script('back/assets/global/plugins/jquery.blockui.min.js') !!}--}}
{!! Html::script('back/assets/global/plugins/uniform/jquery.uniform.min.js') !!}
{!! Html::script('back/assets/pages/scripts/components-bootstrap-switch.min.js') !!}
{!! Html::script('back/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}
{!! Html::script('back/assets/global/plugins/counterup/jquery.waypoints.min.js') !!}
{!! Html::script('back/assets/global/plugins/counterup/jquery.counterup.min.js') !!}
{!! Html::script('back/assets/global/plugins/morris/morris.min.js') !!}
{{-- File Input JS  --}}
{!! Html::script('back/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}

<!-- BEGIN THEME GLOBAL SCRIPTS -->
{!! Html::script('back/assets/global/scripts/app.min.js') !!}
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
{!! Html::script('back/assets/pages/scripts/dashboard.min.js') !!}
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
{!! Html::script('back/assets/layouts/layout4/scripts/layout.min.js') !!}
{!! Html::script('back/assets/layouts/layout4/scripts/demo.min.js') !!}
{!! Html::script('back/assets/layouts/global/scripts/quick-sidebar.min.js') !!}
<!-- END THEME LAYOUT SCRIPTS -->

{!! Html::script('back/assets/global/plugins/selectize-master/js/selectize.js') !!}
{!! Html::script('back/assets/global/plugins/select2/js/select2.full.min.js') !!}
{!! Html::script('back/assets/global/plugins/jquery-validation/js/jquery.validate.js') !!}
{!! Html::script('back/assets/global/plugins/jquery-validation/js/additional-methods.min.js') !!}


{{-- START SECTION DATA TABLE --}}

{!! Html::script('back/datatable/global/plugins/datatables/media/js/jquery.dataTables.min.js') !!}
{!! Html::script('back/datatable/global/scripts/jqueryDatatable.js') !!}
{!! Html::script('back/datatable/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js') !!}
{!! Html::script('back/datatable/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js') !!}
{!! Html::script('back/datatable/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js') !!}
{!! Html::script('back/datatable/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') !!}
{!! Html::script('back/assets/global/sweetAlert/sweetalert.min.js') !!}
<!-- Tags -->
{!! Html::script("back/assets/tags/tagsinput.min.js") !!}
{{-- This File has function Sweet Alert [ Just include for imporve code  ] --}}
@include('admin.appJsBaldeSweetAlert') ;


<script>
    $(function () {
        $('.select2').select2({
            tags: false,
            tokenSeparators: [','],
        });
    });
</script>
@yield('inlineJS')

</body>
</html>
