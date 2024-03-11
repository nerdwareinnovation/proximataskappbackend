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

        }

        .foldtl:before {
            content: "";
            position: absolute;
            top: 0%;
            left: 0%;
            width: 0px;
            height: 0px;

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
            border-top: 69px solid #f1f2f3;
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
    </style>
@endsection

@section('content')
    <div class="row layout-top-spacing">
        <div class="col-md-4" style="display: none;" id="notes" >
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing foldtl">
                <div class="widget widget-card-one" style="background-color: #edef4c">
                    <div class="widget-content">

                        <button class="btn btn-primary" style="margin-left: 80%;margin-top: 20px;" id="saveNotes">Save</button>
                        <textarea style="border:none;padding: 40px; width: 100%; height: 70%; background-color: transparent;" id="notesArea">{{$customer->details->notes}}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4" id="messages">

            @php
                if(isset($messages->astrologerQuery->transalated_by_moderator)){
            @endphp
            <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                <div class="widget widget-card-one" style="background-color: #c5d9ed;" >
                    <div class="widget-content">

                        <div class="media">
                            <div class="w-img">
                                <img src="{{asset('avatar.jpg')}}" alt="avatar">
                            </div>
                            <div class="media-body">
                                <p>Moderator</p>
                                <h6>   {{$messages->astrologerQuery->moderator->name}}</h6>

                            </div>
                        </div>
                        <p style="margin-bottom: 0px;">Translated By Moderator:</p>
                        <p>
                            {{$messages->astrologerQuery->transalated_by_moderator}}
                            <input type="hidden" name="astro_query_id" value="{{$messages->astrologerQuery->id}}">
                            <input type="hidden" name="chat_id" value="{{$messages->astrologerQuery->chat_id}}">

                        </p>


                    </div>
                </div>

            </div>
            @php
                }
            @endphp
            @php
                if(isset($messages->astrologerQuery->translated_answer)){
            @endphp

            <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                <div class="widget widget-card-one" style="background-color: #f5e6ab;">
                    <div class="widget-content">

                        <div class="media">
                            <div class="w-img">
                                <img src="{{asset('avatar.jpg')}}" alt="avatar">
                            </div>
                            <div class="media-body">
                                <p>Psychologist</p>
                                <h6>

                                    {{auth()->user()->name}}


                                </h6>
                                <p class="meta-date-time">{{$messages->astrologerQuery->updated_at}}</p>
                            </div>
                        </div>

                        <p>
                            @if(isset( $messages->astrologerQuery->translated_answer))
                                {{ $messages->astrologerQuery->translated_answer}}

                            @else
                                {{"No Answer Received"}}
                            @endif




                        </p>


                    </div>
                </div>

            </div>
            @php
                }
            @endphp

        </div>
        <div class="col-md-8 sticky-top" >

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-three">
                    <div class="widget-heading">
                        <div class="">
                            <h5 class="">Customer Details</h5>
                        </div>

                        <div class="dropdown  custom-dropdown">
                            @if($messages->read == 0)
                                <td><div class="td-content"><span class="badge outline-badge-primary">New Question for Moderation</span></div></td>
                            @elseif($messages->read == 1)
                                <td><div class="td-content"><span class="badge outline-badge-info">Question Moderated to Astrologer</span></div></td>
                            @elseif($messages->read == 2)
                                <td><div class="td-content"><span class="badge outline-badge-success">Answered Successfully to customer.</span></div></td>

                            @elseif($messages->read == 3)
                                <td><div class="td-content"><span class="badge outline-badge-danger">Postponed</span></div></td>

                            @elseif($messages->read == 4)
                                <td><div class="td-content"><span class="badge outline-badge-info">Question Moderated to Psychologist</span></div></td>

                            @endif

                        </div>
                    </div>

                    <div class="widget-content mt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" value="{{$customer->id}}" name="customer_id">
                                <div class="col-md-12">
                                    <p >Name: {{$customer->name}}</p>
                                </div>
                                <div class="col-md-12">
                                    <p >Gender: {{$customer->details->gender}}</p>
                                </div>
                                <div class="col-md-12">
                                    <p >Birth Date: {{$customer->details->date_of_birth}}</p>
                                </div>
                                <div class="col-md-12">
                                    <p >Time of Birth: {{$customer->details->time_of_birth}} @if($customer->details->is_time_accurate == 1 ) <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#7ed321" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> @else <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d0021b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg> @endif</p>
                                </div>
                                <div class="col-md-12">
                                    <p >Adress of Birth: {{$customer->details->state_of_birth.','.$customer->details->country_of_birth}}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <h6>Kundali</h6>
                                    <div id="demo-test-gallery" class="demo-gallery" data-pswp-uid="1">

                                        <a class="img-1" href="{{asset($customer->details->kundali)}}" data-size="1600x1068" data-med="{{asset($customer->details->kundali)}}" data-med-size="1024x683" data-author="Samuel Rohl">
                                            <img src="{{asset($customer->details->kundali)}}" style="height: 115px;width: 200px;">

                                            <figure>This is dummy caption. It has been placed here solely to demonstrate the look and feel of finished, typeset text.</figure>
                                        </a>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget ">


                    <div class="widget-content">
                        <div class="row">
                            <div class="col-md-12" style="height: 25vh;padding-bottom: 10px;">
                                <textarea style="width: 100%; height: 100%; border-radius: 20px; padding: 20px;" id="messageArea" placeholder="Write Reply...."></textarea>
                                <div id="the-count">
                                    <span id="current">0</span>
                                    <span id="maximum">/ 750</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-three">


                    <div class="widget-content">
                        <div class="col-md-12">
                            <div class="row">

                                <div class="col-md-4 mt-2 mb-2 offset-5">
                                    <button class="btn btn-primary" @if(!($messages->read == 1 or $messages->read == 4)){{'disabled'}}@endif id="sendToCustomer">Answer</button>
                                </div>


{{--                                <div class="col-md-4 mt-2 mb-2">--}}
{{--                                    <button class="btn btn-primary">Postpone</button>--}}
{{--                                </div>--}}

                            </div>
                        </div>

                    </div>
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
@endsection

@section('pagespecificscripts')
    <script src="{{asset('backend/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('backend/plugins/lightbox/photoswipe.min.js')}}"></script>
    <script src="{{asset('backend/plugins/lightbox/photoswipe-ui-default.min.js')}}"></script>
    <script src="{{asset('backend/plugins/lightbox/custom-photswipe.js')}}"></script>
    <script>
        $("#saveNotes").click(function (event){
            event.preventDefault();
            var notes = document.getElementById("notesArea").value;
            var customerId = $("input[name=customer_id]").val();
            let _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/storeCustomerNotes",
                type:"POST",
                data:{
                    notes:notes,
                    customer_id: customerId,
                    _token: _token
                },
                success:function(response){


                    if(response) {
                        $('.success').text(response.success);
                        // location.reload();
                    }
                },
            });



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
            if (characterCount > 650 && characterCount < 750) {
                current.css('color', '#6d5555');
            }


            if (characterCount >= 750) {
                maximum.css('color', '#8f0001');
                current.css('color', '#8f0001');
                theCount.css('font-weight','bold');
            } else {
                maximum.css('color','#666');
                theCount.css('font-weight','normal');
            }


        });
    </script>
    <script type="text/javascript">
        $("#sendToCustomer").click(function (event){

            var restrictedWords = @json($restricted_words);;
            var txtInput = document.getElementById("messageArea").value;
            var error = 0;
            for (var i = 0; i < restrictedWords.length; i++) {
                var val = restrictedWords[i].word;
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
                var customerId = $("input[name=customer_id]").val();
                var moderatorId = {!! auth()->user()->id !!};
                let _token   = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "/psychologist/sendAnswerToCustomer",
                    type: "POST",
                    data: {
                        astrologer_query_id: astrologerQueryId,
                        message: message,
                        customer_id: customerId,
                        moderator_id: moderatorId,
                        _token: _token
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.success) {
                            $("#answerModal").modal("hide");
                            toastr.success(response.success);
                            window.location.replace('{{route('psychologist.dashboard')}}');



                        } else if (response.failed) {
                            $("#answerModal").modal("hide");
                            toastr.warning(response.failed);
                            window.location.replace('{{route('psychologist.dashboard')}}');

                        }
                    }
                });

            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('input[type="checkbox"]').click(function() {
                if($('input[type="checkbox"]').is(':checked'))
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
    {{--    <script>--}}
    {{--        $("#sendToModerator").click(function (event){--}}
    {{--           --}}



    {{--        });--}}
    {{--    </script>--}}


@endsection


