@extends('layouts.customer_layouts')
@section('pagespecificstyles')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/widgets/modules-widgets.css')}}">
    <link href="{{asset('backend/plugins/pricing-table/css/component.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif
    <div class="col-lg-12 " style="padding: 0px;">
        <div class="statbox widget box box-shadow">

            <div class="widget-content widget-content-area">
                <div class="container">
                    <div id="pricingWrapper" class="row">
                        @foreach($packages as $package)
                            @if(!($package->id==1))
                        <div class="col-md-6 col-lg-4">
                            <div class="card stacked mt-5">
                                <div class="card-header pt-0">
                                    <span class="card-price">${{$package->price}}</span>
                                    <h3 class="card-title mt-3 mb-1">{{$package->name}}</h3>
                                    <p>{{$package->description}}</p>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-minimal mb-3">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">Number of Questions: {{$package->number_of_questions}}
                                        </li>

                                    </ul>
                                    <button onclick="buyPackage({{$package->id}});" type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        Buy Package
                                    </button>


                                </div>
                            </div>
                        </div>
                                @endif
                        @endforeach
                    </div>


                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="panel-body card p-2">



                                <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation"
                                      data-cc-on-file="false"
                                      data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                      id="payment-form">
                                    @csrf

                                        <div class='col-xs-12 form-group required'>
                                            <label class='control-label'>Name on Card</label> <input
                                                class='form-control' size='4' type='text'>
                                        </div>

                                        <div class='col-xs-12 form-group  required'>
                                            <label class='control-label'>Card Number</label> <input
                                                autocomplete='off' class='form-control card-number' size='20'
                                                type='text'>
                                        </div>

                                    <div class='form-row row'>
                                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                                            <label class='control-label'>CVC</label> <input autocomplete='off'
                                                                                            class='form-control card-cvc' placeholder='ex. 311' size='4'
                                                                                            type='text'>
                                        </div>
                                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                                            <label class='control-label'>Expiration Month</label> <input
                                                class='form-control card-expiry-month' placeholder='MM' size='2'
                                                type='text'>
                                        </div>
                                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                                            <label class='control-label'>Expiration Year</label> <input
                                                class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                                type='text'>
                                        </div>
                                    </div>
                                    <input class='form-control' name="amount" id="amount" size='4' type='hidden'>
                                    <input class='form-control' name="package_id" id="package_id" size='4' type='hidden'>
{{--                                    <div class='form-row row'>--}}
{{--                                        <div class='col-md-12 error form-group hide'>--}}
{{--                                            <div class='alert-danger alert'>Please correct the errors and try--}}
{{--                                                again.</div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <button class="btn btn-primary btn-lg" type="submit">Pay Now ($<span id="package-price"></span>)</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                            <button type="button" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('pagespecificscripts')
    <script src="{{asset('backend/assets/js/widgets/modules-widgets.js')}}"></script>

{{--    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>--}}

{{--    <script type="text/javascript">--}}
{{--        $(function() {--}}
{{--            var $form = $(".require-validation");--}}
{{--            $('form.require-validation').bind('submit', function(e) {--}}
{{--                var $form         = $(".require-validation"),--}}
{{--                    inputSelector = ['input[type=email]', 'input[type=password]',--}}
{{--                        'input[type=text]', 'input[type=file]',--}}
{{--                        'textarea'].join(', '),--}}
{{--                    $inputs       = $form.find('.required').find(inputSelector),--}}
{{--                    $errorMessage = $form.find('div.error'),--}}
{{--                    valid         = true;--}}
{{--                $errorMessage.addClass('hide');--}}

{{--                $('.has-error').removeClass('has-error');--}}
{{--                $inputs.each(function(i, el) {--}}
{{--                    var $input = $(el);--}}
{{--                    if ($input.val() === '') {--}}
{{--                        $input.parent().addClass('has-error');--}}
{{--                        $errorMessage.removeClass('hide');--}}
{{--                        e.preventDefault();--}}
{{--                    }--}}
{{--                });--}}

{{--                if (!$form.data('cc-on-file')) {--}}
{{--                    e.preventDefault();--}}
{{--                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));--}}
{{--                    Stripe.createToken({--}}
{{--                        number: $('.card-number').val(),--}}
{{--                        cvc: $('.card-cvc').val(),--}}
{{--                        exp_month: $('.card-expiry-month').val(),--}}
{{--                        exp_year: $('.card-expiry-year').val()--}}
{{--                    }, stripeResponseHandler);--}}
{{--                }--}}

{{--            });--}}

{{--            function stripeResponseHandler(status, response) {--}}
{{--                if (response.error) {--}}
{{--                    $('.error')--}}
{{--                        .removeClass('hide')--}}
{{--                        .find('.alert')--}}
{{--                        .text(response.error.message);--}}
{{--                } else {--}}
{{--                    // token contains id, last4, and card type--}}
{{--                    var token = response['id'];--}}
{{--                    // insert the token into the form so it gets submitted to the server--}}
{{--                    $form.find('input[type=text]').empty();--}}
{{--                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");--}}
{{--                    $form.get(0).submit();--}}
{{--                }--}}
{{--            }--}}

{{--        });--}}
{{--    </script>--}}
    <script>
        window.ParsleyConfig = {
            errorsWrapper: '<div></div>',
            errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
            errorClass: 'has-error',
            successClass: 'has-success'
        };
    </script>

    <script src="https://parsleyjs.org/dist/parsley.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script>
        Stripe.setPublishableKey("<?php echo env('STRIPE_KEY') ?>");
        jQuery(function($) {
            $('#payment-form').submit(function(event) {
                var $form = $(this);
                $form.parsley().subscribe('parsley:form:validate', function(formInstance) {
                    formInstance.submitEvent.preventDefault();
                    alert();
                    return false;
                });
                $form.find('#submitBtn').prop('disabled', true);
                Stripe.card.createToken($form, stripeResponseHandler);
                return false;
            });
        });
        function stripeResponseHandler(status, response) {
            var $form = $('#payment-form');
            console.log(response);
            if (response.error) {

                $form.find('.payment-errors').text(response.error.message);
                $form.find('.payment-errors').addClass('alert alert-danger');
                $form.find('#submitBtn').prop('disabled', false);
                $('#submitBtn').button('reset');
            } else {
                var token = response.id;
                $form.append($('<input type="hidden" name="stripeToken" />').val(token));
                $form.get(0).submit();
            }
        };
    </script>
    <script type="text/javascript">
        function buyPackage(id) {
            var sites = {!! json_encode($packages->toArray(), JSON_HEX_TAG) !!};
            site = sites.filter(function(elem) {
                //return false for the element that matches both the name and the id
                return (elem.id == id)
            });
            document.getElementById("amount").setAttribute('value',site[0]['price']);
            document.getElementById("package-price").textContent=site[0]['price'];
            document.getElementById("package_id").setAttribute('value',site[0]['price']);

            console.log(site[0]['price']);
        }
    </script>

@endsection
