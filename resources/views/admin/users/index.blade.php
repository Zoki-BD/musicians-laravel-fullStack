@extends('admin/master')

@section('content')

    <?php
//    $id_menu = Request::segment(2);
    $title = trans('properties.users.index.title');
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
                        <h1><i class="fa fa-user"></i> {{trans('properties.users.index.title')}} <a class="btn btn-outline-secondary btn-sm" href="{{url('/users/create')}}">
                                {{trans('properties.users.index.new')}}</a></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/users') }}">{{trans('properties.users.index.title')}}</a></li>
                            {{--                            <li class="breadcrumb-item active"></li>--}}
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                        <!-- Search =============================================================================================== -->
                <form class="form-horizontal" name="form_search" id="form_search" method="get" action="" accept-charset="UTF-8">
                    <input type="hidden" id="page" name="page" value="{{ app('request')->input('page') }}">
                        <div class="card card card-outline">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1 col-lg-1 col-xl-1">
                                        <label class="control-label">{{trans('properties.users.index.search1')}}</label>
                                        <input type="text" id="search1" name="search1" class="form-control form-control-sm" value="{{app('request')->input('search1')}}" placeholder="{{trans('properties.users.index.search1')}}" maxlength="10">
                                    </div>
                                    <div class="col-md-4 col-lg-3 col-xl-2">
                                        <label class="control-label">{{trans('properties.users.index.search2')}}</label>
                                        <input type="text" id="search2" name="search2" class="form-control form-control-sm"  value="{{app('request')->input('search2')}}" placeholder="{{trans('properties.users.index.search2')}}" maxlength="100">
                                    </div>
                                    <div class="col-md-4 col-lg-3 col-xl-2">
                                        <label class="control-label">{{trans('properties.users.index.search3')}}</label>
                                        <input type="text" id="search3" name="search3" class="form-control form-control-sm"  value="{{app('request')->input('search3')}}" placeholder="{{trans('properties.users.index.search3')}}" maxlength="100">
                                    </div>
                                    <div class="col-md-4 col-lg-3 col-xl-2">
                                        <label class="control-label">{{trans('properties.users.index.search4')}}</label>
                                        <input type="text" id="search4" name="search4" class="form-control form-control-sm"  value="{{app('request')->input('search4')}}" placeholder="{{trans('properties.users.index.search4')}}" maxlength="100">
                                    </div>
                                    <div class="col-md-4 col-lg-3 col-xl-2">
                                        <label class="control-label">{{trans('properties.users.index.search5')}}</label>
                                        <input type="text" id="search5" name="search5" class="form-control form-control-sm"  value="{{app('request')->input('search5')}}" placeholder="{{trans('properties.users.index.search5')}}" maxlength="100">
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1">
                                        <label class="control-label">{{trans('properties.users.index.list')}}</label>

                                        <select id="pageList" name="pageList" class="form-control form-control-sm" onchange="listSeaarch()">
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
                                                {{trans('properties.federations.index.all')}}
                                            </option>
                                        </select>

                                    </div>
                                    <div class="col-sm-4 col-md-3 col-lg-2 col-xl-1">
                                        <label class="control-label"> &nbsp;</label>
                                        <button type="button" class="form-control form-control-sm btn btn-outline-secondary btn-sm"
                                                title="{{trans('properties.users.index.reset_button_des')}}"
                                                onClick="window.open('{{ url('/users') }}','_self');"> {{trans('properties.users.index.reset_button')}}
                                        </button>
                                    </div>
                                    <div class="col-sm-4 col-md-3 col-lg-2 col-xl-1">
                                        <label class="control-label"> &nbsp;</label>
                                        <button type="submit" class="form-control form-control-sm btn btn-outline-danger btn-sm"
                                                title="{{trans('properties.users.index.search_button')}} ">{{trans('properties.users.index.search_button')}}
                                        </button>

                                    </div>

                                </div>
                            </div>
                        </div>
                    <form>
                        <!-- Search end=============================================================================================== -->

                <!-- Table =============================================================================================== -->
                        <div class="card card card-outline">

                            <div class="card-body">
                                @include('flash::message')


                                @if(count($users) > 0)
                                    <?php
                                    $order =  request()->query('order') ;
                                    if (request()->query('sort')==''||request()->query('sort')=='desc') {$sort='asc';}else{$sort='desc';}
                                    ?>
                                    <div class="dataTables_wrapper dt-bootstrap4">

                                        <!-- Page =============================================================================================== -->
                                        <div class="row">
                                            <div class="col-sm-12 col-md-5">
                                                {{trans('properties.global.show_from')}}
                                                <strong> <span class="badge badge-warning">{{ $users->firstItem() }}</span></strong>
                                                {{trans('properties.global.to')}}
                                                <strong> <span class="badge badge-warning">{{$users->lastItem() }}</span></strong>
                                                ({{trans('properties.global.sum')}}
                                                <strong> <span class="badge badge-danger">{{ $users->total() }}</span></strong>
                                                {{trans('properties.global.records')}})
                                            </div>
                                        </div>
                                        <!-- Page end =============================================================================================== -->


                                        <div class="row">
                                            <div class="col-sm-12">


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
                                                        <th class="sortable {{$style_acs_decs}}" onclick="orderBy('id','{{$sort}}')">{{trans('properties.users.index.table_id')}}</th>
                                                        {{-- ========================================================================--}}
                                                        <?php
                                                        $column_name='name';
                                                        $style_acs_decs = '';
                                                        if (request()->query('sort') == 'desc' && $order == $column_name) {$style_acs_decs = 'desc';}
                                                        elseif (request()->query('sort') == 'asc' && $order == $column_name) {$style_acs_decs = 'asc';}
                                                        ?>
                                                        <th class="sortable {{$style_acs_decs}}" onclick="orderBy('{{$column_name}}','{{$sort}}')">{{trans('properties.users.index.table_name')}}&nbsp;</th>
                                                        {{-- ========================================================================--}}
                                                        <?php
                                                        $column_name='surname';
                                                        $style_acs_decs = '';
                                                        if (request()->query('sort') == 'desc' && $order == $column_name) {$style_acs_decs = 'desc';}
                                                        elseif (request()->query('sort') == 'asc' && $order == $column_name) {$style_acs_decs = 'asc';}
                                                        ?>
                                                        <th class="sortable {{$style_acs_decs}}" onclick="orderBy('{{$column_name}}','{{$sort}}')">{{trans('properties.users.index.table_surname')}}</th>
                                                        {{-- ========================================================================--}}
                                                        <?php
                                                        $column_name='email';
                                                        $style_acs_decs = '';
                                                        if (request()->query('sort') == 'desc' && $order == $column_name) {$style_acs_decs = 'desc';}
                                                        elseif (request()->query('sort') == 'asc' && $order == $column_name) {$style_acs_decs = 'asc';}
                                                        ?>
                                                        <th class="sortable {{$style_acs_decs}}" onclick="orderBy('{{$column_name}}','{{$sort}}')">{{trans('properties.users.index.table_email')}}</th>
                                                        {{-- ========================================================================--}}
                                                        <?php
                                                        $column_name='username';
                                                        $style_acs_decs = '';
                                                        if (request()->query('sort') == 'desc' && $order == $column_name) {$style_acs_decs = 'desc';}
                                                        elseif (request()->query('sort') == 'asc' && $order == $column_name) {$style_acs_decs = 'asc';}
                                                        ?>
                                                        <th class="sortable {{$style_acs_decs}}" onclick="orderBy('{{$column_name}}','{{$sort}}')">{{trans('properties.users.index.table_username')}}</th>

                                                            <th style="width: 2%"><i class="fas fa-lock"
                                                                                     title="{{trans('properties.global.deactivated')}}"></i>
                                                            </th>
                                                            <th style="width: 7%">

                                                            </th>
                                                    </tr>
                                                    </thead>


                                                    <tbody>
                                                    @foreach($users as $user)
                                                        <tr @if($user->deactivated == 1) style="color: #cccccc" @endif>
                                                            <td>{{ $user->id }}</td>
                                                            <td>

                                                                @if (strlen(app('request')->input('search2')))
                                                                    <?php
                                                                    echo str_replace(app('request')->input('search2'), '<b style="background-color:#ffc107;color:#fff ">' . app('request')->input('search2') . '</b>', $user->name);
                                                                    ?>
                                                                @else
                                                                    {{$user->name}}
                                                                @endif

                                                            </td>
                                                            <td>

                                                                @if (strlen(app('request')->input('search3')))
                                                                    <?php
                                                                    echo str_replace(app('request')->input('search3'), '<b style="background-color:#ffc107;color:#fff ">' . app('request')->input('search3') . '</b>', $user->surname);
                                                                    ?>
                                                                @else
                                                                    {{$user->surname}}
                                                                @endif

                                                            </td>
                                                            <td>
                                                                @if (strlen(app('request')->input('search4')))
                                                                    <?php
                                                                    echo str_replace(app('request')->input('search4'), '<b style="background-color:#ffc107;color:#fff ">' . app('request')->input('search4') . '</b>', $user->email);
                                                                    ?>
                                                                @else
                                                                    {{$user->email}}
                                                                @endif

                                                            </td>
                                                            <td>
                                                                @if (strlen(app('request')->input('search5')))
                                                                    <?php
                                                                    echo str_replace(app('request')->input('search5'), '<b style="background-color:#ffc107;color:#fff ">' . app('request')->input('search5') . '</b>', $user->username);
                                                                    ?>
                                                                @else
                                                                    {{$user->username}}
                                                                @endif


                                                               </td>
                                                            <td>
                                                                @if($user->deactivated == 1)
                                                                    <i class="fas fa-lock"
                                                                       title="{{trans('properties.global.deactivated')}}"></i>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="btn-group btn-group-sm">
                                                                    <a href="{{ url("users/edit/{$user->id}?{$query}") }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                                </div>
                                                                @if(\Illuminate\Support\Facades\Auth::user()->id != $user->id)
                                                                    <div class="btn-group btn-group-sm">
                                                                        <a href="#" class="btn btn-danger open_modal"
                                                                           data-toggle="modal" data-target="#ModalDel"
                                                                           data-sif="{{ $user->id }}"
                                                                           data-url="delete/{{$user->id}}"
                                                                           data-params="{{$query}}"
                                                                           data-naziv="{{ $user->surname}} {{ $user->name}}, {{ $user->username}}" data-query=""
                                                                           title="{{trans('properties.global.delete')}}"><i class="fa fa-trash"></i></a>
                                                                    </div>
                                                                @endif
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


                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="pagination pagination-sm float-right">
                                                    {{ $users->appends(request()->query())->links() }}
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
