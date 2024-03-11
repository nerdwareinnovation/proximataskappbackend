@switch(auth()->user()->role_id)
@case(1)
@php($url = asset('avatar.jpg'))
@php($roleUser = 'Admin')
@php($redirectUrl = route('admin.dashboard'))
@break
@case(2)
@php($url = isset(auth()->user()->details->imageUrl) ? asset(auth()->user()->details->imageUrl) :  asset('avatar.jpg'))
@php($roleUser = 'Customer')
@php($redirectUrl = route('customer.dashboard'))
@break


@case(3)
@php($url = isset(auth()->user()->astrologerDetails->imageUrl) ? asset(auth()->user()->astrologerDetails->imageUrl) :  asset('avatar.jpg'))
@php($roleUser = 'Astrologer')
@php($redirectUrl = route('astrologer.dashboard'))

@break


@case(4)
@php($url = isset(auth()->user()->moderatorDetails->imageUrl) ? asset(auth()->user()->moderatorDetails->imageUrl) :  asset('avatar.jpg'))
@php($roleUser = 'Moderator')
@php($redirectUrl = route('moderator.dashboard'))

@break

@case(5)
@php($url = isset(auth()->user()->psychologistDetails->imageUrl) ? asset(auth()->user()->psychologistDetails->imageUrl) :  asset('avatar.jpg'))
@php($roleUser = 'Psychologist')
@php($redirectUrl = route('psychologist.dashboard'))
@break
@default
@php($redirectUrl = route('admin.dashboard'))
@php($url =asset('avatar.jpg'))
@break
@endswitch
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
{{--    <title>Proxima Astrology | {{$roleUser}} Dashboard</title>--}}
    <link rel="icon" type="image/x-icon" href="{{asset('backend/assets/img/favicon.ico')}}"/>
    <link href="{{asset('backend/assets/css/loader.css" rel="stylesheet" type="text/css')}}"/>
    <script src="{{asset('backend/assets/js/loader.js')}}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('backend/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('backend/assets/css/widgets/modules-widgets.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/toastr/toastr.css')}}" rel="stylesheet"/>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @yield('pagespecificstyles')

    <style>
        .layout-px-spacing {
            min-height: calc(100vh - 166px)!important;
        }
    </style>

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>
<body class="sidebar-noneoverflow">
<!-- BEGIN LOADER -->
<div id="load_screen"> <div class="loader"> <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div></div></div>
<!--  END LOADER -->


<!--  BEGIN NAVBAR  -->
<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">

        <ul class="navbar-nav theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="{{$redirectUrl}}">
                    <img src="{{asset('backend/assets/img/logo.png')}}" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item toggle-sidebar">
                <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg></a>
            </li>


        </ul>

        <ul class="navbar-item flex-row navbar-dropdown ml-auto">

            <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                    <div class="user-profile-section">
                        <div class="media mx-auto">


                            <img src="{{$url}}" class="img-fluid mr-2" alt="avatar">


                            <div class="media-body">
                                <p>{{auth()->user()->name}}</p>
                                <p>
{{--                                    {{$roleUser}}--}}

{{--                                  old comment starts here--}}
{{--                                    @if(() == 1)--}}
{{--                                            Admin--}}

{{--                                    @elseif(auth()->user()->role_id == 2)--}}
{{--                                        {{\App\User::find(auth()->user()->id)->package->package->name}} <br> Ask to Astrologer:{{\App\User::find(auth()->user()->id)->package->question_left}}--}}
{{--                                    @elseif(auth()->user()->role_id == 3)--}}
{{--                                        Astrologer--}}
{{--                                    @elseif((auth()->user()->role_id) == 4)--}}
{{--                                        Moderator--}}
{{--                                    @elseif((auth()->user()->role_id) == 5)--}}
{{--                                        Psychologist--}}
{{--                                    @endif--}}



                                </p>
                            </div>
                        </div>
                    </div>
                    @if((auth()->user()->role_id) == 2)
                    <div class="dropdown-item">
                        <a href="{{route('customer.userProfile')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> <span>My Profile</span>
                        </a>
                    </div>
                    @endif
                    <div class="dropdown-item">
                        <a  href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                                             document.getElementById('logout-form').submit();">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> Sign Out</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                    </div>
                </div>
            </li>
        </ul>
    </header>
</div>
<!--  END NAVBAR  -->



<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>


    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">

        <nav id="sidebar">
            <div class="profile-info">
                <figure class="user-cover-image"></figure>
                <div class="user-info">
                    <img src="{{$url}}"  alt="avatar">



                    <h6 class="">
                       {{auth()->user()->name}}

                    </h6>
                            <p>
{{--                                {{$roleUser}}--}}



                            </p>
                </div>
            </div>


            <div class="shadow-bottom"></div>
            @if((auth()->user()->role_id) == 1)

            <ul class="list-unstyled menu-categories" id="accordionExample">


                <li class="menu md-visible menu-heading">
                    <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>Apps</span></div>
                </li>
                <li class="menu {{ 'admin/dashboard' == request()->path() ? 'active' : '' }}">
                    <a href="{{route('admin.dashboard')}}" aria-expanded="{{ 'admin/dashboard' == request()->path() ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                            <span>Dashboard</span>
                        </div>
                    </a>
                </li>




                <li class="menu menu-heading">
                    <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>USER MANAGEMENT</span></div>
                </li>

                <li class="menu  {{ 'admin/systemMessage' == request()->path() ? 'active' : '' }}">
                    <a href="{{route('admin.systemMessage')}}" aria-expanded="{{ 'admin/systemMessage' == request()->path() ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
                            <span>System Message</span>
                        </div>
                    </a>
                </li>

                <li class="menu  {{ 'admin/moderators' == request()->path() ? 'active' : '' }}">
                    <a href="{{route('admin.moderators')}}" aria-expanded="{{ 'admin/moderators' == request()->path() ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
                            <span>Moderators</span>
                        </div>
                    </a>
                </li>
                <li class="menu  {{ 'admin/astrologers' == request()->path() ? 'active' : '' }}">
                    <a href="{{route('admin.astrologers')}}" aria-expanded="{{ 'admin/astrologers' == request()->path() ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>                            <span>Astrologers</span>
                        </div>
                    </a>
                </li>
                <li class="menu  {{ 'admin/customers' == request()->path() ? 'active' : '' }}">
                    <a href="{{route('admin.customers')}}" aria-expanded="{{ 'admin/customers' == request()->path() ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5.52 19c.64-2.2 1.84-3 3.22-3h6.52c1.38 0 2.58.8 3.22 3"/><circle cx="12" cy="10" r="3"/><circle cx="12" cy="12" r="10"/></svg>
                            <span>Customers</span>
                        </div>
                    </a>
                </li>
                <li class="menu  {{ 'admin/psychologists' == request()->path() ? 'active' : '' }}">
                    <a href="{{route('admin.psychologists')}}" aria-expanded="{{ 'admin/psychologists' == request()->path() ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 3a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3H6a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3V6a3 3 0 0 0-3-3 3 3 0 0 0-3 3 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 3 3 0 0 0-3-3z"></path></svg>
                            <span>Psychologists</span>
                        </div>
                    </a>
                </li>


                <li class="menu menu-heading">
                    <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>QUERIES</span></div>
                </li>

                <li class="menu  {{ 'admin/queries' == request()->path() ? 'active' : '' }}">
                    <a href="{{route('admin.queries')}}" aria-expanded="{{ 'admin/queries' == request()->path() ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                            <span>Queries</span>
                        </div>
                    </a>
                </li>

                <li class="menu  {{ 'admin/parasiteWords' == request()->path() ? 'active' : '' }}">
                    <a href="{{route('admin.parasiteWords')}}" aria-expanded="{{ 'admin/parasiteWords' == request()->path() ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                            <span>Parasite Words</span>
                        </div>
                    </a>
                </li>

                <li class="menu {{ 'admin/question/questionCategory' == request()->path() ||  'admin/question/customerSample' == request()->path() ||  'admin/question/moderatorSample' == request()->path() || 'admin/question/questionModCategory' == request()->path() ? 'active' : '' }}">
                    <a href="#forms" data-toggle="collapse" aria-expanded="{{ 'admin/question/questionCategory' == request()->path() ||  'admin/question/customerSample' == request()->path() || 'admin/question/moderatorSample' == request()->path()  || 'admin/question/questionModCategory' == request()->path() ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                            <span>Sample Question</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                        <li>
                            <a href="{{route('admin.questionModCategory')}}"> Moderator Categories </a>
                        </li>
                        <li>
                            <a href="{{route('admin.questionCategory')}}"> Customer Categories </a>
                        </li>
                        <li>
                            <a href="{{route('admin.customerSample')}}"> Customer Sample </a>
                        </li>
                        <li>
                            <a href="{{route('admin.moderatorSample')}}"> Moderator Sample </a>
                        </li>
                    </ul>
                </li>

                <li class="menu menu-heading">
                    <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>PACKAGES</span></div>
                </li>





                <li class="menu  {{ 'admin/packages' == request()->path() ? 'active' : '' }}">
                    <a href="{{route('admin.packages')}}" aria-expanded="{{ 'admin/packages' == request()->path() ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2V6l-3-4H6zM3.8 6h16.4M16 10a4 4 0 1 1-8 0"/></svg>                            <span>Packages</span>
                        </div>
                    </a>
                </li>
                <li class="menu  {{ 'admin/transactions' == request()->path() ? 'active' : '' }}">
                    <a href="{{route('admin.transactions')}}" aria-expanded="{{ 'admin/transactions' == request()->path() ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                            <span>Transactions</span>
                        </div>
                    </a>
                </li>


            </ul>

            @elseif(auth()->user()->role_id == 2)
                <ul class="list-unstyled menu-categories" id="accordionExample">


                    <li class="menu md-visible menu-heading">
                        <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>Apps</span></div>
                    </li>
                    <li class="menu {{ 'customer/dashboard' == request()->path() ? 'active' : '' }}">
                        <a href="{{route('customer.dashboard')}}" aria-expanded="{{ 'customer/dashboard' == request()->path() ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                                <span>Ask My Astrologer</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu {{ 'customer/packages' == request()->path() ? 'active' : '' }}">
                        <a href="{{route('customer.packages')}}" aria-expanded="{{ 'customer/packages' == request()->path() ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2V6l-3-4H6zM3.8 6h16.4M16 10a4 4 0 1 1-8 0"/></svg>
                                <span>Question Packages</span>

                            </div>
                        </a>
                    </li>
                    <li class="menu {{ 'customer/transactions' == request()->path() ? 'active' : '' }}">
                        <a href="{{route('customer.transactions')}}" aria-expanded="{{ 'customer/transactions' == request()->path() ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                <span>Transactions</span>
                            </div>
                        </a>
                    </li>

                </ul>
            @elseif(auth()->user()->role_id == 4)
                <ul class="list-unstyled menu-categories" id="accordionExample">


                    <li class="menu md-visible menu-heading">
                        <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>Apps</span></div>
                    </li>
                    <li class="menu {{ 'moderator/dashboard' == request()->path() ? 'active' : '' }}">
                        <a href="{{route('moderator.dashboard')}}" aria-expanded="{{ 'moderator/dashboard' == request()->path() ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu {{ 'moderator/queries' == request()->path() ? 'active' : '' }}">
                        <a href="{{route('moderator.getNewTask')}}" aria-expanded="{{ 'moderator/queryList' == request()->path() ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                <span>Get New Task</span>
                            </div>
                        </a>
                    </li>


                </ul>
            @elseif(auth()->user()->role_id == 3)
                <ul class="list-unstyled menu-categories" id="accordionExample">


                    <li class="menu md-visible menu-heading">
                        <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>Apps</span></div>
                    </li>
                    <li class="menu {{ 'astrologer/dashboard' == request()->path() ? 'active' : '' }}">
                        <a href="{{route('astrologer.dashboard')}}" aria-expanded="{{ 'astrologer/dashboard' == request()->path() ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu {{ 'astrologer/queries' == request()->path() ? 'active' : '' }}">
{{--                        <a href="{{route('astrologer.queries')}}" aria-expanded="{{ 'astrologer/queries' == request()->path() ? 'true' : 'false' }}" class="dropdown-toggle">--}}
{{--                            <div class="">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>--}}
{{--                                <span>Queries</span>--}}
{{--                            </div>--}}
{{--                        </a>--}}

                        <a href="{{route('astrologer.getNewTask')}}" aria-expanded="{{ 'astrologer/queryList' == request()->path() ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                <span>Get New Task</span>
                            </div>
                        </a>
                    </li>
{{--                    <li class="menu {{ 'astrologer/pendingCustomers' == request()->path() ? 'active' : '' }}">--}}
{{--                        <a href="{{route('astrologer.pendingCustomers')}}" aria-expanded="{{ 'astrologer/pendingCustomers' == request()->path() ? 'true' : 'false' }}" class="dropdown-toggle">--}}
{{--                            <div class="">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5.52 19c.64-2.2 1.84-3 3.22-3h6.52c1.38 0 2.58.8 3.22 3"/><circle cx="12" cy="10" r="3"/><circle cx="12" cy="12" r="10"/></svg>                                <span>Customers</span>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}


                </ul>
            @elseif(auth()->user()->role_id == 5)
                <ul class="list-unstyled menu-categories" id="accordionExample">


                    <li class="menu md-visible menu-heading">
                        <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>Apps</span></div>
                    </li>
                    <li class="menu {{ 'psychologist/dashboard' == request()->path() ? 'active' : '' }}">
                        <a href="{{route('psychologist.dashboard')}}" aria-expanded="{{ 'psychologist/dashboard' == request()->path() ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu {{ 'psychologist/queries' == request()->path() ? 'active' : '' }}">
                        <a href="{{route('psychologist.queryList')}}" aria-expanded="{{ 'psychologist/queries' == request()->path() ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                <span>Queries</span>
                            </div>
                        </a>
                    </li>


                </ul>

            @endif
{{--            <ul class="list-unstyled menu-categories" id="accordionExample">--}}
{{--                @if(auth()->user()->role_id == 1)--}}
{{--                    <li class="menu">--}}
{{--                        <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">--}}
{{--                            <div class="">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>--}}
{{--                                <span>Dashboard</span>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                        <ul class="collapse submenu list-unstyled" id="dashboard" data-parent="#accordionExample">--}}
{{--                            <li>--}}
{{--                                <a href="index-2.html"> Analytics </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="index2.html"> Sales </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}


{{--                <li class="menu menu-heading">--}}
{{--                    <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>User Management</span></div>--}}
{{--                </li>--}}



{{--                <li class="menu">--}}
{{--                    <a href="{{route('admin.astrologers')}}" aria-expanded="false" class="dropdown-toggle">--}}
{{--                        <div class="">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>--}}
{{--                            <span>Astrologers</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li class="menu">--}}
{{--                    <a href="{{route('admin.psychologists')}}" aria-expanded="false" class="dropdown-toggle">--}}
{{--                        <div class="">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>--}}
{{--                            <span>Psychologists</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li class="menu">--}}
{{--                    <a href="{{route('admin.moderators')}}" aria-expanded="false" class="dropdown-toggle">--}}
{{--                        <div class="">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>--}}
{{--                            <span>Moderators</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li class="menu menu-heading">--}}
{{--                    <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>Query Management</span></div>--}}
{{--                </li>--}}

{{--                <li class="menu">--}}
{{--                    <a href="{{route('admin.queries')}}" aria-expanded="false" class="dropdown-toggle">--}}
{{--                        <div class="">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>--}}
{{--                            <span>Queries</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="menu">--}}
{{--                    <a href="{{route('admin.parasiteWords')}}" aria-expanded="false" class="dropdown-toggle">--}}
{{--                        <div class="">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>--}}
{{--                            <span>Parasitic Words</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li class="menu">--}}
{{--                    <a href="#elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">--}}
{{--                        <div class="">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zap"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>--}}
{{--                            <span>Sample Question</span>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <ul class="collapse submenu list-unstyled" id="elements" data-parent="#accordionExample">--}}
{{--                        <li>--}}
{{--                            <a href="{{route('admin.questionCategory')}}"> Category </a>--}}
{{--                        </li>--}}

{{--                    </ul>--}}
{{--                    <ul class="collapse submenu list-unstyled" id="elements" data-parent="#accordionExample">--}}
{{--                        <li>--}}
{{--                            <a href="{{route('admin.customerSample')}}"> Customer Sample </a>--}}
{{--                        </li>--}}

{{--                    </ul>--}}
{{--                    <ul class="collapse submenu list-unstyled" id="elements" data-parent="#accordionExample">--}}
{{--                        <li>--}}
{{--                            <a href="{{route('admin.moderatorSample')}}"> Moderator Sample </a>--}}
{{--                        </li>--}}

{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li class="menu menu-heading">--}}
{{--                    <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>Packages Management</span></div>--}}
{{--                </li>--}}

{{--                <li class="menu">--}}
{{--                    <a href="{{route('admin.packages')}}" aria-expanded="false" class="dropdown-toggle">--}}
{{--                        <div class="">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>--}}
{{--                            <span>Packages</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="menu">--}}
{{--                    <a href="{{route('admin.transactions')}}" aria-expanded="false" class="dropdown-toggle">--}}
{{--                        <div class="">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>--}}
{{--                            <span>Transaction</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @elseif(auth()->user()->role_id==3)--}}

{{--                    <li class="menu {{ 'astrologer/dashboard' == request()->path() ? 'active' : '' }}">--}}
{{--                                            <a href="{{route('astrologer.dashboard')}}" aria-expanded="false" class="dropdown-toggle">--}}
{{--                                                <div class="">--}}
{{--                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>--}}
{{--                                                    <span> Dashboard</span>--}}
{{--                                                </div>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        <li class="menu {{ 'astrologer/pendingCustomers' == request()->path() ? 'active' : '' }}">--}}
{{--                                            <a href="{{route('astrologer.pendingCustomers')}}" aria-expanded="false" class="dropdown-toggle">--}}
{{--                                                <div class="">--}}
{{--                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>--}}
{{--                                                    <span> Customers</span>--}}
{{--                                                </div>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        <li class="menu {{ 'astrologer/queries' == request()->path() ? 'active' : '' }}">--}}
{{--                                            <a href="{{route('astrologer.queries')}}" aria-expanded="false" class="dropdown-toggle">--}}
{{--                                                <div class="">--}}
{{--                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>--}}
{{--                                                    <span> Queries</span>--}}
{{--                                                </div>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                @endif--}}







{{--            </ul>--}}

        </nav>

    </div>
    <!--  END SIDEBAR  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">


                    @yield('content')



        </div>
{{--        <div class="footer-wrapper">--}}
{{--            <div class="footer-section f-section-1">--}}
{{--                <p class="">Copyright © 2021 <a target="_blank" href="https://designreset.com/">Nerdware Innovation</a>, All rights reserved.</p>--}}
{{--            </div>--}}
{{--            <div class="footer-section f-section-2">--}}
{{--                <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <!--  END CONTENT PART  -->

</div>
<!-- END MAIN CONTAINER -->

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('backend/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('backend/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('backend/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('backend/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('backend/assets/js/app.js')}}"></script>
<script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="{{asset('backend/assets/js/custom.js')}}"></script>
<script src="{{asset('backend/toastr/toastr.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->
<script>
    $(document).on("click", "#delete", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        swal.fire({
            title: 'Are you sure?',
            text: "User will be deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
</script>
<script>
    $(document).on("click", "#deleteQuestion", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        swal.fire({
            title: 'Are you sure?',
            text: "Sample Question will be deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
</script>
<script>
    $(document).on("click", "#disable", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        swal.fire({
            title: 'Are you sure?',
            text: "User will be disabled!",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, disable it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
    $(document).on("click", "#enable", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        swal.fire({
            title: 'Are you sure?',
            text: "User will be enabled!",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, enable it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
</script>
<script>
    @if(count($errors) > 0)
    @foreach($errors->all() as $error)
    toastr.error("{{ $error }}");
    @endforeach
    @endif
</script>

<script>
    const beamsClient = new PusherPushNotifications.Client({
        instanceId: '785ff663-e865-4830-90d5-22302f4871a1',
    });

    beamsClient.start()
        .then(() => beamsClient.addDeviceInterest('hello'))
        .then(() => console.log('Successfully registered and subscribed!'))
        .catch(console.error);
</script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    @yield('pagespecificscripts')
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
</body>

<!-- Mirrored from designreset.com/cork/ltr/demo3/starter_kit_blank_page.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Feb 2021 08:13:43 GMT -->
</html>
