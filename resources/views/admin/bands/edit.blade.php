@extends('admin/master')

@section('content')



    <?php
    // $id_menu = Request::segment(3);
    $name_menu = Request::segment(1);
    $title = trans('properties.bands.index.title');
    $title1 = trans('properties.musicians.index.title');
    // $title2 = trans('properties.objects.index.title');
    $query = request()->getQueryString();



    $bands_id = (!empty($bands->id)) ? $bands->id : '';
    $bands_name = (!empty($bands->name)) ? $bands->name : old('name');
    $bands_address = (!empty($bands->address)) ? $bands->address : old('address');
    $bands_phone = (!empty($bands->phone)) ? $bands->phone : old('phone');
    $bands_email = (!empty($bands->email)) ? $bands->email : old('email');

    $bands_comment = (!empty($bands->comment)) ? $bands->comment : old('comment');
    $bands_pictures = (!empty($bands->pictures)) ? $bands->pictures : old('pictures');
    $bands_created_at = (!empty($bands->created_at)) ? date("d.m.Y  H:i:s", strtotime($bands->created_at)) : '';
    $bands_updated_at = (!empty($bands->updated_at)) ? date("d.m.Y  H:i:s", strtotime($bands->updated_at)) : '';
    $bands_deactivated = (!empty($bands->deactivated)) ? $bands->deactivated : '';


    $bands_id_cities = (!empty($bands->id_cities)) ? $bands->id_cities : '';
    $bands_sex = (!empty($bands->sex)) ? $bands->sex : '';



    if (empty($bands_id)) {
        $action = 'bands/store';
    } else {
        $action = 'bands/update' . '/' .$bands_id;
        //bands_id nema navodnici posto e gore deklarirano,i se dodava kako id na url-to vo rutata
    }
    ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fa fa-folder text-green"></i> {{trans('properties.bands.index.title')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ url('/bands') }}">{{trans('properties.bands.index.title')}}</a>
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
                    <input type="hidden" id="id" name="id" value="{{ $bands_id }}">
                    <input type="hidden" id="query" name="query" value="{{$query}}">
                    {{csrf_field()}}
                    @method('PUT')
                    <div class="row">


                        <div class="col-md-6">

                            <!-- Errors ---------->
{{--                            @if (count($errors) > 0)--}}
{{--                                <div class="alert alert-danger">--}}
{{--                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>--}}
{{--                                    <p><strong>{{__('properties.global.error')}}</strong> {{__('properties.global.try_again')}}</p>--}}
{{--                                    <ul>--}}
{{--                                        @foreach ($errors->all() as $error)--}}
{{--                                            <li>{{ $error }}</li>--}}
{{--                                        @endforeach--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            @endif--}}
                            @if (count($errors) > 0)
                            <div id="toast-container" class="toast-top-full-width" onclick="closeErrorWindow(this)" >
                                <div class="toast toast-error" aria-live="assertive" style="">
                                    <div class="toast-progress" style="width:100%;"></div>
                                    <button type="button" class="close" data-dismiss="toast-top-full-width"  role="button" onclick="closeErrorWindow(this)">×</button>
                                    <div class="toast-message">
                                        <p><strong>{{__('properties.global.error')}}</strong>
{{--                                            {{__('properties.global.try_again')}}--}}
                                        </p>
{{--                                        <p>--}}
{{--                                            @foreach ($errors->all() as $error)--}}
{{--                                                <li>{{ $error }}</li>--}}
{{--                                            @endforeach--}}
{{--                                        </p>--}}
                                            @foreach ($errors->all() as $error)
                                            <div class="callout callout-danger" style="color: #0a0a0a!important;padding: 10px!important;">
                                                {{ $error }}
                                            </div>
                                            @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
{{--                            @if (count($errors) > 0)--}}
{{--                            <div id="toast-container" class="toast-top-full-width">--}}
{{--                                <div class="toast toast-error" aria-live="assertive" style="display: block;">--}}
{{--                                    <div class="toast-progress" style="width: 89.466%;"></div>--}}
{{--                                    <button type="button" class="close" data-dismiss="toast-top-full-width"  role="button">×</button>--}}
{{--                                    <div class="toast-message">--}}

{{--                                        <p><strong>{{__('properties.global.error')}}</strong> </p>--}}
{{--                                        <p>--}}
{{--                                            @foreach ($errors->all() as $error)--}}
{{--                                                <li>{{ $error }}</li>--}}
{{--                                            @endforeach--}}
{{--                                        </p>--}}


{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            @endif--}}

                            <div class="card card-green">

                                <div class="card-header">
                                    @if($bands_deactivated==1)
                                        &nbsp;<i class="fas fa-lock text-danger"
                                                 title="{{trans('properties.global.deactivated')}}"></i>
                                    @endif
                                    <h3 class="card-title">{{trans('properties.bands.index.table_id')}}: {{ $bands_id}}</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    {{--=========================================================--}}
                                    <div class="form-group">
                                        <label
                                            for="inputName">{{trans('properties.bands.index.table_name')}}</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                               placeholder="{{trans('properties.bands.index.table_name')}}"
                                               value="{{ $bands_name }}"
                                               maxlength="100" >
                                    </div>
                                    {{--=========================================================--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col-sm-6">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label--}}
                                                    {{--for="inputName">{{trans('properties.bands.index.table_federation')}}</label>--}}
                                                {{--<select class="select2bs4" style="width:100%;" id="id_federations"--}}
                                                        {{--name="id_federations">--}}
                                                    {{--@if(count($federations) > 0)--}}
                                                        {{--<option value="">&nbsp;</option>--}}
                                                        {{--@foreach($federations as $federation)--}}
                                                            {{--<option--}}
                                                                {{--value="{{$federation->id}}" {{ ($bands_id_federations==$federation->id)? 'selected' : '' }}>{{$federation->name}}</option>--}}
                                                        {{--@endforeach--}}
                                                    {{--@endif--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-sm-6">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label--}}
                                                    {{--for="inputName">{{trans('properties.bands.index.table_municipality')}}</label>--}}
                                                {{--<select class="select2bs4" style="width:100%;" id="id_municipalities"--}}
                                                        {{--name="id_municipalities">--}}
                                                    {{--@if(count($municipalities) > 0)--}}
                                                        {{--<option value="">&nbsp;</option>--}}
                                                        {{--@foreach($municipalities as $municipality)--}}
                                                            {{--<option--}}
                                                                {{--value="{{$municipality->id}}" {{ ($bands_id_municipalities==$municipality->id)? 'selected' : '' }}>{{$municipality->name}}</option>--}}
                                                        {{--@endforeach--}}
                                                    {{--@endif--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--=========================================================--}}

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="inputName">{{trans('properties.bands.index.table_city')}}</label>
                                                <select class="select2bs4" style="width:100%;" id="id_cities"
                                                        name="id_cities">
                                                    @if(count($cities) > 0)
                                                        <option value="">&nbsp;</option>
                                                        @foreach($cities as $city)
                                                            <option
                                                                value="{{$city->id}}" {{ ($bands_id_cities==$city->id)? 'selected' : '' }}>{{$city->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="inputName">{{trans('properties.bands.index.table_sex')}}</label>
                                                <select class="select2bs4" style="width:100%;" id="sex"
                                                        name="sex">

                                                        <option value="">&nbsp;</option>
                                                        <option value="M" {{ ($bands_sex=='M')? 'selected' : '' }}>Мажи</option>
                                                        <option value="F" {{ ($bands_sex=='F')? 'selected' : '' }}>Жени</option>


                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{--=========================================================--}}

                                    {{--<?php--}}
                                    {{--$myArray = json_decode(json_encode($bands_category_age), true);--}}
                                    {{--//                                    var_dump($myArray);--}}
                                    {{--?>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label>{{trans('properties.bands.index.table_category_age')}}</label>--}}
                                        {{--<select class="select2bs4" multiple="multiple"--}}
                                                {{--style="width: 100%;" id="category_age[]" name="category_age[]" autocomplete="off">--}}
                                            {{--@if(count($category_age) > 0)--}}
                                                {{--@foreach($category_age as $category_age_)--}}
                                                    {{--<option--}}
                                                        {{--value="{{$category_age_->id}}" {{ ((array_search($category_age_->id, array_column($myArray, 'id_category_age', 'name')))!=false)? 'selected' : '' }}>{{$category_age_->name}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--@endif--}}
                                        {{--</select>--}}
                                    {{--</div>--}}

                                    {{--=========================================================--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col-sm-6">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label--}}
                                                    {{--for="inputName">{{trans('properties.bands.index.table_date_registration')}}</label>--}}
                                                {{--<div class="input-group">--}}
                                                    {{--<div class="input-group-prepend">--}}
                                                    {{--<span class="input-group-text"><i--}}
                                                            {{--class="far fa-calendar-alt"></i></span>--}}
                                                    {{--</div>--}}
                                                    {{--<input type="text" id="date_registration" name="date_registration" class="form-control"--}}
                                                           {{--value="{{ $bands_date_registration }}"--}}
                                                           {{--readonly>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

                                        {{--<div class="col-sm-6">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label--}}
                                                    {{--for="inputName">{{trans('properties.bands.index.table_number_conclusion')}}</label>--}}
                                                {{--<input type="text" id="number_conclusion" name="number_conclusion" class="form-control"--}}
                                                       {{--placeholder="{{trans('properties.bands.index.table_number_conclusion')}}"--}}
                                                       {{--value="{{ $bands_number_conclusion }}"--}}
                                                       {{--maxlength="100">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--=========================================================--}}
                                    {{--<div class="row" style="margin-bottom: 15px">--}}
                                        {{--<div class="col-sm-6">--}}
                                            {{--<div class="custom-control custom-checkbox">--}}
                                                {{--<input class="custom-control-input" type="checkbox" id="national"--}}
                                                       {{--name="national"--}}
                                                       {{--value="1" @if($bands_national==1) {{'checked'}} @endif >--}}
                                                {{--<label for="national"--}}
                                                       {{--class="custom-control-label"--}}
                                                       {{--id="national_description">{{trans('properties.bands.index.table_national') }}</label>--}}
                                            {{--</div>--}}
                                            {{--<div class="custom-control custom-checkbox">--}}
                                                {{--<input class="custom-control-input" type="checkbox" id="international"--}}
                                                       {{--name="international"--}}
                                                       {{--value="1" @if($bands_international==1) {{'checked'}} @endif >--}}
                                                {{--<label for="international"--}}
                                                       {{--class="custom-control-label"--}}
                                                       {{--id="national_description">{{trans('properties.bands.index.table_international') }}</label>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--=========================================================--}}
                                    <!-- {{--<?php--}}

                                    {{--$myArray = json_decode(json_encode($bands_objects), true);--}}
                                    {{--//var_dump($myArray);--}}
                                    {{--//var_dump(array_column($myArray, 'id', 'name'));--}}
                                    {{--?>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label>{{trans('properties.bands.index.table_objects')}}</label>--}}
                                        {{--<select class="select2bs4" multiple="multiple"--}}
                                                {{--style="width: 100%;" id="objects[]" name="objects[]" autocomplete="off">--}}
                                            {{--@if(count($objects) > 0)--}}
                                                {{--@foreach($objects as $object)--}}
                                                    {{--<option--}}
                                                        {{--value="{{$object->id}}" {{ ((array_search($object->id, array_column($myArray, 'id', 'name')))!=false)? 'selected' : '' }}>{{$object->name}}, {{$object->municipalities_name}}  ({{$object->objects_types_name}})   </option>--}}
                                                {{--@endforeach--}}
                                            {{--@endif--}}
                                        {{--</select>--}}


                                    {{--</div>--}} -->

                                    {{--=========================================================--}}
                                    <div class="form-group"><i class="fas fa-comment text-warning "></i>
                                        <label>{{trans('properties.bands.index.table_comment')}}</label>
                                        <textarea class="form-control" id="comment" name="comment"  rows="3"
                                                  placeholder="">{{$bands_comment}}</textarea>
                                    </div>
                                    {{--=========================================================--}}



                                    
<!-- _______________________________________________________________________________________________________________________________________________________________________________________ -->
                                    <!-- Ova e pole koe ke dade opcii da se odberat kolku sakame gradovi preku dropdown i koi so snimi ke se vnesat vo tabelata bands_cities -->
                                   <?php
                                       $myArray = json_decode(json_encode($bands_cities), true);
                                   ?>
                                   <div class="form-group">
                                        <label>Градови каде свиреле</label>
                                        <select class="select2bs4" multiple="multiple"
                                                style="width: 100%;" id="cities[]" name="cities[]" autocomplete="off">
                                            @if(count($cities) > 0)
                                                @foreach($cities as $city)
                                                    <option
                                                        value="{{$city->id}}"}>{{$city->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>


                                    </div>



<!-- _______________________________________________________________________________________________________________________________________________________________________________________ -->



                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group"><i class="fas fa-clock text-warning"></i>
                                                <label
                                                    for="inputName">{{trans('properties.bands.index.table_created_at')}}</label>
                                                <input type="text" id="created_at" class="form-control"
                                                       value="{{ $bands_created_at }}"
                                                       readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"><i class="fas fa-clock text-warning "></i>
                                                <label
                                                    for="inputName">{{trans('properties.bands.index.table_updated_at')}}</label>
                                                <div class="input-group">
                                                    <input type="text" id="updated_at" class="form-control"
                                                           value="{{ $bands_updated_at }}"
                                                           readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--=========================================================--}}

                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="deactivated"
                                               name="deactivated"
                                               OnChange="checkboxStatus(this,'deactivated_description','{{trans('properties.bands.index.table_activated')}}','{{trans('properties.bands.index.table_deactivated')}}')"
                                               value="1" @if($bands_deactivated==0) {{'checked'}} @endif >
                                        <label for="deactivated"
                                               class="custom-control-label"
                                               id="deactivated_description">{{ ($bands_deactivated==0)? trans('properties.bands.index.table_activated'): trans('properties.bands.index.table_deactivated') }}</label>
                                    </div>
                                    {{--=========================================================--}}

                                </div>
                                <!-- /.card-body -->
                            {{--                            <div class="card-footer">--}}


                            {{--                            </div>--}}
                            <!-- /.card-footer -->


                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col-md-6 -->

                        <div class="col-md-6">
                            <div class="card card-green">

                                <div class="card-header">
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <!-- /.card-header -->

                                <div class="card-body">
                                    {{--=========================================================--}}

                                    <div class="form-group">
                                        <label
                                            for="inputName">{{trans('properties.bands.index.table_address')}}</label>
                                        <input type="text" id="address" name="address" class="form-control"
                                               value="{{ $bands_address}}"
                                               maxlength="100">
                                    </div>
                                    {{--=========================================================--}}
                                    <div class="form-group">
                                        <label
                                            for="inputName">{{trans('properties.bands.index.table_phone')}}</label>
                                        <input type="text" id="phone" name="phone" class="form-control"
                                               value="{{ $bands_phone }}"
                                               maxlength="100">
                                    </div>
                                    {{--=========================================================--}}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="inputName">{{trans('properties.bands.index.table_email')}}</label>
                                                <div class="input-group">
                                                    <input type="text" id="email" name="email"  class="form-control"
                                                           value="{{ $bands_email }}"
                                                           maxlength="100">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="inputName">{{trans('properties.bands.index.table_url')}}</label>
                                                <input type="text" id="url" name="url" class="form-control"
                                                       value="url treba ovde"
                                                       maxlength="100">
                                            </div>
                                        </div>
                                    </div>
                                    {{--=========================================================--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col-sm-6">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label--}}
                                                    {{--for="inputName">{{trans('properties.bands.index.table_president')}}</label>--}}
                                                {{--<div class="input-group">--}}
                                                    {{--<input type="text" id="president" name="president"  class="form-control"--}}
                                                           {{--value="{{ $bands_president }}"--}}
                                                           {{--maxlength="100">--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

                                        {{--<div class="col-sm-6">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label--}}
                                                    {{--for="inputName">{{trans('properties.bands.index.table_president_vice')}}</label>--}}
                                                {{--<input type="text" id="president_vice" name="president_vice"  class="form-control"--}}
                                                       {{--value="{{ $bands_president_vice }}"--}}
                                                       {{--maxlength="100">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--=========================================================--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col-sm-6">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label--}}
                                                    {{--for="inputName">{{trans('properties.bands.index.table_secretary')}}</label>--}}
                                                {{--<input type="text" id="secretary" name="secretary"  class="form-control"--}}
                                                       {{--value="{{ $bands_secretary }}"--}}
                                                       {{--maxlength="100">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-sm-6">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label--}}
                                                    {{--for="inputName">{{trans('properties.bands.index.table_person_technical')}}</label>--}}
                                                {{--<div class="input-group">--}}
                                                    {{--<input type="text" id="person_technical" name="person_technical" class="form-control"--}}
                                                           {{--value="{{ $bands_person_technical }}"--}}
                                                           {{--maxlength="100">--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--=========================================================--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col-sm-6">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label--}}
                                                    {{--for="inputName">{{trans('properties.bands.index.table_person_expert')}}</label>--}}
                                                {{--<div class="input-group">--}}
                                                    {{--<input type="text" id="person_expert" name="person_expert" class="form-control"--}}
                                                           {{--value="{{ $bands_person_expert }}"--}}
                                                           {{--maxlength="100">--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

                                    {{--</div>--}}
                                    {{--=========================================================--}}


                                    {{--<div class="form-group">--}}
                                        {{--<label>Градови каде настапуваат</label>--}}
                                        {{--<select class="select2bs4" multiple="multiple" style="width:100%;" id="id_cities"--}}
                                                {{--name="id_cities">--}}
                                            {{--@if(count($cities) > 0)--}}
                                                {{--<option value="">&nbsp;</option>--}}
                                                {{--@foreach($cities as $city)--}}
                                                    {{--<option--}}
                                                            {{--value="{{$city->id}}" {{ ($bands_id_cities==$city->id)? 'selected' : '' }}>{{$city->name}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--@endif--}}
                                        {{--</select>--}}
                                   {{--<div>--}}
                                        {{--<?php--}}
                                        {{--$myArray = json_decode(json_encode($bands_cities), true);--}}
                                        {{--?>--}}

                                       {{--<label>Градови каде настапуваат</label>--}}
                                        {{--<select class="select2bs4" multiple="multiple"--}}
                                                {{--style="width: 100%;" id="cities[]" name="cities[]" autocomplete="off">--}}
                                            {{--@if(count($cities) > 0)--}}
                                                {{--@foreach($cities as $city)--}}
                                                    {{--<option value="{{$city->id}}"--}}
                                                            {{--{{ ((array_search($city->id, array_column($myArray, 'id_cities', 'name')))!=false)? 'selected' : '' }}>--}}
                                                        {{--{{$city->name}}--}}
                                                    {{--</option>--}}
                                                {{--@endforeach--}}
                                            {{--@endif--}}
                                        {{--</select>--}}
                                    {{--</div>--}}


                                    {{--OBID DA IMAME preku hasMany genres tabelata samo ama neuspesno, Treba relaciona tabela
                                    kako kaj bands_cities. Vaka samo show go upotrebivme i funkcionirase--}}

                                    {{--<?php--}}
                                    {{--$myArray1 = json_decode(json_encode($genres), true);--}}
                                    {{--?>--}}
                                    {{--<label>Вид на музика што свират</label>--}}


                                    {{--<select class="select2bs4" multiple="multiple"--}}
                                          {{--style="width: 100%;" id="genres[]" name="genres[]" autocomplete="off">--}}
                                         {{--@if(count($genresAll) > 0)--}}
                                            {{--@foreach($genresAll as $genre)--}}
                                                   {{--<option--}}
                                                      {{--value="{{$genre->id}}" {{ ((array_search($genre->id, array_column($myArray1, 'id_genres', 'name')))!=false)? 'selected' : '' }}>{{$genre->name}}--}}
                                                   {{--</option>--}}

                                                 {{--@endforeach--}}
                                             {{--@endif--}}
                                    {{--</select>--}}


                                {{--</div>--}}








                            </div>


                                        {{--=========================================================--}}

                                    <div class="form-group">
                                        <label>{{trans('properties.bands.index.table_pictures')}}</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="pictures" name="pictures"
                                                       onchange="checkImage(this,'{{trans('auth.to_large')}}','{{trans('auth.ext_check_img')}}')" autocomplete="off">
                                                <label class="custom-file-label" id="custom-file-label"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <!--   ================================================================================-->
                                    @php ($css='display: none')
                                    @php ($src='')
                                    @if(!empty($bands_pictures))
                                        {{$css=''}}
                                        @php ( $src='upload/bands/'. $bands_id.'/'. $bands_pictures)
                                    @endif
                                    <input type="hidden" id="file_source_1" name="file_source_1"
                                           value="{{$bands_pictures}}"  autocomplete="off">
                                    <div class="form-group" id="pictures_content" name="pictures_content"
                                         style=" {{$css}}">
                                        <?php //echo $_SERVER["HTTP_HOST"].parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);?>
                                        <?php

                                        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                                        $domainName = $_SERVER['HTTP_HOST'];
                                        //echo $protocol.$domainName.parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH).$bands->pictures;
                                        $domain = $protocol . $domainName;
                                        ?>
                                        <div class="time-label">
                                            <img id="upload_image" class="img-circle img-bordered-sm open_modal2"
                                                 src="{{asset($src)}}"
                                                 width="70px" height="70px" alt="image" data-toggle="modal"
                                                 data-url="{{$domain}}/upload/bands/{{ $bands_id}}/{{ $bands_pictures}}"
                                                 data-title="{{ $bands_pictures}}"
                                                 data-target="#ModalPicture"
                                                 title="{{ $bands_pictures}}"
                                                 style="cursor: pointer">
                                            <a href="#" class="btn btn-danger btn-xs open_modal"
                                                    onclick="delPhoto()">
                                                <i class="fas fa-trash"></i> {{trans('properties.global.delete_pictures')}}</a>
                                        </div>


                                    </div>

                                    {{--                                    @endif--}}
                                <!--   ================================================================================-->
                                    {{--=========================================================--}}






                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit"
                                            class="btn btn-success float-right">{{trans('properties.global.save')}}</button>
                                </div>


                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col-md-6 -->




                        {{--<div class="col-md-6">--}}
                            {{--<div class="card card-primary">--}}
                                {{--<div class="card-header">--}}
                                    {{--<h3 class="card-title">{{trans('properties.bands.index.table_objects')}}--}}
                                        {{--@if(count($bands_objects) > 0)--}}

                                            {{--(вкупно: {{count($bands_objects)}})--}}

                                        {{--@else--}}
                                            {{--(вкупно: 0)--}}
                                        {{--@endif--}}
                                    {{--</h3>--}}

                                {{--</div>--}}


                                {{--@if(count($bands_objects) > 0)--}}
                                    {{--<div class="card-body p-0">--}}
                                        {{--<table class="table">--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($bands_objects as $bands_object)--}}
                                                {{--<tr>--}}
                                                    {{--<td>--}}
                                                        {{--<a href="#"--}}
                                                           {{--onclick="getContentID('{{ $bands_object->id }}','{{ $id_menu }}','ModalContent','{{ $title2}}','objects')"--}}
                                                           {{--class="btn-link text-secondary">{{$loop->iteration}}. {{$bands_object->name}}, {{$bands_object->municipalities_name}}  ({{$bands_object->objects_types_name}})   </a>--}}
                                                    {{--</td>--}}

                                                {{--</tr>--}}
                                            {{--@endforeach--}}

                                            {{--</tbody>--}}
                                        {{--</table>--}}
                                    {{--</div>--}}
                                {{--@else--}}
                                    {{--<div class="card-body">--}}
                                        {{--{{trans('properties.bands.index.table_objects_no')}}--}}
                                    {{--</div>--}}
                                {{--@endif--}}


                            {{--</div>--}}
                        {{--</div>--}}












                    </div>
                    <!-- /.row -->
                </form>


                {{--<div class="row">--}}
                    {{--<div class="col-md-6">--}}
                        {{--<div class="card card-green">--}}

                            {{--<div class="card-header">--}}
                                {{--<h3 class="card-title">{{trans('properties.global.documents')}}--}}

                                    {{--<div class="btn-group btn-group-sm">--}}
                                        {{--@if (!empty($bands_id))--}}
                                        {{--<a href="#" class="btn btn-warning btn-xs open_modal1"--}}
                                           {{--data-toggle="modal" data-target="#ModalDoc"--}}
                                           {{--data-edit_title="{{trans('properties.global.documents_new_title')}}"--}}
                                           {{--data-id_doc=""--}}
                                           {{--data-id="{{$bands_id}}"--}}
                                           {{--data-name=""--}}
                                           {{--data-id_menu="{{$id_menu}}"--}}
                                           {{--data-name_menu="{{$name_menu}}"--}}
                                           {{--data-query="{{$query}}"--}}
                                           {{--data-name_file=""--}}
                                           {{--data-file_source=""--}}
                                           {{--data-css="needs-validation"--}}
                                           {{--data-url="/documents_store/{{$name_menu }}/{{$id_menu }}/{{$bands_id}}"--}}
                                           {{--title="{{trans('properties.global.new')}}"><i class="fa fa-plus"></i></a>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                {{--</h3>--}}
                                {{--<div class="card-tools">--}}
                                    {{--<button type="button" class="btn btn-tool" data-card-widget="collapse"--}}
                                            {{--data-toggle="tooltip" title="Collapse">--}}
                                        {{--<i class="fas fa-minus"></i></button>--}}
                                {{--</div>--}}
                            {{--</div>--}}

{{--                            @if(!empty($documents))--}}
                            {{--@if(count($documents) > 0)--}}


                                {{--<div class="card-body p-0 scrollmenu">--}}
                                    {{--<table class="table">--}}
                                        {{--<thead>--}}
                                        {{--<tr>--}}
                                            {{--<th>{{trans('properties.global.documents_id')}}</th>--}}
                                            {{--<th>{{trans('properties.global.documents_name')}}</th>--}}
                                            {{--<th>{{trans('properties.global.documents_file')}}</th>--}}
                                            {{--<th></th>--}}
                                        {{--</tr>--}}
                                        {{--</thead>--}}
                                        {{--<tbody>--}}
                                        {{--@foreach($documents as $document)--}}

                                            {{--<?php--}}
                                            {{--$document_id = (!empty($document->id)) ? $document->id : '';--}}
                                            {{--$document_name = (!empty($document->name)) ? $document->name : '';--}}
                                            {{--$document_file = (!empty($document->file)) ? $document->file : '';--}}

                                            {{--$array = explode('.', $document_file);--}}
                                            {{--$extension = end($array);--}}
                                            {{--// echo $extension;--}}
                                            {{--if ($extension == 'pdf' || $extension == 'PDF') {--}}
                                                {{--$style = 'fa-file-pdf';--}}
                                            {{--} elseif ($extension == 'doc' || $extension == 'DOC' || $extension == 'docx' || $extension == 'DOCX') {--}}
                                                {{--$style = 'fa-file-word';--}}
                                            {{--} elseif ($extension == 'xls' || $extension == 'XLS' || $extension == 'xlsx' || $extension == 'XLSX') {--}}
                                                {{--$style = 'fa-file-excel';--}}
                                            {{--} else {--}}
                                                {{--$style = 'fa-file';--}}
                                            {{--}--}}
                                            {{--?>--}}

                                            {{--<tr>--}}
                                                {{--<td>{{ $document_id}}</td>--}}
                                                {{--<td>{{ $document_name}}</td>--}}
                                                {{--<td>--}}
                                                    {{--<a href="{{ asset('upload/bands/'. $bands_id.'/'. $document_file)}}"--}}
                                                       {{--class="btn-link text-secondary"><i--}}
                                                            {{--class="far fa-fw {{ $style}}"></i>{{ $document->file}}</a>--}}
                                                {{--</td>--}}
                                                {{--<td class="text-right py-0 align-middle">--}}
                                                    {{--<div class="btn-group btn-group-sm">--}}

                                                        {{--<a href="#" class="btn btn-success open_modal1"--}}
                                                           {{--data-toggle="modal" data-target="#ModalDoc"--}}
                                                           {{--data-edit_title="{{trans('properties.global.documents_edit_title')}}"--}}
                                                           {{--data-id_doc="{{$document_id}}"--}}
                                                           {{--data-id="{{$bands_id}}"--}}
                                                           {{--data-name="{{$document_name}}"--}}
                                                           {{--data-id_menu="{{$id_menu}}"--}}
                                                           {{--data-name_menu="{{$name_menu}}"--}}
                                                           {{--data-query="{{$query}}"--}}
                                                           {{--data-name_file="{{ $document_name }} ({{ $document_file }})"--}}
                                                           {{--data-file_source="({{ $document_file }})"--}}
                                                           {{--data-url="/documents_update/{{$name_menu }}/{{$id_menu }}/{{$bands_id}}/{{$document_id}}"--}}
                                                           {{--title="{{trans('properties.global.edit')}}"><i--}}
                                                                {{--class="fa fa-edit"></i></a>--}}

                                                        {{--<a href="#" class="btn btn-danger open_modal"--}}
                                                           {{--data-toggle="modal" data-target="#ModalDel"--}}
                                                           {{--data-sif="{{ $document->id }}"--}}
                                                           {{--data-url="/documents_delete/{{$name_menu }}/{{$id_menu }}/{{$bands_id}}/{{$document_id}}"--}}
                                                           {{--data-params="{{$query}}"--}}
                                                           {{--data-naziv="{{ $document_name }} ({{ $document_file }}) "--}}
                                                           {{--data-query=""--}}
                                                           {{--title="{{trans('properties.global.delete')}}"><i--}}
                                                                {{--class="fa fa-trash"></i></a>--}}
                                                    {{--</div>--}}
                                                {{--</td>--}}

                                        {{--@endforeach--}}
                                        {{--</tbody>--}}
                                    {{--</table>--}}

                                {{--</div>--}}
                            {{--@else--}}
                                {{--<div class="card-body">--}}
                                    {{--@if(!empty($bands_id))--}}
                                        {{--{{trans('properties.global.no_documents')}}--}}
                                    {{--@else--}}
                                        {{--{{trans('properties.global.no_documents_no_record')}}--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--@endif--}}
{{--                            @endif--}}

                        {{--</div>--}}
                        {{--<!-- /.card -->--}}
                    {{--</div>--}}
                    {{--<!-- /.col-md-6 -->--}}
                    {{--@if(count($athletes) > 0)--}}
                    {{--<div class="col-md-6">--}}
                        {{--<div class="card card-warning">--}}
                            {{--<div class="card-header">--}}
                                {{--<h3 class="card-title">{{trans('properties.bands.index.table_athletes')}}--}}
                                    {{--@if(count($athletes) > 0)--}}

                                        {{--(вкупно: {{count($athletes)}})--}}

                                    {{--@else--}}
                                        {{--(вкупно: 0)--}}
                                    {{--@endif--}}
                                {{--</h3>--}}

                            {{--</div>--}}


                            {{--@if(count($athletes) > 0)--}}
                                {{--<div class="card-body p-0">--}}
                                    {{--<table class="table">--}}
                                        {{--<tbody>--}}
                                        {{--@foreach($athletes as $athlete)--}}
                                            {{--<tr>--}}
                                                {{--<td>--}}
                                                    {{--<a href="#"--}}
                                                       {{--onclick="getContentID('{{ $athlete->id }}','{{ $id_menu }}','ModalContent','{{ $title1 }}','athletes')"--}}
                                                       {{--class="btn-link text-secondary">{{$loop->iteration}}. {{$athlete->surname}}, {{$athlete->name}}</a>--}}
                                                {{--</td>--}}

                                            {{--</tr>--}}
                                        {{--@endforeach--}}

                                        {{--</tbody>--}}
                                    {{--</table>--}}
                                {{--</div>--}}
                            {{--@else--}}
                                {{--<div class="card-body">--}}
                                    {{--{{trans('properties.bands.index.table_no_athletes')}}--}}
                                {{--</div>--}}
                            {{--@endif--}}


                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endif--}}

                    {{--<!-- /.col-md-6 -->--}}

                {{--</div>--}}
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
            $('#date_registration').daterangepicker({
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

        $('input[name="date_registration"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD.MM.YYYY'));
        });

        $('input[name="date_registration"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });



        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })


    </script>

@endsection
