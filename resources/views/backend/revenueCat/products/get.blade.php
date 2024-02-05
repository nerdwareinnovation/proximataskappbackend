@extends('layouts.master')
@section('breadcrumbs')
    <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap mt-n5 mt-lg-0 me-lg-2 pb-2 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
        <!--begin::Heading-->
        <h1 class="text-dark fw-bold my-0 fs-2">User List</h1>
        <!--end::Heading-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb fw-semibold fs-base my-1">
            <li class="breadcrumb-item text-muted">
                <a href="{{url('dashboard')}}" class="text-muted text-hover-primary">Home</a>
            </li>
            <li class="breadcrumb-item text-muted">Product Management</li>
            <li class="breadcrumb-item text-muted">Product</li>
            <li class="breadcrumb-item text-dark">Product List</li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>App ID:</strong>
                {{ $items->app_id }}
            </div>

            <div class="form-group">
                <strong>Product ID:</strong>
                {{ $items->id }}
            </div>

        <div class="form-group">
                <strong>Store Identifier:</strong>
                {{ $items->store_identifier }}
            </div>
        </div>
    <div class="form-group">
                <strong>Subscription:</strong>
                {{ $items->subscription}}
            </div>
        <div class="form-group">
                <strong>Display Name:</strong>
                {{ $items->display_name }}
            </div>

    </div>
@endsection
