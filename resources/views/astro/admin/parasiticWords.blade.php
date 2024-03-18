@extends('layouts.master')
{{--@section('pagespecificstyles')--}}
{{--    <link href="{{asset('backend/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />--}}
{{--    <link href="{{asset('backend/assets/css/components/tabs-accordian/custom-accordions.css')}}" rel="stylesheet" type="text/css" />--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/forms/theme-checkbox-radio.css')}}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/forms/switches.css')}}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/datatables.css')}}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/dt-global_style.css')}}">--}}

{{--@endsection--}}
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
                            <h4>Parasitic Words</h4>
                        </div>
                    </div>
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                <tr>
                            <th>Word</th>


                            <th class="no-content"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($filterWords as $filter)
                            <tr>
                                <td>{{$filter->word}}</td>
                                <td>
                                    <a href="{{URL::to('admin/parasiteWords/delete/'.$filter->id)}}" id="delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

        <div class="col-lg-4 col-4 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Add New Word</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form action="{{route('admin.storeParasiticWord')}}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="form-group mb-4">
                            <label for="exampleFormControlInput2">Parasitic Word</label>
                            <input type="text" class="form-control" name="parasitic_word" id="exampleFormControlInput2" placeholder="Enter Word">
                        </div>

                        <div class="form-group mb-4" style="text-align: center">
                            <input type="submit" class="btn btn-primary">
                        </div>

                    </form>
                </div>
            </div>
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
        @if(Session::has('messege'))
        var type="{{Session::get('alert-type','info')}}"
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('messege') }}");
                break;
            case 'success':
                toastr.success("{{ Session::get('messege') }}");
                break;
            case 'warning':
                toastr.warning("{{ Session::get('messege') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('messege') }}");
                break;
        }
        @endif
    </script>
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

@endsection
