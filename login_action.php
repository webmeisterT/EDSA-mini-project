<?php
session_start();
require_once '../DP/src/Model/Model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "SELECT * FROM `users` WHERE email = '$email'";
    $query = $conn->query($sql);
    if ($query->num_rows > 0) {
        //validate your password is correct
        $result = $query->fetch_assoc();
        if (password_verify($password, $result['password'])) {
            //log the user in
            $_SESSION['is_logged_in'] = true;
            $_SESSION['user_id'] = $result['id'];
            return header('location: tasks.php');
        }
    }

    //send the user back
    $_SESSION['error'] = "Invalid credentials";
    return header('location: login.php');
}