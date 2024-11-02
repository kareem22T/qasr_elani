<ul class="nav navbar-nav pull-right">
    <li class="separator hide"></li>
    <li class="hidden    dropdown dropdown-extended dropdown-notification dropdown-dark"
        id="header_notification_bar">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
           data-close-others="true">
            <i class="fa fa-bell"></i>
            <span class="badge badge-success"> 1 </span>
        </a>
        <ul class="dropdown-menu">
            <li class="external">
                <h3>
                    <span class="bold">12 pending</span> notifications</h3>
                <a href="page_user_profile_1.html">view all</a>
            </li>
            <li>
                <ul class="dropdown-menu-list scroller" style="height: 250px" data-handle-color="#637283">
                    <li>
                        <a href="#">
                            <span class="time">just now</span>
                            <span class="details">
                                                        <span class="label label-sm label-icon label-success">
                                                            <i class="fa fa-plus"></i>
                                                        </span> New user registered. </span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
    <!-- END NOTIFICATION DROPDOWN -->
    <li class="separator hide"></li>
    <!-- BEGIN INBOX DROPDOWN -->
    <li class="separator hide"></li>
    <li class="dropdown dropdown-user dropdown-dark">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
           data-close-others="true">
            <span class="username username-hide-on-mobile"> {{Auth::guard('marketers')->user()->name }} </span>
            <img class="img-circle" src="{{Url('/')}}/back/assets/global/img/person.png" alt="" height="50" width="50">
        </a>
        <ul class="dropdown-menu dropdown-menu-default">
            <li class="hidden">
                <a href="#">
                    <i class="icon-user"></i> My Profile </a>
            </li>
            {{--<li class="divider"></li>--}}
            {{--<li>
                @if(Session::get('local') !== 'en')
                    <a href="{{Url('/')}}/admin/lang/en">
                        <i class="fa fa-language" aria-hidden="true"></i> English </a>
                @else
                    <a href="{{Url('/')}}/admin/lang/ar">
                        <i class="fa fa-language" aria-hidden="true"></i> عربى </a>
                @endif

            </li>--}}
            <li>
                <a href="{{route('marketer.logout')}}">
                    <i class="fa fa-sign-out"></i> {!! trans('sidebar.logOut') !!} </a>
            </li>
        </ul>
    </li>
    <li class="dropdown dropdown-extended quick-sidebar-toggler">
    </li>
</ul>
