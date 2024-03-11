@extends('layouts.admin_layouts')
@section('pagespecificstyles')
    <link href="{{asset('backend/assets/css/users/user-profile.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row layout-spacing">

        <!-- Content -->
        <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

            <div class="user-profile layout-spacing">
                <div class="widget-content widget-content-area">
                    <div class="d-flex justify-content-between">
                        <h3 class="">Profile</h3>
                    </div>
                    <div class="text-center user-info">

                        <img src="{{asset('avatar.jpg')}}" style="height: 90px;width: 90px;" alt="avatar">
                        <p class="">{{$customer->name}}</p>
                    </div>
                    <div class="user-info-list">

                        <div class="">
                            <ul class="contacts-block list-unstyled">
                                <li class="contacts-block__item">
                                    Gender: {{$customer->details->gender}}
                                </li>
                                <li class="contacts-block__item">
                                    Date of Birth: {{$customer->details->date_of_birth}}
                                </li>
                               <li class="contacts-block__item">
                                    Time of Birth: {{$customer->details->time_of_birth}}
                                </li>
                               <li class="contacts-block__item">
                                    Place of Birth: {{$customer->details->state_of_birth}}, {{$customer->details->country_of_birth}}
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

            <div class="skills layout-spacing ">
                <div class="widget-content widget-content-area">
                    <h3 class="">Update Vedic</h3>

                    <form action="{{route('astrologer.updateVedic')}}" enctype="multipart/form-data" method="POST">@csrf
                        <div class="form-group row mb-4">
                            <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Vedic Sign</label>
                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                <select class="form-control selectpicker" name="vedic_sign" >
                                    <option value="Mesh">Mesh</option>
                                    <option value="Varishabha">Varishabha</option>
                                    <option value="Mithuna">Mithuna</option>
                                    <option value="Karka">Karka</option>
                                    <option value="Simha"> Simha</option>
                                    <option value="Kanya"> Kanya</option>
                                    <option value="Tula"> Tula</option>
                                    <option value="Vrischika"> Vrischika</option>
                                    <option value="Dhanu"> Dhanu</option>
                                    <option value="Makara"> Makara</option>
                                    <option value="Kumbha"> Kumbha</option>
                                    <option value="Meena"> Meena </option>


                                </select>
{{--                                <input type="text" class="form-control" name="vedic_sign" value="{{$customer->details->vedic_sign}}" placeholder="Enter Vedic Sign">--}}
                                <input type="hidden" class="form-control" name="customer_id" value="{{$customer->id}}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="hPassword" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Kundali</label>
                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                <div class="custom-file-container" data-upload-id="myFirstImage">
                                    <label>Upload (Kundali) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>


                                    <label class="custom-file-container__custom-file" >
                                        <input type="file" name="image" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary mt-3">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('pagespecificscripts')
    <script src="{{asset('backend/plugins/file-upload/file-upload-with-preview.min.js')}}"></script>

    <script>
        //First upload
        var firstUpload = new FileUploadWithPreview('myFirstImage')
    </script>

@endsection
