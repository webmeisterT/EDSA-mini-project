<?php
namespace App\User;
use App\User\CheckUser;

class ProcessLogin {
    
    public static function processUser (string $email, string $password) {
        $user = CheckUser::userExist($email);
        if (!$user) {
            return "register.php";
        } elseif ($user['password'] && password_verify($password, $user['password'])) {
            return $user['firstname'] . ' '. $user['lastname'];
        } else {
           return false;
        }
        
    }
}