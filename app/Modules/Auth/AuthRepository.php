<?php
namespace App\Modules\Auth;

//use App\Http\Mail\PasswordResetMail; //kaj sportski bese vo Http smesten Mail folderot
use App\Mail\PasswordResetMailSuccess;
use App\Mail\PasswordResetMail;
use App\Modules\User\UsersRepository;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthRepository
{
    private $usersRepository;


    /**
     * AuthImpl constructor.
     * @param $usersRepository
     */
    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function sendResetMail($email)
    {
        //get user
        $user = $this->usersRepository->getUserByEmail($email);


        if($user)
        {
            //generate unique hash
            $uniqueHash = md5($email .'-'. Carbon::now()->toDateTimeString());

            //store unique hash in db
            $user->reset_password_hash = $uniqueHash;
            $user->save();

            //Send Email
            Mail::to($email)
                ->send(new PasswordResetMail($uniqueHash, $user->name,$user->surname ));

            //store log in sent_mail table
            DB::table('send_email')
                ->insert([
                    'id_user' => $user->id,
                    'type' => config('constants.send_email_table_types.rp'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()]);

            return $user;
        }
        return false;
    }

    public function checkHashExist($hash)
    {
        //get user
        $user = $this->usersRepository->getUserByHash($hash);

        if($user)
        {
            return $user;
        }
        return null;
    }


    public function setNewPassword($hash, $newPassword)
    {
        $user = $this->usersRepository->getUserByHash($hash);

        if($user)
        {
            //savePass & clean reset_password_hash
            $user->password = Hash::make($newPassword);
            $user->reset_password_hash = null;
            $user->save();
            $email=$user->email ;
            Mail::to($email)
                ->send(new PasswordResetMailSuccess($user->name,$user->surname ));

            //store log in sent_mail table
            DB::table('send_email')
                ->insert([
                    'id_user' => $user->id,
                    'type' => config('constants.send_email_table_types.cnp'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()]);

            return true;
        }
        return false;
    }
}