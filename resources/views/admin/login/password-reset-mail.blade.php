<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="{{ url('css/login/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/login/style.css')}}">

    <script type="text/javascript" src="{{url('js/login/jquery-3.4.1.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/login/bootstrap.min.js')}}"></script>
</head>
<body>

    <div>
        <h3>{{trans('properties.login.password-reset-mail.hi')}} {{$name}} {{$surname}}</h3>
        <p>{{trans('properties.login.password-reset-mail.reset_password_made')}}</p>
        <p>{{trans('properties.login.password-reset-mail.reset_password_link')}}</p>
        <p><a href="{{url("/password-new/{$hash}")}}">{{url("/password-new/{$hash}")}}</a></p>
        <p>{{trans('properties.login.password-reset-mail.reset_password_note')}}</p>
    </div>

</body>

</html>