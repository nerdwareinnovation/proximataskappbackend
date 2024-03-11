@extends('layouts.admin_layouts')
@section('pagespecificstyles')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/widgets/modules-widgets.css')}}">
@endsection
@section('content')

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 row col-12 layout-spacing">
            <div class="offset-4" style="display: none" id="filterForm">
                <form method="POST" id="formFilterSubmit" enctype="multipart/form-data" action="{{route('admin.filterDashboard')}}">@csrf
                    <div class="row">

                        <div class="mt-2 col-md-4">
                            From: <input name="from_date" id="from_date" value="{{ date('Y-m-d',strtotime($start ?? date('Y-m-d')))}}" class="form-control" type="date">
                        </div>
                        <div class="mt-2 col-md-4">
                            To: <input name="to_date" id="to_date"  value="{{ date('Y-m-d',strtotime($end ?? date('Y-m-d'))) }}" class="form-control" type="date">
                        </div>
                        <input type="hidden" id="filterOptionVal" name="filterOption">
                        <div class="col-md-4">
                            <button class="mt-4 btn btn-secondary">Filter</button>
                        </div>

                    </div>
                </form>
            </div>

            <select class="form-control col-md-3 offset-9" name="filterOption" id="filterOption">
                <option value="" >Select</option>
                <option value="today" {{@$filterOption == 'today' ? 'selected' : ''}}>Today</option>
                <option value="thisweek" {{@$filterOption == 'thisweek' ? 'selected' : ''}}>This Week</option>
                <option value="custom" {{@$filterOption == 'custom' ? 'selected' : ''}}>Custom</option>
            </select>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
            <div class="row widget-statistic">


                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <a href="{{route('admin.customers')}}">
                    <div class="widget widget-one_hybrid widget-followers">
                        <div class="widget-heading">
                            <div class="w-title">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>

                                </div>
                                <div class="">
                                    <p class="">Customers</p>
                                    <h5 class="w-value">{{$customers_count}}</h5>

                                </div>
                            </div>
                        </div>

                    </div>
                    </a>

                </div>

            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
            <div class="row widget-statistic">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <a href="{{route('admin.astrologers')}}">
                    <div class="widget widget-one_hybrid widget-followers">
                        <div class="widget-heading">
                            <div class="w-title">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>

                                </div>
                                <div class="">
                                    <p class="">Astrologers</p>

                                    <h5 class="w-value">{{$astrologers_count}}</h5>
                                </div>
                            </div>
                        </div>

                    </div>
                    </a>
                </div>

            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
            <div class="row widget-statistic">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <a href="{{route('admin.moderators')}}">
                    <div class="widget widget-one_hybrid widget-followers">
                        <div class="widget-heading">
                            <div class="w-title">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>

                                </div>
                                <div class="">
                                    <p class="">Moderators</p>
                                    <h5 class="w-value">{{$moderator_count}}</h5>

                                </div>
                            </div>
                        </div>

                    </div>
                    </a>
                </div>

            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
            <div class="row widget-statistic">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <a href="{{route('admin.queries')}}">

                    <div class="widget widget-one_hybrid widget-followers">
                        <div class="widget-heading">
                            <div class="w-title">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>

                                </div>
                                <div class="">
                                    <p class="">Queries Answered</p>
                                    <h5 class="w-value">{{$queries_count}}</h5>


                                </div>
                            </div>
                        </div>

                    </div>
                    </a>
                </div>

            </div>
        </div>





    </div>

    <div class="row layout">
        <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-table-two">

            <div class="widget-heading">
                <h5 class="">Reporting</h5>
            </div>

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><div class="th-content">Customer</div></th>
                            <th><div class="th-content">Moderator</div></th>
{{--                            <th><div class="th-content">Question</div></th>--}}
                            <th><div class="th-content">Status</div></th>
                            <th><div class="th-content">Query Time</div></th>
                            <th><div class="th-content">Action</div></th>

                        </tr>
                        </thead>
                        <tbody>

                        @if(count($messages) != 0)
                        @foreach ($messages  as $message)

                            @if((\App\User::find($message->sender_id)->role_id == 2) AND ($message->receiver_id !=0))

                        <tr>

                            <td><div class="td-content">{{\App\User::find($message->sender_id)->name}} </div> | <b>ID: {{$message->sender_id}}</b> </td>
                            <td><div class="td-content customer-name">{{@\App\User::find($message->receiver_id)->name}}</div></td>
{{--                            <td><div class="td-content product-brand">{{$message->message}}</div></td>--}}
                            @if($message->read == 0)
                                <td><div class="td-content"><span class="badge outline-badge-primary">New Question for Moderation</span></div></td>
                            @elseif($message->read == 1)
                                <td><div class="td-content"><span class="badge outline-badge-info">Question Moderated to Astrologer a.{{\App\User::find($message->astrologerQuery->astrologer_id)->name}}</span></div></td>
                            @elseif($message->read == 3)
                                <td><div class="td-content"><span class="badge outline-badge-info">Reverted Back by Astrologer a.{{\App\User::find($message->astrologerQuery->astrologer_id)->name}}</span></div></td>

                            @elseif($message->read == 2)
                                <td><div class="td-content"><span class="badge outline-badge-success">Answered by m.{{\App\User::find($message->astrologerQuery->moderator_id)->name}} | a.{{\App\User::find($message->astrologerQuery->astrologer_id)->name}}</span></div></td>
                            @elseif($message->read == 5)
                                <td><div class="td-content"><span class="badge outline-badge-secondary">Answer Ready to be Moderated m.{{\App\User::find($message->astrologerQuery->moderator_id)->name}}</span></div></td>
                            @elseif($message->read == 8)
                                <td><div class="td-content"><span class="badge outline-badge-danger">Clarified</span></div></td>
                            @elseif($message->read == 11)
                                <td><div class="td-content"><span class="badge outline-badge-success">Answered as Pyschologist by m.{{\App\User::find($message->astrologerQuery->moderator_id)->name}}</span></div></td>

                            @elseif($message->read == 6)
                                <td><div class="td-content"><span class="badge outline-badge-danger">Postponed</span></div></td>

                            @endif
                            <td><div class="td-content">{{$message->created_at->format('d-M y H:i')}}</div></td>

                            <td><div class="td-content"><a href="{{URL('admin/customer/'.$message->id)}}">View</a></div></td>

                        </tr>
                            @endif
                        </tbody>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="4" style="text-align: center">No Pending Questions</td>
                            </tr>
                        @endif


                    </table>
                </div>
            </div>
        </div>
    </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
            <div class="widget widget-four">
                <div class="widget-heading">
                    <h5 class="">KEY PERFORMANCE INDICATOR [KPI]</h5>



                </div>
                <div class="widget-content">

                    <div class="order-summary">

                        <div class="summary-list summary-income">

                            <div class="summery-info">

                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                                </div>

                                <div class="w-summary-details">

                                    <div class="w-summary-info">
                                        <h6>Questions Answered and Moderated by Moderator <span class="summary-count">{{$answered_moderator}}</span></h6>
                                        {{--                                        <p class="summary-average">90%</p>--}}
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="summary-list summary-profit">

                            <div class="summery-info">

                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line></svg>
                                </div>
                                <div class="w-summary-details">

                                    <div class="w-summary-info">
                                        <h6>Question Successfully Answered <span class="summary-count">{{$answered_count}}</span></h6>

                                    </div>

                                </div>

                            </div>

                        </div>



                    </div>

                </div>
            </div>
        </div>
{{--        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">--}}
{{--        <div class="widget-four">--}}
{{--            <div class="widget-heading">--}}
{{--                <h5 class="">Questions By Status</h5>--}}
{{--            </div>--}}
{{--            <div class="widget-content">--}}
{{--                <div class="vistorsBrowser">--}}
{{--                    <div class="browser-list">--}}
{{--                        <div class="w-icon">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chrome"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="21.17" y1="8" x2="12" y2="8"></line><line x1="3.95" y1="6.06" x2="8.54" y2="14"></line><line x1="10.88" y1="21.94" x2="15.46" y2="14"></line></svg>--}}
{{--                        </div>--}}
{{--                        <div class="w-browser-details">--}}
{{--                            <div class="w-browser-info">--}}
{{--                                <h6>Unanswered</h6>--}}
{{--                                <p class="browser-count">{{$unanswered_count}}%</p>--}}
{{--                            </div>--}}
{{--                            <div class="w-browser-stats">--}}
{{--                                <div class="progress">--}}
{{--                                    <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: {{$unanswered_count}}%" aria-valuenow="{{$unanswered_count}}" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="browser-list">--}}
{{--                        <div class="w-icon">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-compass"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>--}}
{{--                        </div>--}}
{{--                        <div class="w-browser-details">--}}

{{--                            <div class="w-browser-info">--}}
{{--                                <h6>Sent To Astrologer</h6>--}}
{{--                                <p class="browser-count">{{$sent_to_astrologer_count}}%</p>--}}
{{--                            </div>--}}

{{--                            <div class="w-browser-stats">--}}
{{--                                <div class="progress">--}}
{{--                                    <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: {{$sent_to_astrologer_count}}%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </div>--}}
{{--                    <div class="browser-list">--}}
{{--                        <div class="w-icon">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-compass"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>--}}
{{--                        </div>--}}
{{--                        <div class="w-browser-details">--}}

{{--                            <div class="w-browser-info">--}}
{{--                                <h6>Sent To Psychologist</h6>--}}
{{--                                <p class="browser-count">{{$sent_to_psychologist_count}}%</p>--}}
{{--                            </div>--}}

{{--                            <div class="w-browser-stats">--}}
{{--                                <div class="progress">--}}
{{--                                    <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: {{$sent_to_astrologer_count}}%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </div>--}}

{{--                    <div class="browser-list">--}}
{{--                        <div class="w-icon">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>--}}
{{--                        </div>--}}
{{--                        <div class="w-browser-details">--}}

{{--                            <div class="w-browser-info">--}}
{{--                                <h6>Answered</h6>--}}
{{--                                <p class="browser-count">{{$answered_count}}%</p>--}}
{{--                            </div>--}}

{{--                            <div class="w-browser-stats">--}}
{{--                                <div class="progress">--}}
{{--                                    <div class="progress-bar bg-gradient-success" role="progressbar" style="width: {{$answered_count}}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </div>--}}
{{--                    <div class="browser-list">--}}
{{--                        <div class="w-icon">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>--}}
{{--                        </div>--}}
{{--                        <div class="w-browser-details">--}}

{{--                            <div class="w-browser-info">--}}
{{--                                <h6>Postponed</h6>--}}
{{--                                <p class="browser-count">{{$postponed_count}}%</p>--}}
{{--                            </div>--}}

{{--                            <div class="w-browser-stats">--}}
{{--                                <div class="progress">--}}
{{--                                    <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: {{$postponed_count}}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    </div>


@endsection

@section('pagespecificscripts')
    <script src="{{'backend/assets/js/widgets/modules-widgets.js'}}"></script>
    <script>
        $('#filterOption').change(function (){
            $('#filterOptionVal').val = $('#filterOption').val();
            console.log($('#filterOptionVal').val())
            // if($('#filterOption').val() == 'today'){
            //     $('#from_date').val = new Date().toISOString().split('T')[0];
            //     $('#to_date').val = new Date().toISOString().split('T')[0];
            //     $('#formFilterSubmit').submit();
            //
            // }
            // else if($('#filterOption').val() == 'thisweek'){
            //     const today = new Date();
            //     var first = new Date(today.setDate(today.getDate() - today.getDay())); // First day is the day of the month - the day of the week
            //     var last = new Date(today.setDate(today.getDate() - today.getDay() + 6));
            //     $('#from_date').val = first.toISOString().split('T')[0];
            //     $('#to_date').val = last.toISOString().split('T')[0];
            //     // $('#formFilterSubmit').submit();
            // }
            // else{
            //     $('#filterForm').show();
            // }
            console.log($('#filterOption').val())
        });
    </script>
@endsection
