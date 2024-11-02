@extends('admin.layout')
@section('title',trans('dashboard.title'))
@section('content')
    <div class="col-lg-12 col-md-4 col-sm-6 col-xs-12">
        @if(hasRole(3))
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue">
                    <div class="visual">
                        <i class="fa fa-tasks" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$countGroups}}"> {{$countGroups}}</span>
                            <div class="desc">{{trans('dashboard.countGroups')}}</div>
                        </div>
                    </div>
                    <a class="more" href="{{Url('/admin/groups')}}"
                       title="{{trans('dashboard.countGroups')}}"> {{trans('dashboard.more')}}
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        @endif
        @if(hasRole(4))
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat purple">
                    <div class="visual">
                        <i class="fa fa-user-secret" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$countAdmins}}"> {{$countAdmins}}</span>
                            <div class="desc">{{trans('dashboard.countAdmins')}}</div>
                        </div>
                    </div>
                    <a class="more" href="{{Url('/admin/admins')}}"
                       title="{{trans('dashboard.countAdmins')}}"> {{trans('dashboard.more')}}
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        @endif
        @if(hasRole(5))

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat yellow">
                    <div class="visual">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$pendingUsers}}"> {{$pendingUsers}}</span>
                            <div class="desc">{{trans('dashboard.pendingUsers')}}</div>
                        </div>
                    </div>
                    <a class="more" href="{{Url('/admin/users')}}"
                       title="{{trans('dashboard.pendingUsers')}}"> {{trans('dashboard.more')}}
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$activeUsers}}"> {{$activeUsers}} </span>
                            <div class="desc">{{trans('dashboard.activeUsers')}}</div>
                        </div>
                    </div>
                    <a class="more" href="{{Url('/admin/users')}}"
                       title="{{trans('dashboard.activeUsers')}}"> {{trans('dashboard.more')}}
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        @endif
        @if(hasRole(6))

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue">
                    <div class="visual">
                        <i class="fa fa-flag" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$countCities}} "> {{$countCities}} </span>
                            <div class="desc">{{trans('dashboard.countCities')}}</div>
                        </div>
                    </div>
                    <a class="more" href="{{Url('/admin/cities')}}"
                       title="{{trans('dashboard.countCities')}}"> {{trans('dashboard.more')}}
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat red">
                    <div class="visual">
                        <i class="fa fa-flag" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value=" {{$countAreas}} "> {{$countAreas}} </span>
                            <div class="desc">{{trans('dashboard.countAreas')}}</div>
                        </div>
                    </div>
                    <a class="more" href="{{Url('/admin/cities')}}"
                       title="{{trans('dashboard.countAreas')}}"> {{trans('dashboard.more')}}
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        @endif
        @if(hasRole(7))

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat yellow">
                    <div class="visual">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                        <span data-counter="counterup"
                              data-value="{{$inactiveCategories}} "> {{$inactiveCategories}} </span>
                            <div class="desc">{{trans('dashboard.inactiveCategories')}}</div>
                        </div>
                    </div>
                    <a class="more" href="{{Url('/admin/categories')}}"
                       title="{{trans('dashboard.inactiveCategories')}}"> {{trans('dashboard.more')}}
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                        <span data-counter="counterup"
                              data-value=" {{$activeCategories}} "> {{$activeCategories}} </span>
                            <div class="desc">{{trans('dashboard.activeCategories')}}</div>
                        </div>
                    </div>
                    <a class="more" href="{{Url('/admin/categories')}}"
                       title="{{trans('dashboard.activeCategories')}}"> {{trans('dashboard.more')}}
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat yellow">
                    <div class="visual">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                        <span data-counter="counterup"
                              data-value="{{$inactiveSubCategories}} "> {{$inactiveSubCategories}} </span>
                            <div class="desc">{{trans('dashboard.inactiveSubCategories')}}</div>
                        </div>
                    </div>
                    <a class="more" href="{{Url('/admin/categories')}}"
                       title="{{trans('dashboard.inactiveSubCategories')}}"> {{trans('dashboard.more')}}
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                        <span data-counter="counterup"
                              data-value=" {{$activeSubCategories}} "> {{$activeSubCategories}} </span>
                            <div class="desc">{{trans('dashboard.activeSubCategories')}}</div>
                        </div>
                    </div>
                    <a class="more" href="{{Url('/admin/categories')}}"
                       title="{{trans('dashboard.activeSubCategories')}}"> {{trans('dashboard.more')}}
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        @endif
        @if(hasRole(8))

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat yellow">
                    <div class="visual">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                        <span data-counter="counterup"
                              data-value="{{$inactiveProducts}} "> {{$inactiveProducts}} </span>
                            <div class="desc">{{trans('dashboard.inactiveProducts')}}</div>
                        </div>
                    </div>
                    <a class="more" href="{{Url('/admin/products')}}"
                       title="{{trans('dashboard.inactiveProducts')}}"> {{trans('dashboard.more')}}
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup"
                                  data-value=" {{$activeProducts}} "> {{$activeProducts}} </span>
                            <div class="desc">{{trans('dashboard.activeProducts')}}</div>
                        </div>
                    </div>
                    <a class="more" href="{{Url('/admin/products')}}"
                       title="{{trans('dashboard.activeProducts')}}"> {{trans('dashboard.more')}}
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        @endif

        @if(hasRole(9))

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat yellow">
                    <div class="visual">
                        <i class="fa fa-file-image-o" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                        <span data-counter="counterup"
                              data-value="{{$inactiveProductsAds}} "> {{$inactiveProductsAds}} </span>
                            <div class="desc">{{trans('dashboard.inactiveProductsAds')}}</div>
                        </div>
                    </div>
                    <a class="more" href="{{Url('/admin/productAds')}}"
                       title="{{trans('dashboard.inactiveProductsAds')}}"> {{trans('dashboard.more')}}
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-file-image-o" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup"
                                  data-value=" {{$activeProductsAds}} "> {{$activeProductsAds}} </span>
                            <div class="desc">{{trans('dashboard.activeProductsAds')}}</div>
                        </div>
                    </div>
                    <a class="more" href="{{Url('/admin/productAds')}}"
                       title="{{trans('dashboard.activeProductsAds')}}"> {{trans('dashboard.more')}}
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        @endif

        @if(hasRole(10))

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat yellow">
                    <div class="visual">
                        <i class="fa fa-ticket" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                        <span data-counter="counterup"
                              data-value="{{$openContacts}} "> {{$openContacts}} </span>
                            <div class="desc">{{trans('dashboard.openContacts')}}</div>
                        </div>
                    </div>
                    <a class="more" href="{{Url('/admin/contacts')}}"
                       title="{{trans('dashboard.openContacts')}}"> {{trans('dashboard.more')}}
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-ticket" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup"
                                  data-value=" {{$closedContacts}} "> {{$closedContacts}} </span>
                            <div class="desc">{{trans('dashboard.closedContacts')}}</div>
                        </div>
                    </div>
                    <a class="more" href="{{Url('/admin/contacts')}}"
                       title="{{trans('dashboard.closedContacts')}}"> {{trans('dashboard.more')}}
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        @endif

        @if(hasRole(11))

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat yellow">
                    <div class="visual">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                        <span data-counter="counterup"
                              data-value="{{$inactiveCoupons}} "> {{$inactiveCoupons}} </span>
                            <div class="desc">{{trans('dashboard.inactiveCoupons')}}</div>
                        </div>
                    </div>
                    <a class="more" href="{{Url('/admin/coupons')}}"
                       title="{{trans('dashboard.inactiveCoupons')}}"> {{trans('dashboard.more')}}
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup"
                                  data-value=" {{$activeCoupons}} "> {{$activeCoupons}} </span>
                            <div class="desc">{{trans('dashboard.activeCoupons')}}</div>
                        </div>
                    </div>
                    <a class="more" href="{{Url('/admin/coupons')}}"
                       title="{{trans('dashboard.activeCoupons')}}"> {{trans('dashboard.more')}}
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        @endif

        @if(hasRole(12))

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-align-right" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup"
                                  data-value=" {{$countOrders}} "> {{$countOrders}} </span>
                            <div class="desc">{{trans('dashboard.countOrders')}}</div>
                        </div>
                    </div>
                    <a class="more" href="{{Url('/admin/orders')}}"
                       title="{{trans('dashboard.countOrders')}}"> {{trans('dashboard.more')}}
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        @endif


    </div>
@endsection
