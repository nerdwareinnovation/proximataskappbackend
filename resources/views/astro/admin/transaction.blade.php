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
                <div class="col-md-12">

                    <div class="offset-2">
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

                </div>
                <div class="table-responsive mb-4 mt-4">
                    <table id="zero-config" class="table table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Package</th>
                            <th>Customer</th>
                            <th>Method</th>

                            <th>Price</th>
                            <th>Transaction Time</th>
                            <th>Status</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transaction as $tran)
                            <tr>



                                <td>{{$tran->transaction_id}}</td>
                                <td>@if(isset($tran->package)){{$tran->package->name}}@else {{'UNKNOWN'}} @endif</td>
                                <td>@if(isset($tran->customer)){{$tran->customer->name}}@else {{'UNKNOWN'}} @endif</td>
                                <td>{{$tran->method}}</td>


                                <td>{{$tran->price}}</td>
                                <td>{{$tran->created_at}}</td>
                                <td>
                                    @if($tran->status == 'succeeded')
                                        <span class="badge badge-success">Success</span>
                                    @else
                                        <span class="badge badge-danger">Failed</span>
                                    @endif
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
