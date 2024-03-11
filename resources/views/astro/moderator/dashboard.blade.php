@extends('layouts.admin_layouts')
@section('pagespecificstyles')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/widgets/modules-widgets.css')}}">
@endsection
@section('content')
    @if (session('message')) <div class="alert alert-success mt-4"> {{ session('message') }} </div> @endif
    <div class="row layout-top-spacing">
        <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-table-two">

                <div class="widget-heading">
                    <h5 class="">Latest Questions</h5>

                </div>

                <div class="widget-content">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th><div class="th-content">Customer</div></th>
{{--                                <th><div class="th-content">Question</div></th>--}}
                                <th><div class="th-content">Status</div></th>

                                <th><div class="th-content">Query Time</div></th>
{{--                                <th><div class="th-content">Action</div></th>--}}
                            </tr>
                            </thead>
                            <tbody>

                            @if(count($messages) == 0)
                                <tr>
                                    <td colspan="4" style="text-align: center">No Pending Questions</td>
                                </tr>
                            @else
                            @foreach ($messages  as $message)


                                @if(\App\User::find($message->sender_id)->role_id == 2)

                                    <tr>
                                        <td style="align-content: center"><div class="td-content customer-name ">{{\App\User::find($message->sender_id)->name}} [ID : {{\App\User::find($message->sender_id)->id}}]</div></td>

{{--                                        <td><div class="td-content product-brand">{{$message->message}}</div></td>--}}
                                        @if($message->read == 0)
                                            <td><div class="td-content"><span class="badge outline-badge-primary">New Question for Moderation</span></div></td>
                                        @elseif($message->read == 1)
                                            <td><div class="td-content"><span class="badge outline-badge-info">Question Moderated to Astrologer a.{{\App\User::find($message->astrologerQuery->astrologer_id)->name}}</span></div></td>
                                        @elseif($message->read == 3)
                                            <td><div class="td-content"><span class="badge outline-badge-secondary">Back To Moderator</span></div></td>
                                        @elseif($message->read == 5)
                                            <td><div class="td-content"><span class="badge outline-badge-secondary">Answer Ready to be Moderated m.{{\App\User::find($message->astrologerQuery->moderator_id)->name}}</span></div></td>

                                        @elseif($message->read == 4)
                                            <td><div class="td-content"><span class="badge outline-badge-info">Question Moderated to Psychologist</span></div></td>

                                        @elseif($message->read == 2)
                                            <td><div class="td-content"><span class="badge outline-badge-success">Answered Successfully to customer.</span></div></td>

                                        @elseif($message->read == 6)
                                            <td><div class="td-content"><span class="badge outline-badge-danger">Postponed</span></div></td>
                                        @elseif($message->read == 7)
                                            <td><div class="td-content"><span class="badge outline-badge-danger">Un-Postponed by System</span></div></td>

                                        @endif
                                        <td><div class="td-content">{{$message->created_at->format('d-M y H:i')}}</div></td>
                                    </tr>
                                @endif
                            </tbody>
                            @endforeach
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
                                        <h6>Question Moderated <span class="summary-count">{{$sent_to_astrologer_count}}</span></h6>
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
{{--            <div class="widget-four">--}}
{{--                <div class="widget-heading">--}}
{{--                    <h5 class="">KEY PERFORMANCE INDICATOR [KPI]</h5>--}}
{{--                </div>--}}
{{--                <div class="widget-content">--}}
{{--                    <div class="vistorsBrowser">--}}
{{--                        <div class="browser-list">--}}
{{--                            <div class="w-icon">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chrome"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="21.17" y1="8" x2="12" y2="8"></line><line x1="3.95" y1="6.06" x2="8.54" y2="14"></line><line x1="10.88" y1="21.94" x2="15.46" y2="14"></line></svg>--}}
{{--                            </div>--}}
{{--                            <div class="w-browser-details">--}}
{{--                                <div class="w-browser-info">--}}
{{--                                    <h6>Question Moderated</h6>--}}
{{--                                    <p class="browser-count">{{$unanswered_count}}%</p>--}}
{{--                                </div>--}}
{{--                                <div class="w-browser-stats">--}}
{{--                                    <div class="progress">--}}
{{--                                        <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: {{$unanswered_count}}%" aria-valuenow="{{$unanswered_count}}" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="browser-list">--}}
{{--                            <div class="w-icon">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-compass"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>--}}
{{--                            </div>--}}
{{--                            <div class="w-browser-details">--}}

{{--                                <div class="w-browser-info">--}}
{{--                                    <h6>Question Moderated to Astrologer</h6>--}}
{{--                                    <p class="browser-count">{{$sent_to_astrologer_count}}%</p>--}}
{{--                                </div>--}}

{{--                                <div class="w-browser-stats">--}}
{{--                                    <div class="progress">--}}
{{--                                        <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: {{$sent_to_astrologer_count}}%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}

{{--                        </div>--}}
{{--                        <div class="browser-list">--}}
{{--                            <div class="w-icon">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-compass"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>--}}
{{--                            </div>--}}
{{--                            <div class="w-browser-details">--}}

{{--                                <div class="w-browser-info">--}}
{{--                                    <h6>Question Moderated to Psychologist</h6>--}}
{{--                                    <p class="browser-count">{{$sent_to_psychologist_count}}%</p>--}}
{{--                                </div>--}}

{{--                                <div class="w-browser-stats">--}}
{{--                                    <div class="progress">--}}
{{--                                        <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: {{$sent_to_astrologer_count}}%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}

{{--                        </div>--}}

{{--                        <div class="browser-list">--}}
{{--                            <div class="w-icon">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>--}}
{{--                            </div>--}}
{{--                            <div class="w-browser-details">--}}

{{--                                <div class="w-browser-info">--}}
{{--                                    <h6>Answered Successfully to customer.</h6>--}}
{{--                                    <p class="browser-count">{{$answered_count}}%</p>--}}
{{--                                </div>--}}

{{--                                <div class="w-browser-stats">--}}
{{--                                    <div class="progress">--}}
{{--                                        <div class="progress-bar bg-gradient-success" role="progressbar" style="width: {{$answered_count}}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}

{{--                        </div>--}}


{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>
@endsection
