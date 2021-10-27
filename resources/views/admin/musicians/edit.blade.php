@extends('admin/master')

@section('content')



    <?php
    //$id_menu = Request::segment(3);// posto ne koristime id na menijata kako kaj sportregistar ova e nebitno vo nasata aplikacija
    $name_menu = Request::segment(1); //go dobivame prviot zbor posle localhost brojceto t.e koga ima 127.0.0.1:8000/musicians/create -fakjame 'musicians'
    $title = trans('properties.musicians.index.title');
    $query = request()->getQueryString();



    $musicians_id = (!empty($musicians->id)) ? $musicians->id : '';
    $musicians_name = (!empty($musicians->name)) ? $musicians->name : old('name');
    $musicians_surname = (!empty($musicians->surname)) ? $musicians->surname : old('surname');
    $musicians_date_birth = (!empty($musicians->date_birth)) ? date("d.m.Y", strtotime($musicians->date_birth)) : old('date_birth');
    $musicians_email = (!empty($musicians->email)) ? $musicians->email : old('email');
    $musicians_id_cities = (!empty($musicians->id_cities)) ? $musicians->id_cities :  old('id_cities');

    $musicians_id_instruments = (!empty($musicians->id_instruments)) ? $musicians->id_instruments : old('id_instruments');
    $musicians_id_bands = (isset($musicians->id_bands)) ? $musicians->id_bands : old('id_bands');
   // $musicians_id_category_age = (!empty($musicians->id_category_age)) ? $musicians->id_category_age : old('id_category_age');

    //$musicians_club_international = (!empty($musicians->club_international)) ? $musicians->club_international : old('club_international');
    $musicians_sex = (!empty($musicians->sex)) ? $musicians->sex :  old('sex');

    $musicians_comment = (!empty($musicians->comment)) ? $musicians->comment : old('comment');
    $musicians_pictures = (!empty($musicians->pictures)) ? $musicians->pictures : old('pictures');
    $musicians_created_at = (!empty($musicians->created_at)) ? date("d.m.Y  H:i:s", strtotime($musicians->created_at)) : '';
    $musicians_updated_at = (!empty($musicians->updated_at)) ? date("d.m.Y  H:i:s", strtotime($musicians->updated_at)) : '';
    $musicians_deactivated = (!empty($musicians->deactivated)) ? $musicians->deactivated : '';

    //echo $musicians_deactivated;die();
    if (empty($musicians_id)) {
        $action = 'musicians/store ';
    } else {
        $action = 'musicians/update' . '/' .$musicians_id;
    }

    ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fa fa-users text-warning"></i> {{trans('properties.musicians.index.title')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ url('/musicians') }}">{{trans('properties.musicians.index.title')}}</a>
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
                    <input type="hidden" id="id" name="id" value="{{ $musicians_id }}">
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


                            <div class="card card-warning">

                                <div class="card-header">
                                    @if($musicians_deactivated==1)
                                        &nbsp;<i class="fas fa-lock text-danger"
                                                 title="{{trans('properties.global.deactivated')}}"></i>
                                    @endif
                                    <h3 class="card-title">{{trans('properties.musicians.index.table_id')}}: {{ $musicians_id}}</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">




                                    {{--=========================================================--}}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="inputName">{{trans('properties.musicians.index.table_name')}}</label>
                                                <input type="text" id="name" name="name" class="form-control" onclick="test()"
                                                       placeholder="{{trans('properties.musicians.index.table_name')}}"
                                                       value="{{ $musicians_name }}"
                                                       maxlength="100">
                                            </div>
                                        </div>
                                            <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="inputName">{{trans('properties.musicians.index.table_surname')}}</label>
                                                <input type="text" id="surname" name="surname" class="form-control"
                                                       placeholder="{{trans('properties.musicians.index.table_surname')}}"
                                                       value="{{ $musicians_surname }}"
                                                       maxlength="100">
                                            </div>
                                        </div>
                                    </div>
                                    {{--=========================================================--}}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="inputName">{{trans('properties.musicians.index.table_date_birth')}}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="far fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="text" id="date_birth" name="date_birth" class="form-control"
                                                           value="{{ $musicians_date_birth }}"
                                                           readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="inputName">{{trans('properties.musicians.index.table_city')}}</label>
                                                <select class="select2bs4" style="width:100%;" id="id_cities"
                                                        name="id_cities">
                                                    @if(count($cities) > 0)
                                                        <option value="">&nbsp;</option>
                                                        @foreach($cities as $city)
                                                            <option
                                                                value="{{$city->id}}" {{ ($musicians_id_cities == $city->id)? 'selected' : '' }}>{{$city->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{--=========================================================--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col-sm-6">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label--}}
                                                    {{--for="inputName">{{trans('properties.musicians.index.table_category_age')}}</label>--}}
                                                {{--<select class="select2bs4" style="width:100%;" id="id_category_age"--}}
                                                        {{--name="id_category_age">--}}
                                                    {{--@if(count($category_age_all) > 0)--}}
                                                        {{--<option value="">&nbsp;</option>--}}
                                                        {{--@foreach($category_age_all as $category_age_all_)--}}
                                                            {{--<option--}}
                                                                {{--value="{{$category_age_all_->id}}" {{ ($musicians_id_category_age==$category_age_all_->id)? 'selected' : '' }}>{{$category_age_all_->name}}</option>--}}
                                                        {{--@endforeach--}}
                                                    {{--@endif--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="inputName">{{trans('properties.musicians.index.table_email')}}</label>
                                                <div class="input-group">
                                                    <input type="text" id="email" name="email"  class="form-control"
                                                           value="{{ $musicians_email }}"
                                                           maxlength="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--=========================================================--}}


                                  
                                  <!-- REACT calendar e dole -->
                                  <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="inputName">React Birth Date</label>

                                                <div id="calendar">
                                                   
                                                </div>
                                           </div>
                                        </div>
                                   </div>
                                    <!-- do ovde e calendarot -->



                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="inputName">{{trans('properties.musicians.index.table_instrument')}}</label>
                                                <select class="select2bs4" style="width:100%;" id="id_instruments"
                                                        name="id_instruments">
                                                    @if(count($instruments) > 0)
                                                        <option value="">&nbsp;</option>
                                                        @foreach($instruments as $instrument)
                                                            <option
                                                                value="{{$instrument->id}}" {{ ($musicians_id_instruments==$instrument->id)? 'selected' : '' }}>{{$instrument->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="inputName">{{trans('properties.musicians.index.table_sex')}}</label>
                                                <select class="select2bs4" style="width:100%;" id="sex"
                                                        name="sex">
                                                    <option value="">&nbsp;</option>
                                                    <option value="M" {{ ($musicians_sex=='M')? 'selected' : '' }}>{{trans('properties.musicians.index.table_sex_m')}}</option>
                                                    <option value="F" {{ ($musicians_sex=='F')? 'selected' : '' }}>{{trans('properties.musicians.index.table_sex_f')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{--=========================================================--}}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="inputName">{{trans('properties.musicians.index.table_band')}}</label>
                                                <select class="select2bs4" style="width:100%;" id="id_bands"
                                                        name="id_bands" onchange="changeInternationalClub(this.value)">
                                                    @if(count($bands) > 0)
                                                        <option value="">&nbsp;</option>
                                                        <option value="0"  {{ ($musicians_id_bands=='0') ? 'selected' : '' }}>{{trans('properties.musicians.index.table_band_international')}}</option>

                                                        @foreach($bands as $band)
                                                            <option
                                                                value="{{$band->id}}" {{ ($musicians_id_bands==$band->id) ? 'selected' : '' }}>{{$band->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        {{--<div class="col-sm-6">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label--}}
                                                    {{--for="inputName">{{trans('properties.musicians.index.table_band_international')}}</label>--}}
                                                {{--<input type="text" id="band_international" name="band_international" class="form-control"--}}
                                                       {{--value="{{$musicians_band_international}}"--}}
                                                       {{--maxlength="100" {{ ($musicians_id_bands!='0')? 'readonly' : ''}}>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--=========================================================--}}
                                    <div class="form-group"><i class="fas fa-comment text-warning "></i>
                                        <label>{{trans('properties.musicians.index.table_comment')}}</label>
                                        <textarea class="form-control" id="comment" name="comment"  rows="3"
                                                  placeholder="">{{$musicians_comment}}</textarea>
                                    </div>
                                    {{--=========================================================--}}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group"><i class="fas fa-clock text-warning"></i>
                                                <label
                                                    for="inputName">{{trans('properties.musicians.index.table_created_at')}}</label>
                                                <input type="text" id="created_at" class="form-control"
                                                       value="{{ $musicians_created_at }}"
                                                       readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"><i class="fas fa-clock text-warning "></i>
                                                <label
                                                    for="inputName">{{trans('properties.musicians.index.table_updated_at')}}</label>
                                                <div class="input-group">
                                                    <input type="text" id="updated_at" class="form-control"
                                                           value="{{ $musicians_updated_at }}"
                                                           readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--=========================================================--}}
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="deactivated"
                                               name="deactivated"
                                               OnChange="checkboxStatus(this,'deactivated_description','{{trans('properties.musicians.index.table_activated')}}','{{trans('properties.musicians.index.table_deactivated')}}')"
                                               value="1" @if($musicians_deactivated==0) {{'checked'}} @endif >
                                        <label for="deactivated"
                                               class="custom-control-label"
                                               id="deactivated_description">{{ ($musicians_deactivated==0) ? trans('properties.musicians.index.table_activated') : trans('properties.musicians.index.table_deactivated') }}</label>
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
                            <div class="card card-warning">

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

                                    {{--=========================================================--}}

                                    {{--=========================================================--}}

                                    <div class="form-group">
                                        <label>{{trans('properties.musicians.index.table_pictures')}}</label>
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
                                    @if(!empty($musicians_pictures))
                                        {{$css=''}}
                                        @php ( $src='upload/musicians/'. $musicians_id.'/'. $musicians_pictures)
                                    @endif
                                    <input type="hidden" id="file_source_1" name="file_source_1"
                                           value="{{$musicians_pictures}}"  autocomplete="off">
                                    <div class="form-group" id="pictures_content" name="pictures_content"
                                         style=" {{$css}}">
                                        <?php //echo $_SERVER["HTTP_HOST"].parse_club_international($_SERVER['REQUEST_URI'], PHP_URL_PATH);?>
                                        <?php

                                        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                                        $domainName = $_SERVER['HTTP_HOST'];
                                        //echo $protocol.$domainName.parse_club_international($_SERVER['REQUEST_URI'], PHP_URL_PATH).$musicians->pictures;
                                        $domain = $protocol . $domainName;
                                        ?>
                                        <div class="time-label">
                                            <img id="upload_image" class="img-circle img-bordered-sm open_modal2"
                                                 src="{{asset($src)}}"
                                                 width="70px" height="70px" alt="image" data-toggle="modal"
                                                 data-url="{{$domain}}/upload/musicians/{{ $musicians_id}}/{{ $musicians_pictures}}"
                                                 data-title="{{ $musicians_pictures}}"
                                                 data-target="#ModalPicture"
                                                 title="{{ $musicians_pictures}}"
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

                    </div>
                    <!-- /.row -->
                </form>


                {{--<div class="row">--}}
                    {{--<div class="col-md-6">--}}
                        {{--<div class="card card-warning">--}}

                            {{--<div class="card-header">--}}
                                {{--<h3 class="card-title">{{trans('properties.global.documents')}}--}}

                                    {{--<div class="btn-group btn-group-sm">--}}
                                        {{--@if (!empty($musicians_id))--}}
                                        {{--<a href="#" class="btn btn-warning btn-xs open_modal1"--}}
                                           {{--data-toggle="modal" data-target="#ModalDoc"--}}
                                           {{--data-edit_title="{{trans('properties.global.documents_new_title')}}"--}}
                                           {{--data-id_doc=""--}}
                                           {{--data-id="{{$musicians_id}}"--}}
                                           {{--data-name=""--}}
                                           {{--data-id_menu="{{$id_menu}}"--}}
                                           {{--data-name_menu="{{$name_menu}}"--}}
                                           {{--data-query="{{$query}}"--}}
                                           {{--data-name_file=""--}}
                                           {{--data-file_source=""--}}
                                           {{--data-css="needs-validation"--}}
                                           {{--data-url="/documents_store/{{$name_menu }}/{{$id_menu }}/{{$musicians_id}}"--}}
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
                                                    {{--<a href="{{ asset('upload/musicians/'. $musicians_id.'/'. $document_file)}}"--}}
                                                       {{--class="btn-link text-secondary"><i--}}
                                                            {{--class="far fa-fw {{ $style}}"></i>{{ $document->file}}</a>--}}
                                                {{--</td>--}}
                                                {{--<td class="text-right py-0 align-middle">--}}
                                                    {{--<div class="btn-group btn-group-sm">--}}

                                                        {{--<a href="#" class="btn btn-success open_modal1"--}}
                                                           {{--data-toggle="modal" data-target="#ModalDoc"--}}
                                                           {{--data-edit_title="{{trans('properties.global.documents_edit_title')}}"--}}
                                                           {{--data-id_doc="{{$document_id}}"--}}
                                                           {{--data-id="{{$musicians_id}}"--}}
                                                           {{--data-name="{{$document_name}}"--}}
                                                           {{--data-id_menu="{{$id_menu}}"--}}
                                                           {{--data-name_menu="{{$name_menu}}"--}}
                                                           {{--data-query="{{$query}}"--}}
                                                           {{--data-name_file="{{ $document_name }} ({{ $document_file }})"--}}
                                                           {{--data-file_source="({{ $document_file }})"--}}
                                                           {{--data-url="/documents_update/{{$name_menu }}/{{$id_menu }}/{{$musicians_id}}/{{$document_id}}"--}}
                                                           {{--title="{{trans('properties.global.edit')}}"><i--}}
                                                                {{--class="fa fa-edit"></i></a>--}}

                                                        {{--<a href="#" class="btn btn-danger open_modal"--}}
                                                           {{--data-toggle="modal" data-target="#ModalDel"--}}
                                                           {{--data-sif="{{ $document->id }}"--}}
                                                           {{--data-url="/documents_delete/{{$name_menu }}/{{$id_menu }}/{{$musicians_id}}/{{$document_id}}"--}}
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
                                    {{--@if(!empty($musicians_id))--}}
                                        {{--{{trans('properties.global.no_documents')}}--}}
                                    {{--@else--}}
                                        {{--{{trans('properties.global.no_documents_no_record')}}--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--@endif--}}
{{--                            @endif--}}

                        {{--</div>--}}
                        <!-- /.card -->
                    {{--</div>--}}
                    <!-- /.col-md-6 -->


                    <!-- /.col-md-6 -->

                {{--</div>--}}
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </section>
        <!-- /.content -->

    </div>

<script src="/js/app.js"></script>

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


        });

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
