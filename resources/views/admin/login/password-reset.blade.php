<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <link rel="stylesheet" type="text/css" href="{{ url('css/login/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/login/style.css')}}">

    <title>{{trans('properties.global.header_title')}}</title>
</head>
<body>



<div class="login-wrap">
    <div class="login-html">
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
        <label for="tab-1" class="tab">1. {{trans('properties.global.title')}}</label>

        <div class="login-form">

            <div class="sign-in-htm">
                <form action="{{ url('/password-reset-post') }}" method="post">
                    {{csrf_field()}}
                    <div class="group">
                        <label for="email" class="label">{{trans('properties.login.password-reset.email_label')}}


                        </label>
                        <input type="text" class="input" id="email" name="email" placeholder="{{trans('properties.login.password-reset.email_placeholder')}}"  required maxlength="60">


{{--                        @if ($message = Session::get('error'))--}}
{{--                            <div class="alert alert-danger alert-block">--}}
{{--                                <button type="button" class="close" data-dismiss="alert">×</button>--}}
{{--                                <strong>{{ $message }}</strong>--}}
{{--                            </div>--}}
{{--                        @endif--}}

{{--                        @if (count($errors) > 0)--}}
{{--                            @foreach($errors->all() as $error)--}}
{{--                                <h6 class="text-center" style="color:#ab0000">{{ $error }}</h6>--}}
{{--                            @endforeach--}}
{{--                        @endif--}}

                    </div>


                    <div class="group">
                        <input type="submit" class="button" value="{{trans('properties.global.send')}}">
                    </div>

                    <div class="foot-lnk">
                        <a href="{{ url('/') }}">{{trans('properties.login.password-reset.back')}}</a>
                    </div>
                    <div class="hr"  style="margin-top: 89px">
                        {{--ova so if za errorite e ovde da proveri dali ima error i ako ima da go pokaze div-ot so class="error_massage".
                        DOdeka podolu sto ima include ('flash::message e flash porakata koja e postavena vo controllerot')--}}
                        @if (count($errors) > 0)
                            @foreach($errors->get('email') as $error)
                                <div class="error_massage">{{ $error }}</div>
                            @endforeach
                        @endif
                        @include('flash::message')
                    </div>

                    <div class="footer">
                        <a href="http://www.medium3.mk" target="_blank" class="footer_link">{{trans('properties.global.development')}}</a>
                    </div>
                </form>
            </div>


        </div>

    </div>
</div>




<script type="text/javascript" src="{{url('js/login/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/login/bootstrap.min.js')}}"></script>

</body>

</html>