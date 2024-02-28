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
            <li class="breadcrumb-item text-muted">Task Management</li>
            <li class="breadcrumb-item text-muted">Task</li>
            <li class="breadcrumb-item text-dark">Task List</li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection
@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <!--begin::Container-->


        <div class="container-xxl" id="kt_content_container">
            <!--begin::Card-->
            <div class="row g-5 g-xl-10 g-xl-10">

{{--                <div class="col-xxl-6 mb-md-5 mb-xl-n20">--}}

{{--                    <div class="row g-5 g-xl-10 g-xl-10">--}}

{{--                        <div class="col-md-6 col-xl-6 mb-xxl-10">--}}


{{--                <!--begin::Card widget 8-->--}}
{{--                <!--end::Card widget 8-->--}}
{{--                <!--begin::Card widget 5-->--}}
{{--                <div class="card card-flush h-md-50 mb-xl-10">--}}
{{--                    <!--begin::Header-->--}}
{{--                    <div class="card-header pt-5">--}}
{{--                        <!--begin::Title-->--}}
{{--                        <div class="card-title d-flex flex-column">--}}
{{--                            <!--begin::Info-->--}}
{{--                            <div class="d-flex align-items-center">--}}
{{--                                <!--begin::Amount-->--}}
{{--                                <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{$incompleteCount}}</span>--}}
{{--                                <!--end::Amount-->--}}
{{--                                <!--begin::Badge-->--}}
{{--                                <span class="badge badge-light-danger fs-base">--}}
{{--															<i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">--}}
{{--																<span class="path1"></span>--}}
{{--																<span class="path2"></span>--}}
{{--                                                            </i>--}}
{{--                                </span>--}}
{{--															</i>2.2%</span>--}}
{{--                                <!--end::Badge-->--}}
{{--                            </div>--}}
{{--                            <!--end::Info-->--}}
{{--                            <!--begin::Subtitle-->--}}
{{--                            <span class="text-gray-400 pt-1 fw-semibold fs-6">Total Completed Task</span>--}}
{{--                            <!--end::Subtitle-->--}}
{{--                        </div>--}}
{{--                        <!--end::Title-->--}}
{{--                    </div>--}}
{{--                    <!--end::Header-->--}}
{{--                    <!--begin::Card body-->--}}
{{--                    <div class="card-body d-flex align-items-end pt-0">--}}
{{--                        <!--begin::Progress-->--}}
{{--                        <div class="d-flex align-items-center flex-column mt-3 w-100">--}}
{{--                            <div class="d-flex justify-content-between w-100 mt-auto mb-2">--}}
{{--                                <span class="fw-bolder fs-6 text-dark">{{$incompleteCount}} task to complete</span>--}}
{{--                                <span class="fw-bold fs-6 text-gray-400">--}}
{{--                                    {{$percentage}}%--}}
{{--                            </span>--}}

{{--                            </div>--}}
{{--                            <div class="h-8px mx-3 w-100 bg-light-success rounded">--}}
{{--                                <div class="bg-success rounded h-8px" role="progressbar" style="width: {{$percentage}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!--end::Progress-->--}}
{{--                    </div>--}}
{{--                    <!--end::Card body-->--}}
{{--                </div>--}}
{{--                <!--end::Card widget 5-->--}}
{{--                        </div>--}}


{{--                <div class="col-xl-4 mb-xl-20">--}}

{{--            <div class="card card-flush h-md-50 mb-xl-20">--}}
{{--                <!--begin::Header-->--}}
{{--                <div class="card-header pt-5">--}}
{{--                    <!--begin::Title-->--}}
{{--                    <div class="card-title d-flex flex-column">--}}
{{--                        <!--begin::Amount-->--}}
{{--                        <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{$todo}}</span>--}}
{{--                        <!--end::Amount-->--}}
{{--                        <!--begin::Subtitle-->--}}
{{--                        <span class="text-gray-400 pt-1 fw-semibold fs-6">Total Todo Task</span>--}}
{{--                        <!--end::Subtitle-->--}}
{{--                    </div>--}}
{{--                    <!--end::Title-->--}}
{{--                </div>--}}
{{--                <!--end::Header-->--}}
{{--                <!--begin::Card body-->--}}

{{--                <!--end::Card body-->--}}
{{--            </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-4 mb-xl-20">--}}

{{--            <div class="card card-flush h-md-50 mb-xl-20">--}}
{{--                <!--begin::Header-->--}}
{{--                <div class="card-header pt-5">--}}
{{--                    <!--begin::Title-->--}}
{{--                    <div class="card-title d-flex flex-column">--}}
{{--                        <!--begin::Amount-->--}}
{{--                        <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{$delete}}</span>--}}
{{--                        <!--end::Amount-->--}}
{{--                        <!--begin::Subtitle-->--}}
{{--                        <span class="text-gray-400 pt-1 fw-semibold fs-6">Total Deleted Task</span>--}}
{{--                        <!--end::Subtitle-->--}}
{{--                    </div>--}}
{{--                    <!--end::Title-->--}}
{{--                </div>--}}
{{--                <!--end::Header-->--}}
{{--                <!--begin::Card body-->--}}

{{--                <!--end::Card body-->--}}
{{--            </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-4 mb-xl-20">--}}

{{--                <div class="card card-flush h-md-50 mb-xl-20">--}}
{{--                    <!--begin::Header-->--}}
{{--                    <div class="card-header pt-5">--}}
{{--                        <!--begin::Title-->--}}
{{--                        <div class="card-title d-flex flex-column">--}}
{{--                            <!--begin::Amount-->--}}
{{--                            <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{$schedule}}</span>--}}
{{--                            <!--end::Amount-->--}}
{{--                            <!--begin::Subtitle-->--}}
{{--                            <span class="text-gray-400 pt-1 fw-semibold fs-6">Total Schedule Task</span>--}}
{{--                            <!--end::Subtitle-->--}}
{{--                        </div>--}}
{{--                        <!--end::Title-->--}}
{{--                    </div>--}}
{{--                    <!--end::Header-->--}}
{{--                    <!--begin::Card body-->--}}

{{--                    <!--end::Card body-->--}}
{{--                </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-4 mb-xl-20">--}}

{{--                <div class="card card-flush h-md-50 mb-xl-20">--}}
{{--                    <!--begin::Header-->--}}
{{--                    <div class="card-header pt-5">--}}
{{--                        <!--begin::Title-->--}}
{{--                        <div class="card-title d-flex flex-column">--}}
{{--                            <!--begin::Amount-->--}}
{{--                            <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{$delegate}}</span>--}}
{{--                            <!--end::Amount-->--}}
{{--                            <!--begin::Subtitle-->--}}
{{--                            <span class="text-gray-400 pt-1 fw-semibold fs-6">Total Delegate Task</span>--}}
{{--                            <!--end::Subtitle-->--}}
{{--                        </div>--}}
{{--                        <!--end::Title-->--}}
{{--                    </div>--}}
{{--                    <!--end::Header-->--}}
{{--                    <!--begin::Card body-->--}}

{{--                    <!--end::Card body-->--}}
{{--                </div>--}}
{{--                    </div>--}}

                <div class="row g-5 g-xl-10">
                    <!--begin::Col-->
                    <div class="col-xl-4 mb-xl-10">
                        <!--begin::Lists Widget 19-->
                        <div class="card card-flush h-xl-100">
                            <!--begin::Heading-->
                            <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px" style="background-image:url({{asset('backend/assets/media/svg/shapes/top-green.png')}}" data-bs-theme="light">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column text-white pt-15">
                                    <span class="fw-bold fs-2x mb-3">My Tasks</span>
                                    <div class="fs-4 text-white">
                                        <span class="opacity-75">You have</span>
                                        <span class="position-relative d-inline-block">
														<a href="{{route('task')}}" class="link-white opacity-75-hover fw-bold d-block mb-1">{{$incompleteCount}}</a>
                                            <!--begin::Separator-->
														<span class="position-absolute opacity-50 bottom-0 start-0 border-2 border-body border-bottom w-100"></span>
                                            <!--end::Separator-->
													</span>
                                        <span class="opacity-75">to complete</span>
                                    </div>
                                </h3>
                                <!--end::Title-->
                                <!--begin::Toolbar-->
                                <div class="card-toolbar pt-5">
                                    <!--begin::Menu-->
                                    <button class="btn btn-sm btn-icon btn-active-color-primary btn-color-white bg-white bg-opacity-25 bg-hover-opacity-100 bg-hover-white bg-active-opacity-25 w-20px h-20px" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                        <i class="ki-duotone ki-dots-square fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </button>
                                    <!--begin::Menu 2-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Quick Actions</div>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator mb-3 opacity-75"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Ticket</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Customer</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                            <!--begin::Menu item-->
                                            <a href="#" class="menu-link px-3">
                                                <span class="menu-title">New Group</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <!--end::Menu item-->
                                            <!--begin::Menu sub-->
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Admin Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Staff Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Member Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu sub-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Contact</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator mt-3 opacity-75"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content px-3 py-3">
                                                <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu 2-->
                                    <!--end::Menu-->
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Body-->
                            <div class="card-body mt-n20">
                                <!--begin::Stats-->
                                <div class="mt-n20 position-relative">
                                    <!--begin::Row-->
                                    <div class="row g-3 g-lg-6">
                                        <!--begin::Col-->
                                        <div class="col-6">
                                            <!--begin::Items-->
                                            <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-30px me-5 mb-8">
																<span class="symbol-label">
																	<i class="ki-duotone ki-flask fs-1 text-primary">
																		<span class="path1"></span>
																		<span class="path2"></span>
																	</i>
																</span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Stats-->
                                                <div class="m-0">
                                                    <!--begin::Number-->
                                                    <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">{{$totalTasks}}</span>
                                                    <!--end::Number-->
                                                    <!--begin::Desc-->
                                                    <span class="text-gray-500 fw-semibold fs-6">Tasks</span>
                                                    <!--end::Desc-->
                                                </div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Items-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-6">
                                            <!--begin::Items-->
                                            <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-30px me-5 mb-8">
																<span class="symbol-label">
																	<i class="ki-duotone ki-bank fs-1 text-primary">
																		<span class="path1"></span>
																		<span class="path2"></span>
																	</i>
																</span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Stats-->
                                                <div class="m-0">
                                                    <!--begin::Number-->
                                                    <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">{{$completedCount}}</span>
                                                    <!--end::Number-->
                                                    <!--begin::Desc-->
                                                    <span class="text-gray-500 fw-semibold fs-6">Completed Task</span>
                                                    <!--end::Desc-->
                                                </div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Items-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-6">
                                            <!--begin::Items-->
                                            <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-30px me-5 mb-8">
																<span class="symbol-label">
																	<i class="ki-duotone ki-award fs-1 text-primary">
																		<span class="path1"></span>
																		<span class="path2"></span>
																		<span class="path3"></span>
																	</i>
																</span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Stats-->
                                                <div class="m-0">
                                                    <!--begin::Number-->
                                                    <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">{{$delete}}</span>
                                                    <!--end::Number-->
                                                    <!--begin::Desc-->
                                                    <span class="text-gray-500 fw-semibold fs-6">Deleted Task</span>
                                                    <!--end::Desc-->
                                                </div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Items-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-6">
                                            <!--begin::Items-->
                                            <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-30px me-5 mb-8">
																<span class="symbol-label">
																	<i class="ki-duotone ki-timer fs-1 text-primary">
																		<span class="path1"></span>
																		<span class="path2"></span>
																		<span class="path3"></span>
																	</i>
																</span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Stats-->
                                                <div class="m-0">
                                                    <!--begin::Number-->
                                                    <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">{{$incompleteCount}}</span>
                                                    <!--end::Number-->
                                                    <!--begin::Desc-->
                                                    <span class="text-gray-500 fw-semibold fs-6">incompleted task</span>
                                                    <!--end::Desc-->
                                                </div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Items-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Lists Widget 19-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-8 mb-5 mb-xl-10">
                        <!--begin::Row-->
                        <div class="row g-5 g-xl-10">
                            <!--begin::Col-->
                            <div class="col-xl-6 mb-xl-10">
                                <!--begin::Slider Widget 1-->
                                <div id="kt_sliders_widget_1_slider" class="card card-flush carousel carousel-custom carousel-stretch slide h-xl-100" data-bs-ride="carousel" data-bs-interval="5000">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <h4 class="card-title d-flex align-items-start flex-column">
                                            <span class="card-label fw-bold text-gray-800">Today’s Course</span>
                                            <span class="text-gray-400 mt-1 fw-bold fs-7">4 lessons, 3 hours 45 minutes</span>
                                        </h4>
                                        <!--end::Title-->
                                        <!--begin::Toolbar-->
                                        <div class="card-toolbar">
                                            <!--begin::Carousel Indicators-->
                                            <ol class="p-0 m-0 carousel-indicators carousel-indicators-bullet carousel-indicators-active-primary">
                                                <li data-bs-target="#kt_sliders_widget_1_slider" data-bs-slide-to="0" class="active ms-1"></li>
                                                <li data-bs-target="#kt_sliders_widget_1_slider" data-bs-slide-to="1" class="ms-1"></li>
                                                <li data-bs-target="#kt_sliders_widget_1_slider" data-bs-slide-to="2" class="ms-1"></li>
                                            </ol>
                                            <!--end::Carousel Indicators-->
                                        </div>
                                        <!--end::Toolbar-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-6">
                                        <!--begin::Carousel-->
                                        <div class="carousel-inner mt-n5">
                                            <!--begin::Item-->
                                            <div class="carousel-item active show">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-5">
                                                    <!--begin::Chart-->
                                                    <div class="w-80px flex-shrink-0 me-2">
                                                        <div class="min-h-auto ms-n3" id="kt_slider_widget_1_chart_1" style="height: 100px"></div>
                                                    </div>
                                                    <!--end::Chart-->
                                                    <!--begin::Info-->
                                                    <div class="m-0">
                                                        <!--begin::Subtitle-->
                                                        <h4 class="fw-bold text-gray-800 mb-3">Ruby on Rails</h4>
                                                        <!--end::Subtitle-->
                                                        <!--begin::Items-->
                                                        <div class="d-flex d-grid gap-5">
                                                            <!--begin::Item-->
                                                            <div class="d-flex flex-column flex-shrink-0 me-4">
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>3 Topics</span>
                                                                <!--end::Section-->
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>1 Speakers</span>
                                                                <!--end::Section-->
                                                            </div>
                                                            <!--end::Item-->
                                                            <!--begin::Item-->
                                                            <div class="d-flex flex-column flex-shrink-0">
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>50 Min</span>
                                                                <!--end::Section-->
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>72 students</span>
                                                                <!--end::Section-->
                                                            </div>
                                                            <!--end::Item-->
                                                        </div>
                                                        <!--end::Items-->
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Action-->
                                                <div class="m-0">
                                                    <a href="#" class="btn btn-sm btn-light me-2 mb-2">Skip This</a>
                                                    <a href="#" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Continue</a>
                                                </div>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="carousel-item">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-5">
                                                    <!--begin::Chart-->
                                                    <div class="w-80px flex-shrink-0 me-2">
                                                        <div class="min-h-auto ms-n3" id="kt_slider_widget_1_chart_2" style="height: 100px"></div>
                                                    </div>
                                                    <!--end::Chart-->
                                                    <!--begin::Info-->
                                                    <div class="m-0">
                                                        <!--begin::Subtitle-->
                                                        <h4 class="fw-bold text-gray-800 mb-3">Ruby on Rails</h4>
                                                        <!--end::Subtitle-->
                                                        <!--begin::Items-->
                                                        <div class="d-flex d-grid gap-5">
                                                            <!--begin::Item-->
                                                            <div class="d-flex flex-column flex-shrink-0 me-4">
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>3 Topics</span>
                                                                <!--end::Section-->
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>1 Speakers</span>
                                                                <!--end::Section-->
                                                            </div>
                                                            <!--end::Item-->
                                                            <!--begin::Item-->
                                                            <div class="d-flex flex-column flex-shrink-0">
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>50 Min</span>
                                                                <!--end::Section-->
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>72 students</span>
                                                                <!--end::Section-->
                                                            </div>
                                                            <!--end::Item-->
                                                        </div>
                                                        <!--end::Items-->
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Action-->
                                                <div class="m-0">
                                                    <a href="#" class="btn btn-sm btn-light me-2 mb-2">Skip This</a>
                                                    <a href="#" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Continue</a>
                                                </div>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="carousel-item">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-5">
                                                    <!--begin::Chart-->
                                                    <div class="w-80px flex-shrink-0 me-2">
                                                        <div class="min-h-auto ms-n3" id="kt_slider_widget_1_chart_3" style="height: 100px"></div>
                                                    </div>
                                                    <!--end::Chart-->
                                                    <!--begin::Info-->
                                                    <div class="m-0">
                                                        <!--begin::Subtitle-->
                                                        <h4 class="fw-bold text-gray-800 mb-3">Ruby on Rails</h4>
                                                        <!--end::Subtitle-->
                                                        <!--begin::Items-->
                                                        <div class="d-flex d-grid gap-5">
                                                            <!--begin::Item-->
                                                            <div class="d-flex flex-column flex-shrink-0 me-4">
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>3 Topics</span>
                                                                <!--end::Section-->
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>1 Speakers</span>
                                                                <!--end::Section-->
                                                            </div>
                                                            <!--end::Item-->
                                                            <!--begin::Item-->
                                                            <div class="d-flex flex-column flex-shrink-0">
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>50 Min</span>
                                                                <!--end::Section-->
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>72 students</span>
                                                                <!--end::Section-->
                                                            </div>
                                                            <!--end::Item-->
                                                        </div>
                                                        <!--end::Items-->
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Action-->
                                                <div class="m-0">
                                                    <a href="#" class="btn btn-sm btn-light me-2 mb-2">Skip This</a>
                                                    <a href="#" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Continue</a>
                                                </div>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Carousel-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Slider Widget 1-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-6 mb-5 mb-xl-10">
                                <!--begin::Slider Widget 2-->
                                <div id="kt_sliders_widget_2_slider" class="card card-flush carousel carousel-custom carousel-stretch slide h-xl-100" data-bs-ride="carousel" data-bs-interval="5500">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <h4 class="card-title d-flex align-items-start flex-column">
                                            <span class="card-label fw-bold text-gray-800">Today’s Events</span>
                                            <span class="text-gray-400 mt-1 fw-bold fs-7">24 events on all activities</span>
                                        </h4>
                                        <!--end::Title-->
                                        <!--begin::Toolbar-->
                                        <div class="card-toolbar">
                                            <!--begin::Carousel Indicators-->
                                            <ol class="p-0 m-0 carousel-indicators carousel-indicators-bullet carousel-indicators-active-success">
                                                <li data-bs-target="#kt_sliders_widget_2_slider" data-bs-slide-to="0" class="active ms-1"></li>
                                                <li data-bs-target="#kt_sliders_widget_2_slider" data-bs-slide-to="1" class="ms-1"></li>
                                                <li data-bs-target="#kt_sliders_widget_2_slider" data-bs-slide-to="2" class="ms-1"></li>
                                            </ol>
                                            <!--end::Carousel Indicators-->
                                        </div>
                                        <!--end::Toolbar-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-6">
                                        <!--begin::Carousel-->
                                        <div class="carousel-inner">
                                            <!--begin::Item-->
                                            <div class="carousel-item active show">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-9">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-70px symbol-circle me-5">
																	<span class="symbol-label bg-light-success">
																		<i class="ki-duotone ki-abstract-24 fs-3x text-success">
																			<span class="path1"></span>
																			<span class="path2"></span>
																		</i>
																	</span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Info-->
                                                    <div class="m-0">
                                                        <!--begin::Subtitle-->
                                                        <h4 class="fw-bold text-gray-800 mb-3">Ruby on Rails</h4>
                                                        <!--end::Subtitle-->
                                                        <!--begin::Items-->
                                                        <div class="d-flex d-grid gap-5">
                                                            <!--begin::Item-->
                                                            <div class="d-flex flex-column flex-shrink-0 me-4">
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>5 Topics</span>
                                                                <!--end::Section-->
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>1 Speakers</span>
                                                                <!--end::Section-->
                                                            </div>
                                                            <!--end::Item-->
                                                            <!--begin::Item-->
                                                            <div class="d-flex flex-column flex-shrink-0">
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>60 Min</span>
                                                                <!--end::Section-->
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>137 students</span>
                                                                <!--end::Section-->
                                                            </div>
                                                            <!--end::Item-->
                                                        </div>
                                                        <!--end::Items-->
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Action-->
                                                <div class="m-0">
                                                    <a href="#" class="btn btn-sm btn-light me-2 mb-2">Details</a>
                                                    <a href="#" class="btn btn-sm btn-success mb-2" data-bs-toggle="modal" data-bs-target="#kt_modal_create_campaign">Join Event</a>
                                                </div>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="carousel-item">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-9">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-70px symbol-circle me-5">
																	<span class="symbol-label bg-light-danger">
																		<i class="ki-duotone ki-abstract-25 fs-3x text-danger">
																			<span class="path1"></span>
																			<span class="path2"></span>
																		</i>
																	</span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Info-->
                                                    <div class="m-0">
                                                        <!--begin::Subtitle-->
                                                        <h4 class="fw-bold text-gray-800 mb-3">Ruby on Rails</h4>
                                                        <!--end::Subtitle-->
                                                        <!--begin::Items-->
                                                        <div class="d-flex d-grid gap-5">
                                                            <!--begin::Item-->
                                                            <div class="d-flex flex-column flex-shrink-0 me-4">
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>12 Topics</span>
                                                                <!--end::Section-->
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>1 Speakers</span>
                                                                <!--end::Section-->
                                                            </div>
                                                            <!--end::Item-->
                                                            <!--begin::Item-->
                                                            <div class="d-flex flex-column flex-shrink-0">
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>50 Min</span>
                                                                <!--end::Section-->
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>72 students</span>
                                                                <!--end::Section-->
                                                            </div>
                                                            <!--end::Item-->
                                                        </div>
                                                        <!--end::Items-->
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Action-->
                                                <div class="m-0">
                                                    <a href="#" class="btn btn-sm btn-light me-2 mb-2">Details</a>
                                                    <a href="#" class="btn btn-sm btn-success mb-2" data-bs-toggle="modal" data-bs-target="#kt_modal_create_campaign">Join Event</a>
                                                </div>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="carousel-item">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-9">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-70px symbol-circle me-5">
																	<span class="symbol-label bg-light-primary">
																		<i class="ki-duotone ki-abstract-36 fs-3x text-primary">
																			<span class="path1"></span>
																			<span class="path2"></span>
																		</i>
																	</span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Info-->
                                                    <div class="m-0">
                                                        <!--begin::Subtitle-->
                                                        <h4 class="fw-bold text-gray-800 mb-3">Ruby on Rails</h4>
                                                        <!--end::Subtitle-->
                                                        <!--begin::Items-->
                                                        <div class="d-flex d-grid gap-5">
                                                            <!--begin::Item-->
                                                            <div class="d-flex flex-column flex-shrink-0 me-4">
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>3 Topics</span>
                                                                <!--end::Section-->
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>1 Speakers</span>
                                                                <!--end::Section-->
                                                            </div>
                                                            <!--end::Item-->
                                                            <!--begin::Item-->
                                                            <div class="d-flex flex-column flex-shrink-0">
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>50 Min</span>
                                                                <!--end::Section-->
                                                                <!--begin::Section-->
                                                                <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
																			<i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
																				<span class="path1"></span>
																				<span class="path2"></span>
																			</i>72 students</span>
                                                                <!--end::Section-->
                                                            </div>
                                                            <!--end::Item-->
                                                        </div>
                                                        <!--end::Items-->
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Action-->
                                                <div class="m-0">
                                                    <a href="#" class="btn btn-sm btn-light me-2 mb-2">Details</a>
                                                    <a href="#" class="btn btn-sm btn-success mb-2" data-bs-toggle="modal" data-bs-target="#kt_modal_create_campaign">Join Event</a>
                                                </div>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Carousel-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Slider Widget 2-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                        <!--begin::Engage widget 4-->
                        <div class="card border-transparent" data-bs-theme="light" style="background-color: #1C325E;">
                            <!--begin::Body-->
                            <div class="card-body d-flex ps-xl-15">
                                <!--begin::Wrapper-->
                                <div class="m-0">
                                    <!--begin::Title-->
                                    <div class="position-relative fs-2x z-index-2 fw-bold text-white mb-7">
												<span class="me-2">You have got
												<span class="position-relative d-inline-block text-danger">
													<a href="../../demo7/dist/pages/user-profile/overview.html" class="text-danger opacity-75-hover">2300 bonus</a>
                                                    <!--begin::Separator-->
													<span class="position-absolute opacity-50 bottom-0 start-0 border-4 border-danger border-bottom w-100"></span>
                                                    <!--end::Separator-->
												</span></span>points.
                                        <br />Feel free to use them in your lessons</div>
                                    <!--end::Title-->
                                    <!--begin::Action-->
                                    <div class="mb-3">
                                        <a href='#' class="btn btn-danger fw-semibold me-2" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">Get Reward</a>
                                        <a href="../../demo7/dist/apps/support-center/overview.html" class="btn btn-color-white bg-white bg-opacity-15 bg-hover-opacity-25 fw-semibold">How to</a>
                                    </div>
                                    <!--begin::Action-->
                                </div>
                                <!--begin::Wrapper-->
                                <!--begin::Illustration-->
                                <img src="assets/media/illustrations/sigma-1/17-dark.png" class="position-absolute me-3 bottom-0 end-0 h-200px" alt="" />
                                <!--end::Illustration-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Engage widget 4-->
                    </div>
                    <!--end::Col-->
                </div>





            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search user" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <!--begin::Filter-->
                            <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="ki-duotone ki-filter fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>Filter</button>
                            <!--begin::Menu 1-->
                            <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bold">Filter Options</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Separator-->
                                <!--begin::Content-->
                                <div class="px-7 py-5" data-kt-user-table-filter="form">
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">Role:</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-user-table-filter="role" data-hide-search="true">
                                            <option></option>
                                            <option value="Administrator">Administrator</option>
                                            <option value="Analyst">Analyst</option>
                                            <option value="Developer">Developer</option>
                                            <option value="Support">Support</option>
                                            <option value="Trial">Trial</option>
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true" data-kt-user-table-filter="reset">Reset</button>
                                        <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" data-kt-user-table-filter="filter">Apply</button>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Menu 1-->
                            <!--end::Filter-->
                            <!--begin::Export-->
                            <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_export_users">
                                <i class="ki-duotone ki-exit-up fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>Export</button>
                            <!--end::Export-->
                            <!--begin::Add user-->
{{--                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">--}}
{{--                                <i class="ki-duotone ki-plus fs-2"></i>Add User</button>--}}
                            <!--end::Add user-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                            <div class="fw-bold me-5">
                                <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected</div>
                            <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
                        </div>
                        <!--end::Group actions-->
                        <!--begin::Modal - Adjust Balance-->
                        <div class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">
                            <!--begin::Modal dialog-->
                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                    <!--begin::Modal header-->
                                    <div class="modal-header">
                                        <!--begin::Modal title-->
                                        <h2 class="fw-bold">Export Users</h2>
                                        <!--end::Modal title-->
                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                                            <i class="ki-duotone ki-cross fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Close-->
                                    </div>
                                    <!--end::Modal header-->
                                    <!--begin::Modal body-->
{{--                                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">--}}
{{--                                        <!--begin::Form-->--}}
{{--                                        <form id="kt_modal_export_users_form" class="form" action="#">--}}
{{--                                            <!--begin::Input group-->--}}
{{--                                            <div class="fv-row mb-10">--}}
{{--                                                <!--begin::Label-->--}}
{{--                                                <label class="fs-6 fw-semibold form-label mb-2">Select Roles:</label>--}}
{{--                                                <!--end::Label-->--}}
{{--                                                <!--begin::Input-->--}}
{{--                                                <select name="role" data-control="select2" data-placeholder="Select a role" data-hide-search="true" class="form-select form-select-solid fw-bold">--}}
{{--                                                    <option></option>--}}
{{--                                                    @foreach($roles as $role)--}}
{{--                                                        <option value="{{$role->id}}">{{$role->name}}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                                <!--end::Input-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Input group-->--}}
{{--                                            <!--begin::Input group-->--}}
{{--                                            <div class="fv-row mb-10">--}}
{{--                                                <!--begin::Label-->--}}
{{--                                                <label class="required fs-6 fw-semibold form-label mb-2">Select Export Format:</label>--}}
{{--                                                <!--end::Label-->--}}
{{--                                                <!--begin::Input-->--}}
{{--                                                <select name="format" data-control="select2" data-placeholder="Select a format" data-hide-search="true" class="form-select form-select-solid fw-bold">--}}
{{--                                                    <option></option>--}}
{{--                                                    <option value="excel">Excel</option>--}}
{{--                                                    <option value="pdf">PDF</option>--}}
{{--                                                    <option value="cvs">CVS</option>--}}
{{--                                                    <option value="zip">ZIP</option>--}}
{{--                                                </select>--}}
{{--                                                <!--end::Input-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Input group-->--}}
{{--                                            <!--begin::Actions-->--}}
{{--                                            <div class="text-center">--}}
{{--                                                <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>--}}
{{--                                                <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">--}}
{{--                                                    <span class="indicator-label">Submit</span>--}}
{{--                                                    <span class="indicator-progress">Please wait...--}}
{{--																	<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                            <!--end::Actions-->--}}
{{--                                        </form>--}}
{{--                                        <!--end::Form-->--}}
{{--                                    </div>--}}
                                    <!--end::Modal body-->
                                </div>
                                <!--end::Modal content-->
                            </div>
                            <!--end::Modal dialog-->
                        </div>
                        <!--end::Modal - New Card-->
                        <!--begin::Modal - Add task-->
                        <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                            <!--begin::Modal dialog-->
                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                    <!--begin::Modal header-->
                                    <div class="modal-header" id="kt_modal_add_user_header">
                                        <!--begin::Modal title-->
{{--                                        <h2 class="fw-bold">Add User</h2>--}}
                                        <!--end::Modal title-->
                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                                            <i class="ki-duotone ki-cross fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Close-->
                                    </div>
                                    <!--end::Modal header-->
                                    <!--begin::Modal body-->
{{--                                    <div class="modal-body px-5 my-7">--}}
{{--                                        <!--begin::Form-->--}}
{{--                                        <form id="kt_modal_add_user_form" class="form" action="{{route('roles.store')}}" method="post">--}}
{{--                                            @csrf--}}
{{--                                            <!--begin::Scroll-->--}}
{{--                                            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">--}}
{{--                                                <!--begin::Input group-->--}}
{{--                                                <!--end::Input group-->--}}
{{--                                                <!--begin::Input group-->--}}
{{--                                                <div class="fv-row mb-7">--}}
{{--                                                    <!--begin::Label-->--}}
{{--                                                    <label class="required fw-semibold fs-6 mb-2">Name</label>--}}
{{--                                                    <!--end::Label-->--}}
{{--                                                    <!--begin::Input-->--}}
{{--                                                    <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Full name" />--}}
{{--                                                    <!--end::Input-->--}}
{{--                                                </div>--}}
{{--                                                <!--end::Input group-->--}}
{{--                                                <!--begin::Input group-->--}}
{{--                                                <!--end::Input group-->--}}
{{--                                                <!--begin::Input group-->--}}
{{--                                                <div class="mb-5">--}}
{{--                                                    <!--begin::Label-->--}}
{{--                                                    <label class="required fw-semibold fs-6 mb-5">Permission</label>--}}
{{--                                                    <!--end::Label-->--}}

{{--                                                    <!--begin::Roles-->--}}
{{--                                                    <!--begin::Input row-->--}}

{{--                                                    <!--end::Input row-->--}}
{{--                                                    <div class='separator separator-dashed my-5'></div>--}}
{{--                                                    <!--begin::Input row-->--}}
{{--                                                    <div class="d-flex fv-row">--}}
{{--                                                        <!--begin::Radio-->--}}

{{--                                                        <div class="form-check form-check-custom form-check-solid">--}}
{{--                                                            <!--begin::Input-->--}}

{{--                                                            --}}{{--                                                        <input class="form-check-input me-3" name="roles" value="{{$role->id}}" type="radio" id="kt_modal_update_role_option_4" />--}}
{{--                                                            --}}{{--                                                        <!--end::Input-->--}}
{{--                                                            --}}{{--                                                        <!--begin::Label-->--}}
{{--                                                            --}}{{--                                                            <label class="form-check-label" for="kt_modal_update_role_option_4">--}}
{{--                                                            --}}{{--                                                                <div class="fw-bold text-gray-800">{{$role->name}}</div>--}}
{{--                                                            --}}{{--                                                            </label>--}}

{{--                                                            <label class="fs-6 fw-semibold form-label mb-2">Select Permission:</label>--}}
{{--                                                            <!--end::Label-->--}}
{{--                                                            <!--begin::Input-->--}}
{{--                                                            @foreach($permission as $value)--}}
{{--                                                                <label>{{ Form::checkbox('permission[]', $value->name, false, array('class' => 'name')) }}--}}
{{--                                                                    {{ $value->name }}</label>--}}
{{--                                                                <br/>--}}
{{--                                                            @endforeach--}}


{{--                                                        </div>--}}
{{--                                                        <!--end::Radio-->--}}
{{--                                                    </div>--}}
{{--                                                    <!--end::Input row-->--}}
{{--                                                    <!--end::Roles-->--}}
{{--                                                </div>--}}
{{--                                                <!--end::Input group-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Scroll-->--}}
{{--                                            <!--begin::Actions-->--}}
{{--                                            <div class="text-center pt-10">--}}
{{--                                                <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>--}}
{{--                                                <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">--}}
{{--                                                    <span class="indicator-label">Submit</span>--}}
{{--                                                    <span class="indicator-progress">Please wait...--}}
{{--																	<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                            <!--end::Actions-->--}}
{{--                                        </form>--}}
{{--                                        <!--end::Form-->--}}
{{--                                    </div>--}}
                                    <!--end::Modal body-->
                                </div>
                                <!--end::Modal content-->
                            </div>
                            <!--end::Modal dialog-->
                        </div>
                        <!--end::Modal - Add task-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                                </div>
                            </th>
                            <th class="min-w-125px">No</th>
                            <th class="min-w-125px">Title</th>
                            <th class="min-w-125px">Requirements</th>
                            <th class="min-w-125px">Due Date</th>
                            <th class="min-w-125px">Due Time Start</th>
                            <th class="min-w-125px">Due Time End</th>
                            <th class="min-w-125px">Completed</th>
{{--                            <th class="text-end min-w-100px">Actions</th>--}}
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                        @foreach ($task as $key => $record)
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>{{ $record->id }}</td>
                                <td class="d-flex align-items-center">
                                    <!--begin::User details-->
                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$record->task_title}}</a>

                                    </div>
                                    <!--begin::User details-->
                                </td>
                                <td >
                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$record->task_requirements}}</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$record->due_date}}</a>
                                    </div>
                                </td>
                                <td >
                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$record->due_time_start}}</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-gray-800 text-hover-primary mb-1">{{$record->due_time_end}}</a>
                                    </div>
                                </td>
                                <td>

                                        <div class="d-flex flex-row-fluid flex-wrap align-items-center">

                                            <span class="badge badge-light-success fs-8 fw-bold my-2">
                                                @php
                                                $status = $record->is_completed == 1 ? 'Completed' : 'Not Completed';
                                                echo $status
                                                @endphp
                                            </span>

                                        </div>

                                </td>

{{--                                <td class="text-end">--}}
{{--                                    <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions--}}
{{--                                        <i class="ki-duotone ki-down fs-5 ms-1"></i></a>--}}
{{--                                    <!--begin::Menu-->--}}
{{--                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">--}}
{{--                                        <!--begin::Menu item-->--}}
{{--                                        @can('role-edit')--}}
{{--                                            <div class="menu-item px-3">--}}
{{--                                                <a href="{{ route('roles.edit',$role->id) }}" class="menu-link px-3">Edit</a>--}}
{{--                                            </div>--}}
{{--                                        @endcan--}}
{{--                                        <!--end::Menu item-->--}}
{{--                                        <!--begin::Menu item-->--}}
{{--                                        @can('role-delete')--}}
{{--                                            <div class="menu-item px-3">--}}
{{--                                                <form action="{{route('roles.destroy',$role->id)}}" method="post" class="menu-link px-3" data-kt-users-table-filter="delete_row">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}
{{--                                                    <button class="btn btn-danger" type="submit">Delete</button></form>--}}
{{--                                            </div>--}}
{{--                                        @endcan--}}
{{--                                        <!--end::Menu item-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Menu-->--}}
{{--                                </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        </div>
        <!--end::Container-->
    </div>
@endsection
