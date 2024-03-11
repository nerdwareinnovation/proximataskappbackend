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
                    <table id="zero-config" class="table table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Question</th>
                            <th>Translated[Moderator]</th>
                            <th>Answer[Astrologer]</th>
                            <th>Answer[Translated by Moderator]</th>
                            <th>Status</th>
                            <th class="no-content"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($queries as $query)
                            <tr>
                                <td>{{\App\User::find($query->sender_id)->name}}</td>
                                <td>{{$query->message}}</td>
                                <td>
                                    @if(isset($query->astrologerQuery->transalated_by_moderator))
                                    {{$query->astrologerQuery->transalated_by_moderator}}
                                    @else
                                        Not Answered Yet
                                    @endif
                                </td>
                                <td>
                                    @if(isset($query->astrologerQuery->astrologer_answer))
                                        {{$query->astrologerQuery->astrologer_answer}}
                                    @else
                                        Not Answered Yet
                                    @endif
                                </td>
                                <td>
                                    @if(isset($query->astrologerQuery->translated_answer))
                                        {{$query->astrologerQuery->translated_answer}}
                                    @else
                                        Not Answered Yet
                                    @endif
                                </td>
                                @if($query->read == 0)
                                    <td><div class="td-content"><span class="badge outline-badge-primary">New Question for Moderation</span></div></td>
                                @elseif($query->read == 1)
                                    <td><div class="td-content"><span class="badge outline-badge-info">Question Moderated to Astrologer</span></div></td>
                                @elseif($query->read == 4)
                                    <td><div class="td-content"><span class="badge outline-badge-info">Question Moderated to Psychologist</span></div></td>
                                @elseif($query->read == 5)
                                    <td><div class="td-content"><span class="badge outline-badge-secondary">Answer Ready to be Moderated</span></div></td>

                                @elseif($query->read == 2)
                                    <td><div class="td-content"><span class="badge outline-badge-success">Answered Successfully to customer.</span></div></td>

                                @elseif($query->read == 6)
                                    <td><div class="td-content"><span class="badge outline-badge-danger">Postponed</span></div></td>
                                @endif

                                <td><a href="{{URL('moderator/query/'.$query->id)}}">View</a></td>
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
