@extends('layouts.admin_layouts')

@section('pagespecificstyles')
    <link href="{{asset('backend/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/components/tabs-accordian/custom-accordions.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/forms/theme-checkbox-radio.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/forms/switches.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/table/datatable/dt-global_style.css')}}">

@endsection

@section('content')
    <div class="row layout-top-spacing">
        <div class="col-lg-8  layout-spacing">
            <div class="statbox widget box box-shadow">
                <div id="accordionBasic" class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Categories [Customer]</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-sm-12 mt-3 layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <div class="table-responsive mb-4 mt-4">
                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Description</th>
                                    <th class="no-content"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $cat)
                                <tr>
                                    <td>{{$cat->category_name}}</td>
                                    <td>{{$cat->description}}</td>
                                    <td>
                                        <a href="{{URL::to('admin/question/customerCategory/edit/'.$cat->id)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                        </a>
                                        <a href="{{URL::to('admin/question/customerCategory/delete/'.$cat->id)}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-4 col-4 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>@if(isset($category))Edit @else Add New @endif Category</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    @if(isset($category))
                        <form action="{{route('admin.updateCategory',$category->id)}}" method="POST" enctype="multipart/form-data">@csrf

                            @else
                                <form action="{{route('admin.storeCategory')}}" method="POST" enctype="multipart/form-data">@csrf


                                    @endif
                                    <div class="form-group mb-4">
                                        <label for="exampleFormControlInput2">Category Name</label>
                                        <input type="text" class="form-control" value="{{@$category->category_name}}" name="category_name" id="exampleFormControlInput2" placeholder="Enter Name..">
                                    </div>
                                    <div class="form-group mb-4">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="exampleFormControlInput2">Category Description</label>
                                        <input type="text" class="form-control" value="{{@$category->description}}" name="description" id="exampleFormControlInput2" placeholder="Enter Description..">
                                    </div>
                                    <div class="form-group mb-4" style="text-align: center">
                                        <input type="submit" class="btn btn-primary" value="@if(isset($category))Edit @else Add @endif">
                                    </div>

                                </form>

                </div>
            </div>
        </div>

        <div style="display: none;" class="col-lg-4 col-4 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Edit Sample Question </h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form action="{{route('admin.storeCQuestionSample')}}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="form-group mb-4">
                            <label for="exampleFormControlInput2">Question</label>
                            <input type="text" class="form-control" name="question" id="exampleFormControlInput2" placeholder="Enter Question..">
                        </div>
                        <div class="form-group mb-4">

                        </div>
                        <div class="form-group mb-4">
                            <label>Published?</label>
                            <br>
                            <label class="switch s-icons s-outline s-outline-default mr-2">

                                <input type="checkbox" name="is_published" checked>
                                <span class="slider round"></span>
                            </label>
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
