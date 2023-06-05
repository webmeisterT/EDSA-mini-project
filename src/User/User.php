<?php
// namespace App;
require_once "../DP/vendor/autoload.php";

class User {
      public $name, $email = null;
      public function __construct($name, $email)
      {
        $this->name = $name;
        $this->email = $email;
      }

      public function getName()
      {
        return $this->name;
      }
      public function arrayVal()
      {
        return [
          'email'=>$this->email,
          'name'=>$this->name
        ];
      }


}