@extends('layouts.admin_layouts')
@section('pagespecificstyles')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/dt-global_style.css')}}">
    <link href="{{asset('backend/assets/css/elements/avatar.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="table-responsive mb-4 mt-4">
                    <table id="zero-config" class="table table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Moderator</th>

                            <th>Translated By Moderator</th>
                            <th>Status</th>

                            <th class="no-content"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($messages) == 0)
                            <tr>
                                <td colspan="4" style="text-align: center">No Questions</td>

                            </tr>
                        @else
                        @foreach($messages as $message)

                                <tr>

                                    <td>{{\App\User::find($message->chat->sender_id)->name}}</td>

                                    <td>{{\App\User::find($message->chat->receiver_id)->name}}</td>

                                    <td>{{$message->transalated_by_moderator}}</td>

                                    @if($message->astrologer_answer == null)
                                        <td><div class="td-content"><span class="badge outline-badge-primary">Unanswered</span></div></td>
                                    @else
                                        <td><div class="td-content"><span class="badge outline-badge-success">Answered</span></div></td>
                                    @endif
                                    <td><div class="td-content"><a href="{{URL('astrologer/query/'.$message->id)}}">View</a></div></td>

                                </tr>
                        @endforeach
                            @endif
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
