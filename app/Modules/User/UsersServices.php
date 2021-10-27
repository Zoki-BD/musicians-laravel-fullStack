<?php

namespace App\Modules\User;


//use App\Mail\CreateNewUserMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UsersServices
{
    private $usersRepository;

    /**
     * UsersImpl constructor.
     * @param $usersRepository
     */
    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    /**
     * * @param $temp
     * @return mixed
     */
    public function getAllUsers($temp) {
        return $this->usersRepository->getAllUsers($temp);
    }

    /**
     * @param $id
     * @return null
     */
    public function getUserById($id)
    {
        if($id) {
            return $this->usersRepository->getUserById($id);
        }
        return null;
    }

    /**
     * Create new user
     * @param $data
     */
    public function storeUser($data)
    {
        if($data) {
            return $this->usersRepository->storeUser($data);
        }
        return null;

    }

    /**
     * Update user by id
     * @param $id
     * @param $data
     * @return null
     */
    public function updateUser($id, $data)
    {
        if($id && $data) {
            return $this->usersRepository->updateUser($id, $data);
        }
        return null;
    }

    /**
     * Delete user
     * @param $id
     * @return mixed
     */
    public function deleteUser($id)
    {
        $user = $this->usersRepository->getUserById($id);

        if($user) {
            $this->usersRepository->deleteUser($id);
            return true;
        }
        return null;


    }

    public function getUserPermissions()
    {
        return collect(DB::table('user_permissions')->get());
    }


}
