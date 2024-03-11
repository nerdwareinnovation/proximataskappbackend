@extends('layouts.admin_layouts')
@section('pagespecificstyles')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/widgets/modules-widgets.css')}}">
    <link href="{{asset('backend/assets/css/components/cards/card.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
    @if (session('message')) <div class="alert alert-success mt-4"> {{ session('message') }} </div> @endif
    <div class="row layout-top-spacing">
    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-table-two">

            <div class="widget-heading">
                <h5 class="">Recent Questions</h5>
            </div>

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><div class="th-content">ID</div></th>
                            <th><div class="th-content">Customer</div></th>
                            <th><div class="th-content">Status</div></th>
                            <th><div class="th-content">Query Time</div></th>

{{--                            <th><div class="th-content">Action</div></th>--}}
                        </tr>
                        </thead>
                        <tbody>

                        @if(count($messages) == 0)
                            <tr>
                                <td colspan="4" style="text-align: center">No Pending Questions</td>
                            </tr>
                        @else
                        @foreach ($messages  as $message)

                            @if(\App\User::find($message->chat->sender_id)->role_id == 2)
                                <tr>
                                    <td><div class="td-content product-brand">{{\App\User::find($message->chat->sender_id)->id}}</div></td>

                                    <td><div class="td-content customer-name">{{\App\User::find($message->chat->sender_id)->name}}</div></td>

                                    @if($message->chat->read == 0)
                                        <td><div class="td-content"><span class="badge outline-badge-primary">New Question for Moderation</span></div></td>
                                    @elseif($message->chat->read == 1)
                                        <td><div class="td-content"><span class="badge outline-badge-info">Question Moderated to Astrologer a.{{\App\User::find($message->astrologer_id)->name}}</span></div></td>
                                    @elseif($message->chat->read == 5)
                                        <td><div class="td-content"><span class="badge outline-badge-secondary">Answer Ready to be Moderated m.{{\App\User::find($message->moderator_id)->name}}</span></div></td>

                                    @elseif($message->chat->read == 4)
                                        <td><div class="td-content"><span class="badge outline-badge-info">Question Moderated to Psychologist</span></div></td>

                                    @elseif($message->chat->read == 2)
                                        <td><div class="td-content"><span class="badge outline-badge-success">Answered Successfully to customer.</span></div></td>

                                    @elseif($message->chat->read == 6)
                                        <td><div class="td-content"><span class="badge outline-badge-danger">Postponed</span></div></td>

                                    @endif
                                    <td><div class="td-content">{{$message->chat->created_at->format('d-M y H:i')}}</div></td>
{{--                                    <td><div class="td-content"><a href="{{URL('astrologer/query/'.$message->id)}}">View</a></div></td>--}}
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
        <div class="widget-content widget-content-area">

            <div class="card component-card_7">
                <div class="card-body">
                    <h5 class="card-text">Rating</h5>
                    <h6 class="rating-count">{{$avg_rating}}</h6>
                    <div class="rating-stars">
                        @for($i=0;$i<$avg_rating;$i++)
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star fill"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        @endfor
                        @for($j=0;$j<5-$avg_rating;$j++)

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                            @endfor
                        <span class="r-rating-num">({{$total_raters_count}})</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
