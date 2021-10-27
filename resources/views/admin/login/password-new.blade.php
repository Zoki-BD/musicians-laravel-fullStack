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
        <label for="tab-1" class="tab">{{trans('properties.global.title')}}</label>

        <div class="login-form">

            <div class="sign-in-htm">
                <form action="{{ url('/insert-new-password') }}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" id="hash" name="hash" value="{{$hash}}">
                    <div class="group">
                        <label for="new-password" class="label">{{trans('properties.login.password-new.new_password')}}</label>

                        <input type="password" class="input" id="new-password" name="new-password"  maxlength="20">


{{--                        @if ($message = Session::get('error'))--}}
{{--                            <div class="alert alert-danger alert-block">--}}
{{--                                <button type="button" class="close" data-dismiss="alert">×</button>--}}
{{--                                <strong>{{ $message }}</strong>--}}
{{--                            </div>--}}
{{--                        @endif--}}


                    </div>
                    <div class="group">
                        <label for="confirm-password" class="label">{{trans('properties.login.password-new.confirm_new_password')}}


                        </label>
                        <input type="password" class="input" id="confirm-password" name="confirm-password" maxlength="20">


{{--                        @if ($message = Session::get('error'))--}}
{{--                            <div class="alert alert-danger alert-block">--}}
{{--                                <button type="button" class="close" data-dismiss="alert">×</button>--}}
{{--                                <strong>{{ $message }}</strong>--}}
{{--                            </div>--}}
{{--                        @endif--}}


                    </div>

                    <div class="group">
                        <input type="submit" class="button" value="{{trans('properties.global.send')}}">
                    </div>

                    <div class="foot-lnk">

                    </div>
                    <div class="hr"  style="margin-top: 33px">

                        @include('flash::message')
                        @if (count($errors) > 0)
                            @foreach($errors->get('new-password') as $error)
                                <div class="error_massage">{{ $error }}</div>
                            @endforeach
                        @endif

                        @if (count($errors) > 0)
                            @foreach($errors->get('confirm-password') as $error)
                                <div class="error_massage">{{ $error }}</div>
                            @endforeach
                        @endif

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