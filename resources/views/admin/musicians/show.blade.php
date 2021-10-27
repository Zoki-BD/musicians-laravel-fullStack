

<div class="col-12">

    <div class="row invoice-info">
        <div class="col-sm-12 invoice-col" >

            <div class="timeline">
                <!-- timeline time label -->


                <div class="time-label">
                    @if($musician->deactivated==0)
                        <span class="bg-info" >{{ trans('properties.musicians.index.table_activated') }}</span>
                    @else
                        <span class="bg-red ">{{ trans('properties.musicians.index.table_deactivated') }}</span>
                    @endif
                    <br>
                    <span class="bg-gradient-gray" style="margin-top: 3px">  <i class="fas fa-portrait text-warning"></i> <strong>{{trans('properties.musicians.index.table_id')}}</strong>: {{ (!empty($musician->id))? $musician->id : '' }}</span>
                    <span class="bg-gradient-gray" style="margin-top: 3px"><i class="fas fa-clock text-warning"></i> <strong>{{trans('properties.musicians.index.table_created_at')}}</strong>: {{ (!empty($musician->created_at))? date("d.m.Y  H:i:s", strtotime($musician->created_at))  : '' }}</span>
                    <span class="bg-gradient-gray" style="margin-top: 3px"> <i class="fas fa-clock text-warning "></i></i> <strong> {{trans('properties.musicians.index.table_updated_at')}}</strong>:  {{ (!empty($musician->updated_at))? date("d.m.Y  H:i:s", strtotime($musician->updated_at))  : '' }}</span>
                </div>
                <!--   ================================================================================-->
                <div>
                    <i class="fas fa-id-card bg-warning"></i>

                    <div class="timeline-item">


                        <div class="timeline-header">
                            <strong>{{trans('properties.musicians.index.table_name')}}</strong>: {{ (!empty($musician->name))? $musician->name : '' }}
                            <hr>
                            <strong>{{trans('properties.musicians.index.table_surname')}}</strong>: {{ (!empty($musician->surname))? $musician->surname : '' }}
                            <hr>
                            <strong>{{trans('properties.musicians.index.table_date_birth')}}</strong>: {{ (!empty($musician->date_birth))? date("d.m.Y ", strtotime($musician->date_birth))  : '' }}
                            <hr>
                            <strong>{{trans('properties.musicians.index.table_city')}}</strong>: {{ (!empty($city))? $city : '' }}

                        </div>

                    </div>
                </div>
                <!--   ================================================================================-->

                <div>
                    <i class="fas fa-envelope bg-info"></i>
                    <div class="timeline-item">
                        <div class="timeline-header">
                            <strong>{{trans('properties.musicians.index.table_email')}}</strong>: {{ (!empty($musician->email))? $musician->email : '' }}
                        </div>

                    </div>
                </div>
                <!--   ================================================================================-->

                <div>
                    <i class="fas fa-user-friends bg-default"></i>
                    <div class="timeline-item">
                        <div class="timeline-header">
                            <strong>{{trans('properties.musicians.index.table_band')}}</strong>: {{ (!empty($band))? $band : '' }}
                            <hr>
                            <strong>{{trans('properties.musicians.index.table_band_international')}}</strong>: {{ (!empty($musician->band_international))? $musician->band_international : '' }}
                        </div>
                    </div>
                </div>
                <!--   ================================================================================-->
                <div>
                    <i class="fas fa-guitar bg-orange"></i>
                    <div class="timeline-item">
                        <div class="timeline-header">
                            <strong>{{trans('properties.musicians.index.table_instrument')}}</strong>: {{ (!empty($instrument))? $instrument : '' }}
                        </div>
                    </div>
                </div>
                <!--   ================================================================================-->
                <div>
                    @if ($musician->sex=="M") <i class="fas fa-male bg-yellow"></i> @else <i class="fas fa-female bg-yellow"></i> @endif

                    <div class="timeline-item">
                        <div class="timeline-header">

                            <strong>{{trans('properties.musicians.index.table_sex')}}</strong>: @if ($musician->sex=="M") {{trans('properties.musicians.index.table_sex_m')}} @else {{trans('properties.musicians.index.table_sex_f')}} @endif
                        </div>
                    </div>
                </div>
                <!--   ================================================================================-->
                {{--<div>--}}
                    {{--<i class="fas fa-users bg-red"></i>--}}
                    {{--<div class="timeline-item">--}}
                        {{--<div class="timeline-header">--}}
                            {{--<strong>{{trans('properties.musicians.index.table_category_age')}}</strong>: {{ (!empty($category_age))? $category_age : '' }}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <!--   ================================================================================-->

                <!--   ================================================================================-->

                <!--   ================================================================================-->

                <!--   ================================================================================-->

                <!--   ================================================================================-->

                <!--   ================================================================================-->

                <!--   ================================================================================-->
                <!-- END timeline item -->
                <!-- timeline item -->

                <div>
                    <i class="fas fa-comments bg-yellow"></i>
                    <div class="timeline-item">
                        {{--                        <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>--}}
                        <div class="timeline-header"> <strong>{{trans('properties.musicians.index.table_comment')}}</strong><br></div>
                        <div class="timeline-body">
                            {{ (!empty($musician->comment))? $musician->comment : '--' }}
                        </div>
                    </div>
                </div>
                <!--   ================================================================================-->
            {{--@if(count($documents) > 0)--}}
            {{--<div class="time-label">--}}
            {{--<i class="fas fa-book-open bg-info"></i>--}}
            {{--<div class="timeline-item">--}}
            {{--<div class="timeline-header"> <strong>{{trans('properties.musicians.index.table_documents')}}</strong><br></div>--}}
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
            {{--<a href="{{ asset('upload/musicians/'. $musician->id.'/'. $document->file)}}" class="btn-link text-secondary"><i class="far fa-fw {{ $style}}"></i>{{ $document->name}}</a>--}}
            {{--</li>--}}
            {{--@endforeach--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--@endif--}}
            <!--   ================================================================================-->

                @if(!empty($musician->pictures))
                    <?php //echo $_SERVER["HTTP_HOST"].parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);?>
                    <?php

                    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                    $domainName = $_SERVER['HTTP_HOST'];
                    //echo $protocol.$domainName.parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH).$musician->pictures;
                    $domain = $protocol . $domainName;
                    ?>
                    <div class="time-label">
                        <img class="img-circle img-bordered-sm open_modal2"
                             src="{{ asset('upload/musicians/'. $musician->id.'/'. $musician->pictures)}}"
                             width="70px" height="70px" alt="user image" data-toggle="modal"
                             data-url="{{$domain}}/upload/musicians/{{ $musician->id}}/{{ $musician->pictures}}"
                             data-title="{{ $musician->pictures}}"
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





