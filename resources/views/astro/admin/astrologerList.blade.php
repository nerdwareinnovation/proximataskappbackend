@extends('layouts.admin_layouts')
@section('pagespecificstyles')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/dt-global_style.css')}}">
    <link href="{{asset('backend/assets/css/elements/avatar.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/widgets/modules-widgets.css')}}">
        <link href="{{asset('backend/assets/css/components/cards/card.css')}}" rel="stylesheet" type="text/css" />

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
                                    To: <input name="to_date"  value="{{ date('Y-m-d',strtotime($start ?? date('Y-m-d')))}}" class="form-control" type="date">
                                </div>
                                <div class="col-md-4">
                                    <button class="mt-4 btn btn-secondary">Filter</button>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="col-md-12" style="text-align: right">
                        <a href="{{route('admin.addAstrologer')}}" > <button class="btn btn-primary">Add New Astrologer</button></a>

                    </div>
                </div>
                <div class="table-responsive mb-4 mt-4">
                    <table id="zero-config" class="table table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Designation</th>

                            <th>Total Question Answered</th>
                            <th>Status</th>

                            <th class="no-content"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($astrologers as $astrologer)
                            <tr>

                                <td>


                                        @if($astrologer->isOnline())

                                            <div class="avatar avatar-xl avatar-indicators avatar-online">
                                                @if(isset($astrologer->astrologerDetails->image_url))
                                                    <img alt="avatar" src="{{asset($astrologer->astrologerDetails->image_url)}}" class="rounded-circle" />
                                                @else
                                                    <img alt="avatar" src="{{asset('avatar.jpg')}}" class="rounded-circle" />
                                                @endif
                                            </div>
                                        @else
                                            <div class="avatar avatar-xl avatar-indicators avatar-offline">
                                                @if(isset($astrologer->astrologerDetails->image_url))
                                                    <img alt="avatar" src="{{asset($astrologer->astrologerDetails->image_url)}}" class="rounded-circle" />
                                                @else
                                                    <img alt="avatar" src="{{asset('avatar.jpg')}}" class="rounded-circle" />
                                                @endif
                                            </div>
                                        @endif



                                </td>


                                <td><a  onclick="astrologerKPI({{$astrologer->id}})">{{$astrologer->name}}</a></td>
                                <td>{{$astrologer->email}}</td>
                                <td>{{$astrologer->astrologerDetails->designation}}</td>

                                <td>{{$astrologer->astrologerDetails->total_question_answered}}</td>
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ff0004" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg>
                                            <circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                        </a>
                                    @else
                                        <a href="{{URL::to('admin/user/active/'.$astrologer->id)}}" id="enable">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                        </a>
                                    @endif
                                        <a href="{{route('admin.editAstrologer',$astrologer->id)}}" id="edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                        </a>
                                        <a href="{{URL::to('admin/user/delete/'.$astrologer->id)}}" id="delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                        </a>
                                </td>





                            </tr>
                        @endforeach
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Astrologer KPI</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="#e4090d" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                    </button>
                </div>
                <div class="modal-body" id="astroKPIBody">

                </div>
{{--                <div class="modal-footer">--}}
{{--                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>--}}
{{--                    <button type="button" class="btn btn-primary">Save</button>--}}
{{--                </div>--}}
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
    <script>
        function astrologerKPI(id){

            $.ajax({
                url: "/admin/astrologerKPI/"+id,
                type:"GET",
                // data:{
                //     reverted_id: revertedQueryId,
                //     message: message,
                //     chat_id:chat_id,
                //     _token: _token
                // },
                success:function(response){
                    console.log(response);
                    if(response) {
                        $('#astroKPIBody').html(response)
                        $("#exampleModal").modal('show');

                    }

                },
            });
        }

    </script>
@endsection
