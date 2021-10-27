<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthNewPasswordRequest;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\AuthResetPasswordRequest;
use App\Modules\Auth\AuthServices;
use App\Modules\User\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{



    public function login()
    {
       return view('admin/login/index');
    }




    public function postLogin(AuthRequest $request)
    {
       // die('test');
        //die($request->get('username'));
        $user_data = array(
            'username'  => $request->get('username'),
            'password' => $request->get('password')
        );
 //dd($user_data);
        if(Auth::attempt($user_data))
        {

            return redirect('main');
        }
        else
        {
            flash(__('auth.field_login'))->error()->important();
            return redirect("/");
          // return back()->with('error', 'Wrong Login Details');
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

    public function passwordReset()
    {
        return view('admin/login/password-reset');
    }

    /**
     *
     * Sent email to reset the password
     *
     * @param AuthResetPasswordRequest $request
     * @param AuthServices $authServices
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function passwordResetPost(AuthResetPasswordRequest $request, AuthServices $authServices)
    {

        $response = $authServices->sendResetMail($request->get('email'));
       // dd($response);
        //var_dump('dddd');die;
        if ($response) {
            flash(__('auth.success-email'))->success();
            return redirect('/password-reset');
        }

        flash(__('auth.field-email-send'))->error();
        return redirect('/password-reset');
        //return back()->with('error', 'auth.admin.login.reset-password.field-email-send');
    }

    public function passwordNew($hash, AuthServices $authServices)
    {

        $hashExist = $authServices->checkHashExist($hash);

//       var_dump($hashExist);
//        die;

        if ($hashExist) {

            return view('admin/login/password-new', compact('hash'));
        }
        return redirect('/');
    }

    /**
     *
     * Change the old password with new one
     *
     * @param AuthNewPasswordRequest $request
     * @param AuthServices $authServices
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function insertNewPassword(AuthNewPasswordRequest $request, AuthServices $authServices)
    {


        $response = $authServices->setNewPassword($request->get('hash'), $request->get('new-password'));

        if($response) {
            flash(__('auth.password_changed'))->success();
            return redirect('/');
        }
        //return back()->with('error', 'Wrong Password Details');
        flash(__('auth.password_no_changed'))->error();
        return redirect('/');
    }

}

