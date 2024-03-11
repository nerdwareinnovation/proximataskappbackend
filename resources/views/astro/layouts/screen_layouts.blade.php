<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Nerdware Astrology | Admin Dashboard</title>
    <link rel="icon" type="image/x-icon" href="{{asset('backend/assets/img/favicon.ico')}}"/>

    <link href="{{asset('backend/assets/css/loader.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{asset('backend/assets/js/loader.js')}}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('backend/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('backend/assets/css/widgets/modules-widgets.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/toastr/toastr.css')}}" rel="stylesheet"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/forms/switches.css')}}">
    <link href="{{asset('backend/assets/css/components/tabs-accordian/custom-accordions.css')}}" rel="stylesheet" type="text/css" />
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @yield('pagespecificstyles')

    <style>
        .layout-px-spacing {
            min-height: calc(100vh - 152px)!important;
        }
        .widget-card-one{
            border: 1px solid black;
        }
        h6 .number{
            font-size: 1.2em;
        }
        h6{
            font-size: 1.0em;
        }
    </style>

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>

<body  style="overflow:hidden;">


<div id="load_screen"> <div class="loader"> <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div></div></div>


<!--  BEGIN NAVBAR  -->
<div class="sub-header-container">

        <header class="header navbar navbar-expand-sm">

            <ul class="navbar-nav theme-brand flex-row  text-center">
{{--                <li class="nav-item theme-logo ml-2 mt-2">--}}
{{--                    @if(auth()->user()->role_id == 3)--}}
{{--                        <a href="{{route('astrologer.dashboard')}}">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#e2a03f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>--}}
{{--                        </a>--}}
{{--                    @elseif(auth()->user()->role_id == 4)--}}
{{--                        <a href="{{route('moderator.dashboard')}}">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#e2a03f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>--}}
{{--                        </a>--}}
{{--                    @elseif(auth()->user()->role_id == 5)--}}
{{--                        <a href="{{route('psychologist.dashboard')}}">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#e2a03f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>--}}
{{--                        </a>--}}

{{--                    @endif--}}

{{--                </li>--}}

                <li class="nav-item theme-text ml-3 mt-2">
                    <h5 style="color: #edef4c;">Notes:</h5>
                </li>

                <li class="nav-item theme-text mt-2">

                    <label class="switch s-icons s-outline s-outline-default ml-2">

                        <input id="notesCheck" type="checkbox">

                        <span class="slider"></span>
                    </label>

                </li>
                <li class="nav-item theme-text ml-4 mt-3">


                   <?php
                        $question_asked = intval($customer->details->question_asked);
                        $user_type ='';

                        if ($question_asked == 0 OR $question_asked == 1 ){
                            $user_type ='Free';

                        }
                        elseif ($question_asked >= 1 AND $question_asked <= 50 ){
                             $user_type ='Silver';
                        }
                        elseif ($question_asked >= 51 AND $question_asked <= 99 ){
                             $user_type ='Gold';
                        }
                        elseif ($question_asked >= 100){
                             $user_type ='Platinum';
                        }

                   ?>
                    <h6 style="color: #fff;">CustomerID: <span class="number">{{$customer->id}} </span>| Package Type:  <span class="number">{{$customer->package->package->name}}</span> | Customer Type:  <span class="number">{{$user_type}}</span> | Question Asked: <span class="number">{{$question_asked}}</span></h6>
                </li>
                <li class="nav-item dropdown user-profile-dropdown ml-5 mt-2  order-lg-0 order-1">
{{--                    <h5 class="ml-2">Type:  @if(auth()->user()->role_id == 4)  @if($messages->astrologerQuery->type==0) Free  @endif @endif</h5>--}}

                </li>

            </ul>



            <ul class="navbar-item flex-row search-ul">
                <li class="nav-item dropdown user-profile-dropdown ml-5 mt-2  order-lg-0 order-1">
                    <h6 style="color: #fff;"> @if(isset($messages->receiver_id)) m.{{\App\User::find($messages->receiver_id)->name}} @endif @if(isset($messages->astrologer_id)) | a.{{\App\User::find($messages->astrologer_id)->name}} @endif</h6>
                </li>
                <li class="nav-item align-self-center search-animated">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search toggle-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <form class="form-inline search-full form-inline search" role="search">
                        <div class="search-bar">
                            <input type="text" class="form-control search-form-control  ml-lg-auto" id="searchCustomerId" placeholder="Search Customer ID ...">
                        </div>
                    </form>
                </li>

            </ul>
            <ul class="navbar-item flex-row navbar-dropdown">


                <li class="nav-item dropdown language-dropdown more-dropdown mr-2">
                    <button class="btn btn-rounded " style="background-color: #f4f4ed;" type="submit" id="searchCustomerButton">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </button>
                </li>





            </ul>
            <div class="modal fade" id="customerModal" role="dialog">
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">User Info</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12 layout-spacing">
                                    <div class="statbox widget box box-shadow">
                                        <div id="accordionIcons" class="widget-header">
                                            <div class="row">
                                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                    <h4>Icons</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content widget-content-area customerQueries">



                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


</header>

</div>
<!--  END NAVBAR  -->
<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>


    <!--  BEGIN CONTENT PART  -->
    <div id="screen-content" class="main-content">
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
<!-- END GLOBAL MANDATORY SCRIPTS -->

<script>$(document).ready(function(){

        $('#searchCustomerButton').click(function(){
            event.preventDefault();
            var customerId = document.getElementById('searchCustomerId').value;

            // AJAX request
            $.ajax({

                url: '{{route('searchCustomer')}}',
                type: 'post',
                data: {_token: "{{ csrf_token() }}",customerId: customerId},
                success: function(response){
                    // Add response in Modal body

                    $('#customerModal .modal-body').html(response);


                    $('#customerModal').modal('show');
                },
                error: function (){
                    toastr.error("No Customer Found")
                }
            });
            document.getElementById('searchCustomerId').value='';

        });

    });
</script>
<script src="{{asset('backend/assets/js/components/ui-accordions.js')}}"></script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@yield('pagespecificscripts')
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
</body>

<!-- Mirrored from designreset.com/cork/ltr/demo3/starter_kit_blank_page.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Feb 2021 08:13:43 GMT -->
</html>
