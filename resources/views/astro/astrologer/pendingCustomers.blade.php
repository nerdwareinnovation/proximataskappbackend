@extends('layouts.admin_layouts')
@section('pagespecificstyles')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/dt-global_style.css')}}">
    <link href="{{asset('backend/assets/css/elements/avatar.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing mt-3">
            <div class="widget-content widget-content-area br-6">
                <div class="table-responsive mb-4 mt-4">
                    <table id="zero-config" class="table table-hover" >
                        <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Place Of Birth</th>
                            <th>Date of Birth</th>
                            <th>Time of Birth</th>
                            <th>Is Time Accurate</th>
                            <th class="no-content"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td>
                                    @if($customer->isOnline())

                                        <div class="avatar avatar-xl avatar-indicators avatar-online">
                                            @if($customer->details->image_url)
                                                <img alt="avatar" src="{{asset($customer->details->image_url)}}" class="rounded-circle" />
                                            @else
                                                <img alt="avatar" src="{{asset('avatar.jpg')}}" class="rounded-circle" />
                                            @endif
                                        </div>
                                    @else
                                        <div class="avatar avatar-xl avatar-indicators avatar-offline">
                                            @if($customer->details->image_url)
                                                <img alt="avatar" src="{{asset($customer->details->image_url)}}" class="rounded-circle" />
                                            @else
                                                <img alt="avatar" src="{{asset('avatar.jpg')}}" class="rounded-circle" />
                                            @endif
                                        </div>
                                    @endif



                                </td>
                                <td>{{$customer->name}}</td>

                                <td>{{$customer->details->gender}}</td>
                                <td>{{$customer->details->state_of_birth, $customer->details->country_of_birth}}</td>

                                <td>{{$customer->details->date_of_birth}}</td>
                                <td>{{$customer->details->time_of_birth}}</td>
                                <td>{{$customer->details->is_time_accurate}}</td>

                                <td>
                                    <a href="{{URL('astrologer/editVedic/'.$customer->id)}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-edit"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                    </a>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                </td>
                            </tr>

                        @endforeach
                        </tfoot>
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
