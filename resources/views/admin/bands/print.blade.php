
<style>
    *{ font-family: DejaVu Sans !important;}
</style>
<link rel="stylesheet" href="{{ url('css/style_print.css')}}">

{{trans('properties.global.header_title')}}
<hr>
        @if(count($clubs) > 0)
                        <table class="print">
                            <thead>
                            <tr>

                                <th>
                                    {{trans('properties.clubs.index.table_name')}}
                                </th>

                                <th>
                                    {{trans('properties.clubs.index.table_federation')}}
                                </th>
                                <th>
                                    {{trans('properties.clubs.index.table_sport')}}
                                </th>
                                <th>
                                    {{trans('properties.clubs.index.table_municipality')}}
                                </th>

                            </tr>
                            </thead>


                            <tbody>
                            @foreach($clubs as $club)
                                <tr>
                                    <td>{{$club->name }}</td>
                                    <td>{{$club->federations_name}}</td>
                                    <td>{{$club->sports_name}}</td>
                                    <td>{{$club->municipalities_name}}</td>
{{--                                    <td>--}}
{{--                                        {{!empty($clubs->date_registration) ? date("d.m.Y", strtotime($clubs->date_registration)) : ''}}--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>


                        </table>




        @else
            {{trans('properties.global.no_records')}}
        @endif
