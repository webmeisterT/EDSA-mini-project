<?php
namespace App\User;
use App\Model\ReadRecord;
use App\Model\Sanitize;

class CheckUser {

    public static function userExist(string $email)
    {
        $mail = Sanitize::sanitizeData($email);
        $readrec = new ReadRecord;
        $readrec->setColumn("*");
        $readrec->setTable("users");
        $readrec->setWhere("email=:email");
        $readrec->setData(["email"=>$mail]);
        $user = $readrec->readOneRecord();
        if (!$user) {
            return false;
        } else {
           return $user;
        }
    }
}
