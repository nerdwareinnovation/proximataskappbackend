@extends('layouts.admin_layouts')

@section('pagespecificstyles')
    <link href="{{asset('backend/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')


    <div class="row layout-top-spacing">


        <div id="flFormsGrid" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Edit Astrologer</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form action="{{route('admin.updateAstrologer',$user->id)}}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="form-row mb-4">
                            <div class="form-group col-md-3">
                                <label>Name</label>
                                <input type="text" class="form-control" value="{{$user->name}}" name="name" placeholder="Full Name" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPassword4">Email</label>
                                <input type="email" class="form-control" value="{{$user->email}}" name="email" placeholder="Email" required>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputAddress">Designation</label>
                                <input type="text" class="form-control" value="{{$user->astrologerDetails->designation}}" name="designation" id="inputAddress" placeholder="Designation" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPassword4">MAC Address</label>
                                <input type="text" class="form-control" value="{{$user->astrologerDetails->mac_address}}" name="mac_address" placeholder="MAC Address" required>
                            </div>
{{--                            <div class="form-group col-md-3">--}}
{{--                                <label for="inputPassword4">Password</label>--}}
{{--                                <input type="password" class="form-control" name="password" placeholder="Password" required>--}}
{{--                            </div>--}}
                        </div>

                        <div class="custom-file-container" data-upload-id="myFirstImage">
                            <label>Upload (Single File) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                            <label class="custom-file-container__custom-file" >
                                <input type="file" name="image" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                            </label>
                            <div class="custom-file-container__image-preview"></div>


                        </div>
                        <div class="col-md-12" style="text-align: center">
                            <button type="submit" class="btn btn-primary mt-3">Update Astrologer</button>

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
        @if($user->astrologerDetails->image_url != null)
        //First upload
        var firstUpload = new FileUploadWithPreview('myFirstImage',{
            images: {
                baseImage: "{{asset($user->astrologerDetails->image_url)}}",
            },
        })
        @else
        var firstUpload = new FileUploadWithPreview('myFirstImage')
        @endif
    </script>
@endsection
