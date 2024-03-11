@extends('layouts.admin_layouts')

@section('pagespecificstyles')
    <link href="{{asset('backend/plugins/file-upload/file-upload-with-preview.min.css    ')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')


    <div class="row layout-top-spacing">


        <div id="flFormsGrid" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Add New Moderator</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form action="{{route('admin.updateModerator')}}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="form-row mb-4">
                            <div class="form-group col-md-4">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{$moderator->name}}" placeholder="Full Name">
                                <input type="hidden" class="form-control" name="moderator_id" value="{{$moderator->id}}" >

                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">Email</label>
                                <input type="email" class="form-control" name="email"  value="{{$moderator->email}}"  placeholder="Email">
                            </div>

                        </div>
                        <div class="form-row mb-4">
                            <div class="form-group col-md-3">
                                <label>Display Name</label>
                                <input type="text" class="form-control" name="astro_name" value="@if(isset($moderator->moderatorDetails->astro_name)){{$moderator->moderatorDetails->astro_name}}@else{{''}}@endif"  placeholder="Display Name">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address" value="{{$moderator->moderatorDetails->address}}" placeholder="Address">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Contact No</label>
                                <input type="text" class="form-control" name="contact_no" value="{{$moderator->moderatorDetails->contact_no}}" placeholder="Contact No">
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
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
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
