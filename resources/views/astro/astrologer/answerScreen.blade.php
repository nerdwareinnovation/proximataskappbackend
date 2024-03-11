@extends('layouts.screen_layouts')
@section('pagespecificstyles')
    <link href="{{asset('backend/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/components/cards/card.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/plugins/lightbox/photoswipe.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/plugins/lightbox/default-skin/default-skin.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/plugins/lightbox/custom-photswipe.css')}}" rel="stylesheet" type="text/css" />
    <style>

        .foldtl {
            position: relative;
            -webkit-box-shadow: 5px 5px 5px rgba(0,0,0,0.2);
            -moz-box-shadow: 5px 5px 5px rgba(0,0,0,0.2);
            box-shadow: 5px 5px 5px rgba(0,0,0,0.2);
            display: none; height: 70vh;background-color: #feff9c;
        }

        .foldtl:before {
            content: "";
            position: absolute;
            top: 0%;
            left: 0%;
            width: 0px;
            height: 0px;
            border-bottom: 70px solid #eee;
            border-left: 70px solid transparent;
            -webkit-box-shadow: 7px 7px 7px rgba(0,0,0,0);
            -moz-box-shadow: 7px 7px 7px rgba(0,0,0,0);
            box-shadow: 7px 7px 7px rgba(0,0,0,0);
        }
        .foldtl:after {
            content: "";
            position: absolute;
            top: 0%;
            left: 0%;
            width: 0px;
            height: 0px;
            border-top: 69px solid #eee;
            border-right: 69px solid transparent;
        }
    </style>
    <style>

        .labl > input{ /* HIDE RADIO */
            visibility: hidden; /* Makes input not-clickable */
            position: absolute; /* Remove input from document flow */
        }
        .labl > input + div{ /* DIV STYLES */
            cursor:pointer;
            border:2px solid transparent;
        }
        .labl > input:checked + div{ /* (RADIO CHECKED) DIV STYLES */
            background-color: #000809;
            border: 1px solid #ff6600;
        }

        #the-count {
            float: right;
            padding: 0.1rem 0 0 0;
            font-size: 0.875rem;
        }
        p{
            margin-bottom: 0.2rem;

        }
        .mydivScroll {
            height:300px;
            overflow-y: scroll;
        }

    </style>
@endsection

@section('content')
    <div class="row ">
        <div class="col-md-4" style="display: none;height: 80vh;overflow: scroll;" id="notes">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing" style="height: 80vh">
                <div class="widget-content">

                    <button class="btn btn-primary" style="margin-left: 70%;margin-top: 20px;" id="addNewNote">Add New Note</button>
                    @foreach($customer_notes as $notes)
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-2 layout-spacing">
                            <div class="widget widget-card-one" style="background-color: #fdfdd5;">
                                <div class="widget-content">

                                    <div class="media">

                                        <div class="media-body">
                                            <h6>
                                                {{\App\User::find($notes->user_id)->name}}
                                                <a onclick="editNote({{$notes->id}},'{{$notes->note}}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                                </a>
                                                <a id="delete" href="{{route('astrologer.deleteNote',$notes->id)}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                </a>
                                            </h6>
                                            <p>{{$notes->created_at->format('d-M y H:i')}}</p>
                                        </div>
                                    </div>
                                    <p>{{$notes->note}}</p>

                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>


        </div>
    <div class="col-md-4" id="messages"  style="height: 90vh;overflow: scroll;background-color: #c0c0c0;">
        @foreach($cus_messages as $customer_history)
            @if($customer_history->id == $messages->chat->id)

                <input type="hidden" name="astro_query_id" value="{{$customer_history->astrologerQuery->id}}">
                 <input type="hidden" name="chat_id" value="{{$messages->chat->id}}">
                <input type="hidden" name="moderator_id" value="{{$messages->moderator_id}}">

            @endif
                @if($customer_history->receiver_id == 0)
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-1 layout-spacing">
                        <div class="widget widget-card-one" style="background-color: #fdd5d5;@if($customer_history->id == $messages->chat->id)border-color: #e6ab05;
                                box-shadow: 0 10px 20px -10px #e6ab05; @endif">
                            <div class="widget-content">
                                <a onclick='pinmessage("{{$customer_history->id}}",{{$customer_history->sender_id}},"system")' style="float: right">
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 122.879 122.867" enable-background="new 0 0 122.879 122.867" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" d="M83.88,0.451L122.427,39c0.603,0.601,0.603,1.585,0,2.188l-13.128,13.125 c-0.602,0.604-1.586,0.604-2.187,0l-3.732-3.73l-17.303,17.3c3.882,14.621,0.095,30.857-11.37,42.32 c-0.266,0.268-0.535,0.529-0.808,0.787c-1.004,0.955-0.843,0.949-1.813-0.021L47.597,86.48L0,122.867l36.399-47.584L11.874,50.76 c-0.978-0.98-0.896-0.826,0.066-1.837c0.24-0.251,0.485-0.503,0.734-0.753C24.137,36.707,40.376,32.917,54.996,36.8l17.301-17.3 l-3.733-3.732c-0.601-0.601-0.601-1.585,0-2.188L81.691,0.451C82.295-0.15,83.279-0.15,83.88,0.451L83.88,0.451z"/></g></svg>
                                </a>
                                <p style="text-align: center;">{!! $customer_history->message !!}</p>
                            </div>
                        </div>

                    </div>

                @elseif( $customer_history->sender_id == 1)
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-1 layout-spacing">
                        <div class="widget widget-card-one" style="background-color: #ffffff;">
                            <div class="widget-content">
                                <a onclick='pinmessage("{{$customer_history->id}}",{{$customer_history->sender_id}},"system")' style="float: right">
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 122.879 122.867" enable-background="new 0 0 122.879 122.867" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" d="M83.88,0.451L122.427,39c0.603,0.601,0.603,1.585,0,2.188l-13.128,13.125 c-0.602,0.604-1.586,0.604-2.187,0l-3.732-3.73l-17.303,17.3c3.882,14.621,0.095,30.857-11.37,42.32 c-0.266,0.268-0.535,0.529-0.808,0.787c-1.004,0.955-0.843,0.949-1.813-0.021L47.597,86.48L0,122.867l36.399-47.584L11.874,50.76 c-0.978-0.98-0.896-0.826,0.066-1.837c0.24-0.251,0.485-0.503,0.734-0.753C24.137,36.707,40.376,32.917,54.996,36.8l17.301-17.3 l-3.733-3.732c-0.601-0.601-0.601-1.585,0-2.188L81.691,0.451C82.295-0.15,83.279-0.15,83.88,0.451L83.88,0.451z"/></g></svg>
                                </a>
                                <p style="text-align: center;">{!! $customer_history->message !!}</p>
                                @if($customer_history->read_by_customer == 1)
                                    <p style="float: right;opacity: 0.7">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" style="opacity: 0.7" height="20" viewBox="0 0 127.818 63.298" >
                                            <g id="Group_27723" data-name="Group 27723" transform="translate(0)">
                                                <rect id="Rectangle_215" data-name="Rectangle 215" width="74.358" height="15.159" transform="translate(64.52 52.579) rotate(-45)"/>
                                                <path id="Path_2932" data-name="Path 2932" d="M798.975,442.981l-10.719-10.719-41.963,41.963L725.363,453.3l-10.719,10.719,31.548,31.545.1-.1.1.1Z" transform="translate(-714.644 -432.262)"/>
                                            </g>
                                        </svg>
                                        Read at:{{$customer_history->read_at}}
                                    </p>
                                @endif
                            </div>
                        </div>

                    </div>
                @elseif($customer_history->sender_id == $messages->chat->sender_id)
                {{-- Customer History --}}
                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 layout-spacing">

                    <div class="widget widget-card-one" style="background-color: #d5e6fd;@if($customer_history->id == $messages->chat->id) border-color: #e6ab05;
                            box-shadow: 0 10px 20px -10px #e6ab05; @endif">
                        <div class="widget-content">

                            <div class="media">

                                <div class="media-body">
                                    <h6>c. {{\App\User::find($customer_history->sender_id)->name}}
                                        <a onclick="pinmessage( '{{$customer_history->message}}', {{$customer_history->sender_id}},'customer')">
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 122.879 122.867" enable-background="new 0 0 122.879 122.867" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" d="M83.88,0.451L122.427,39c0.603,0.601,0.603,1.585,0,2.188l-13.128,13.125 c-0.602,0.604-1.586,0.604-2.187,0l-3.732-3.73l-17.303,17.3c3.882,14.621,0.095,30.857-11.37,42.32 c-0.266,0.268-0.535,0.529-0.808,0.787c-1.004,0.955-0.843,0.949-1.813-0.021L47.597,86.48L0,122.867l36.399-47.584L11.874,50.76 c-0.978-0.98-0.896-0.826,0.066-1.837c0.24-0.251,0.485-0.503,0.734-0.753C24.137,36.707,40.376,32.917,54.996,36.8l17.301-17.3 l-3.733-3.732c-0.601-0.601-0.601-1.585,0-2.188L81.691,0.451C82.295-0.15,83.279-0.15,83.88,0.451L83.88,0.451z"/></g></svg>
                                        </a>

                                    </h6>
                                    <p>{{$customer_history->created_at->format('d-M y H:i')}}</p>
                                </div>
                            </div>
                            <p>{{$customer_history->message}}</p>

                            {{--                            <input type="hidden" name="chat_id" value="{{$messages->id}}">--}}
                            {{--                            <input type="hidden" name="moderator_id" value="{{$messages->receiver_id}}">--}}

                        </div>
                    </div>

                </div>
                @endif
            @if(isset($customer_history->astrologerQuery ))
                @if(isset($customer_history->astrologerQuery->astrologer_id))
                {{-- Translated by Moderator History --}}
                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-1 layout-spacing">
                    <div class="widget widget-card-one"  style="background-color: #ddddf3;@if($customer_history->id == $messages->chat->id) border-color: #e6ab05;
                            box-shadow: 0 10px 20px -10px #e6ab05;  @endif">
                        <div class="widget-content">

                            <div class="media">

                                <div class="media-body">
                                    <h6>m. {{\App\User::find($customer_history->astrologerQuery->moderator_id)->name}}
                                        <a onclick="pinmessage('{{$customer_history->astrologerQuery->transalated_by_moderator}}',{{$customer_history->astrologerQuery->moderator_id}},'modtoastro' )">
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 122.879 122.867" enable-background="new 0 0 122.879 122.867" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" d="M83.88,0.451L122.427,39c0.603,0.601,0.603,1.585,0,2.188l-13.128,13.125 c-0.602,0.604-1.586,0.604-2.187,0l-3.732-3.73l-17.303,17.3c3.882,14.621,0.095,30.857-11.37,42.32 c-0.266,0.268-0.535,0.529-0.808,0.787c-1.004,0.955-0.843,0.949-1.813-0.021L47.597,86.48L0,122.867l36.399-47.584L11.874,50.76 c-0.978-0.98-0.896-0.826,0.066-1.837c0.24-0.251,0.485-0.503,0.734-0.753C24.137,36.707,40.376,32.917,54.996,36.8l17.301-17.3 l-3.733-3.732c-0.601-0.601-0.601-1.585,0-2.188L81.691,0.451C82.295-0.15,83.279-0.15,83.88,0.451L83.88,0.451z"/></g></svg>
                                        </a>
                                    </h6>
                                    <p class="meta-date-time">{{$customer_history->astrologerQuery->created_at->format('d-M y H:i')}}</p>

                                </div>
                            </div>

                            <p>

                                {{$customer_history->astrologerQuery->transalated_by_moderator}}




                            </p>
                            @if(isset($customer_history->astrologerQuery->reply))
                                @if($customer_history->astrologerQuery->reply->read_by_customer == 1)
                                    <p style="float: right;opacity: 0.7">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" style="opacity: 0.7" height="20" viewBox="0 0 127.818 63.298" >
                                            <g id="Group_27723" data-name="Group 27723" transform="translate(0)">
                                                <rect id="Rectangle_215" data-name="Rectangle 215" width="74.358" height="15.159" transform="translate(64.52 52.579) rotate(-45)"/>
                                                <path id="Path_2932" data-name="Path 2932" d="M798.975,442.981l-10.719-10.719-41.963,41.963L725.363,453.3l-10.719,10.719,31.548,31.545.1-.1.1.1Z" transform="translate(-714.644 -432.262)"/>
                                            </g>
                                        </svg>
                                        Read at:{{$customer_history->astrologerQuery->reply->read_at}}
                                    </p>
                                @endif
                            @endif



                        </div>
                    </div>

                </div>
                        @if(isset($customer_history->astrologerQuery->revertedQuery))
                            @foreach($customer_history->astrologerQuery->revertedQuery as $reverted)

                                @if(isset($reverted->astrologer_answer))
                                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-1 layout-spacing">
                                        <div class="widget widget-card-one" style="background-color: #eff8f7; @if($customer_history->id == $messages->chat->id) border-color: #e6ab05;
                                                box-shadow: 0 10px 20px -10px #e6ab05;  @endif">
                                            <div class="widget-content">

                                                <div class="media">

                                                    <div class="media-body">

                                                        <h6>a. {{\App\User::find($reverted->astrologer_id)->name}}
                                                            <a onclick="pinmessage('{{$reverted->astrologer_answer}}',{{$reverted->astrologer_id}},'astroans')">
                                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 122.879 122.867" enable-background="new 0 0 122.879 122.867" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" d="M83.88,0.451L122.427,39c0.603,0.601,0.603,1.585,0,2.188l-13.128,13.125 c-0.602,0.604-1.586,0.604-2.187,0l-3.732-3.73l-17.303,17.3c3.882,14.621,0.095,30.857-11.37,42.32 c-0.266,0.268-0.535,0.529-0.808,0.787c-1.004,0.955-0.843,0.949-1.813-0.021L47.597,86.48L0,122.867l36.399-47.584L11.874,50.76 c-0.978-0.98-0.896-0.826,0.066-1.837c0.24-0.251,0.485-0.503,0.734-0.753C24.137,36.707,40.376,32.917,54.996,36.8l17.301-17.3 l-3.733-3.732c-0.601-0.601-0.601-1.585,0-2.188L81.691,0.451C82.295-0.15,83.279-0.15,83.88,0.451L83.88,0.451z"/></g></svg>
                                                            </a>
                                                        </h6>
                                                        <p>{{$reverted->created_at->format('d-M y H:i')}}</p>

                                                    </div>
                                                </div>
                                                <p>{{$reverted->astrologer_answer}}</p>

                                                {{--                            <input type="hidden" name="chat_id" value="{{$messages->id}}">--}}
                                                {{--                            <input type="hidden" name="moderator_id" value="{{$messages->receiver_id}}">--}}

                                            </div>
                                        </div>

                                    </div>
                                @endif
                                @if(isset($reverted->moderator_reply))
                                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-1 layout-spacing">
                                        <div class="widget widget-card-one" style="background-color: #ddddf3; @if($customer_history->id == $messages->chat->id) border-color: #e6ab05;
                                                box-shadow: 0 10px 20px -10px #e6ab05;  @endif">
                                            <div class="widget-content">

                                                <div class="media">

                                                    <div class="media-body">

                                                        <h6>m. {{\App\User::find($reverted->moderator_id)->name}}</h6>
                                                        <p>{{$reverted->updated_at->format('d-M y H:i')}}</p>

                                                    </div>
                                                </div>
                                                <p>{{$reverted->moderator_reply}}</p>

                                                {{--                            <input type="hidden" name="chat_id" value="{{$messages->id}}">--}}
                                                {{--                            <input type="hidden" name="moderator_id" value="{{$messages->receiver_id}}">--}}

                                            </div>
                                        </div>

                                    </div>
                                @endif

                            @endforeach
                        @endif
                    @else
                        @if($customer_history->read == 8)
                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-3 layout-spacing">
                                <div class="widget widget-card-one"  style="background-color: #eff8f7;@if($customer_history->id == $messages->id) border-color: #e6ab05;
                                        box-shadow: 0 10px 20px -10px #e6ab05; ; @endif">
                                    <div class="widget-content">

                                        <div class="media">

                                            <div class="media-body">
                                                @if(isset($customer_history->astrologerQuery->customer_rating))
                                                    <p style="text-align: center;">
                                                        @for($i=0; $i<$customer_history->astrologerQuery->customer_rating->rating; $i++)<img src="{{asset('star.png')}}" style="width: 25px; height: 25px;">
                                                        @endfor
                                                    </p>
                                                @else
                                                    {{$customer_history->astrologerQuery->customer_rating}}
                                                    <p style="margin-bottom: 10px;text-align: center;font-size: 0.7em;">Not Rated</p>
                                                @endif
                                                <h6>m. {{\App\User::find($customer_history->astrologerQuery->moderator_id)->name}} Clarified
                                                    <a onclick="pinmessage('{{$customer_history->astrologerQuery->transalated_by_moderator}}',{{$customer_history->astrologerQuery->moderator_id}},'modclarified' )">
                                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 122.879 122.867" enable-background="new 0 0 122.879 122.867" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" d="M83.88,0.451L122.427,39c0.603,0.601,0.603,1.585,0,2.188l-13.128,13.125 c-0.602,0.604-1.586,0.604-2.187,0l-3.732-3.73l-17.303,17.3c3.882,14.621,0.095,30.857-11.37,42.32 c-0.266,0.268-0.535,0.529-0.808,0.787c-1.004,0.955-0.843,0.949-1.813-0.021L47.597,86.48L0,122.867l36.399-47.584L11.874,50.76 c-0.978-0.98-0.896-0.826,0.066-1.837c0.24-0.251,0.485-0.503,0.734-0.753C24.137,36.707,40.376,32.917,54.996,36.8l17.301-17.3 l-3.733-3.732c-0.601-0.601-0.601-1.585,0-2.188L81.691,0.451C82.295-0.15,83.279-0.15,83.88,0.451L83.88,0.451z"/></g></svg>
                                                    </a>
                                                </h6>
                                                <p class="meta-date-time">{{$customer_history->astrologerQuery->created_at->format('d-M y H:i')}}</p>

                                            </div>
                                        </div>

                                        <p>

                                            {{$customer_history->astrologerQuery->transalated_by_moderator}}
                                            {{--                                    <input type="hidden" name="astro_query_id" value="{{$messages->astrologerQuery->id}}">--}}




                                        </p>
                                        @if(isset($customer_history->astrologerQuery->reply))
                                            @if($customer_history->astrologerQuery->reply->read_by_customer == 1)
                                                <p style="float: right;opacity: 0.7">

                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" style="opacity: 0.7" height="20" viewBox="0 0 127.818 63.298" >
                                                        <g id="Group_27723" data-name="Group 27723" transform="translate(0)">
                                                            <rect id="Rectangle_215" data-name="Rectangle 215" width="74.358" height="15.159" transform="translate(64.52 52.579) rotate(-45)"/>
                                                            <path id="Path_2932" data-name="Path 2932" d="M798.975,442.981l-10.719-10.719-41.963,41.963L725.363,453.3l-10.719,10.719,31.548,31.545.1-.1.1.1Z" transform="translate(-714.644 -432.262)"/>
                                                        </g>
                                                    </svg>
                                                    Read at:{{$customer_history->astrologerQuery->reply->read_at}}
                                                </p>
                                            @endif
                                        @endif


                                    @if(isset($customer_history->astrologerQuery->reply))
                                            @if($customer_history->astrologerQuery->reply->read_by_customer == 1)
                                                <p style="float: right;opacity: 0.7">

                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" style="opacity: 0.7" height="20" viewBox="0 0 127.818 63.298" >
                                                        <g id="Group_27723" data-name="Group 27723" transform="translate(0)">
                                                            <rect id="Rectangle_215" data-name="Rectangle 215" width="74.358" height="15.159" transform="translate(64.52 52.579) rotate(-45)"/>
                                                            <path id="Path_2932" data-name="Path 2932" d="M798.975,442.981l-10.719-10.719-41.963,41.963L725.363,453.3l-10.719,10.719,31.548,31.545.1-.1.1.1Z" transform="translate(-714.644 -432.262)"/>
                                                        </g>
                                                    </svg>
                                                    Read at:{{$customer_history->astrologerQuery->reply->read_at}}
                                                </p>
                                            @endif
                                        @endif

                                    </div>
                                </div>

                            </div>
                        @else
                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-3 layout-spacing">
                            <div class="widget widget-card-one"  style="background-color: #eff8f7;@if($customer_history->id == $messages->id) border-color: #e6ab05;
                                    box-shadow: 0 10px 20px -10px #e6ab05; @endif">
                                <div class="widget-content">

                                    <div class="media">

                                        <div class="media-body">
                                            @if(isset($customer_history->astrologerQuery->customer_rating))
                                                <p style="text-align: center;">
                                                    @for($i=0; $i<$customer_history->astrologerQuery->customer_rating->rating; $i++)<img src="{{asset('star.png')}}" style="width: 25px; height: 25px;">
                                                    @endfor
                                                </p>
                                            @else
                                                {{$customer_history->astrologerQuery->customer_rating}}
                                                <p style="margin-bottom: 10px;text-align: center;font-size: 0.7em;">Not Rated</p>
                                            @endif
                                            <h6>m. {{\App\User::find($customer_history->astrologerQuery->moderator_id)->name}} Clarified
                                                <a onclick="pinmessage('aspsychologist', {{$customer_history->id}})">
                                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 122.879 122.867" enable-background="new 0 0 122.879 122.867" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" d="M83.88,0.451L122.427,39c0.603,0.601,0.603,1.585,0,2.188l-13.128,13.125 c-0.602,0.604-1.586,0.604-2.187,0l-3.732-3.73l-17.303,17.3c3.882,14.621,0.095,30.857-11.37,42.32 c-0.266,0.268-0.535,0.529-0.808,0.787c-1.004,0.955-0.843,0.949-1.813-0.021L47.597,86.48L0,122.867l36.399-47.584L11.874,50.76 c-0.978-0.98-0.896-0.826,0.066-1.837c0.24-0.251,0.485-0.503,0.734-0.753C24.137,36.707,40.376,32.917,54.996,36.8l17.301-17.3 l-3.733-3.732c-0.601-0.601-0.601-1.585,0-2.188L81.691,0.451C82.295-0.15,83.279-0.15,83.88,0.451L83.88,0.451z"/></g></svg>
                                                </a>
                                            </h6>
                                            <p class="meta-date-time">{{$customer_history->astrologerQuery->created_at->format('d-M y H:i')}}</p>

                                        </div>
                                    </div>

                                    <p>

                                        {{$customer_history->astrologerQuery->transalated_by_moderator}}
                                        {{--                                    <input type="hidden" name="astro_query_id" value="{{$messages->astrologerQuery->id}}">--}}




                                    </p>
                                    @if($customer_history->astrologerQuery->reply->read_by_customer == 1)
                                        <p style="float: right;opacity: 0.7">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" style="opacity: 0.7" height="20" viewBox="0 0 127.818 63.298" >
                                                <g id="Group_27723" data-name="Group 27723" transform="translate(0)">
                                                    <rect id="Rectangle_215" data-name="Rectangle 215" width="74.358" height="15.159" transform="translate(64.52 52.579) rotate(-45)"/>
                                                    <path id="Path_2932" data-name="Path 2932" d="M798.975,442.981l-10.719-10.719-41.963,41.963L725.363,453.3l-10.719,10.719,31.548,31.545.1-.1.1.1Z" transform="translate(-714.644 -432.262)"/>
                                                </g>
                                            </svg>
                                            Read at:{{$customer_history->astrologerQuery->reply->read_at}}
                                        </p>
                                    @endif



                                </div>
                            </div>

                        </div>
                            @endif
                    @endif


                @if(isset($customer_history->astrologerQuery->astrologer_answer ) AND isset($customer_history->astrologerQuery->astrologer_id ) )
                    {{--                     Answered By Astrologer History --}}
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-2 layout-spacing">


                        <div class="widget widget-card-one"  style="background-color: #f3eede;@if($customer_history->id == $messages->chat_id) border-color: #e6ab05;
                                box-shadow: 0 10px 20px -10px #e6ab05; @endif ">
                            <div class="widget-content">

                                <div class="media">

                                    <div class="media-body">

                                        <h6>a. {{\App\User::find($customer_history->astrologerQuery->astrologer_id)->name}}
                                        </h6>
                                        <p class="meta-date-time">{{$customer_history->astrologerQuery->updated_at->format('d-M y H:i')}}</p>

                                    </div>
                                </div>

                                <p style="margin-bottom: 10px;">

                                    {{$customer_history->astrologerQuery->astrologer_answer}} </p>
                                @if(isset($customer_history->astrologerQuery->rating))
                                    <p style="text-align: center;">
                                        @for($i=0; $i<$customer_history->astrologerQuery->rating->rating; $i++)<img src="{{asset('star.png')}}" style="width: 25px; height: 25px;">
                                        @endfor
                                    </p>
                                @else
                                    <p style="margin-bottom: 10px;text-align: center;font-size: 0.7em;">Not Rated</p>
                                @endif






                            </div>
                        </div>

                    </div>

                @endif

                @if(isset($customer_history->astrologerQuery->translated_answer) and isset($customer_history->astrologerQuery->astrologer_id))
                    {{-- Moderator Answer Customer History --}}
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-3 layout-spacing" >
                        <div class="widget widget-card-one" style="background-color: #eff8f7">
                            <div class="widget-content">

                                <div class="media">

                                    <div class="media-body">

                                        <h6>m. {{\App\User::find($customer_history->astrologerQuery->moderator_id)->name}}</h6>
                                        <p>{{$customer_history->astrologerQuery->updated_at->format('d-M y H:i')}}</p>
                                        @if(isset($customer_history->rating))
                                            <p style="text-align: center;">
                                                @for($i=0; $i<$customer_history->rating->rating; $i++)<img src="{{asset('star.png')}}" style="width: 25px; height: 25px;">
                                                @endfor
                                            </p>
                                        @else
                                            <p style="margin-bottom: 10px;text-align: center;font-size: 0.7em;">Not Rated</p>
                                        @endif
                                    </div>
                                </div>
                                <p>{{$customer_history->astrologerQuery->translated_answer}}</p>
                                @if(isset($customer_history->astrologerQuery->reply))
                                    @if($customer_history->astrologerQuery->reply->read_by_customer == 1)
                                        <p style="float: right;opacity: 0.7">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" style="opacity: 0.7" height="20" viewBox="0 0 127.818 63.298" >
                                                <g id="Group_27723" data-name="Group 27723" transform="translate(0)">
                                                    <rect id="Rectangle_215" data-name="Rectangle 215" width="74.358" height="15.159" transform="translate(64.52 52.579) rotate(-45)"/>
                                                    <path id="Path_2932" data-name="Path 2932" d="M798.975,442.981l-10.719-10.719-41.963,41.963L725.363,453.3l-10.719,10.719,31.548,31.545.1-.1.1.1Z" transform="translate(-714.644 -432.262)"/>
                                                </g>
                                            </svg>
                                            Read at:{{$customer_history->astrologerQuery->reply->read_at}}
                                        </p>
                                    @endif
                                @endif

                                {{--                            <input type="hidden" name="chat_id" value="{{$messages->id}}">--}}
                                {{--                            <input type="hidden" name="moderator_id" value="{{$messages->receiver_id}}">--}}

                            </div>
                        </div>

                    </div>

                @endif
            @endif
        @endforeach



    </div>
    <div class="col-md-8 sticky-top" style="height: 90vh;" >

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing" style="padding: 0px;">
            <div class="widget widget-chart-three">
{{--                <div class="widget-heading">--}}
{{--                    --}}
{{--                    <div class="dropdown  custom-dropdown">--}}
{{--                        @if($messages->chat->read == 0)--}}
{{--                            <td><div class="td-content"><span class="badge outline-badge-primary">New Question for Moderation</span></div></td>--}}
{{--                        @elseif($messages->chat->read == 1)--}}
{{--                            <td><div class="td-content"><span class="badge outline-badge-info">Question Moderated to Astrologer</span></div></td>--}}
{{--                        @elseif($messages->chat->read == 2)--}}
{{--                            <td><div class="td-content"><span class="badge outline-badge-success">Answered Successfully to customer.</span></div></td>--}}

{{--                        @elseif($messages->chat->read == 3)--}}
{{--                            <td><div class="td-content"><span class="badge outline-badge-danger">Postponed</span></div></td>--}}
{{--                        @endif--}}

{{--                    </div>--}}
{{--                </div>--}}

                <div class="widget-content mt-3">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="hidden" value="{{$customer->id}}" name="customer_id">
                            <div class="col-md-12">
                                <p >Name: {{$customer->name}}</p>
                            </div>
                            <div class="col-md-12">
                                <p >Gender: {{$customer->details->gender}}</p>
                            </div>

                            <div class="col-md-12">
                                @if(isset($customer->details->date_of_birth))
                                @php
                                    $age = date_diff(date_create($customer->details->date_of_birth), date_create('now'))->y;
                                @endphp
                                @endif

                            <p >Birth Date:  @if(isset($customer->details->date_of_birth)) {{$customer->details->date_of_birth}} @else NOT SET @endif, @if(isset($customer->details->time_of_birth)) {{\Carbon\Carbon::createFromFormat('H:i:s',$customer->details->time_of_birth)->format('H:i')}}  @if($customer->details->is_time_accurate == 1 ) <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#7ed321" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> @else <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d0021b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg> @endif @else NOT SET @endif, Age: @if(isset($age))<span style="font-weight: bold; color: @if($age<=17){{'red'}}@else{{'black'}}@endif">{{$age}} @else NOT SET @endif</span> </p>
                            </div>
                            <div class="col-md-12">
                                <p >Adress of Birth: {{$customer->details->city_of_birth != null ? $customer->details->city_of_birth . ', ' : ''}}{{$customer->details->state_of_birth.','.$customer->details->country_of_birth}}</p>
                            </div>
                            <div class="col-md-12">

                                <p >Vedic Sign: {{$customer->details->vedic_sign}}
                                <a data-toggle="modal" data-target="#updateVedicModal"  id="updateVedic">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1780e5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                </a>
                                </p>
                            </div>
                            <div class="col-md-12">
                                <h6>Profile Image</h6>
                                @if(isset($customer->details->imageUrl))
                                    <div id="demo-test-gallery" class="demo-gallery" data-pswp-uid="1">
                                        <a class="img-1" href="{{asset($customer->details->imageUrl)}}" data-size="1600x1068" data-med="{{asset($customer->details->imageUrl)}}" data-med-size="1024x683" data-author="Samuel Rohl">
                                            <img src="{{asset($customer->details->imageUrl)}}" style="height: 150px;width: 150px;">

                                            <figure>This is dummy caption. It has been placed here solely to demonstrate the look and feel of finished, typeset text.</figure>
                                        </a>
                                    </div>
                                @else
                                    <div id="demo-test-gallery" class="demo-gallery" data-pswp-uid="1">
                                        <a class="img-1" href="{{asset('default-avatar.png')}}" data-size="1600x1068" data-med="{{asset('default-avatar.png')}}" data-med-size="1024x683" data-author="Aspect Astrology">
                                            <img src="{{asset('default-avatar.png')}}" style="height: 150px;width: 150px;">

                                        </a>
                                    </div>
                                @endif
                            </div>


                        </div>

{{--                        <div class="col-md-">--}}
{{--                            <div class="col-md-12">--}}
{{--                                --}}
{{--                                <h6 style="text-align: center">Kundali</h6>--}}

{{--                                @if(isset($customer->details->kundali))--}}
{{--                                <div style="text-align: center" id="demo-test-gallery" class="demo-gallery" data-pswp-uid="1">--}}
{{--                                <a class="img-1" href="{{asset($customer->details->kundali)}}" data-size="1600x1068" data-med="{{asset($customer->details->kundali)}}" data-med-size="1024x683" data-author="Samuel Rohl">--}}
{{--                                    <img src="{{asset($customer->details->kundali)}}" style="height: 115px;width: 200px;">--}}

{{--                                    <figure>This is dummy caption. It has been placed here solely to demonstrate the look and feel of finished, typeset text.</figure>--}}
{{--                                </a>--}}
{{--                                </div>--}}
{{--                                @else--}}
{{--                                <p>No Kundali Found</p>--}}
{{--                                @endif--}}

{{--                            </div>--}}
{{--                        </div>--}}


                        <div class="col-md-4 mydivScroll" >
                            <h6>Pinned Message</h6>

                            <div class="pinnedMessage" id="pinHere">
                                @foreach($pinnedMessages as $pn)

                                    @if($pn->message_type=='customer')
                                        <div id="pin-{{$pn->id}}" class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 layout-spacing">
                                            <div class="widget widget-card-one" style="background-color: #d5e6fd;">
                                                <div class="widget-content">

                                                    <div class="media">

                                                        <div class="media-body">
                                                            <h6>c. {{\App\User::find($pn->sender_id)->name}}
                                                                <a onclick="unpinmessage({{$pn->id}})">
                                                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 122.879 122.867" enable-background="new 0 0 122.879 122.867" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" d="M83.88,0.451L122.427,39c0.603,0.601,0.603,1.585,0,2.188l-13.128,13.125 c-0.602,0.604-1.586,0.604-2.187,0l-3.732-3.73l-17.303,17.3c3.882,14.621,0.095,30.857-11.37,42.32 c-0.266,0.268-0.535,0.529-0.808,0.787c-1.004,0.955-0.843,0.949-1.813-0.021L47.597,86.48L0,122.867l36.399-47.584L11.874,50.76 c-0.978-0.98-0.896-0.826,0.066-1.837c0.24-0.251,0.485-0.503,0.734-0.753C24.137,36.707,40.376,32.917,54.996,36.8l17.301-17.3 l-3.733-3.732c-0.601-0.601-0.601-1.585,0-2.188L81.691,0.451C82.295-0.15,83.279-0.15,83.88,0.451L83.88,0.451z"></path></g></svg>
                                                                </a>
                                                            </h6>
                                                            {{--                                               <p>30-Jun 23 06:52</p>--}}
                                                        </div>
                                                    </div>
                                                    <p>{{$pn->message}}</p>

                                                </div>
                                            </div>

                                        </div>
                                    @elseif($pn->message_type=='modtoastro')
                                        <div id="pin-{{$pn->id}}" class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-1 layout-spacing">
                                            <div class="widget widget-card-one" style="background-color: #ddddf3;">
                                                <div class="widget-content">

                                                    <div class="media">

                                                        <div class="media-body">

                                                            <h6>m. {{\App\User::find($pn->sender_id)->name}}
                                                                <a onclick="unpinmessage({{$pn->id}})">
                                                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 122.879 122.867" enable-background="new 0 0 122.879 122.867" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" d="M83.88,0.451L122.427,39c0.603,0.601,0.603,1.585,0,2.188l-13.128,13.125 c-0.602,0.604-1.586,0.604-2.187,0l-3.732-3.73l-17.303,17.3c3.882,14.621,0.095,30.857-11.37,42.32 c-0.266,0.268-0.535,0.529-0.808,0.787c-1.004,0.955-0.843,0.949-1.813-0.021L47.597,86.48L0,122.867l36.399-47.584L11.874,50.76 c-0.978-0.98-0.896-0.826,0.066-1.837c0.24-0.251,0.485-0.503,0.734-0.753C24.137,36.707,40.376,32.917,54.996,36.8l17.301-17.3 l-3.733-3.732c-0.601-0.601-0.601-1.585,0-2.188L81.691,0.451C82.295-0.15,83.279-0.15,83.88,0.451L83.88,0.451z"></path></g></svg>
                                                                </a>
                                                            </h6>
                                                            <p class="meta-date-time">21-Jun 23 09:26</p>

                                                        </div>
                                                    </div>

                                                    <p>

                                                        {{$pn->message}}





                                                    </p>


                                                </div>
                                            </div>

                                        </div>
                                    @elseif($pn->message_type == 'astroans')
                                        <div id="pin-{{$pn->id}}" class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-1 layout-spacing">
                                            <div class="widget widget-card-one" style="background-color: #eff8f7; ">
                                                <div class="widget-content">

                                                    <div class="media">

                                                        <div class="media-body">

                                                            <h6>a. {{\App\User::find($pn->sender_id)->name}}
                                                                <a onclick="unpinmessage({{$pn->id}})">
                                                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 122.879 122.867" enable-background="new 0 0 122.879 122.867" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" d="M83.88,0.451L122.427,39c0.603,0.601,0.603,1.585,0,2.188l-13.128,13.125 c-0.602,0.604-1.586,0.604-2.187,0l-3.732-3.73l-17.303,17.3c3.882,14.621,0.095,30.857-11.37,42.32 c-0.266,0.268-0.535,0.529-0.808,0.787c-1.004,0.955-0.843,0.949-1.813-0.021L47.597,86.48L0,122.867l36.399-47.584L11.874,50.76 c-0.978-0.98-0.896-0.826,0.066-1.837c0.24-0.251,0.485-0.503,0.734-0.753C24.137,36.707,40.376,32.917,54.996,36.8l17.301-17.3 l-3.733-3.732c-0.601-0.601-0.601-1.585,0-2.188L81.691,0.451C82.295-0.15,83.279-0.15,83.88,0.451L83.88,0.451z"></path></g></svg>
                                                                </a>
                                                            </h6>
                                                            <p>17-Jun 23 08:35</p>

                                                        </div>
                                                    </div>
                                                    <p>
                                                        {{$pn->message}}
                                                    </p>




                                                </div>
                                            </div>

                                        </div>
                                    @elseif($pn->message_type =='modaspsychologist')
                                        <div id="pin-{{$pn->id}}" class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-3 layout-spacing">
                                            <div class="widget widget-card-one" style="background-color: #eff8f7;">
                                                <div class="widget-content">

                                                    <div class="media">

                                                        <div class="media-body">

                                                            <p style="margin-bottom: 10px;text-align: center;font-size: 0.7em;">Not Rated</p>
                                                            <h6>m. {{\App\User::find($pn->sender_id)->name}}
                                                                <a onclick="unpinmessage({{$pn->id}})">
                                                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 122.879 122.867" enable-background="new 0 0 122.879 122.867" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" d="M83.88,0.451L122.427,39c0.603,0.601,0.603,1.585,0,2.188l-13.128,13.125 c-0.602,0.604-1.586,0.604-2.187,0l-3.732-3.73l-17.303,17.3c3.882,14.621,0.095,30.857-11.37,42.32 c-0.266,0.268-0.535,0.529-0.808,0.787c-1.004,0.955-0.843,0.949-1.813-0.021L47.597,86.48L0,122.867l36.399-47.584L11.874,50.76 c-0.978-0.98-0.896-0.826,0.066-1.837c0.24-0.251,0.485-0.503,0.734-0.753C24.137,36.707,40.376,32.917,54.996,36.8l17.301-17.3 l-3.733-3.732c-0.601-0.601-0.601-1.585,0-2.188L81.691,0.451C82.295-0.15,83.279-0.15,83.88,0.451L83.88,0.451z"></path></g></svg>
                                                                </a>
                                                            </h6>
                                                            <p class="meta-date-time">06-Jun 23 02:35</p>

                                                        </div>
                                                    </div>

                                                    <p>

                                                        {{$pn->message}}





                                                    </p>


                                                </div>
                                            </div>

                                        </div>
                                    @elseif($pn->message_type =='modclarified' || $pn->message_type == 'modtocustomer')
                                        <div id="pin-{{$pn->id}}"  class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-3 layout-spacing">
                                            <div class="widget widget-card-one" style="background-color: #eff8f7;">
                                                <div class="widget-content">

                                                    <div class="media">

                                                        <div class="media-body">

                                                            <p style="margin-bottom: 10px;text-align: center;font-size: 0.7em;">Not Rated</p>
                                                            <h6>m. {{\App\User::find($pn->sender_id)->name}} Clarified
                                                                <a onclick="unpinmessage({{$pn->id}})">
                                                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 122.879 122.867" enable-background="new 0 0 122.879 122.867" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" d="M83.88,0.451L122.427,39c0.603,0.601,0.603,1.585,0,2.188l-13.128,13.125 c-0.602,0.604-1.586,0.604-2.187,0l-3.732-3.73l-17.303,17.3c3.882,14.621,0.095,30.857-11.37,42.32 c-0.266,0.268-0.535,0.529-0.808,0.787c-1.004,0.955-0.843,0.949-1.813-0.021L47.597,86.48L0,122.867l36.399-47.584L11.874,50.76 c-0.978-0.98-0.896-0.826,0.066-1.837c0.24-0.251,0.485-0.503,0.734-0.753C24.137,36.707,40.376,32.917,54.996,36.8l17.301-17.3 l-3.733-3.732c-0.601-0.601-0.601-1.585,0-2.188L81.691,0.451C82.295-0.15,83.279-0.15,83.88,0.451L83.88,0.451z"></path></g></svg>
                                                                </a>
                                                            </h6>
                                                            <p class="meta-date-time">29-May 23 23:33</p>

                                                        </div>
                                                    </div>

                                                    <p>

                                                        {{$pn->message}}





                                                    </p>


                                                </div>
                                            </div>

                                        </div>
                                    @elseif($pn->message_type == 'system')
                                        <div  id="pin-{{$pn->id}}"  class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 offset-1 layout-spacing">
                                            <div class="widget widget-card-one" style="background-color: #ffffff;">
                                                <div class="widget-content">
                                                    <a onclick="unpinmessage({{$pn->id}})" style="float: right">
                                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 122.879 122.867" enable-background="new 0 0 122.879 122.867" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" d="M83.88,0.451L122.427,39c0.603,0.601,0.603,1.585,0,2.188l-13.128,13.125 c-0.602,0.604-1.586,0.604-2.187,0l-3.732-3.73l-17.303,17.3c3.882,14.621,0.095,30.857-11.37,42.32 c-0.266,0.268-0.535,0.529-0.808,0.787c-1.004,0.955-0.843,0.949-1.813-0.021L47.597,86.48L0,122.867l36.399-47.584L11.874,50.76 c-0.978-0.98-0.896-0.826,0.066-1.837c0.24-0.251,0.485-0.503,0.734-0.753C24.137,36.707,40.376,32.917,54.996,36.8l17.301-17.3 l-3.733-3.732c-0.601-0.601-0.601-1.585,0-2.188L81.691,0.451C82.295-0.15,83.279-0.15,83.88,0.451L83.88,0.451z"></path></g></svg>
                                                    </a>
                                                    <p style="text-align: center;">
                                                        {{$pn->message}}
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    @endif
                                @endforeach
                            </div>

                        </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing" style="padding: 0px;">
            <div class="widget ">


                <div class="widget-content">
                    <div class="row">
                        <div class="col-md-12" style="height: 25vh;padding-bottom: 10px;">
                            <textarea style="width: 100%; height: 100%; border-radius: 20px; padding: 20px;" id="messageArea" placeholder="Write Reply...."></textarea>
                            <div id="the-count">
                                <span id="current">0</span>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing" style="padding: 0px;">
            <div class="widget widget-chart-three">


                <div class="widget-content">


                        <div class="row" style="text-align: center">
                            <div class="col-md-3  mt-2 mb-2 ">
                                <button class="btn btn-secondary" id="backToModerator">Back To Moderator</button>
                            </div>
                            <div class="col-md-3 offset-1 mt-2 mb-2 ">
                                <button class="btn btn-primary" id="sendToModerator">Answer</button>
                            </div>

                            <div class="col-md-3 mt-2 mb-2">
                                <a style="width: 100%;" href="{{URL('astrologer/postpone/'.$messages->id)}}"  type="button" class="btn btn-danger mb-2 mr-2" >Postpone</a>
                            </div>
{{--                            @else--}}

{{--                                <div class="col-md-12 mt-2 mb-2 ">--}}
{{--                                    <button class="btn btn-primary" id="answerPreviewButton">Edit Answer</button>--}}
{{--                                </div>--}}


{{--                            <div class="col-md-4 mt-2 mb-2">--}}
{{--                                <button class="btn btn-primary">Templates</button>--}}
{{--                            </div>--}}


{{--                            <div class="col-md-4 mt-2 mb-2">--}}
{{--                                <button class="btn btn-primary">Postpone</button>--}}
{{--                            </div>--}}

                        </div>


                </div>
            </div>
        </div>


    </div>

    </div>




    <div class="modal " id="updateVedicModal" tabindex="-1" role="dialog" aria-labelledby="updateVedicModal" aria-hidden="true">

        <div class="modal-dialog" role="document">
            <!-- Modal content-->
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title">Update Vedic</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" class="overflow-auto">
                        <div class="col-md-12">
                            <div class="widget-content widget-content-area">


                                <form action="{{route('astrologer.updateVedic')}}" enctype="multipart/form-data" method="POST">@csrf
                                    <div class="form-group row mb-4">
                                        <label class="col-xl-4 col-sm-3 col-sm-2 col-form-label">Vedic Sign</label>
                                        <div class="col-xl-8 col-lg-9 col-sm-10">
                                            <select class="form-control selectpicker" name="vedic_sign" >
                                                <option value="Mesh">Mesh</option>
                                                <option value="Varishabha">Varishabha</option>
                                                <option value="Mithuna">Mithuna</option>
                                                <option value="Karka">Karka</option>
                                                <option value="Simha"> Simha</option>
                                                <option value="Kanya"> Kanya</option>
                                                <option value="Tula"> Tula</option>
                                                <option value="Vrischika"> Vrischika</option>
                                                <option value="Dhanu"> Dhanu</option>
                                                <option value="Makara"> Makara</option>
                                                <option value="Kumbha"> Kumbha</option>
                                                <option value="Meena"> Meena </option>


                                            </select>
                                            {{--                                <input type="text" class="form-control" name="vedic_sign" value="{{$customer->details->vedic_sign}}" placeholder="Enter Vedic Sign">--}}
                                            <input type="hidden" class="form-control" name="customer_id" value="{{$customer->id}}">
                                        </div>
                                    </div>
{{--                                    <div class="form-group row mb-4">--}}
{{--                                        <label for="hPassword" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Kundali</label>--}}
{{--                                        <div class="col-xl-10 col-lg-9 col-sm-10">--}}
{{--                                            <div class="custom-file-container" data-upload-id="myFirstImage">--}}
{{--                                                <label>Upload (Kundali) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>--}}


{{--                                                <label class="custom-file-container__custom-file" >--}}
{{--                                                    <input type="file" name="image" class="custom-file-container__custom-file__custom-file-input" accept="image/*">--}}
{{--                                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />--}}
{{--                                                    <span class="custom-file-container__custom-file__custom-file-control"></span>--}}
{{--                                                </label>--}}
{{--                                                <div class="custom-file-container__image-preview"></div>--}}
{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="form-group row">
                                        <div class="col-sm-10"  style=" text-align: center;">
                                            <button type="submit" class="btn btn-primary mt-3">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>
    <div class="modal " id="answerModal" tabindex="-1" role="dialog" aria-labelledby="answerModal" aria-hidden="true">

        <div class="modal-dialog modal-xl" role="document">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Answer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" class="overflow-auto">
                        <div class="col-md-12">
                            <div class="widget-content widget-content-area">
                                <p> Please review your answer and confirm you meet the criteria for the answer. </p>

                                <b>Old Answer</b>
                                <textarea style="width: 100%;"  class="form-control" readonly>@if(isset( $messages->astrologer_answer)){{$messages->astrologer_answer}}@endif</textarea>
                                <div class="col-md-12">

                                    <input id="termsCheck"  type="checkbox"> <label><p>I give affirmation to the requirement and criteria.</p></label>
                                </div>
                                New Answer
                                <textarea class="form-control" style="width: 100%;" id="messagePreviewArea"></textarea>

                            </div>
                        </div>
                    </div>
                </div>



                <div class="modal-footer md-button">
                    <button class="btn btn-primary" id="updateModeration">Answer</button>

                    <button class="btn" id="closeModal"><i class="flaticon-cancel-12"></i> Discard</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="addNoteModal" tabindex="-1" role="dialog" aria-labelledby="addNoteModal" aria-hidden="true">

        <div class="modal-dialog" role="document">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Answer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" class="overflow-auto">
                        <div class="col-md-12">
                            <div class="widget-content widget-content-area">

                                <b>Note</b>
                                <textarea  style="width: 100%;height: 150px;" class="form-control" id="customerNote"></textarea>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="modal-footer md-button">
                    <button class="btn btn-primary" id="storeNote">Save</button>

                    <button class="btn" id="closeModal" data-dismiss="modal"><i class="flaticon-cancel-12" ></i>Discard</button>
                </div>
            </div>
        </div>
    </div>
        <div class="modal" id="editNoteModal" tabindex="-1" role="dialog" aria-labelledby="editNoteModal" aria-hidden="true">

            <div class="modal-dialog" role="document">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Note</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row" class="overflow-auto">
                            <div class="col-md-12">
                                <div class="widget-content widget-content-area">
                                    <form method="POST" id="noteEditForm" action="{{route('astrologer.updateCustomerNotes')}}">@csrf
                                        <b>Note</b>
                                        <textarea  style="width: 100%;height: 150px;" class="form-control" name="note" id="customerNoteEdit"></textarea>
                                        <input type="hidden" name="id" id="editNoteId">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="modal-footer md-button">
                        <button class="btn btn-primary" id="updateNote">Save</button>

                        <button class="btn" id="closeModal" data-dismiss="modal"><i class="flaticon-cancel-12" ></i>Discard</button>
                    </div>
                </div>
            </div>
        </div>

    <!-- Root element of PhotoSwipe. Must have class pswp. -->
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

        <!-- Background of PhotoSwipe. It's a separate element, as animating opacity is faster than rgba(). -->
        <div class="pswp__bg"></div>

        <!-- Slides wrapper with overflow:hidden. -->
        <div class="pswp__scroll-wrap">
            <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
            <!-- don't modify these 3 pswp__item elements, data is added later on. -->
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
            <div class="pswp__ui pswp__ui--hidden">

                <div class="pswp__top-bar">

                    <!--  Controls are self-explanatory. Order can be changed. -->
                    <div class="pswp__counter"></div>
                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                    <button class="pswp__button pswp__button--share" title="Share"></button>
                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                    <!-- element will get class pswp__preloader--active when preloader is running -->
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div>
                <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                </button>
                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                </button>
                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection

@section('pagespecificscripts')
    <script src="{{asset('backend/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('backend/plugins/lightbox/photoswipe.min.js')}}"></script>
    <script src="{{asset('backend/plugins/lightbox/photoswipe-ui-default.min.js')}}"></script>
    <script src="{{asset('backend/plugins/lightbox/custom-photswipe.js')}}"></script>
    <script>
        $('#answerPreviewButton').click(function (event){
            var message = document.getElementById("messageArea").value;


            document.getElementById("messagePreviewArea").value = message;
            $("#answerModal").modal("show");
            $('#sendToCustomer').prop('disabled', true);
            setTimeout(function() {
                $('#sendToCustomer').prop('disabled', false);
            }, 5000);


        });
    </script>
    <script type="text/javascript">
        $("#updateModeration").click(function (event){

            var restrictedWords = new Array("actually", "apologies for the confusion");

            var txtInput = document.getElementById("messagePreviewArea").value;
                if(!($('input[id="termsCheck"]').is(':checked'))){
                    toastr.error("Please accept terms and condition!")
                    return;
                }

            if (txtInput.length == 0 ){
                    toastr.error("Empty Message!")
                    return;
            }

            var error = 0;
            for (var i = 0; i < restrictedWords.length; i++) {
                var val = restrictedWords[i];
                if ((txtInput.toLowerCase()).indexOf(val.toString()) > -1) {
                    error = error + 1;
                }
            }

            if (error > 0) {
                alert('You have entered some restricted words.')
            }
            else {
                event.preventDefault();
                var message = document.getElementById("messagePreviewArea").value;
                var astrologerQueryId = $("input[name=astro_query_id]").val();
                let _token   = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "/astrologer/updateAnswerModeration",
                    type:"POST",
                    data:{
                        astrologer_query_id: astrologerQueryId,
                        message:message,
                        _token: _token
                    },
                    success:function(response){
                        console.log(response);
                        if(response) {
                            $('.success').text(response.success);
                            $('.error').text(response.failed);
                            window.location.replace('{{route('astrologer.dashboard')}}');
                        }
                    },
                });
            }
        }
        );
    </script>
    <script>
        $( document ).ready(function() {
            var myDiv = document.getElementById("messages");
            myDiv.scrollTop = myDiv.scrollHeight;
        });
    </script>
    <script type="text/javascript">

        $('textarea').keyup(function() {

            var characterCount = $(this).val().length,
                current = $('#current'),
                maximum = $('#maximum'),
                theCount = $('#the-count');

            current.text(characterCount);


            /*This isn't entirely necessary, just playin around*/
            if (characterCount < 650) {
                current.css('color', '#666');
            }
            if (characterCount > 650) {
                current.css('color', '#00A300');
            }





        });
    </script>
        <script type="text/javascript">
            $("#backToModerator").click(function (event) {
                $('#backToModerator').prop('disabled', true);
                event.preventDefault();
                var message = document.getElementById("messageArea").value;
                var astrologerQueryId = $("input[name=astro_query_id]").val();
                var moderator_id = $("input[name=moderator_id]").val();
                var chat_id = $("input[name=chat_id]").val();
                let _token   = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "/astrologer/backToModerator",
                    type:"POST",
                    data:{
                        astrologer_query_id: astrologerQueryId,
                        moderator_id: moderator_id,
                        message:message,
                        chat_id,chat_id,
                        _token: _token
                    },
                    success:function(response){
                        console.log(response);
                        if(response) {
                            $('.success').text(response.success);
                            $('.error').text(response.failed);
                            window.location.replace('{{route('astrologer.dashboard')}}');
                        }
                    },
                });
            });
        </script>
    <script type="text/javascript">
        $("#sendToModerator").click(function (event){
            $('#sendToModerator').prop('disabled', true);
            if ($('#current').text() > 650) {
                var restrictedWords = new Array("actually", "apologies for the confusion");
                var txtInput = document.getElementById("messageArea").value;
                var error = 0;
                for (var i = 0; i < restrictedWords.length; i++) {
                    var val = restrictedWords[i];
                    if ((txtInput.toLowerCase()).indexOf(val.toString()) > -1) {
                        error = error + 1;
                    }
                }

                if (error > 0) {
                    alert('You have entered some restricted words.')
                }
                else {
                    event.preventDefault();
                    var message = document.getElementById("messageArea").value;
                    var astrologerQueryId = $("input[name=astro_query_id]").val();
                    var chat_id = $("input[name=chat_id]").val();
                    let _token   = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "/astrologer/sendReplyToModerator",
                        type:"POST",
                        data:{
                            astrologer_query_id: astrologerQueryId,
                            chat_id: chat_id,
                            message:message,
                            _token: _token
                        },
                        success:function(response){
                            console.log(response);
                            if(response) {
                                $('.success').text(response.success);
                                $('.error').text(response.failed);
                                window.location.replace('{{route('astrologer.dashboard')}}');
                            }
                        },
                    });
                }


            }

            else{
                $('#sendToModerator').prop('disabled', false);
                toastr.warning('Invalid Character Length: Min 650')
            }

        });
    </script>
    <script>
        $(document).ready(function() {
            $('input[id="notesCheck"]').click(function() {
                if($('input[id="notesCheck"]').is(':checked'))
                {
                    var x = document.getElementById("messages");
                    var y = document.getElementById("notes");
                    x.style.display = "none";
                    y.style.display = "block";
                }else
                {
                    var x = document.getElementById("messages");
                    var y = document.getElementById("notes");
                    x.style.display = "block";
                    y.style.display = "none";

                }
            });
        });
    </script>
    <script>
        $('#addNewNote').click(function (event){
            console.log('a');
            $("#addNoteModal").modal("show");


        });
        function editNote(id,note){
            $('#customerNoteEdit').val(note)
            $('#editNoteId').val(id)
            $("#editNoteModal").modal("show");

        }
        $("#updateNote").click(function (){
            $("#noteEditForm").submit()
        })
    </script>
    <script>
        $("#storeNote").click(function (event){
            event.preventDefault();
            $('#storeNote').prop('disabled', true);


            let _token   = $('meta[name="csrf-token"]').attr('content');
            var customerId = $("input[name=customer_id]").val();
            var note = document.getElementById('customerNote').value;
            $.ajax({
                url: "/astrologer/storeNote",
                type:"POST",
                data:{
                    note:note,
                    customer_id:customerId,
                    _token: _token,

                },
                success:function(response){
                    console.log(response);
                    if(response.success) {

                        location.reload();
                        toastr.success('Successfully Added Note.') ;
                    }

                },
            });


        });


    </script>
    <script>
        function pinmessage(message,sender,messageType) {
            console.log(message);
            console.log(sender);
            console.log(messageType);
            let _token   = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "/moderator/pinMessage",
                type:"POST",

                data:{
                    message:message,
                    sender_id:sender,
                    message_type: messageType,
                    pinned_by: {{Auth::user()->id}},
                    _token: _token
                },
                success:function(response){
                    toastr.success('Pin Successfull.') ;
                    html = '';
                    offset ='';
                    color = '';
                    sender = '';
                    if(response.message_type == 'customer'){
                        color='#d5e6fd';
                        sender = 'c. '+ response.sender.name;
                    }
                    else if (response.message_type=='modtoastro' ){
                        offset='offset-1';
                        color='#ddddf3';
                        sender = 'm. '+ response.sender.name;

                    }
                    else if(response.message_type =='astroans'){
                        offset='offset-1';
                        color='#eff8f7';
                        sender = 'a. '+ response.sender.name;

                    }
                    else if(response.message_type =='modaspsychologist'){
                        offset='offset-3';
                        color='#eff8f7';
                        sender = 'm. '+ response.sender.name;

                    }
                    else if(response.message_type =='modclarified'){
                        offset='offset-3';
                        color='#eff8f7';
                        sender = 'm. '+ response.sender.name + 'Clarified';

                    }
                    else if(response.message_type =='modtocustomer' ){
                        offset='offset-3';
                        color='#eff8f7';
                        sender = 'm. '+ response.sender.name;

                    }
                    html += '<div id="pin-'+response.id+'" class="col-xl-9 col-lg-9 col-md-9 col-sm-9 '+
                        offset+' col-9 layout-spacing"> '
                        +
                        '<div class="widget widget-card-one" style="background-color: '+color+'"> ' +
                        '<div class="widget-content"> ' +
                        '<div class="media">' +
                        '<div class="media-body"> ' +
                        '<h6>'+sender+'<a onclick="unpinmessage('+response.id+')"> <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 122.879 122.867" enable-background="new 0 0 122.879 122.867" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" d="M83.88,0.451L122.427,39c0.603,0.601,0.603,1.585,0,2.188l-13.128,13.125 c-0.602,0.604-1.586,0.604-2.187,0l-3.732-3.73l-17.303,17.3c3.882,14.621,0.095,30.857-11.37,42.32 c-0.266,0.268-0.535,0.529-0.808,0.787c-1.004,0.955-0.843,0.949-1.813-0.021L47.597,86.48L0,122.867l36.399-47.584L11.874,50.76 c-0.978-0.98-0.896-0.826,0.066-1.837c0.24-0.251,0.485-0.503,0.734-0.753C24.137,36.707,40.376,32.917,54.996,36.8l17.301-17.3 l-3.733-3.732c-0.601-0.601-0.601-1.585,0-2.188L81.691,0.451C82.295-0.15,83.279-0.15,83.88,0.451L83.88,0.451z"></path></g></svg> </a> </h6> </div> </div> <p>'+
                        response.message+ '</p> </div> </div> </div>';
                    console.log(html );
                    $('#pinHere').prepend(html);





                },
            });

        }
        function unpinmessage(pin_id){
            console.log(pin_id);
            let _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/moderator/unpinMessage",
                type:"POST",

                data:{
                    id: pin_id,
                    _token: _token
                },
                success:function(response){
                    toastr.success('Unpin Successfull.');
                    id='#pin-'+pin_id;
                    $(id).remove();
                    console.log(id);
                },
            });
        }
    </script>
{{--    <script>--}}
{{--        $("#sendToModerator").click(function (event){--}}
{{--           --}}



{{--        });--}}
{{--    </script>--}}


@endsection


