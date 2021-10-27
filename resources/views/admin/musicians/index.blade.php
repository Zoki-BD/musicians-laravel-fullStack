@extends('admin/master')

@section('content')


<?php
//    $id_menu = Request::segment(2);
$title = trans('properties.musicians.index.title');
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
               <h1><i class="fa fa-users text-warning"></i> {{trans('properties.musicians.index.title')}}
                  <a class="btn btn-warning btn-sm" href="{{url('/musicians/create')}}">{{trans('properties.musicians.index.new')}}
                  </a>
               </h1>
            </div>

            {{--ova dole e za primer so react koga bi rabotele--}}
            {{--<div id="example" class="col-sm-6">--}}
            {{--ovde se pokazuva kodot od react example komponentata--}}
            {{--</div>--}}


            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ url('musicians') }}">{{trans('properties.musicians.index.title')}}</a>
                  </li>
                  {{-- <li class="breadcrumb-item active"></li>--}}
               </ol>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>

   {{--Probno za hasMany i belongsTo dali funkcionira--}}
   {{--<div class="col-sm-6">--}}
   {{--@foreach($musiciansTest as $musician)--}}
   {{--<p> {{ !empty($musician->city) ? $musician->city->name : 'muzicar bez grad vo DB' }} </p>--}}
   {{--@endforeach--}}
   {{--</div>--}}



   <!-- <div id='modalReact'></div> -->

   <!-- <div id="showWithReact"> </div> -->
   {{--dava error so dolnata componenta preku class pristap--}}
   {{--<div id="classComponent"> </div>--}}

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">

         <!-- Search =============================================================================================== -->
         <form class="form-horizontal" name="form_search" id="form_search" method="get" action="" accept-charset="UTF-8">
            <input type="hidden" id="page" name="page" value="{{ app('request')->input('page') }}">
            <div class="card card-warning card-outline">
               <div class="card-body">
                  <div class="row">


                     <div class="col-md-1 col-lg-1 col-xl-1">
                        <label class="control-label">{{trans('properties.musicians.index.search1')}}</label>
                        <input type="text" id="search1" name="search1" class="form-control form-control-sm" value="{{app('request')->input('search1')}}" placeholder="{{trans('properties.musicians.index.search1')}}" maxlength="10">
                     </div>
                     <div class="col-md-4 col-lg-3 col-xl-2">
                        <label class="control-label">{{trans('properties.musicians.index.search2')}}</label>
                        <input type="text" id="search2" name="search2" class="form-control form-control-sm" value="{{app('request')->input('search2')}}" placeholder="{{trans('properties.musicians.index.search2')}}" maxlength="100">
                     </div>
                     <div class="col-md-4 col-lg-3 col-xl-2">
                        <label class="control-label">{{trans('properties.musicians.index.search3')}}</label>
                        <input type="text" id="search3" name="search3" class="form-control form-control-sm" value="{{app('request')->input('search3')}}" placeholder="{{trans('properties.musicians.index.search3')}}" maxlength="100">
                     </div>

                     <div class="col-md-2 col-lg-2 col-xl-1">
                        <label class="control-label">{{trans('properties.musicians.index.search4')}}</label>
                        <select class="select2 select2-lime" id="search4" name="search4" onchange="this.form.submit()" style="width: 100%">

                           <option value="">&nbsp;</option>
                           <option value="F" {{ ((app('request')->input('search4'))=='F')? 'selected' : '' }}>{{trans('properties.musicians.index.table_sex_f')}}</option>
                           <option value="M" {{ ((app('request')->input('search4'))=='M')? 'selected' : '' }}>{{trans('properties.musicians.index.table_sex_m')}}</option>

                        </select>
                     </div>

                     <div class="col-md-4 col-lg-3 col-xl-3">
                        <label class="control-label">{{trans('properties.musicians.index.search5')}}</label>
                        <select class="select2" id="search5" name="search5" onchange="this.form.submit()" style="width: 100%">
                           @if(count($bands)>0)
                           <option value="">&nbsp;</option>
                           <option value="0" {{ ((app('request')->input('search5'))=='0')? 'selected' : '' }}>{{trans('properties.musicians.index.table_band_international')}}</option>
                           @foreach($bands as $band)
                           <option value="{{$band->id}}" {{ ((app('request')->input('search5'))==$band->id)? 'selected' : '' }}>{{$band->name}}</option>
                           @endforeach
                           @endif
                        </select>
                     </div>
                     {{--@endif--}}

                     <div class="col-md-3 col-lg-3 col-xl-2">
                        <label class="control-label">{{trans('properties.musicians.index.search6')}}</label>
                        <select class="select2 select2-lime" id="search6" name="search6" onchange="this.form.submit()" style="width: 100%">
                           @if(count($instruments) > 0)
                           <option value="">&nbsp;</option>
                           @foreach($instruments as $instrument)
                           <option value="{{$instrument->id}}" {{ ((app('request')->input('search6'))==$instrument->id)? 'selected' : '' }}>{{$instrument->name}}</option>
                           @endforeach
                           @endif
                        </select>
                     </div>

                     {{--Пагинатион е доле искоментирано привремено--}}

                     <div class=" col-md-2 col-lg-1 col-xl-1">
                        <label class="control-label">{{trans('properties.musicians.index.list')}}</label>

                        <select id="pageList" name="pageList" class="form-control form-control-sm" onchange="listSeaarch()">
                           <option value="3" @if($pageList==3) {{'selected'}} @endif>
                              3
                           </option>
                           <option value="15" @if($pageList==15) {{'selected'}} @endif>
                              15
                           </option>
                           <option value="50" @if($pageList==50) {{'selected'}} @endif>
                              50
                           </option>
                           <option value="100" @if($pageList==100) {{'selected'}} @endif>
                              100
                           </option>
                           <option value="200" @if($pageList==200) {{'selected'}} @endif>
                              200
                           </option>
                           <option value="a" @if($pageList=='a' ) {{'selected'}} @endif>
                              {{trans('properties.musicians.index.all')}}
                           </option>
                        </select>

                     </div>



                     

                     <!-- tuka e REACT ufrleno -->
                     <div id="reactSearch"></div>





                  </div>

                  <div class="row">
                     <div class="col-sm-4 col-md-3 col-lg-2 col-xl-1">
                        <label class="control-label"> &nbsp;</label>
                        <button type="button" class="form-control form-control-sm btn btn-warning btn-sm" title="{{trans('properties.musicians.index.reset_button_des')}}" onClick="window.open('{{ url('musicians') }}','_self');"> {{trans('properties.musicians.index.reset_button')}}
                        </button>
                     </div>
                     <div class="col-sm-4 col-md-3 col-lg-2 col-xl-1">
                        <label class="control-label"> &nbsp;</label>
                        <button type="submit" class="form-control form-control-sm btn btn-danger btn-sm" title="{{trans('properties.musicians.index.search_button')}} ">{{trans('properties.musicians.index.search_button')}}
                        </button>

                     </div>


                  </div>
               </div>
            </div>
         </form>
         <!-- Search end=============================================================================================== -->

         <!-- Table =============================================================================================== -->
         <div class="card card-warning card-outline">

            <div class="card-body">
               @include('flash::message')

               @if(count($musicians) > 0)
               <?php
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
                        <strong> <span class="badge badge-warning">{{ $musicians->firstItem() }}</span></strong>
                        {{trans('properties.global.to')}}
                        <strong> <span class="badge badge-warning">{{$musicians->lastItem() }}</span></strong>
                        ({{trans('properties.global.sum')}}
                        <strong> <span class="badge badge-danger">{{ $musicians->total() }}</span></strong>
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
                                 $column_name = 'id';
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
                                 <th class="sortable {{$style_acs_decs}}" onclick="orderBy('id','{{$sort}}')">
                                    {{trans('properties.musicians.index.table_id')}}
                                 </th>
                                 <?php
                                 $column_name = 'name';
                                 $style_acs_decs = '';
                                 if (request()->query('sort') == 'desc' && $order == $column_name) {
                                    $style_acs_decs = 'desc';
                                 }
                                 if (request()->query('sort') == 'asc' && $order == $column_name) {
                                    $style_acs_decs = 'asc';
                                 }
                                 ?>
                                 <th class="sortable {{$style_acs_decs}}" onclick="orderBy('{{$column_name}}','{{$sort}}')">{{trans('properties.musicians.index.table_name')}}</th>

                                 <?php
                                 $column_name = 'surname';
                                 $style_acs_decs = '';
                                 if (request()->query('sort') == 'desc' && $order == $column_name) {
                                    $style_acs_decs = 'desc';
                                 }
                                 if (request()->query('sort') == 'asc' && $order == $column_name) {
                                    $style_acs_decs = 'asc';
                                 }
                                 ?>
                                 <th class="sortable {{$style_acs_decs}}" onclick="orderBy('{{$column_name}}','{{$sort}}')">{{trans('properties.musicians.index.table_surname')}}</th>

                                 <?php
                                 $column_name = 'bands_name';
                                 $style_acs_decs = '';
                                 if (request()->query('sort') == 'desc' && $order == $column_name) {
                                    $style_acs_decs = 'desc';
                                 }
                                 if (request()->query('sort') == 'asc' && $order == $column_name) {
                                    $style_acs_decs = 'asc';
                                 }
                                 ?>
                                 <th class="sortable {{$style_acs_decs}}" onclick="orderBy('{{$column_name}}','{{$sort}}')">{{trans('properties.musicians.index.table_band')}}</th>

                                 <?php
                                 $column_name = 'instruments_name';
                                 $style_acs_decs = '';
                                 if (request()->query('sort') == 'desc' && $order == $column_name) {
                                    $style_acs_decs = 'desc';
                                 }
                                 if (request()->query('sort') == 'asc' && $order == $column_name) {
                                    $style_acs_decs = 'asc';
                                 }
                                 ?>
                                 <th class="sortable {{$style_acs_decs}}" onclick="orderBy('{{$column_name}}','{{$sort}}')">{{trans('properties.musicians.index.table_instrument')}}</th>


                                 <?php
                                 $column_name = 'sex';
                                 $style_acs_decs = '';
                                 if (request()->query('sort') == 'desc' && $order == $column_name) {
                                    $style_acs_decs = 'desc';
                                 }
                                 if (request()->query('sort') == 'asc' && $order == $column_name) {
                                    $style_acs_decs = 'asc';
                                 }
                                 ?>
                                 <th class="sortable {{$style_acs_decs}}" onclick="orderBy('{{$column_name}}','{{$sort}}')">{{trans('properties.musicians.index.table_sex')}}</th>


                                 <th style="width: 2%"><i class="fas fa-lock" title="{{trans('properties.global.deactivated')}}"></i>
                                 </th>
                                 <th style="width: 7%">

                                 </th>
                              </tr>
                           </thead>


                           <tbody>
                              @foreach($musicians as $musician)
                              <tr @if($musician->deactivated == 1) style="color: #cccccc" @endif>
                                 <td>{{ $musician->id }}</td>
                                 <td>
                                    @if (strlen(app('request')->input('search2')))
                                    <?php
                                    echo str_replace(app('request')->input('search2'), '<b style="background-color:#ffc107;color:#fff ">' . app('request')->input('search2') . '</b>', $musician->name);
                                    ?>
                                    @else
                                    {{$musician->name}}
                                    @endif
                                 </td>
                                 <td>
                                    @if (strlen(app('request')->input('search3')))
                                    <?php
                                    echo str_replace(app('request')->input('search3'), '<b style="background-color:#ffc107;color:#fff ">' . app('request')->input('search3') . '</b>', $musician->surname);
                                    ?>
                                    @else
                                    {{$musician->surname}}
                                    @endif
                                 </td>
                                 <td>
                                    @if ($musician->id_bands == '0')
                                    {{trans('properties.musicians.index.table_band_international')}}
                                    @elseif(isset($musician->bands_id)) {{$musician->bands_name}}@else @endif


                                 </td>
                                 <td>
                                    {{$musician->instruments_name}}
                                 </td>
                                 <td>
                                    @if($musician->sex== 'M') Машки @endif
                                    @if($musician->sex== 'F') Женски @endif
                                 </td>
                                 <td>
                                    @if($musician->deactivated == 1)
                                    <i class="fas fa-lock" title="{{trans('properties.global.deactivated')}}"></i>
                                    @endif
                                 </td>
                                 <td>
                                    <div class="btn-group btn-group-sm">
                                       {{--<a href="{{ url("musicians/show/{$musician->id}? {$query}") }}"--}}
                                       {{--class="btn btn-info"><i--}}
                                       {{--class="fa fa-eye"></i></a>--}}
                                       <button class="btn btn-info open_modal" onclick="getContentID('{{ $musician->id }}','ModalContent','{{ $title }}','musicians')">
                                          <i class="fas fa-eye"></i></button>
                                       <a href="{{ url("musicians/edit/{$musician->id} ? {$query}") }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                       <a href="#" class="btn btn-danger open_modal" data-toggle="modal" data-target="#ModalDel" data-sif="{{ $musician->id }}" data-url="musicians/delete/{{$musician->id}}" data-params="{{$query}}" data-naziv="{{ $musician->name .' '. $musician->surname}} " data-query="" title="{{trans('properties.global.delete')}}"><i class="fa fa-trash"></i></a>
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
                        <a class="btn btn-default btn-sm" href="{{ url(Request::segment(1)."/print/".$query) }}" title="{{trans('properties.global.print')}}"><i class="fa fa-print"></i> {{trans('properties.global.print')}}
                        </a>
                        <a class="btn btn-default btn-sm" href="{{url(Request::segment(1)."/export/".$query) }}" title="{{trans('properties.global.export')}}"><i class="fa fa-print"></i> {{trans('properties.global.export')}}
                        </a>
                     </div>
                     <div class="col-sm-6 col-md-6">
                        <div class="pagination pagination-sm float-right">
                           {{ $musicians->appends(request()->query())->links() }}
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

<script src="/js/app.js"></script>
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
   $(function() {
      //Initialize Select2 Elements
      $('.select2bs4').select2({
         theme: 'bootstrap4'
      })
      //Initialize Select2 Elements
      $('.select2').select2()
   })
</script>
@endsection