@extends('layouts.master')
{{--@section('pagespecificstyles')--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/datatables.css')}}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/dt-global_style.css')}}">--}}
{{--    <link href="{{asset('backend/assets/css/elements/avatar.css')}}" rel="stylesheet" type="text/css" />--}}
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
                            <h4>Moderator List</h4>
                        </div>

                        <form method="POST" enctype="multipart/form-data" action="{{route('admin.filterAstrologer')}}">@csrf
                            <div class="row">

                                <div class="mt-2 col-md-4">
                                    From: <input name="from_date" value="{{ date('Y-m-d',strtotime($start ?? date('Y-m-d')))}}" class="form-control" type="date">
                                </div>
                                <div class="mt-2 col-md-4">
                                    To: <input name="to_date"  value="{{ date('Y-m-d',strtotime($end ?? date('Y-m-d'))) }}" class="form-control" type="date">
                                </div>
                                <div class="col-md-4">
                                    <button class="mt-4 btn btn-secondary">Filter</button>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="col-md-12" style="text-align: right">
                        <a href="{{route('admin.addPsychologist')}}" > <button class="btn btn-primary">Add New Psychologist</button></a>

                    </div>
                </div>
                <div class="card-body py-4">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Avatar</th>

                            <th class="min-w-125px">Name</th>
                            <th class="min-w-125px">Display Name</th>
                            <th class="min-w-125px">Email</th>
                            <th class="min-w-125px">Designation</th>
                            <th  class="min-w-125px">Total Question Answered</th>

                            <th class="no-content"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($psychologists as $astrologer)
                            <tr>
                                <td>


                                    @if($astrologer->isOnline())

                                        <div class="avatar avatar-xl avatar-indicators avatar-online">
                                            @if($astrologer->psychologistDetails->image_url)
                                                <img alt="avatar" src="{{asset($astrologer->psychologistDetails->image_url)}}" class="rounded-circle" />
                                            @else
                                                <img alt="avatar" src="{{asset('avatar.jpg')}}" class="rounded-circle" />
                                            @endif
                                        </div>
                                    @else
                                        <div class="avatar avatar-xl avatar-indicators avatar-offline">
                                            @if($astrologer->psychologistDetails->image_url)
                                                <img alt="avatar" src="{{asset($astrologer->psychologistDetails->image_url)}}" class="rounded-circle" />
                                            @else
                                                <img alt="avatar" src="{{asset('avatar.jpg')}}" class="rounded-circle" />
                                            @endif
                                        </div>
                                    @endif



                                </td>


                                <td>{{$astrologer->name}}</td>
                                <td>{{$astrologer->email}}</td>
                                <td>{{$astrologer->psychologistDetails->designation}}</td>

                                <td>{{$astrologer->psychologistDetails->total_question_answered}}</td>
                                <td>
                                    @if($astrologer->status == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>

                                <td>
                                    @if($astrologer->status == 1)
                                        <a href="{{URL::to('admin/user/disable/'.$astrologer->id)}}" id="disable">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                        </a>
                                    @else
                                        <a href="{{URL::to('admin/user/active/'.$astrologer->id)}}" id="enable">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                        </a>
                                    @endif


                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>



@endsection

@section('pagespecificscripts')
    <script src="{{asset('backend/plugins/table/datatable/datatables.js')}}"></script>
    <script>
        $('#zero-config').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7
        });
    </script>

@endsection
