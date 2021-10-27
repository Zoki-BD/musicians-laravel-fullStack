<?php
namespace App\Modules\Auth;

class AuthServices
{
    private $authRepository;

    /**
     * AuthRepository constructor.
     * @param $authRepository
     */
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * * @param $email
     * @return mixed
     */
    public function sendResetMail($email) {
        return $this->authRepository->sendResetMail($email);
    }

    /**
     * * @param $email
     * @return mixed
     */
    public function checkHashExist($hash) {
        return $this->authRepository->checkHashExist($hash);
    }

    /**
     * * @param $hash
     * * @param $newPassword
     * @return mixed
     */
    public function setNewPassword($hash, $newPassword){
        return $this->authRepository->setNewPassword($hash, $newPassword);
    }

}