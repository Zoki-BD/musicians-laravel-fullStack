
<div class="col-12">
    <div class="row invoice-info">
        <div class="col-sm-12 invoice-col" >

            <div class="timeline">
                <!-- timeline time label -->

                <div class="time-label">

                    @if($bands->deactivated==0)
                        <span class="bg-info">{{ trans('properties.bands.index.table_activated') }}</span>
                        @else
                        <span class="bg-red">{{ trans('properties.bands.index.table_deactivated') }}</span>
                    @endif
                    <br>
                        <span class="bg-gradient-gray" style="margin-top: 3px">   <i class="fas fa-circle text-warning"></i> <strong>{{trans('properties.bands.index.table_id')}}</strong>: {{ (!empty($bands->id))? $bands->id : '' }}</span>
                        <span class="bg-gradient-gray" style="margin-top: 3px"><i class="fas fa-clock text-warning"></i> <strong>{{trans('properties.bands.index.table_created_at')}}</strong>: {{ (!empty($bands->created_at))? date("d.m.Y  H:i:s", strtotime($bands->created_at))  : '' }}</span>
                        <span class="bg-gradient-gray" style="margin-top: 3px"> <i class="fas fa-clock text-warning "></i></i> <strong> {{trans('properties.bands.index.table_updated_at')}}</strong>:  {{ (!empty($bands->updated_at))? date("d.m.Y  H:i:s", strtotime($bands->updated_at))  : '' }}</span>
                </div>


            <!-- Ime na bendot  ================================================================================-->
                <div>
                    <i class="fas fa-id-card bg-warning"></i>

                    <div class="timeline-item">


                        <div class="timeline-header">
                            <strong>{{trans('properties.bands.index.table_name')}}</strong>: {{ (!empty($bands->name))? $bands->name : '' }}
                            {{--<hr>--}}
                            {{--<strong>{{trans('properties.bands.index.table_federation')}}</strong>: {{ (!empty($federation))? $federation : '' }}--}}
                            {{--<hr>--}}
                            {{--<strong>{{trans('properties.bands.index.table_municipality')}}</strong>: {{ (!empty($municipality))? $municipality : '' }}--}}


                        </div>

                    </div>
                </div>
                <!--  Grad od kade e bendot ================================================================-->
                <div>
                    <i class="fas fa-city bg-orange"></i>
                    <div class="timeline-item">
                        <div class="timeline-header">
                            <strong>{{trans('properties.bands.index.table_city')}}</strong>: {{ (!empty($city))? $city : '' }}
                        </div>
                    </div>
                </div>
                <!-- Dali se mazi ili zeni-pol =====================================================================-->
                <div>
                    @if ($bands->sex=="M") <i class="fas fa-male bg-yellow"></i> @else <i class="fas fa-female bg-yellow"></i> @endif

                    <div class="timeline-item">
                        <div class="timeline-header">

                            <strong>{{trans('properties.bands.index.table_sex')}}</strong>: @if ($bands->sex=="M") {{trans('properties.bands.index.table_sex_m')}} @else {{trans('properties.bands.index.table_sex_f')}} @endif
                        </div>
                    </div>
                </div>
                <!-- NAcionalni i mefjunarodni natrevaruvanja  ===========================================-->
                <div>
                    <i class="fas fa-globe bg-default"></i>
                    <div class="timeline-item">
                        <div class="timeline-header">
                            <strong>{{trans('properties.bands.index.table_national')}}</strong>: {{ (!empty($bands->national))? 'Да' : 'Не' }}
                            <hr>
                            <strong>{{trans('properties.bands.index.table_international')}}</strong>: {{ (!empty($bands->international))? 'Да' : 'Не' }}
                        </div>
                    </div>
                </div>
                <!--   ================================================================================-->

                {{--<div>--}}
                    {{--<i class="fas fa-users bg-red"></i>--}}
                    {{--<div class="timeline-item">--}}
                        {{--<div class="timeline-header"><strong>{{trans('properties.bands.index.table_category_age')}}</strong>: </div>--}}
                        {{--<div class="timeline-body">--}}
                            {{--@if(count($bands_category_age) > 0)--}}
                                {{--@foreach($bands_category_age as $clubs_category_age_)--}}
                                    {{--{{$clubs_category_age_->name}}@if (!$loop->last),@endif--}}
                                {{--@endforeach--}}

                            {{--@else--}}
                                {{------}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <!--   ================================================================================-->
                {{--<div>--}}
                    {{--<i class="fas fa-info-circle bg-gray"></i>--}}
                    {{--<div class="timeline-item">--}}
                        {{--<div class="timeline-header">--}}
                            {{--<strong>{{trans('properties.bands.index.table_date_registration')}}</strong>: {{ (!empty($bands->date_registration))? date("d.m.Y ", strtotime($bands->date_registration))  : '' }}--}}
                            {{--<hr>--}}
                            {{--<strong>{{trans('properties.bands.index.table_number_conclusion')}}</strong>: {{ (!empty($bands->number_conclusion))? $bands->number_conclusion : '' }}--}}
                        {{--</div>--}}

                    {{--</div>--}}
                {{--</div>--}}


                <!-- Adresa , tel, email  ==========================================================================-->
                <div>
                    <i class="fas fa-envelope bg-info"></i>
                    <div class="timeline-item">
                        <div class="timeline-header">
                            <strong>{{trans('properties.bands.index.table_address')}}</strong>: {{ (!empty($bands->address))? $bands->address : '' }}<br>
                            <hr>
                            <strong>{{trans('properties.bands.index.table_phone')}}</strong>: {{ (!empty($bands->phone))? $bands->phone : '' }}
                            <hr>
                            <strong>{{trans('properties.bands.index.table_email')}}</strong>: {{ (!empty($bands->email))? $bands->email : '' }}
                            <hr>
                            {{--<strong>{{trans('properties.bands.index.table_url')}}</strong>: {{ (!empty($bands->url))? $clubs->url : '' }}--}}

                        </div>

                    </div>
                </div>
                <!--   ================================================================================-->
                {{--<div>--}}
                    {{--<i class="fas fa-user bg-green"></i>--}}
                    {{--<div class="timeline-item">--}}
                        {{--<div class="timeline-header">--}}
                            {{--<strong>{{trans('properties.clubs.index.table_president')}}</strong>: {{ (!empty($clubs->president))? $clubs->president : '' }}<br>--}}
                            {{--<hr>--}}
                            {{--<strong>{{trans('properties.clubs.index.table_president_vice')}}</strong>: {{ (!empty($clubs->president_vice))? $clubs->president_vice : '' }}--}}
                            {{--<hr>--}}
                            {{--<strong>{{trans('properties.clubs.index.table_secretary')}}</strong>: {{ (!empty($clubs->secretary))? $clubs->secretary : '' }}--}}
                            {{--<hr>--}}
                            {{--<strong>{{trans('properties.clubs.index.table_person_technical')}}</strong>: {{ (!empty($clubs->person_technical))? $clubs->person_technical : '' }}--}}
                            {{--<hr>--}}
                            {{--<strong>{{trans('properties.clubs.index.table_person_expert')}}</strong>: {{ (!empty($clubs->person_expert))? $clubs->person_expert : '' }}--}}
                        {{--</div>--}}

                    {{--</div>--}}
                {{--</div>--}}
                <!--   ================================================================================-->

                <!--   ================================================================================-->
                <!-- END timeline item -->
                <!-- timeline item -->



                 <!-- Komentar  ================================================================================-->
                <div>
                    <i class="fas fa-comments bg-yellow"></i>
                    <div class="timeline-item">
{{--                        <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>--}}
                        <div class="timeline-header"> <strong>{{trans('properties.bands.index.table_comment')}}</strong><br></div>
                        <div class="timeline-body">
                            {{ (!empty($bands->comment))? $bands->comment : '--' }}
                        </div>
                    </div>
                </div>



                <!-- Muzicari koi svirat vo ovoj bend  ==========================================================-->

                <div class="time-label">
                    <i class="fas fa-list-ul bg-warning"></i>
                    <div class="timeline-item">
                        <div class="timeline-header">
                            <strong> {{trans('properties.bands.index.table_musicians')}}
                                @if(count($musicians) > 0)

                                    (вкупно: {{count($musicians)}})

                                @else
                                    (вкупно: 0)
                                @endif
                            </strong><br></div>
                        <div class="timeline-body">
                            <ul class="list-unstyled">
                                @if(count($musicians) > 0)
                                    @foreach($musicians as $musician)
                                        <li>
                                            {{$loop->iteration}}. {{$musician->surname}}, {{$musician->name}}
                                        </li>
                                    @endforeach
                                @else
                                    --
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
               {{--================================================================================================================================================= -}}--}}




                <div class="time-label">
                    <i class="fas fa-futbol bg-orange"></i>
                    <div class="timeline-item">
                        <div class="timeline-header"><strong>Vidovi na muzika sto svirat:
                            @if(count($genres) > 0)
                                    (вкупно: {{count($genres)}})
                                @else
                                (вкупно: 0)
                            @endif
                            </strong>
                        </div>


                        <div class="timeline-body">
                            @if(count($genres) > 0)
                                @foreach($genres as $genre)
                                    {{$genre->name}}
                                    @if (!$loop->last),@endif
                                @endforeach
                            @else
                                --
                            @endif
                        </div>
                    </div>
                </div>

                <div class="time-label">
                    <i class="fas fa-futbol bg-orange"></i>
                    <div class="timeline-item">
                        <div class="timeline-header"><strong>Gradovi kade sto svirat:
                                @if(count($bands_cities) > 0)
                                    (вкупно: {{count($bands_cities)}})
                                @else
                                (вкупно: 0)
                                @endif
                            </strong>
                        </div>


                        <div class="timeline-body">
                            @if(count($bands_cities) > 0)
                                @foreach($bands_cities as $band_city)
                                    {{$band_city->name}}
                                    @if (!$loop->last),@endif
                                @endforeach
                            @else
                                --
                            @endif
                        </div>
                    </div>
                </div>




            <!--   =================================================================================================================================================-}}
            {{--<div class="time-label">--}}
                    {{--<i class="fas fa-list-ul bg-primary"></i>--}}
                    {{--<div class="timeline-item">--}}
                        {{--<div class="timeline-header">--}}
                            {{--<strong>{{trans('properties.clubs.index.table_objects')}}--}}
                                {{--@if(count($clubs_objects) > 0)--}}

                                    {{--(вкупно: {{count($clubs_objects)}})--}}

                                {{--@else--}}
                                    {{--(вкупно: 0)--}}
                                {{--@endif--}}
                            {{--</strong><br></div>--}}
                        {{--<div class="timeline-body">--}}
                            {{--<ul class="list-unstyled">--}}
                                {{--@if(count($clubs_objects) > 0)--}}
                                    {{--@foreach($clubs_objects as $clubs_object)--}}
                                        {{--<li>--}}
                                            {{--{{$loop->iteration}}. {{$clubs_object->name}}, {{$clubs_object->municipalities_name}}  ({{$clubs_object->objects_types_name}})--}}
                                        {{--</li>--}}
                                    {{--@endforeach--}}
                                {{--@else--}}
                                    {{------}}
                                {{--@endif--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <!--   ================================================================================-->
                {{--@if(count($documents) > 0)--}}
                {{--<div class="time-label">--}}
                    {{--<i class="fas fa-book-open bg-info"></i>--}}
                    {{--<div class="timeline-item">--}}
                        {{--<div class="timeline-header"> <strong>{{trans('properties.clubs.index.table_documents')}}</strong><br></div>--}}
                        {{--<div class="timeline-body">--}}
                            {{--<ul class="list-unstyled">--}}
                                {{--@foreach($documents as $document)--}}
                                    {{--<?php--}}
                                    {{--$array = explode('.',$document->file);--}}
                                    {{--$extension = end($array);--}}
                                   {{--// echo $extension;--}}
                                    {{--if ($extension=='pdf'||$extension=='PDF'){ $style='fa-file-pdf';}--}}
                                    {{--elseif ($extension=='doc'||$extension=='DOC'||$extension=='docx'||$extension=='DOCX'){ $style='fa-file-word';}--}}
                                    {{--elseif ($extension=='xls'||$extension=='XLS'||$extension=='xlsx'||$extension=='XLSX'){ $style='fa-file-excel';}--}}
                                    {{--else { $style='fa-file';}--}}
                                    {{--?>--}}
                                {{--<li>--}}
                                    {{--<a href="{{ asset('upload/clubs/'. $clubs->id.'/'. $document->file)}}" class="btn-link text-secondary"><i class="far fa-fw {{ $style}}"></i>{{ $document->name}}</a>--}}
                                {{--</li>--}}
                                {{--@endforeach--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--@endif--}}
                {{--<!--   ================================================================================-->--}}

                @if(!empty($bands->pictures))
                    <?php //echo $_SERVER["HTTP_HOST"].parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);?>
                    <?php

                    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                    $domainName = $_SERVER['HTTP_HOST'];
                    //echo $protocol.$domainName.parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH).$bands->pictures;
                    $domain = $protocol . $domainName;
                    ?>
                    <div class="time-label">
                        <img class="img-circle img-bordered-sm open_modal2"
                             src="{{ asset('upload/bands/'. $bands->id.'/'. $bands->pictures)}}"
                             width="70px" height="70px" alt="user image" data-toggle="modal"
                             data-url="{{$domain}}/upload/bands/{{ $bands->id}}/{{ $bands->pictures}}"
                             data-title="{{ $bands->pictures}}"
                             data-target="#ModalPicture"
                             style="cursor: pointer">
                    </div>


            @endif
            <!--   ================================================================================-->
                <!-- END timeline item -->

            </div>

        </div>
    </div>
</div>




