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
        <h3>{{trans('properties.login.password-reset-mail-success.hi')}} {{$name}} {{$surname}}</h3>
        <p>{{trans('properties.login.password-reset-mail-success.reset_password_made')}}</p>
        <p>{{trans('properties.login.password-reset-mail-success.reset_password_note')}}</p>
    </div>

</body>

</html>
{{--//login.password-reset-mail-success==============================================--}}

{{--'login.password-reset-mail-success.hi' => 'Здраво,',--}}
{{--'login.password-reset-mail-success.reset_password_made' => 'Со оваа порака Ве известуваме дека Вашата лозинка е успешно сменета.',--}}
{{--'login.password-reset-mail-success.reset_password_note' => 'Ви благодариме.',--}}
{{--//login.password-reset-mail end ==============================================--}}

{{--//login.password-new-==============================================--}}
{{--'login.password-new.new_password' => 'Нова лозинка',--}}
{{--'login.password-new.confirm_new_password' => 'Потврди ја новата лозинката',--}}
{{--'login.password-new.hash' => 'Hash',--}}
{{--//login.new-password end ==============================================--}}
{{--//login.password-reset-mail end ==============================================--}}
{{--'login.password-reset.email_label' => 'Линк за ресетирање на лозинката',--}}
{{--'login.password-reset.email_placeholder' => 'е-mail',--}}
{{--'login.password-reset.back' => 'Кон страната за најава во апликацијата',--}}
{{--'login.password-reset.hi' => 'Здраво,',--}}
{{--'login.password-reset.reset_password_made' => 'Оваа порака е наменета исклучиво за промена на Вашата лозинка.',--}}
{{--'login.password-reset.reset_password_link' => 'Можете да ја ресетирате Вашата лозинка на следниот линк:',--}}
{{--'login.password-reset.reset_password_note' => 'Вашата лозинка нема да биде променета доколку не го кликнете наведениот линк.',--}}
{{--//login.password-reset end ==============================================--}}

{{--//login.password-reset-mail==============================================--}}

{{--'login.password-reset-mail.hi' => 'Здраво,',--}}
{{--'login.password-reset-mail.reset_password_made' => 'Оваа порака е наменета исклучиво за промена на Вашата лозинка.',--}}
{{--'login.password-reset-mail.reset_password_link' => 'Можете да ја ресетирате Вашата лозинка на следниот линк:',--}}
{{--'login.password-reset-mail.reset_password_note' => 'Вашата лозинка нема да биде променета доколку не го кликнете наведениот линк.',--}}

