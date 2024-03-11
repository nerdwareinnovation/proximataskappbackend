@extends('layouts.customer_layouts')
@section('pagespecificstyles')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/widgets/modules-widgets.css')}}">
    <link href="{{asset('backend/assets/css/users/user-profile.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="row">

        <!-- Content -->
        <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 ">

            <div class="user-profile layout-spacing">
                <div class="widget-content widget-content-area">
                    <div class="d-flex justify-content-between">
                        <h3 class="">Info</h3>
                        <a href="{{route('customer.editProfile')}}" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
                    </div>
                    <div class="text-center user-info">
                        @if(isset(auth()->user()->details->imageUrl))
                        <img style="border-radius: 100%;width: 150px;height: 150px;" src="{{asset(auth()->user()->details->imageUrl)}}" alt="avatar">
                        @else
                            <img style="border-radius: 100%;width: 150px;height: 150px;" src="{{asset('avatar.jpg')}}" alt="avatar">

                        @endif
                            <p class="">{{auth()->user()->name}}</p>

                    </div>
                    <div class="user-info-list">

                        <div class="">
                            <ul class="contacts-block list-unstyled">
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg>
                                    {{(auth()->user()->details->vedic_sign != null ? auth()->user()->details->vedic_sign : 'Vedic Sign will be updated by Astrologer.')}}
                                </li>
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                    {{(auth()->user()->details->date_of_birth)}} {{auth()->user()->details->time_of_birth != null ? ', '.auth()->user()->details->time_of_birth : ''}}
                                </li>
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                    {{(auth()->user()->details->state_of_birth)}}, {{(auth()->user()->details->country_of_birth)}}
                                </li>
                                <li class="contacts-block__item">
                                    <a href="mailto:example@mail.com" style="font-size: 0.97em;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                    {{(auth()->user()->email)}}</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>





        </div>

        <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 ">

            <div class="skills layout-spacing ">
                <div class="widget-content widget-content-area" >
                    <h3 class="">Natal Chart</h3>
                    <div style="text-align: center">
{{--                      <img style="width: 300px; height: 300px;" src="{{asset(auth()->user()->details->kundali)}}">--}}
                        <img style="width: 225px; height: 225px;" src="{{asset('coming_soon.jpg')}}">
                    </div>
                </div>
            </div>



        </div>

    </div>
@endsection

@section('pagespecificscripts')
    <script src="{{asset('backend/assets/js/widgets/modules-widgets.js')}}"></script>
@endsection
