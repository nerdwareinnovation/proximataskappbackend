@extends('layouts.admin_layouts')

@section('pagespecificstyles')
    <link href="{{asset('backend/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/components/tabs-accordian/custom-accordions.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/forms/theme-checkbox-radio.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/forms/switches.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/datatables.css')}}">
    <link href="{{asset('backend/assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/custom_dt_multiple_tables.css')}}">

@endsection

@section('content')
    <div class="row layout-top-spacing">
    <div class="col-lg-8 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div id="accordionBasic" class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Sample Question [Customer] </h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div id="toggleAccordion">
                    @foreach($questions as $ques)
                    <div class="card">
                        <div class="card-header" id="headingOne1">
                            <section class="mb-0 mt-0">
                                <div role="menu" class="collapsed" data-toggle="collapse" data-target="#ques-{{$ques->id}}" aria-expanded="true" aria-controls="{{$ques->id}}">
                                    {{$ques->category_name}}  <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                </div>
                            </section>
                        </div>

                        <div id="ques-{{$ques->id}}" class="collapse" aria-labelledby="headingOne1" data-parent="#toggleAccordion">
                            <div class="card-body">
                                <div class="table-responsive mb-4 mt-4">
                                    <table class=" table table-hover" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Order</th>

                                            <th class="no-content"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($ques->questions as $q)
                                            @if(count($ques->questions) == 0)
                                                <tr>
                                                    <td>No Sample Questions Found</td>
                                                </tr>
                                            @else
                                        <tr>
                                            <td >{{$q->question}}</td>
                                            <td>{{$q->order_ques}}
                                                </td>

                                            <td width="30%">
                                                <a data-toggle="modal" data-target="#myEditModal{{ $q->id }}" class=" text-info ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 9.5H3M21 4.5H3M21 14.5H3M21 19.5H3"/></svg>

                                                </a>
                                                <a href="{{URL::to('admin/question/customer/edit/'.$q->id)}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                                </a>
                                                <a href="{{URL::to('admin/question/customer/delete/'.$q->id)}}" id="deleteQuestion">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                                </a>
                                            </td>


                                            <div  id="myEditModal{{ $q->id }}" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Question Order</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row" class="overflow-auto">
                                                            <div class="col-md-12">
                                                                <form action="{{route('admin.updateCustomerSample')}}" method="POST" enctype="multipart/form-data">@csrf
                                                                    <div class="form-row mb-12">
                                                                        <div class="form-group col-md-12">
                                                                            <label>Order</label>
                                                                            <input type="text" class="form-control" name="order_by" value="{{$q->order_by}}" placeholder="Order">
                                                                            <input type="hidden" class="form-control" name="sample_id" value="{{$q->id}}" >

                                                                        </div>

                                                                    </div>

                                                                    <button type="submit" class="btn btn-primary mt-3 offset-3">Update</button>
                                                                </form>
                                                            </div>
                                                        </div>

                                                </div>
                                            </div>
                                                </div>
                                            </div>
                                        </tr>
                                        @endif
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Question</th>
                                            <th>Is Published</th>

                                            <th class="no-content"></th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>


            </div>
        </div>
    </div>
    <div class="col-lg-4 col-4 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@if(isset($ques_edit))Edit @else Add New @endif Sample Question</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                @if(isset($ques_edit))
                    <form action="{{route('admin.updateCQuestionSample',$ques_edit->id)}}" method="POST" enctype="multipart/form-data">@csrf

                    @else
                    <form action="{{route('admin.storeCQuestionSample')}}" method="POST" enctype="multipart/form-data">@csrf

                    @endif
                    <div class="form-group mb-4">
                        <label for="exampleFormControlInput2">Question</label>
                        <input type="text" class="form-control" name="question" value="{{@$ques_edit->question}}" id="exampleFormControlInput2" placeholder="Enter Question..">
                    </div>
                    <div class="form-group mb-4">
                        <label >Category</label>
                            @foreach($questions as $question)

                                <div class="n-chk">
                                    <label class="new-control new-radio radio-classic-primary">
                                        <input type="radio" class="new-control-input" name="category_id" @if(@$ques_edit->category_id == $question->id) checked @endif value="{{$question->id}}">
                                        <span class="new-control-indicator"></span>{{$question->category_name}}
                                </div>

                            @endforeach
                        </label>
                    </div>
                    <div class="form-group mb-4">
                        <label>Order</label>
                        <input type="text" value="{{@$ques_edit->order_ques}}" class="form-control" name="order_by" placeholder="Order">
                    </div>
                   
                    <div class="form-group mb-4" style="text-align: center">
                        <input type="submit" class="btn btn-primary">
                    </div>

                </form>
            </div>
        </div>
    </div>


    </div>
@endsection
@section('pagespecificscripts')
    <script src="{{asset('backend/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('backend/assets/js/components/ui-accordions.js')}}"></script>
    <script src="{{asset('backend/plugins/table/datatable/datatables.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('table.multi-table').DataTable({
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
                "pageLength": 7,
                drawCallback: function () {
                    $('.t-dot').tooltip({ template: '<div class="tooltip status" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' })
                    $('.dataTables_wrapper table').removeClass('table-striped');
                }
            });
        } );
    </script>
@endsection
