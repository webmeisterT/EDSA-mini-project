<?php
namespace App\User;
use App\Model\CreateRecord;
use App\Model\Sanitize;
use App\User\CheckUser;

class ProcessRegister {
    
    public static function registerUser (string $firstname, string $lastname, string $email, string $password) {
        $user = CheckUser::userExist($email);
        if ($user) {
            return "user exists";
        } else {
            $f = Sanitize::sanitizeData($firstname);
            $l = Sanitize::sanitizeData($lastname);
            $e = Sanitize::sanitizeData($email);
            // Hash password
            $p = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
            $createUser = new CreateRecord;
            $createUser->setColumn("firstname,lastname,email,password");
            $createUser->setTable("users");
            $createUser->setValue(":firstname, :lastname, :email, :password");
            $createUser->setData(['firstname'=>$f, 'lastname'=>$l, 'email'=>$e, 'password'=>$p]);
            $res = $createUser->create();
            if ($res) {
                return true;
            } else {
                return false;
            } 
        }    
    }
}