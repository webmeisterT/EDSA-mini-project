<?php
session_start();

require "../DP/src/Model/Model.php";
$config = new Model();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $errors = [];
    //validate that email is unique
    $users = $config->read("users", "email", "email=:email", ['email'=>$email]);

    if (count($users) >0) {
        $errors['email'] = "Email already exists";
    }

    //validate that username is unique
    $users = $config->read("users", "username", "username=:username", ['username'=>$username]);
    $query = $conn->query($sql);
    if (count($users) >0) {
        $errors['username'] = "Username already exists";
    }

    if (empty($errors)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (first_name, last_name, username, email, password) VALUES('$fname', '$lname', '$username', '$email', '$password')";
        if($conn->query($sql) === true){
            //went well
            $_SESSION['message'] = "Registration successful!";
            return header('location: ../login.php');
        }
        else {
            $_SESSION['error'] = 'Sorry an error occurred please again!';
        }
    }
    $_SESSION['errors'] = $errors;
    header('location: ../register.php');
}