@extends('layouts.customer_layouts')
@section('pagespecificstyles')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/widgets/modules-widgets.css')}}">
    <link href="{{asset('backend/assets/css/apps/mailing-chat.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        #the-count {
            float: right;
            padding: 0.1rem 0 0 0;
            font-size: 0.875rem;
        }
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center
        }
        .checked {
            color: #f8d863;
        }

        .rating>input {
            display: none
        }
        #sendSVG{
            left: 95%;
        }

        @media screen and (max-width: 450px){
            #sendSVG{
                left:90%;
            }


        }
        @media screen and (min-width: 1350px){
            #sendSVG{
                left:96%;
            }


        }

        .rating>label {
            position: relative;
            width: 1em;
            font-size: 30px;
            font-weight: 300;
            color: #FFD600;
            cursor: pointer
        }

        .rating>label::before {
            content: "\2605";
            position: absolute;
            opacity: 0
        }

        .rating>label:hover:before,
        .rating>label:hover~label:before {
            opacity: 1 !important
        }

        .rating>input:checked~label:before {
            opacity: 1
        }

        .rating:hover>input:checked~label:before {
            opacity: 0.4
        }

        .buttons {
            top: 36px;
            position: relative
        }

        .rating-submit {
            border-radius: 15px;
            color: #fff;
            height: 49px
        }

        .rating-submit:hover {
            color: #fff
        }
    </style>
@endsection
@section('content')


            <div class="chat-section" >
                <div class="row" style="min-height: 86vh;">

                    <div class="col-xl-12 col-lg-12 col-md-12">

                        <div class="chat-system" style="min-height: 86vh;">
                            <div class="hamburger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu mail-menu d-lg-none"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></div>

                            <div class="chat-box" style="min-height: 86vh;">

                                <div class="chat-box-inner">

                                    <div class="chat-conversation-box" id="chatUI">
                                        <div id="chat-conversation-box-scroll" class="chat-conversation-box-scroll">
                                            <div class="chat active-chat" >
                                                @foreach($conversationByDate as $date=>$conversation)
                                                <div class="conversation-start">
                                                    <span>{{$date}}</span>
                                                </div>
                                                @foreach($conversation as $convo)
                                                    @if($convo->sender_id == auth()->user()->id)
                                                        <div class="bubble me">
                                                            {{$convo->message}}<br>
                                                            <p style="font-size: 14px;">{{date('H:m', strtotime($convo->created_at))}}</p>
                                                        </div>
                                                     @elseif($convo->sender_id == 1)
                                                        <div style="width: 100%; text-align: center;">
                                                            <div class="bubble-1 bot" style="max-width: 100%;">
                                                                <p style="font-size: 14px;">System Message</p>
                                                                {{$convo->message}}
                                                                <p style="font-size: 14px;">{{date('H:m', strtotime($convo->created_at))}}</p>
                                                            </div>
                                                        </div>

                                                        @else
                                                            <img src="{{asset('astro_avatar.jpg')}}" class="rounded-circle" width="50px" height="50px">
                                                            <div class="bubble you mt-1" style="">
                                                                <h6><b>{{\App\User::find($convo->sender_id)->moderatorDetails->astro_name}}</b></h6>
                                                                <br>
                                                                {{$convo->message}}<br>
                                                                <p style="font-size: 14px;">{{date('H:m', strtotime($convo->created_at))}}</p>
{{--                                                                @if(isset($convo->rating))--}}
{{--                                                                    <div style="text-align: center;">--}}
{{--                                                                    @for($i=0;$i<$convo->rating->rating;$i++)--}}
{{--                                                                    <i class="fa fa-star checked fa-2x"></i>--}}
{{--                                                                        @endfor--}}
{{--                                                                    </div>--}}
{{--                                                                @else--}}
                                                                @php

                                                                    $first = false;
                                                                    $second = false;
                                                                    $third = false;
                                                                    $fourth = false;
                                                                    $fifth = false;

                                                                @endphp
                                                                @if(isset($convo->rating))

                                                                    @if($convo->rating->rating == 1)
                                                                        @php
                                                                            $first = true;
                                                                        @endphp
                                                                    @elseif($convo->rating->rating == 2)
                                                                        @php
                                                                            $second = true;
                                                                        @endphp
                                                                    @elseif($convo->rating->rating == 3)
                                                                        @php
                                                                            $third = true;
                                                                        @endphp
                                                                    @elseif($convo->rating->rating == 4)
                                                                        @php
                                                                            $fourth = true;
                                                                        @endphp
                                                                    @elseif($convo->rating->rating == 5)
                                                                        @php
                                                                            $fifth = true;
                                                                        @endphp
                                                                    @endif
                                                                @endif
                                                                <form method="POST" id="myForm-{{$convo->id}}" action="{{route('customer.rateAstrologer')}}">@csrf
                                                                    <div class="rating">
{{--                                                                        {{$convo->id}}--}}



                                                                        <input type="radio" name="rating" onchange='document.getElementById("myForm-{{$convo->id}}").submit()' @if($fifth) {{'checked'}} @endif  value="5" id="5">
                                                                        <label for="5">☆</label>
                                                                        <input type="radio" name="rating" onchange='document.getElementById("myForm-{{$convo->id}}").submit()' @if($fourth) {{'checked'}} @endif value="4" id="4">
                                                                        <label for="4">☆</label>
                                                                        <input type="radio" name="rating" onchange='document.getElementById("myForm-{{$convo->id}}").submit()' @if($third) {{'checked'}} @endif value="3" id="3">
                                                                        <label for="3">☆</label>
                                                                        <input type="radio" onchange='document.getElementById("myForm-{{$convo->id}}").submit()' @if($second) {{'checked'}} @endif  name="rating"  value="2" id="2">
                                                                        <label for="2">☆</label>
                                                                        <input type="radio" name="rating" onchange='document.getElementById("myForm-{{$convo->id}}").submit()' @if($first) {{'checked'}} @endif  value="1" id="1">
                                                                        <label for="1">☆</label>
                                                                        <input name="chat_id" id="_{{$convo->id}}" value="{{$convo->id}}" type="hidden">
                                                                    </div>
                                                                </form>
{{--                                                               @endif--}}
                                                            </div>
                                                        @endif
                                                    @endforeach


                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                    <div class="chat-footer chat-active"  style="margin-top: 2.5%;">
                                        <div class="chat-input">
                                            <form class="chat-form" method="POST" id="messageForm" action="{{route('customer.sendMessage')}}">@csrf
                                                <a  data-toggle="modal" data-target="#sampleQuestionModal">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"  stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                                </a>
                                                <textarea type="text" required class="mail-write-box form-control" id="messageArea" name="message" placeholder="Message" style="max-height: 7vh;"/></textarea>
                                                <a  onclick="submitValidate();" style="cursor: pointer;">
                                                    <svg  xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 24 24" fill="none" stroke="#1fb306" id="sendSVG" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 8l4 4-4 4M8 12h7"/></svg>
                                                </a>

                                            </form>
                                            <div id="the-count">
                                                <span id="current">0</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div id="sampleQuestionModal" class="modal animated zoomInUp custo-zoomInUp"  role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Sample Questions</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row" class="overflow-auto">
                                <div class="col-md-12">
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
                                                            <table>
                                                                @foreach($ques->questions as $q)
                                                                    <tr>
                                                                        @if($q->role == 1)

                                                                            <td class="col-md-6" id="copy-{{$q->id}}">{{$q->question}}</td>
                                                                            <td  class="col-md-6" style="text-align: right"><button onclick="myFunction('copy-{{$q->id}}')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg></button></td>
                                                                        @endif
                                                                    </tr>
                                                                @endforeach

                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="modal-footer md-button">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                        </div>
                    </div>
                </div>
            </div>




@endsection

@section('pagespecificscripts')
    <script>
        var myDiv = document.getElementById("chatUI");
        myDiv.scrollTop = myDiv.scrollHeight;

        // function scrollToBottom (id) {
        //     var div = document.getElementById(id);
        //     div.scrollTop = div.scrollHeight - div.clientHeight;
        // }
    </script>
    <script src="{{asset('backend/assets/js/widgets/modules-widgets.js')}}"></script>
    <script src="{{asset('backend/assets/js/apps/mailbox-chat.js')}}"></script>
    <script>
        @if (session('message')) toastr.info("{{ Session::get('message') }}");  @endif
    </script>
    <script>
        function rateAstrologer(id) {
            event.preventDefault();
            var message = document.getElementById("messageArea").value;
            var astrologerQueryId = $("input[name=astro_query_id]").val();
            var customerId = $("input[name=customer_id]").val();
            var moderatorId = {!! auth()->user()->id !!};
            let _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/admin/sendAnswerToCustomer",
                type:"POST",
                data:{
                    astrologer_query_id:astrologerQueryId,
                    message:message,
                    customer_id: customerId,
                    moderator_id:moderatorId,
                    _token: _token
                },
                success:function(response){
                    console.log(response);
                    if(response) {
                        $('.success').text(response.success);
                        // location.reload();
                    }
                },
            });



        });
    </script>
    <script>
    function myFunction(id) {
    /* Get the text field */

        console.log(id);
        var copyText = document.getElementById(id).innerText;

        const el = document.createElement('textarea')
        el.value = copyText
        el.setAttribute('readonly', '')
        el.style.position = 'absolute'
        el.style.left = '-9999px'
        document.body.appendChild(el)
        el.select()
        document.getElementById("messageArea").value = copyText;
        document.execCommand('copy')
        document.body.removeChild(el)
        toastr.success('Copied To ClipBoard!')
        $('.modal').modal('hide');
    }
    </script>
    <script>
        function submitValidate(){
            if (document.getElementById("messageArea").value.length < 500){
                document.getElementById("messageForm").submit();

            }
            else {
                toastr.warning('Invalid Character Length! Maximum length to ask question is 500 characters.');
            }
        }
    </script>
{{--    <script>--}}
{{--        $("input[name='rating']").change(function(){--}}

{{--            var rating = $(this).val();--}}
{{--            var chatId = $("input[name=chat_id]").val();--}}
{{--            var moderatorId =$("input[name=moderatorId]").val();--}}
{{--            let _token   = $('meta[name="csrf-token"]').attr('content');--}}
{{--            console.log(chatId);--}}
{{--            console.log(moderatorId);--}}
{{--            $.ajax({--}}
{{--                url: "/customer/rateAstrologer",--}}
{{--                type:"POST",--}}
{{--                data:{--}}
{{--                    rating:rating,--}}
{{--                    chat_id: chatId,--}}
{{--                    user_id: moderatorId,--}}
{{--                    _token: _token--}}
{{--                },--}}
{{--                success:function(response){--}}
{{--                    console.log(response);--}}

{{--                    if(response) {--}}
{{--                        // $('.success').text(response.success);--}}

{{--                    }--}}
{{--                },--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
    <script type="text/javascript">
        $('textarea').keyup(function() {

            var characterCount = $(this).val().length,
                current = $('#current'),

                theCount = $('#the-count');

            current.text(characterCount);


            /*This isn't entirely necessary, just playin around*/
            if (characterCount < 500) {
                current.css('color', '#666');
            }
            if (characterCount > 500) {

                current.css('color', '#00A300');
            }


            // if (characterCount >= 750) {
            //     maximum.css('color', '#8f0001');
            //     current.css('color', '#8f0001');
            //     theCount.css('font-weight','bold');
            // } else {
            //     maximum.css('color','#666');
            //     theCount.css('font-weight','normal');
            // }
            //

        });
    </script>
@endsection
