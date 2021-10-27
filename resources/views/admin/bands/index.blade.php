@extends('admin/master')

@section('content')

    <?php
//    $id_menu = Request::segment(2);
    $title = trans('properties.bands.index.title');
    $query = request()->getQueryString();
    $pageList = app('request')->input('pageList');
    if ($pageList == '') {
        $pageList = Config::get('constants.pagination');
    }
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fa fa-folder text-success"></i> {{trans('properties.bands.index.title')}} <a
                                class="btn btn-success btn-sm"
                                href="{{url('/bands/create')}}">{{trans('properties.bands.index.new')}}</a></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ url('/bands') }}">{{trans('properties.bands.index.title')}}</a></li>
                            {{--                            <li class="breadcrumb-item active"></li>--}}
                        </ol>
                    </div >

                </div>


            </div><!-- /.container-fluid -->

        </section>


        <div id="modalReact"> </div>


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <!-- Search =============================================================================================== -->
                <form class="form-horizontal" name="form_search" id="form_search" method="get" action=""
                      accept-charset="UTF-8">
                    <input type="hidden" id="page" name="page" value="{{ app('request')->input('page') }}">
                    <div class="card card-success card-outline">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-3 col-lg-1 col-xl-1">
                                    <label class="control-label">{{trans('properties.bands.index.search1')}}</label>
                                    <input type="text" id="search1" name="search1" class="form-control form-control-sm"
                                           value="{{app('request')->input('search1')}}"
                                           placeholder="{{trans('properties.bands.index.search1')}}" maxlength="10">
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-2">
                                    <label class="control-label">{{trans('properties.bands.index.search2')}}</label>
                                    <input type="text" id="search2" name="search2" class="form-control form-control-sm"
                                           value="{{app('request')->input('search2')}}"
                                           placeholder="{{trans('properties.bands.index.search2')}}" maxlength="100">
                                </div>
                                {{--<div class="col-md-3 col-lg-3 col-xl-3">--}}
                                    {{--<label class="control-label">{{trans('properties.bands.index.search3')}}</label>--}}
                                    {{--<select class="select2" id="search3" name="search3"  onchange="this.form.submit()" style="width: 100%">--}}
                                        {{--@if(count($federations) > 0)--}}
                                            {{--<option value="">&nbsp;</option>--}}
                                            {{--@foreach($federations as $federation)--}}
                                                {{--<option--}}
                                                    {{--value="{{$federation->id}}" {{ ((app('request')->input('search3'))==$federation->id)? 'selected' : '' }}>{{$federation->name}}</option>--}}
                                            {{--@endforeach--}}
                                        {{--@endif--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                                <div class="col-md-3 col-lg-2 col-xl-2">
                                    <label class="control-label">{{trans('properties.bands.index.search4')}}</label>
                                    <select class="select2 select2-lime"
                                            id="search4" name="search4" onchange="this.form.submit()"  style="width: 100%">
                                        @if(count($cities) > 0)
                                            <option value="">&nbsp;</option>
                                            @foreach($cities as $city)
                                                <option
                                                    value="{{$city->id}}" {{ ((app('request')->input('search4'))==$city->id)? 'selected' : '' }}>{{$city->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                {{--<div class="col-md-3 col-lg-2 col-xl-2">--}}
                                    {{--<label class="control-label">{{trans('properties.bands.index.search5')}}</label>--}}
                                    {{--<select class="form-control form-control-sm select2 select2-danger"--}}
                                            {{--data-dropdown-css-class="select2-danger" id="search5" name="search5" onchange="this.form.submit()"  style="width: 100%">--}}
                                        {{--@if(count($municipalities) > 0)--}}
                                            {{--<option value="">&nbsp;</option>--}}
                                            {{--@foreach($municipalities as $municipality)--}}
                                                {{--<option--}}
                                                    {{--value="{{$municipality->id}}" {{ ((app('request')->input('search5'))==$municipality->id)? 'selected' : '' }}>{{$municipality->name}}</option>--}}
                                            {{--@endforeach--}}
                                        {{--@endif--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                                <div class=" col-md-3 col-lg-1 col-xl-1">
                                    <label class="control-label">{{trans('properties.bands.index.list')}}</label>

                                    <select id="pageList" name="pageList" class="form-control form-control-sm"
                                            onchange="listSeaarch()">
                                        <option value="3" @if($pageList == 3) {{'selected'}} @endif>
                                            3
                                        </option>
                                        <option value="15" @if($pageList == 15) {{'selected'}} @endif>
                                            15
                                        </option>
                                        <option value="50" @if($pageList == 50) {{'selected'}} @endif>
                                            50
                                        </option>
                                        <option value="100" @if($pageList == 100) {{'selected'}} @endif>
                                            100
                                        </option>
                                        <option value="200" @if($pageList == 200) {{'selected'}} @endif>
                                            200
                                        </option>
                                        <option value="a" @if($pageList == 'a') {{'selected'}} @endif>
                                            {{trans('properties.bands.index.all')}}
                                        </option>
                                    </select>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-4 col-md-3 col-lg-2 col-xl-1">
                                    <label class="control-label"> &nbsp;</label>
                                    <button type="button" class="form-control form-control-sm btn btn-success btn-sm"
                                            title="{{trans('properties.bands.index.reset_button_des')}}"
                                            onClick="window.open('{{ url('/bands') }}','_self');"> {{trans('properties.bands.index.reset_button')}}
                                    </button>
                                </div>
                                <div class="col-sm-4 col-md-3 col-lg-2 col-xl-1">
                                    <label class="control-label"> &nbsp;</label>
                                    <button type="submit" class="form-control form-control-sm btn btn-danger btn-sm"
                                            title="{{trans('properties.bands.index.search_button')}} ">{{trans('properties.bands.index.search_button')}}
                                    </button>

                                </div>

                            </div>

                        </div>
                    </div>
                    </form>
                <!-- Search end=============================================================================================== -->

                        <!-- Table =============================================================================================== -->
                        <div class="card card-success card-outline">

                            <div class="card-body">
                                @include('flash::message')

                                @if(count($bands) > 0)
                                    <?php
                                   // $id_menu = Request::segment(2);
                                    $order = request()->query('order');
                                    if (request()->query('sort') == '' || request()->query('sort') == 'desc') {
                                        $sort = 'asc';
                                    } else {
                                        $sort = 'desc';
                                    }
                                    ?>
                                    <div class="dataTables_wrapper dt-bootstrap4">

                                        <!-- Page =============================================================================================== -->
                                        <div class="row">
                                            <div class="col-sm-12 col-md-5">
                                                {{trans('properties.global.show_from')}}
                                                <strong> <span
                                                        class="badge badge-warning">{{ $bands->firstItem() }}</span></strong>
                                                {{trans('properties.global.to')}}
                                                <strong> <span
                                                        class="badge badge-warning">{{$bands->lastItem() }}</span></strong>
                                                ({{trans('properties.global.sum')}}
                                                <strong> <span
                                                        class="badge badge-danger">{{ $bands->total() }}</span></strong>
                                                {{trans('properties.global.records')}})
                                            </div>
                                        </div>
                                        <!-- Page end =============================================================================================== -->


                                        <div class="row">
                                            <div class="col-sm-12 scrollmenu">


                                                <table id="example2" class="table_grid">
                                                    <thead>
                                                    <tr>
                                                        <?php
                                                        $column_name='id';
                                                        $style_acs_decs = '';

                                                        if (request()->query('sort') == '' && $order == '') {
                                                            $style_acs_decs = 'desc';
                                                        }
                                                        if (request()->query('sort') == 'desc' && $order == $column_name) {
                                                            $style_acs_decs = 'desc';
                                                        }
                                                        if (request()->query('sort') == 'asc' && $order == $column_name) {
                                                            $style_acs_decs = 'asc';
                                                        }
                                                        ?>
                                                        <th class="sortable {{$style_acs_decs}}"
                                                            onclick="orderBy({{$column_name}}','{{$sort}}')">{{trans('properties.bands.index.table_id')}}&nbsp;&nbsp;&nbsp;</th>
                                                        <?php
                                                        $column_name='name';
                                                        $style_acs_decs = '';
                                                        if (request()->query('sort') == 'desc' && $order == $column_name) {
                                                            $style_acs_decs = 'desc';
                                                        }
                                                        if (request()->query('sort') == 'asc' && $order == $column_name) {
                                                            $style_acs_decs = 'asc';
                                                        }
                                                        ?>
                                                        <th class="sortable {{$style_acs_decs}}"
                                                            onclick="orderBy('{{$column_name}}','{{$sort}}')">{{trans('properties.bands.index.table_name')}}&nbsp;&nbsp;&nbsp;</th>

                                                        {{--<?php--}}
                                                        {{--$column_name='federations_name';--}}
                                                        {{--$style_acs_decs = '';--}}
                                                        {{--if (request()->query('sort') == 'desc' && $order == $column_name) {--}}
                                                            {{--$style_acs_decs = 'desc';--}}
                                                        {{--}--}}
                                                        {{--if (request()->query('sort') == 'asc' && $order == $column_name) {--}}
                                                            {{--$style_acs_decs = 'asc';--}}
                                                        {{--}--}}
                                                        {{--?>--}}
                                                        {{--<th class="sortable {{$style_acs_decs}}"--}}
                                                            {{--onclick="orderBy('{{$column_name}}','{{$sort}}')">{{trans('properties.bands.index.table_federation')}}&nbsp;&nbsp;&nbsp;</th>--}}

                                                        <?php
                                                            $column_name='cities_name';
                                                            $style_acs_decs = '';
                                                        if (request()->query('sort') == 'desc' && $order == $column_name) {
                                                            $style_acs_decs = 'desc';
                                                        }
                                                        if (request()->query('sort') == 'asc' && $order == $column_name) {
                                                            $style_acs_decs = 'asc';
                                                        }
                                                        ?>
                                                        <th class="sortable {{$style_acs_decs}}"
                                                            onclick="orderBy('{{$column_name}}','{{$sort}}')">{{trans('properties.bands.index.table_city')}}&nbsp;&nbsp;&nbsp;</th>

                                                            {{--<?php--}}
                                                            {{--$column_name='municipalities_name';--}}
                                                            {{--$style_acs_decs = '';--}}
                                                            {{--if (request()->query('sort') == 'desc' && $order == $column_name) {--}}
                                                                {{--$style_acs_decs = 'desc';--}}
                                                            {{--}--}}
                                                            {{--if (request()->query('sort') == 'asc' && $order == $column_name) {--}}
                                                                {{--$style_acs_decs = 'asc';--}}
                                                            {{--}--}}
                                                            {{--?>--}}
                                                            {{--<th class="sortable {{$style_acs_decs}}"--}}
                                                                {{--onclick="orderBy('{{$column_name}}','{{$sort}}')">{{trans('properties.bands.index.table_municipality')}}&nbsp;&nbsp;&nbsp;</th>--}}


                                                        <th style="width: 2%"><i class="fas fa-lock"
                                                                                 title="{{trans('properties.global.deactivated')}}"></i>
                                                        </th>
                                                        <th style="width: 7%">

                                                        </th>
                                                    </tr>
                                                    </thead>


                                                    <tbody>
                                                    @foreach($bands as $band)
                                                        <tr @if($band->deactivated == 1) style="color: #cccccc" @endif>
                                                            <td>{{ $band->id }}</td>
                                                            <td>
                                                                @if (strlen(app('request')->input('search2')))
                                                                    <?php
                                                                    echo str_replace(app('request')->input('search2'), '<b style="background-color:#ffc107;color:#fff ">' . app('request')->input('search2') . '</b>', $band->name);
                                                                    ?>
                                                                @else
                                                                    {{$band->name}}
                                                                @endif
                                                            </td>
                                                            {{--<td>--}}
                                                                {{--{{$band->federations_name}}--}}
                                                            {{--</td>--}}
                                                            <td>
                                                                {{$band->cities_name}}
                                                            </td>
                                                            {{--<td>--}}
                                                                {{--{{$band->municipalities_name}}--}}
                                                            {{--</td>--}}
                                                            <td>
                                                                @if($band->deactivated == 1)
                                                                    <i class="fas fa-lock"
                                                                       title="{{trans('properties.global.deactivated')}}"></i>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="btn-group btn-group-sm">

                                                                    <button class="btn btn-info open_modal"
                                                                            onclick="getContentID('{{ $band->id }}','ModalContent','{{ $title}}','bands')">
                                                                        <i class="fas fa-eye"></i></button>
                                                                    <a href="{{ url("bands/edit/{$band->id}?{$query}") }}"
                                                                       class="btn btn-success"><i
                                                                            class="fa fa-edit"></i></a>
                                                                    <a href="#" class="btn btn-danger open_modal"
                                                                       data-toggle="modal" data-target="#ModalDel"
                                                                       data-sif="{{ $band->id }}"
                                                                       data-url="bands/delete/{{$band->id}}"
                                                                       data-params="{{$query}}"
                                                                       data-naziv="{{ $band->name }} " data-query=""
                                                                       title="{{trans('properties.global.delete')}}"><i
                                                                            class="fa fa-trash"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>


                                                </table>
                                            </div>
                                        </div>

                                        <!-- Page =============================================================================================== -->

                                        <div class="row">

                                            <div class="col-sm-6 col-md-6">

                                                <?php
                                                $query = request()->getQueryString();

                                                if (empty($query)) {
                                                    $query = 'r';
                                                }
                                                ?>
                                                    <a class="btn btn-default btn-sm"
                                                       href="{{ url(Request::segment(1)."/print/".$query) }}"
                                                       title="{{trans('properties.global.print')}}"><i
                                                            class="fa fa-print"></i> {{trans('properties.global.print')}}
                                                    </a>
                                                    <a class="btn btn-default btn-sm"
                                                       href="{{url(Request::segment(1)."/export/".$query) }}"
                                                       title="{{trans('properties.global.export')}}"><i class="fa fa-print"></i> {{trans('properties.global.export')}}
                                                    </a>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="pagination pagination-sm float-right">
                                                    {{ $bands->appends(request()->query())->links() }}
                                                </div>

                                            </div>

                                        </div>
                                        <!-- Page end =============================================================================================== -->
                                    </div>
                                @else
                                    {{trans('properties.global.no_records')}}
                                @endif

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <!-- Table end =============================================================================================== -->


            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->


    </div>

@endsection
@section('additional_css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('LTE/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ url('LTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('additional_js')
    <!-- Select2 -->
    <script src="{{url('LTE/plugins/select2/js/select2.full.min.js')}}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>
@endsection
