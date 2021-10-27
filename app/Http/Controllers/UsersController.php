<?php

namespace App\Http\Controllers;
//
//use App\Http\Requests\CreateUserRequest;
//use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Modules\User\UsersServices;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;


class UsersController extends Controller
{


   public function index(UsersServices $userService)
   {
      if (Auth::user()->is_admin) {
         $params = Request::all();
         $users = $userService->getAllUsers($params);
         // dd($users);
         return view('admin/users/index', compact('users'));
      } else {
         return redirect('main');
      }
   }


   public function create()
   {
      //dd(Auth::user()->is_admin);
      if (Auth::user()->is_admin) {
         return view('admin/users/edit');
      } else {
         return redirect('main');
      }
   }



   public function store(CreateUserRequest $request, UsersServices $usersServices)
   {
      $user = $usersServices->storeUser($request->all());
      //dd($user);
      //id pri nov user gore se uste ne e kreirano zatoa dole ideme so id=user->id
      $id = $user->id;
      //dd($id);
      if ($user) {
         flash(__('auth.new_success'))->success();
         return redirect(url("users/edit/{$id}" . '?' . $request->get('query')));
      }
      flash(__('auth.new_error'))->error();
      return redirect(url("users/edit/{$id}" . '?' . $request->get('query')));
   }


   public function edit($id, UsersServices $usersService)
   {
      if (Auth::user()->is_admin) {
         $user = $usersService->getUserById($id);
         // dd($user);
         return view('admin/users/edit', compact('user'));
      } else {
         return redirect('main');
      }
   }


   public function update($id, UpdateUserRequest $request,  UsersServices $usersServices)
   {
      $user = $usersServices->updateUser($id, $request->all());

      if ($user) {
         flash(__('auth.update_success'))->success();
         return redirect(url("users/edit/{$id}" . '?' . $request->get('query')));
      }
      flash(__('auth.update_error'))->error();
      return redirect(url("users/edit/{$id}" . '?' . $request->get('query')));
   }



   public function destroy($id, Request $request, UsersServices $userService)
   {
      $user = $userService->deleteUser($id);
      //dd($user);
      if ($user) {
         flash(__('auth.delete_success'))->success();
         return redirect(url("users" . '?' . $request->get('query-string')));
      }
      flash(__('auth.delete_error'))->error();
      return redirect(url("users" . '?' . $request->get('query-string')));
   }
}
