<?php

?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <title style="background-color: #ff4003">{{trans('assets.title')}} | @yield('title')</title>
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
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet">
        {{--<link href="https://fonts.googleapis.com/css?family=Reem+Kufi" rel="stylesheet">--}}
    <!-- BEGIN THEME GLOBAL STYLES -->
        {!! Html::style('back/assets/global/css/components-rtl.css')!!}
        {!! Html::style('back/assets/global/css/plugins-rtl.min.css') !!}
    <!-- BEGIN THEME GLOBAL STYLES -->
        {!! Html::style('back/assets/layouts/layout4/css/layout-rtl.min.css') !!}
        {!! Html::style('back/assets/layouts/layout4/css/themes/light-rtl.min.css') !!}
        {!! Html::style('back/assets/layouts/layout4/css/custom-rtl.min.css') !!}
    @else
        <link href="https://fonts.googleapis.com/css?family=Sansita" rel="stylesheet">
        <!-- BEGIN THEME GLOBAL STYLES -->
        {!! Html::style('back/assets/global/css/components.css')!!}
        {!! Html::style('back/assets/global/css/plugins.min.css') !!}
    <!-- BEGIN THEME GLOBAL STYLES -->
        {!! Html::style('back/assets/layouts/layout4/css/layout.min.css') !!}
        {!! Html::style('back/assets/layouts/layout4/css/themes/light.min.css') !!}
        {!! Html::style('back/assets/layouts/layout4/css/custom.min.css') !!}
    @endif
<!-- END THEME LAYOUT STYLES -->
    {{--<link rel="shortcut icon" href="favicon.ico"/>--}}

    {!! Html::style('back/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
    {!! Html::style('back/datatable/global/plugins/select2/select2.css') !!}
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
            <a href="{{Url('/').'/admin'}}">
                {!! Html::image('back/assets/global/img/sawa4-white.png',null,['class'=>'logo-default']) !!}
            </a>

            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN PAGE ACTIONS -->
        <!-- DOC: Remove "hide" class to enable the page header actions -->
        <div class="page-actions">

        </div>
        <!-- END PAGE ACTIONS -->
        <!-- BEGIN PAGE TOP -->
        <div class="page-top">
            <!-- BEGIN HEADER SEARCH BOX -->
            <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
        {{--<form class="search-form" action="page_general_search_2.html" method="GET">
            <div class="input-group">
                <input type="text" class="form-control input-sm" placeholder="Search..." name="query">
                <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit">
                                <i class="icon-magnifier"></i>
                            </a>
                        </span>
            </div>
        </form>
--}}            <!-- END HEADER SEARCH BOX -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="separator hide"></li>
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-extended dropdown-notification dropdown-dark"
                        id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            <i class="icon-bell"></i>
                            <span class="badge badge-success"> 7 </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3>
                                    <span class="bold">12 pending</span> notifications</h3>
                                <a href="page_user_profile_1.html">view all</a>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 250px;"
                                    data-handle-color="#637283">
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">just now</span>
                                            <span class="details">
                                                        <span class="label label-sm label-icon label-success">
                                                            <i class="fa fa-plus"></i>
                                                        </span> New user registered. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">3 mins</span>
                                            <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Server #12 overloaded. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">10 mins</span>
                                            <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> Server #2 not responding. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">14 hrs</span>
                                            <span class="details">
                                                        <span class="label label-sm label-icon label-info">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </span> Application error. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">2 days</span>
                                            <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Database overloaded 68%. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">3 days</span>
                                            <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> A user IP blocked. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">4 days</span>
                                            <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> Storage Server #4 not responding dfdfdfd. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">5 days</span>
                                            <span class="details">
                                                        <span class="label label-sm label-icon label-info">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </span> System Error. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">9 days</span>
                                            <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Storage server failed. </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- END NOTIFICATION DROPDOWN -->
                    <li class="separator hide"></li>
                    <!-- BEGIN INBOX DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_inbox_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            <i class="icon-envelope-open"></i>
                            <span class="badge badge-danger"> 4 </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3>You have
                                    <span class="bold">7 New</span> Messages</h3>
                                <a href="app_inbox.html">view all</a>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 275px;"
                                    data-handle-color="#637283">
                                    <li>
                                        <a href="#">
                                                    <span class="photo">
                                                        <img src="{{Url('/')}}/back/assets/layouts/layout3/img/avatar2.jpg"
                                                             class="img-circle" alt=""> </span>
                                            <span class="subject">
                                                        <span class="from"> Lisa Wong </span>
                                                        <span class="time">Just Now </span>
                                                    </span>
                                            <span class="message"> Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                                    <span class="photo">
                                                        <img src="{{Url('/')}}/back/assets/layouts/layout3/img/avatar3.jpg"
                                                             class="img-circle" alt=""> </span>
                                            <span class="subject">
                                                        <span class="from"> Richard Doe </span>
                                                        <span class="time">16 mins </span>
                                                    </span>
                                            <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                                    <span class="photo">
                                                        <img src="{{Url('/')}}/back/assets/layouts/layout3/img/avatar1.jpg"
                                                             class="img-circle" alt=""> </span>
                                            <span class="subject">
                                                        <span class="from"> Bob Nilson </span>
                                                        <span class="time">2 hrs </span>
                                                    </span>
                                            <span class="message"> Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                                    <span class="photo">
                                                        <img src="{{Url('/')}}/back/assets/layouts/layout3/img/avatar2.jpg"
                                                             class="img-circle" alt=""> </span>
                                            <span class="subject">
                                                        <span class="from"> Lisa Wong </span>
                                                        <span class="time">40 mins </span>
                                                    </span>
                                            <span class="message"> Vivamus sed auctor 40% nibh congue nibh... </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                                    <span class="photo">
                                                        <img src="{{Url('/')}}/back/assets/layouts/layout3/img/avatar3.jpg"
                                                             class="img-circle" alt=""> </span>
                                            <span class="subject">
                                                        <span class="from"> Richard Doe </span>
                                                        <span class="time">46 mins </span>
                                                    </span>
                                            <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- END INBOX DROPDOWN -->
                    <li class="separator hide"></li>
                    <!-- BEGIN TODO DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

                    <!-- END TODO DROPDOWN -->
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            <span class="username username-hide-on-mobile"> {{Auth::guard('admins')->user()->username }} </span>
                            <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                            @if(!Auth::guard('admins')->user()->img_profile == "")
                                <img alt="" class="img-circle"
                                     src="{{Url('/')}}/uploads/admins/thumb/{{@Auth::guard('admins')->user()->img_profile}}"/>
                            @else
                                <img class="img-circle" src="{{Url('/')}}/back/assets/global/img/person.png" alt=""
                                     height="50" width="50">
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="#">
                                    <i class="icon-user"></i> My Profile </a>
                            </li>
                            {{--<li class="divider"></li>--}}
                            <li>
                                @if(Session::get('local') !== 'en')
                                    <a href="{{Url('/')}}/admin/lang/en">
                                        <i class="fa fa-language" aria-hidden="true"></i> Change Language </a>
                                @else
                                    <a href="{{Url('/')}}/admin/lang/ar">
                                        <i class="fa fa-language" aria-hidden="true"></i> تغيير اللغة </a>
                                @endif

                            </li>
                            <li>
                                <a href="{{Url('/')}}/admin/logout">
                                    <i class="fa fa-sign-out"></i> {!! trans('sidebar.logOut') !!} </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <li class="dropdown dropdown-extended quick-sidebar-toggler">

                    </li>
                    <!-- END QUICK SIDEBAR TOGGLER -->
                </ul>
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
