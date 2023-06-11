<?php
namespace App\User;
use App\User\CheckUser;

class ProcessLogin {
    
    public static function processUser (string $email, string $password) {
        $user = CheckUser::userExist($email);
        if (!$user) {
            return false;
        } elseif ($user['password'] && password_verify($password, $user['password'])) {
            return [$user['id'], $user['firstname'], $user['lastname'], $user['passport']];
        } else {
           return false;
        }
        
    }
}