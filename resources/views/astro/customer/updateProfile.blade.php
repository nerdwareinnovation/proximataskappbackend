@extends('layouts.customer_layouts')
@section('pagespecificstyles')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/dropify/dropify.min.css')}}">
    <link href="{{asset('backend/assets/css/users/account-setting.css')}}" rel="stylesheet" type="text/css" />
    <script type= "text/javascript" src = "{{asset('js/countries.js')}}"></script>

@endsection
@section('content')
    <div class="account-settings-container">

        <div class="account-content">
            <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                        <form id="general-info" enctype="multipart/form-data" method="POST" action="{{route('customer.updateProfile')}}" class="section general-info">@csrf
                            <div class="info">
                                <h6 class="">General Information</h6>
                                <div class="row">
                                    <div class="col-lg-11 mx-auto">

                                        <div class="row">
                                            <div class="col-xl-2 col-lg-12 col-md-4">
                                                <div class="upload mt-4 pr-md-4">
                                                    <input type="file" name="user_image" id="input-file-max-fs" class="dropify" value="{{auth()->user()->details->imageUrl}}" data-default-file="{{asset(auth()->user()->details->imageUrl)}}" data-max-file-size="2M" />
                                                    <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i> Upload Picture</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                <div class="form">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="fullName">Full Name</label>
                                                                <input type="text" class="form-control mb-4" id="full_name" name="full_name" placeholder="Full Name" value="{{auth()->user()->name}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label class="dob-input">Date of Birth</label>
                                                            <div class="d-sm-flex d-block">
                                                                <div class="form-group mr-1">
                                                                    <input type="date" class="form-control mb-4" id="dob" name="dob" placeholder="Full Name" value="{{auth()->user()->details->date_of_birth}}">

                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label class="dob-input">Time of Birth</label>
                                                            <div class="d-sm-flex d-block">
                                                                <div class="form-group mr-1">
                                                                    <input type="time" class="form-control mb-4" id="tob"  name="tob" placeholder="Full Name" value="{{auth()->user()->details->time_of_birth }}">

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="fullName">Country of Birth</label>
                                                                <select class="form-control mb-4" onchange="print_state('state',this.selectedIndex);" id="country" name ="country"></select>
{{--                                                                <input type="text" class="form-control mb-4" id="cob" name="cob" placeholder="Country of Birth" value="{{auth()->user()->details->country_of_birth}}">--}}
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">


                                                                <label for="fullName">State of Birth</label>
                                                                <select name="state" class="form-control mb-4" id ="state"></select>
{{--                                                                <input type="text" class="form-control mb-4" id="sob" name="sob" placeholder="State of Birth" value="{{auth()->user()->details->state_of_birth}}">--}}
                                                                <script language="javascript">print_country("country");</script>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">

                                                                <label for="fullName">City of Birth</label>
                                                                     <input type="text" class="form-control mb-4" id="city" name="city" placeholder="City of Birth" value="{{auth()->user()->details->city_of_birth}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label class="dob-input">Gender</label>
                                                            <div class="form-check mb-2">
                                                                <div class="custom-control custom-radio classic-radio-info">
                                                                    <input type="radio" id="hRadio1" value="Female" name="genderRadio"  @if(auth()->user()->details->gender == "Female") {{'checked'}} @endif class="custom-control-input">
                                                                    <label class="custom-control-label" for="hRadio1">Female</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-check mb-2">
                                                                <div class="custom-control custom-radio classic-radio-info">
                                                                    <input type="radio" id="hRadio2" value="Male" name="genderRadio" @if(auth()->user()->details->gender == "Male") {{'checked'}} @endif class="custom-control-input">
                                                                    <label class="custom-control-label" for="hRadio2">Male</label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" style="text-align: center;">
                                    <button type="submit" id="saveBtn" class="btn btn-success">Update Profile</button>

                                </div>
                            </div>

                        </form>
                    </div>





                </div>
            </div>
        </div>


    </div>

@endsection

@section('pagespecificscripts')
    <script src="{{asset('backend/plugins/dropify/dropify.min.js')}}"></script>
    <script src="{{asset('backend/plugins/blockui/jquery.blockUI.min.js')}}"></script>
    <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
    <script src="{{asset('backend/assets/js/users/account-settings.js')}}"></script>
{{--    <script type="text/javascript">--}}
{{--        $("#saveBtn").click(function (event){--}}
{{--                event.preventDefault();--}}
{{--                var firstName = document.getElementById("fullName").value;--}}
{{--                var dateOfBirth = document.getElementById("dob").value;--}}
{{--                var countryOfBirth = document.getElementById("cob").value;--}}
{{--                var stateOfBirth = document.getElementById("sob").value;--}}
{{--                var timeOfBirth = document.getElementById("tob").value;--}}
{{--                var gender = document.getElementById("tob").value;--}}
{{--                var astrologerQueryId = $("input[name=astro_query_id]").val();--}}
{{--                var chat_id = $("input[name=chat_id]").val();--}}
{{--                let _token   = $('meta[name="csrf-token"]').attr('content');--}}
{{--                $.ajax({--}}
{{--                    url: "/astrologer/sendReplyToModerator",--}}
{{--                    type:"POST",--}}
{{--                    data:{--}}
{{--                        astrologer_query_id: astrologerQueryId,--}}
{{--                        chat_id: chat_id,--}}
{{--                        message:message,--}}
{{--                        _token: _token--}}
{{--                    },--}}
{{--                    success:function(response){--}}
{{--                        console.log(response);--}}
{{--                        if(response) {--}}
{{--                            $('.success').text(response.success);--}}
{{--                            $('.error').text(response.failed);--}}
{{--                            window.location.replace('{{route('astrologer.dashboard')}}');--}}
{{--                        }--}}
{{--                    },--}}
{{--                });--}}

{{--    </script>--}}
@endsection
