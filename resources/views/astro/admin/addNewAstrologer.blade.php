@extends('layouts.master')

{{--@section('pagespecificstyles')--}}
{{--    <link href="{{asset('backend/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />--}}
{{--@endsection--}}
@section('content')


    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Add New Astrologer</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form action="{{route('admin.storeAstrologer')}}" method="POST" enctype="multipart/form-data">@csrf
                            <div class="form-row mb-4">
                                <div class="form-group col-md-3">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputPassword4">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputPassword4">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputAddress">Designation</label>
                                    <input type="text" class="form-control" name="designation" id="inputAddress" placeholder="Designation" required>
                                </div>
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
                                <button type="submit" class="btn btn-primary mt-3">Add Astrologer</button>

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
