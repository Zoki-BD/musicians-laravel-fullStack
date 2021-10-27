
<style>
    *{ font-family: DejaVu Sans !important;}
</style>
<link rel="stylesheet" href="{{ url('css/style_print.css')}}">

{{trans('properties.global.header_title')}}
<hr>
        @if(count($athletes) > 0)
                        <table class="print">
                            <thead>
                            <tr>

                                <th>
                                    {{trans('properties.athletes.index.table_surname')}}
                                </th>

                                <th>
                                    {{trans('properties.athletes.index.table_name')}}
                                </th>
                                <th>
                                    {{trans('properties.athletes.index.table_club')}}
                                </th>
                                <th>
                                    {{trans('properties.athletes.index.table_sport')}}
                                </th>

                            </tr>
                            </thead>


                            <tbody>
                            @foreach($athletes as $athlete)
                                <tr>
                                    <td>{{$athlete->surname }}</td>
                                    <td>{{$athlete->name}}</td>
                                    <td>
                                        @if ($athlete->id_clubs == '0')
                                            {{trans('properties.athletes.index.table_club_international')}}
                                        @elseif(isset($athlete->clubs_id)) {{$athlete->clubs_name}}@else @endif
                                            @if (isset($athlete->club_international)&&!empty($athlete->club_international)), {{ $athlete->club_international }} @endif
                                    </td>
                                    <td>{{$athlete->sports_name}}</td>
{{--                                    <td>--}}
{{--                                        {{!empty($athletes->date_registration) ? date("d.m.Y", strtotime($athletes->date_registration)) : ''}}--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>


                        </table>




        @else
            {{trans('properties.global.no_records')}}
        @endif
