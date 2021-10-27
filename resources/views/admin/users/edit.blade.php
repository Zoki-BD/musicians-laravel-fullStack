@extends('admin/master')

@section('content')



    <?php
//    $id_menu = Request::segment(3);
    // $name_menu = Request::segment(1);
    $title = trans('properties.users.index.title');
    $query = request()->getQueryString();



    $user_id = (!empty($user->id)) ? $user->id :  '';
    $user_name = (!empty($user->name)) ? $user->name :  old('name');
    $user_surname = (!empty($user->surname)) ? $user->surname : old('surname');
    $user_address = (!empty($user->address)) ? $user->address : old('address');
    $user_phone = (!empty($user->phone)) ? $user->phone : old('phone');
    $user_email = (!empty($user->email)) ? $user->email : old('email');
    $user_is_admin = (!empty($user->is_admin )) ? $user->is_admin : old('email');
    $user_username = (!empty($user->username)) ? $user->username : old('username');
    $user_password = (!empty($user->password)) ? $user->password : '';

    $user_created_at = (!empty($user->created_at)) ? date("m.d.Y  H:i:s", strtotime($user->created_at)) : '';
    $user_updated_at = (!empty($user->updated_at)) ? date("m.d.Y  H:i:s", strtotime($user->updated_at)) : '';
    $user_deactivated = (!empty($user->deactivated)) ? $user->deactivated : '';


    if (empty($user_id)) {
        $action = 'users/store' ;
    } else {
        $action = 'users/update'. '/' . $user_id;
    }


    ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fa fa-users text-secondary"></i> {{trans('properties.users.index.title')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ url('/users') }}">{{trans('properties.users.index.title')}}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @include('flash::message')
                <form class="needs-validation" role="form" id="form1" name="form1"
                      action="{{ url("{$action}") }}" method="POST"
                      enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id" value="{{ $user_id }}">
                    <input type="hidden" id="query" name="query" value="{{$query}}">
                    {{csrf_field()}}
                    @method('PUT')
                    <div class="row">


                        <div class="col-md-6">

                            <!-- Errors ---------->
                            @if (count($errors) > 0)
                            <div id="toast-container" class="toast-top-full-width" onclick="closeErrorWindow(this)" >
                                <div class="toast toast-error" aria-live="assertive" style="">
                                    <div class="toast-progress" style="width:100%;"></div>
                                    <button type="button" class="close" data-dismiss="toast-top-full-width"  role="button" onclick="closeErrorWindow(this)">×</button>
                                    <div class="toast-message">
                                        <p><strong>{{__('properties.global.error')}}</strong>
                                        </p>

                                            @foreach ($errors->all() as $error)
                                            <div class="callout callout-danger" style="color: #0a0a0a!important;padding: 10px!important;">
                                                {{ $error }}
                                            </div>
                                            @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif


                            <div class="card card">

                                <div class="card-header">
                                    @if($user_deactivated==1)
                                        &nbsp;<i class="fas fa-lock text-danger"
                                                 title="{{trans('properties.global.deactivated')}}"></i>
                                    @endif
                                    <h3 class="card-title">  @if(isset($user) && !empty($user))id : {{$user_id}} @else &nbsp;@endif</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    {{--=========================================================--}}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="inputName">{{trans('properties.users.index.table_name')}}</label>
                                                <input type="text" id="name" name="name" class="form-control"
                                                       value="{{$user_name}}"
                                                       maxlength="100" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="inputName">{{trans('properties.users.index.table_surname')}}</label>
                                                <input type="text" id="surname" name="surname" class="form-control"
                                                       value="{{$user_surname}}"
                                                       maxlength="100" >
                                            </div>
                                        </div>
                                    </div>
                                    {{--=========================================================--}}
                                    <div class="form-group">
                                        <label
                                            for="inputName">{{trans('properties.users.index.table_address')}}</label>
                                        <input type="text" id="address" name="address" class="form-control"
                                               value="{{$user_address}}"
                                               maxlength="100" >
                                    </div>
                                    {{--=========================================================--}}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="inputName">{{trans('properties.users.index.table_phone')}}</label>
                                                <input type="text" id="phone" name="phone" class="form-control"
                                                       value="{{$user_phone}}"
                                                       maxlength="100">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="inputName">{{trans('properties.users.index.table_email')}}</label>
                                                <input type="text" id="email" name="email" class="form-control"
                                                       value="{{$user_email}}"
                                                       maxlength="100">
                                            </div>
                                        </div>
                                    </div>
                                    {{--=========================================================--}}


                                    {{--=========================================================--}}

                                    <div class="form-group">
                                        <label
                                                for="">{{trans('properties.users.index.table_username')}}</label>
                                        <input type="text" id="" name="username" class="form-control"
                                               value="{{$user_username}}"
                                               maxlength="100" >
                                    </div>
                                    {{--=========================================================--}}
                                    <div class="form-group">
                                        <label
                                            for="password">{{trans('properties.users.index.table_password')}}</label>
                                        <input type="password" id="password" name="password" class="form-control"
                                               value=""
                                               maxlength="100" >
                                    </div>
                                    {{--=========================================================--}}

                                    <div class="form-group">
                                        <label
                                            for="confirm-password">{{trans('properties.users.index.table_confirm_password')}}</label>
                                        <input type="password" id="confirm-password" name="confirm-password" class="form-control"
                                               value=""
                                               maxlength="100" >
                                    </div>
                                    {{--=========================================================--}}
                                    <div class="form-group">
                                        <label
                                            for="inputName">Admin</label>
                                        <select class="form-control" id="is_admin" name="is_admin">
                                            <option value="0" {{ ($user_is_admin=='0')? 'selected' : '' }}>user</option>
                                            <option value="1" {{ ($user_is_admin=='1')? 'selected' : '' }}>admin</option>
                                        </select>
                                    </div>
                                    {{--=========================================================--}}
                                    <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="deactivated"
                                               name="deactivated"
                                               OnChange="checkboxStatus(this,'deactivated_description','{{trans('properties.users.index.table_activated')}}','{{trans('properties.users.index.table_deactivated')}}')"
                                               value="1" @if($user_deactivated==0) {{'checked'}} @endif >
                                        <label for="deactivated"
                                               class="custom-control-label"
                                               id="deactivated_description">{{ ($user_deactivated==0)? trans('properties.users.index.table_activated'): trans('properties.users.index.table_deactivated') }}</label>
                                    </div>
                                    </div>
                                    {{--=========================================================--}}
                                    @if(isset($user) && !empty($user))
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group"><i class="fas fa-clock text-warning"></i>
                                                    <label
                                                        for="inputName">{{trans('properties.created_at')}}</label>
                                                    <input type="text" id="created_at" class="form-control"
                                                           value="{{ $user_created_at }}"
                                                           readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"><i class="fas fa-clock text-warning "></i>
                                                    <label
                                                        for="inputName">{{trans('properties.updated_at')}}</label>
                                                    <div class="input-group">
                                                        <input type="text" id="updated_at" class="form-control"
                                                               value="{{ $user_updated_at }}"
                                                               readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    {{--=========================================================--}}



                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit"
                                            class="btn btn-success float-right">{{trans('properties.save')}}</button>
                                </div>
                                <!-- /.card-footer -->


                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col-md-6 -->


                        <!-- /.col-md-6 -->

                    </div>
                    <!-- /.row -->
                </form>



                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </section>
        <!-- /.content -->

    </div>



@endsection

@section('additional_css')
    <!-- date-range-picker -->
    <link rel="stylesheet" href="{{ url('LTE/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('LTE/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ url('LTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ url('LTE/plugins/toastr/toastr.min.css')}}">


@endsection

@section('additional_js')

    <!-- Select2 -->
    <script src="{{url('LTE/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{url('LTE/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{url('LTE/plugins/moment/moment.min.js')}}"></script>
    <script src="{{url('LTE/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{url('LTE/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{url('LTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <style>
        .daterangepicker.single .drp-buttons {
            display: block !important;
        }
    </style>
    <script>

        $(document).ready(function () {
            bsCustomFileInput.init();
        });
        $(function () {
            //Date range picker
            $('#date_birth').daterangepicker({
                singleDatePicker: true,
                autoUpdateInput: false,
                showDropdowns: true,
                locale: {
                    format: "DD.MM.YYYY",
                    separator: " - ",
                    applyLabel: "Внеси",
                    cancelLabel: "Бриши",
                    fromLabel: "From",
                    toLabel: "To",
                    customRangeLabel: "Custom",
                    weekLabel: "W",
                    daysOfWeek: ["Не", "По", "Вт", "Ср", "Че", "Пе", "Са"],
                    monthNames: ["Јануари", "Февруари", "Март", "Април", "Мај", "Јуни", "Јули", "Август", "Септември", "Октомври", "Ноември", "Декември"],
                    firstDay: 1
                },
            })


        })

        $('input[name="date_birth"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD.MM.YYYY'));
        });

        $('input[name="date_birth"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });



        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })


    </script>

@endsection
