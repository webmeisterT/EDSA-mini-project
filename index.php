<?php 
  session_start();
  if (isset($_SESSION['is_logged_in'])) {
    header('location: store.php');
  }
  require "vendor/autoload.php";
  use App\User\ProcessLogin;

  if ($_SERVER['REQUEST_METHOD'] === "POST") {  
    $user = ProcessLogin::processUser($_POST['email'], $_POST['password']);
    if ($user === "register.php") {
      $_SESSION['user_error'] = "Please register before using this application";
      header('location: register.php');
    }
    elseif (!$user) {
      $_SESSION['user_error'] = "Invalid credentials! Please enter a valid password/email";
    } else {
      $_SESSION['user'] = $user;
      $_SESSION['is_logged_in'] = true;
      header('location: store.php');
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <title>Login</title>
</head>
<body>
    
<div class="vh-100 d-flex justify-content-center align-items-center container pt-5 mt-5">
  <div class="card mt-5" style="width: 40rem;">
    <div class="card-body">
      <h1 class="card-title text-center bg-primary text-white p-3">Login Page</h1>
      <?php if (isset($_SESSION['user_error'])) : ?>
      <div class="alert alert-danger">
        <strong><?= $_SESSION['user_error']?></strong>
      </div>
      <?php 
        unset($_SESSION['user_error']);
        endif 
      ?>
      <?php if (isset($_SESSION['user_msg'])) : ?>
      <div class="alert alert-success">
        <strong><?= $_SESSION['user_msg']?></strong>
      </div>
      <?php 
        unset($_SESSION['user_msg']);
        endif 
      ?>
      <form action="" method="post">
        <div class="form-group">
          <input type="email" name="email" id="" class="form-control" placeholder="Your Email" aria-describedby="helpId" required>              
          <small id="helpId" class="text-muted">Enter the email you registered with</small>
        </div>

        <div class="form-group">
          <input type="password" name="password" id="" class="form-control" placeholder="Your Password" aria-describedby="helpId" minlength="8" required>
          <small id="helpId" class="text-muted">Password must not be less than 8</small>
        </div>            
        <button type="submit" class="btn btn-primary mr-5">Submit</button>
        <a href="register.php">No account yet? Register here</a>         
      </form>
    </div>
  </div>
</div>

<script src="js/jquery-3.0.0.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script> 
</body>
</html>
