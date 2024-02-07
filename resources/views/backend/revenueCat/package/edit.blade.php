@extends('layouts.master')
@section('breadcrumbs')
    <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap mt-n5 mt-lg-0 me-lg-2 pb-2 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
        <!--begin::Heading-->
        <h1 class="text-dark fw-bold my-0 fs-2">Package List</h1>
        <!--end::Heading-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb fw-semibold fs-base my-1">
            <li class="breadcrumb-item text-muted">
                <a href="{{url('dashboard')}}" class="text-muted text-hover-primary">Home</a>
            </li>
            <li class="breadcrumb-item text-muted">Package List</li>
            <li class="breadcrumb-item text-muted">Package</li>
            <li class="breadcrumb-item text-dark">Package Edit</li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection
@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-xl-6">
        <!--begin::Contacts-->
        <div class="card card-flush h-lg-100" id="kt_contacts_main">
            <!--begin::Card header-->
            <div class="card-header pt-7" id="kt_chat_contacts_header">
                <!--begin::Card title-->
                <div class="card-title">
                    <i class="ki-duotone ki-badge fs-1 me-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                        <span class="path5"></span>
                    </i>
                    <h2>Edit Contact</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-5">
                <!--begin::Form-->
                <form id="kt_ecommerce_settings_general_form" class="form" action="{{route('updatePackages',$items->id)}}" method="post">
                    @csrf
                    {{--                    @method('PUT')--}}
                    <!--begin::Input group-->
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span class="required">Display Name</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Enter the contact's name.">
															<i class="ki-duotone ki-information fs-7">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="path3"></span>
															</i>
														</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" name="display_name" value="{{$items->display_name}}" />

                        <!--end::Input-->
                    </div>
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span class="required">Position</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Enter the contact's name.">
															<i class="ki-duotone ki-information fs-7">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="path3"></span>
															</i>
														</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" name="position" value="{{$items->position}}" />

                        <!--end::Input-->
                    </div>

                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <!--end::Input group-->
                    <!--begin::Row-->
                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">

                        <!--begin::Separator-->
                        <div class="separator mb-6"></div>
                        <!--end::Separator-->
                        <!--begin::Action buttons-->
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <button type="reset" data-kt-contacts-type="cancel" class="btn btn-light me-3">Cancel</button>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit"  data-kt-contacts-type="submit" class="btn btn-primary">
                                <span class="indicator-label">Save</span>
                                <span class="indicator-progress">Please wait...
														<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                        <!--end::Action buttons-->
                    </div>
                </form>
                <!--end::Form-->
            </div>

            <!--end::Card body-->
        </div>
        <!--end::Contacts-->
    </div>
@endsection
