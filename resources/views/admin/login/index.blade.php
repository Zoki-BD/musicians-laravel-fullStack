<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <link rel="stylesheet" type="text/css" href="{{ url('css/login/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/login/style.css')}}">

    <title>{{trans('properties.global.header_title')}} </title>
</head>
<body>

{{--imase ovde vidi kaj saso php-info  nesto pisuvase--}}


<div class="login-wrap">
    <div class="login-html">
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
        <label for="tab-1" class="tab">{{trans('properties.global.title')}}</label>

        <div class="login-form">

            <div class="sign-in-html">
                <form action="{{ url('/post-login') }}" method="post">
                    {{--<form action="{{ route('postLogin') }}" method="post"> moze i vaka ako se dade ime na rutata--}}
                        {{csrf_field()}}
                        <div class="group">
                            <label for="username" class="label">{{trans('properties.login.index.username')}}
                                @if (count($errors) > 0)
                                @foreach($errors->get('username') as $error)
                                <b style="color:#ab2b21">{{ $error }}</b>
                                @endforeach
                                @endif
                            </label>
                            <input id="username" name="username" type="text" class="input" value="{{ old('username')}}" required maxlength="60">
                        </div>

                        <div class="group">
                            <label for="password" class="label">{{trans('properties.login.index.password')}}
                                @if (count($errors) > 0)
                                @foreach($errors->get('password') as $error)
                                <b style="color:#ab2b21">{{ $error }}</b>
                                @endforeach
                                @endif


                            </label>
                            <input id="password" name="password" type="password" class="input" data-type="password"  required maxlength="60">
                        </div>

                    {{--ova e da ako kucneme vo url 127.0.0.1:8000  da ne odnese direkt na main ako e userot se uste logiran vo sesija--}}
                        @if(isset(Auth::user()->username))
                        <script>window.location="/main";</script>
                        @endif



                        {{--                    @if (count($errors) > 0)--}}
                        {{--                        @foreach($errors->all() as $error)--}}
                        {{--                            <h6 class="text-center" style="color:#ab0000">{{ $error }}</h6>--}}
                        {{--                        @endforeach--}}
                        {{--                    @endif--}}


                        {{--                <div class="group">--}}
                            {{--                    <input id="check" type="checkbox" class="check" checked>--}}
                            {{--                    <label for="check"><span class="icon"></span> Keep me Signed in</label>--}}
                            {{--                </div>--}}
                        <div class="group">
                            <input type="submit" class="button" value="{{trans('properties.login.index.login')}}">
                        </div>

                        <div class="foot-lnk">
                            <a href="{{ url('/password-reset') }}">{{trans('properties.login.index.forget')}}</a>
                        </div>

                        {{--<div class="hr">--}}

                                                {{--@if ($message = Session::get('error'))--}}
                                                    {{--<div class="alert alert-danger alert-block">--}}
                                                            {{--<button type="button" class="close" data-dismiss="alert">×</button>--}}
                                                            {{--<strong>{{ $message }}</strong>--}}
                                                        {{--</div>--}}
                                                {{--@endif--}}
                            @include('flash::message')

                        {{--</div>--}}

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
<script>
    $(document).ready(function() {
        // show the alert
        setTimeout(function() {
            $(".alert").alert('close');
        }, 5000);
    });
</script>

</body>

</html>