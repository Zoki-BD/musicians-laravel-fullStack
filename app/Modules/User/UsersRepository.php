<?php

namespace App\Modules\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersRepository {


    /**
     * Get user by email
     * @param $email
     * @return mixed
     */
    public function getUserByEmail($email)
    {
        return User::where('email', '=', $email)->first();
    }

    /**
     * Get user by password_hash
     * @param $hash
     * @return mixed
     */
    public function getUserByHash($hash)
    {
        return User::where('reset_password_hash', '=', $hash)->first();
    }

    /**
     * Get paginated users
     * @param $params
     * @return mixed
     */
    public function getAllUsers($params)
    {
        $users=User::where('deleted', '=', '0');
        // dd($params['pageList']);

        if(isset($params['search1']) && !empty($params['search1'])) {
            $users->where('id', '=', $params['search1']);
        }
        if(isset($params['search2']) && !empty($params['search2'])) {
            $users->where('name', 'like', '%'.$params['search2'].'%');
        }
        if(isset($params['search3']) && !empty($params['search3'])) {
            $users->where('surname', 'like', '%'.$params['search3'].'%');
        }

        if(isset($params['search4']) && !empty($params['search4'])) {
            $users->where('email', 'like', '%'.$params['search4'].'%');
        }
        if(isset($params['search5']) && !empty($params['search5'])) {
            $users->where('username', 'like', '%'.$params['search5'].'%');
        }
        $pageList = config('constants.pagination');
        if (isset($params['pageList']) && !empty($params['pageList'])) {
            $pageList = $params['pageList'];
            if ($params['pageList'] == 'a') {
                $pageList  =   $users->count();
            }
        }
        if(!isset($params['sort']) && empty($params['sort'])&&!isset($params['order']) && empty($params['order'])) {
            $users->orderBy('id', 'DESC');
        }else{$users->orderBy($params['order'], $params['sort'], "UTF-8");
        }
//        var_dump($table5->toSql());die();
//        dd($table5);

        return $users->paginate($pageList);
        // return User::paginate(100);
    }


    public function getUserById($id)
    {
        $users=User::where('id', '=', $id)->first();
       // dd($users);
        return $users;
    }

 
    public function storeUser($data)
    {

        return User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            //'remember_token' => Hash::make(Str::random(10)),
            'is_admin' => $data['is_admin']
        ]);
    }

    /**
     * Update user by id
     * @param $id
     * @param $data
     * @return null
     */
    public function updateUser($id, $data)
    {
        $user = User::where('id', '=', $id)->first();
//dd($user);
        if($user) {
            $user->name = $data['name'];
            $user->surname = $data['surname'];
            $user->address = $data['address'];
            $user->phone = $data['phone'];
            $user->username = $data['username'];
            $user->email = $data['email'];
            $user->is_admin = $data['is_admin'];
            if(!empty($data['password'])) {
                $user->password = Hash::make($data['password']);
            }
            if (isset($data['deactivated'])) {
                $user->deactivated = 0;
            } else {
                $user->deactivated = 1;
            }
            return $user->save();
        }
        return null;
    }

    /**
     * Delete user
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function deleteUser($id)
    {
        $users = $this->getUserById($id);

        if($users) {
            // $coaches =User::where('id', '=', $id)->delete();
            $users->deleted = 1;
            //dd($coaches);
            return $users->save();
        }
        return null;
    }

}
