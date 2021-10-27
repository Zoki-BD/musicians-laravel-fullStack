@extends('admin/master')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <section class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Добредојдовте</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('main') }}">Почетна</a></li>
{{--                            <li class="breadcrumb-item active"></li>--}}
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="card card-info card-outline">
                            {{--                <div class="card-header">--}}
                            {{--                    <h3 class="card-title">Icons</h3>--}}
                            {{--                </div> <!-- /.card-body -->--}}
                            <div class="card-body">

                                <p> Апликацијата <strong>„РЕГИСТАР НА МУЗИЧАРИ ВО РМ“</strong> служи за внесување и
                                    архивирање на податоци поврзани со музичарите и бендовите во Република Македонија.<br>
                                    Одберете активност од главното мени...</p>

                            </div><!-- /.card-body -->
                        </div>
                    </div>
                </div>



                <div class="row ">

                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                        <!-- small box -->
                        <a href="{{ url('/musicians') }}">
                            <div class="small-box bg-info background_fade">
                                <div class="inner">
                                    <h3>Музичари</h3>

                                    <p><strong>Активни:</strong> {{ $musicians_on }}<br><strong>Неактивни:</strong> {{ $musicians_off }}</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-filing"></i>
                                </div>
                                {{--<i class="fas fa-arrow-circle-right small-box-footer"></i>--}}
                            </div>
                        </a>
                    </div>


                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                        <!-- small box -->
                        <a href="{{ url('/bands') }}">
                            <div class="small-box bg-success background_fade">
                                <div class="inner">
                                    <h3>Бендови</h3>

                                    <p><strong>Активни:</strong> {{ $bands_on }}<br><strong>Неактивни:</strong> {{ $bands_off }}</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-filing"></i>
                                </div>
                                {{--<i class="fas fa-arrow-circle-right small-box-footer"></i>--}}
                            </div>
                        </a>
                    </div>


                    {{--<div class="col-lg-4 col-md-4 col-sm-6 col-12">--}}
                        {{--<!-- small box -->--}}
                            {{--<a href="{{ url('/athletes/3') }}">--}}
                            {{--<div class="small-box bg-warning background_fade">--}}
                                {{--<div class="inner">--}}
                                    {{--<h3>Спортисти</h3>--}}

                                    {{--<p><strong>Активни:</strong> {{ $athletes_on }}<br><strong>Неактивни:</strong> {{ $athletes_off }}</p>--}}
                                {{--</div>--}}
                                {{--<div class="icon">--}}
                                    {{--<i class="ion ion-person-stalker"></i>--}}
                                {{--</div>--}}
                                {{--                            <i class="fas fa-arrow-circle-right small-box-footer"></i>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--</div>--}}



{{--                </div>--}}

{{--                <div class="row">--}}

                    {{--<div class="col-lg-4 col-md-4 col-sm-6 col-12">--}}
                        {{--<!-- small box -->--}}
                        {{--<a href="{{ url('/coaches/4') }}">--}}
                            {{--<div class="small-box bg-danger background_fade">--}}
                                {{--<div class="inner">--}}
                                    {{--<h3>Тренери</h3>--}}

                                    {{--<p><strong>Активни:</strong> {{ $coaches_on }}<br><strong>Неактивни:</strong> {{ $coaches_off }}</p>--}}
                                {{--</div>--}}
                                {{--<div class="icon">--}}
                                    {{--<i class="ion ion-person-stalker"></i>--}}
                                {{--</div>--}}
                                {{--                            <i class="fas fa-arrow-circle-right small-box-footer"></i>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                     {{--<div class="col-lg-4 col-md-4 col-sm-6 col-12">--}}
                        {{--<!-- small box -->--}}
                        {{--<a href="{{ url('/judges/5') }}">--}}
                            {{--<div class="small-box bg-secondary background_fade">--}}
                                {{--<div class="inner">--}}
                                    {{--<h3>Судии</h3>--}}
                                    {{--<p><strong>Активни:</strong> {{ $judges_on }}<br><strong>Неактивни:</strong> {{ $judges_off }}</p>--}}
                                {{--</div>--}}
                                {{--<div class="icon">--}}
                                    {{--<i class="ion ion-person-stalker"></i>--}}
                                {{--</div>--}}
                                {{--                            <i class="fas fa-arrow-circle-right small-box-footer"></i>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--</div>--}}




                    {{--<div class="col-lg-4 col-md-4 col-sm-6 col-12">--}}
                    {{--<!-- small box -->--}}
                    {{--<a href="{{ url('/objects/6') }}">--}}
                        {{--<div class="small-box bg-primary background_fade">--}}
                            {{--<div class="inner">--}}
                                {{--<h3>Објекти</h3>--}}

                                {{--<p><strong>Активни:</strong> {{ $objects_on }}<br><strong>Неактивни:</strong> {{ $objects_off }}</p>--}}
                            {{--</div>--}}
                            {{--<div class="icon">--}}
                                {{--<i class="ion ion-document"></i>--}}
                            {{--</div>--}}
                            {{--                            <i class="fas fa-arrow-circle-right small-box-footer"></i>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}

            </div><!-- /.row-->







            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->


    </section>



@endsection

@section('additional_css')
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ url('LTE/plugins/ionicons/ionicons.min.css')}}">
@endsection

{{-- nz dali ovoj section dole e voopsto potreben, ili e dupli i voopsto ne se povikuva nikade --}}
@section('additional_css')
@endsection
