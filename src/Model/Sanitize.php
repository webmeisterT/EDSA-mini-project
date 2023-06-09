<?php
namespace App\Model;

class Sanitize {

    public static function sanitizeData(string $data)
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }

}

