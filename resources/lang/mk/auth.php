<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',


    'field_required' => 'Полето ":name" е задолжително',
    'delete' => 'Записот е успешно избришан',
    'delete_success' => 'Записот е успешно избришан',
    'delete_error' => 'Записот е не е успешно избришан',
    'update_success' => 'Записот е успешно изменет',
    'update_error' => 'Записот е не е успешно изменет',
    'new_success' => 'Записот е успешно креиран',
    'new_error' => 'Записот не е успешно креиран',
    'to_large' => 'Документот не треба да е поголем од 4MB!',
    'ext_check_doc' => 'Дозволени се само документи со наставка „.pdf“, „.doc“, „.docx“, „.xls“, „.xlsx“ и „.txt“ !',
    'ext_check_img' => 'Дозволени се само слики со наставка „.jpg“, „.jpeg“, „.gif“ и „.png“ !',

    'delete_federations' => 'Не е дозволено да ја избишете федерацијата, додека не ги избришете сите клубови во неа !',
    'delete_bands' => 'Не е дозволено да го избишете бендот, додека не ги избришете сите музичари кои свират во него !',
    'delete_objects' => 'Не е дозволено да го избишете објект, додека не ги избришете сите клубови кои го користат!',

    //login.index==============================================
    'field_login'                => 'Внесовте погрешни податоци. <br>Обидете се повторно!',
    //login.index end ==============================================


    //login.password-reset ==============================================
    'field_email'                => 'Полето ":attribute" мора да биде валидна email адреса.',
    'field_exists'               => 'Внесениот ":attribute" не постои во системот.',
    'success-email'               => 'Линкот за ресетирање на лозинката е испратен на вашата email адреса.',
    'field-email-send'               => 'Грешка во постапка. Обидете се повторно.',
    'field-email-exists'               => 'Внесениот e-mail веќе постои во системот. Обидете се повторно !',
    'field-username-exists'               => 'Внесеното корисничко име веќе постои во системот. Обидете се повторно !',
    //login.password-reset end ==============================================

    //login.password-new ==============================================
    'exists'               => 'Полето :attribute не постои во системот.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => '* Полето ":attribute" мора да содржи најмалку :min карактери.',
        'array'   => 'The :attribute must have at least :min items.',

    ],
    'same'    => '* Полето ":attribute" и полето ":other" треба да имаат иста вредност.',
    'password_changed' => 'Лозинката е успешно променета',
    'password_no_changed' => 'Промента на лозинката е неуспешно',
    //login.password-new end ==============================================

];
