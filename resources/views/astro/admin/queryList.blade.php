@extends('layouts.master')
@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Query</h4>
                        </div>
                    </div>
                </div>
                    <form method="POST" enctype="multipart/form-data" action="{{route('admin.filterQuery')}}">@csrf
                        <div class="row">

                            <div class="mt-2 col-md-4">
                                From: <input id="from_date" name="from_date" value="{{ date('Y-m-d',strtotime($start ?? date('Y-m-d')))}}" class="form-control" type="date">
                            </div>
                            <div class="mt-2 col-md-4">
                                To: <input id="to_date" name="to_date"  value="{{ date('Y-m-d',strtotime($end ?? date('Y-m-d'))) }}" class="form-control" type="date">
                            </div>
                            <div class="col-md-4">
                                <button class="mt-4 btn btn-secondary">Filter</button>
                            </div>

                        </div>
                    </form>
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                    <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <thead>
                    <tr>
                            <th>Customer</th>

                            <th>Status</th>
                            <th>Query Time</th>
                            <th class="no-content"></th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
        <div class="modal fade" id="customerModal" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">User Info</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 layout-spacing">
                                <div class="statbox widget box box-shadow">
                                    <div id="accordionIcons" class="widget-header">
                                        <div class="row">
                                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                <h4>Icons</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-content widget-content-area customerQueries">



                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@section('pagespecificscripts')
    <script src="{{asset('backend/plugins/table/datatable/datatables.js')}}"></script>
{{--    <script>--}}
{{--        $('#zero-config').DataTable({--}}
{{--            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +--}}
{{--                "<'table-responsive'tr>" +--}}
{{--                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",--}}
{{--            "oLanguage": {--}}
{{--                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },--}}
{{--                "sInfo": "Showing page _PAGE_ of _PAGES_",--}}
{{--                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',--}}
{{--                "sSearchPlaceholder": "Search...",--}}
{{--                "sLengthMenu": "Results :  _MENU_",--}}
{{--            },--}}
{{--            "ordering": false,--}}
{{--            "stripeClasses": [],--}}
{{--            "lengthMenu": [7, 10, 20, 50],--}}
{{--            "pageLength": 7--}}
{{--        });--}}
{{--        --}}
{{--    </script>--}}
    <script>
        $.fn.dataTable.pipeline = function ( opts ) {
            // Configuration options
            var conf = $.extend( {
                pages: 5,     // number of pages to cache
                url: '',      // script url
                data: null,   // function or object with parameters to send to the server
                              // matching how `ajax.data` works in DataTables
                method: 'GET' // Ajax HTTP method
            }, opts );

            // Private variables for storing the cache
            var cacheLower = -1;
            var cacheUpper = null;
            var cacheLastRequest = null;
            var cacheLastJson = null;

            return function ( request, drawCallback, settings ) {
                var ajax          = false;
                var requestStart  = request.start;
                var drawStart     = request.start;
                var requestLength = request.length;
                var requestEnd    = requestStart + requestLength;
                if ( settings.clearCache ) {
                    // API requested that the cache be cleared
                    ajax = true;
                    settings.clearCache = false;
                }
                else if ( cacheLower < 0 || requestStart < cacheLower || requestEnd > cacheUpper ) {
                    // outside cached data - need to make a request
                    ajax = true;
                }
                else if ( JSON.stringify( request.order )   !== JSON.stringify( cacheLastRequest.order ) ||
                    JSON.stringify( request.columns ) !== JSON.stringify( cacheLastRequest.columns ) ||
                    JSON.stringify( request.search )  !== JSON.stringify( cacheLastRequest.search )
                ) {
                    // properties changed (ordering, columns, searching)
                    ajax = true;
                }

                // Store the request for checking next time around
                cacheLastRequest = $.extend( true, {}, request );

                if ( ajax ) {
                    // Need data from the server
                    if ( requestStart < cacheLower ) {
                        requestStart = requestStart - (requestLength*(conf.pages-1));

                        if ( requestStart < 0 ) {
                            requestStart = 0;
                        }
                    }

                    cacheLower = requestStart;
                    cacheUpper = requestStart + (requestLength * conf.pages);

                    request.start = requestStart;
                    request.length = requestLength*conf.pages;

                    // Provide the same `data` options as DataTables.
                    if ( typeof conf.data === 'function' ) {
                        // As a function it is executed with the data object as an arg
                        // for manipulation. If an object is returned, it is used as the
                        // data object to submit
                        var d = conf.data( request );
                        if ( d ) {
                            $.extend( request, d );
                        }
                    }
                    else if ( $.isPlainObject( conf.data ) ) {
                        // As an object, the data given extends the default
                        $.extend( request, conf.data );
                    }

                    return $.ajax( {
                        "type":     conf.method,
                        "url":      conf.url,
                        "data":     request,
                        "dataType": "json",
                        "cache":    false,
                        "success":  function ( json ) {
                            cacheLastJson = $.extend(true, {}, json);

                            if ( cacheLower != drawStart ) {
                                json.data.splice( 0, drawStart-cacheLower );
                            }
                            if ( requestLength >= -1 ) {
                                json.data.splice( requestLength, json.data.length );
                            }

                            drawCallback( json );
                        }
                    } );
                }
                else {
                    json = $.extend( true, {}, cacheLastJson );
                    json.draw = request.draw; // Update the echo for each response
                    json.data.splice( 0, requestStart-cacheLower );
                    json.data.splice( requestLength, json.data.length );

                    drawCallback(json);
                }
            }
        };

        // Register an API method that will empty the pipelined data, forcing an Ajax
        // fetch on the next draw (i.e. `table.clearPipeline().draw()`)
        $.fn.dataTable.Api.register( 'clearPipeline()', function () {
            return this.iterator( 'table', function ( settings ) {
                settings.clearCache = true;
            } );
        } );
        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
            var min = parseInt($('#min').val(), 10);
            var max = parseInt($('#max').val(), 10);
            var age = parseFloat(data[3]) || 0; // use data for the age column

            if (
                (isNaN(min) && isNaN(max)) ||
                (isNaN(min) && age <= max) ||
                (min <= age && isNaN(max)) ||
                (min <= age && age <= max)
            ) {
                return true;
            }
            return false;
        });

        $(document).ready(function() {
            var table = $('#zero-config').DataTable({
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                    "<'table-responsive'tr>" +
                    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "oLanguage": {
                    "oPaginate": {
                        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                    },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50, 100],
                "pageLength": 7,
                "order": [[0, "desc"]],
                "autoWidth": false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "{{route('admin.getQueryList')}}",
                    data: function(data){
                        data.category = $('#searchByCategory').find(':selected').val();
                        data.subCategory = $('#searchBySubCategory').find(':selected').val();
                        data.reporter = $('#searchByReporter').find(':selected').val();
                        data.status = $('#searchByStatus').find(':selected').val();

                    }

                },
                "columns": [
                    {'data': 'customer'},
                    {'data': 'status'},
                    {'data': 'query_time'},
                    {'data': 'actions'},

                ]
            });
            $('#searchByCategory, #searchBySubCategory, #searchByReporter, #searchByStatus').change(function () {
                table.draw();
            });
        });



    </script>

{{--    <script>--}}

{{--        function searchCustomer(id){--}}
{{--            event.preventDefault();--}}
{{--            var customerId = id;--}}

{{--            // AJAX request--}}
{{--            $.ajax({--}}

{{--                url: '{{route('searchCustomer')}}',--}}
{{--                type: 'post',--}}
{{--                data: {_token: "{{ csrf_token() }}",customerId: customerId},--}}
{{--                success: function(response){--}}
{{--                    // Add response in Modal body--}}

{{--                    $('#customerModal .modal-body').html(response);--}}


{{--                    $('#customerModal').modal('show');--}}
{{--                },--}}
{{--                error: function (){--}}
{{--                    toastr.error("No Customer Found")--}}
{{--                }--}}
{{--            });--}}

{{--        }--}}



{{--    </script>--}}
@endsection
