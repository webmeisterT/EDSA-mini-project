<?php 
  session_start();
  if (isset($_SESSION['is_logged_in'])) {
    return header('location: store.php');
  }
require "vendor/autoload.php";
  use App\User\ProcessRegister;
use App\Model\FileUpload;


  if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (empty($_FILES['passport']['name'])) {
      $error = "Choose An Image To Upload!";
    } else {
    $file_upl = new FileUpload('passport');
      $file_upl->setName();
      $file_upl->setTempName();
      $file_upl->setSize();
      $file_upl->setExtension();
      $file_upl->setFilename();
      $file_upl->setFilePath("uploads/");
      $uploaded = $file_upl->uploadTheFile();
      if ($uploaded->errorUpload()) {
          $_SESSION['user_error'] = $uploaded->getError();
          return header('location:register.php');
      }
      if (!$uploaded->isUploaded()) {
          $_SESSION['user_error'] = "Sorry, your file cannot be uploaded, try again later";
          return header('location:register.php');
        }

      $passport = $uploaded->getFilename();
    }
    $created = ProcessRegister::registerUser($_POST['firstname'], $_POST['lastname'], $_POST['email'], $passport, $_POST['password']);
    if ($created === "user exists") {
      $_SESSION['user_error'] = "A user with this email already exists, Please login to continue";
    }
    elseif (!$created) {
      $_SESSION['user_error'] = "Your registration is not successful! please try again later";
    } else {
      header('location: index.php');
      $_SESSION['user_msg'] = "You have successfully registered, please login to continue";
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title>Register</title>
</head>
<body>
    
<div class="vh-100 d-flex justify-content-center align-items-center container pt-4 mt-lg-5">
  <div class="card mt-5" style="width: 40rem;">
    <div class="card-body">
      <h3 class="card-title text-center bg-primary text-white pt-1 pb-2">Registration Page</h3>
      <?php if (isset($_SESSION['user_error'])) : ?>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><?= $_SESSION['user_error']?></strong>
      </div>
      <?php 
        unset($_SESSION['user_error']);
        endif 
      ?>
      <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <input type="text" name="firstname" id="" class="form-control" required placeholder=" Enter Your First Name">              
          </div>
          <div class="form-group">
            <input type="text" name="lastname" id="" class="form-control" required placeholder=" Enter Your Last Name">              
          </div>
          <div class="form-group">
            <input type="email" name="email" id="" class="form-control" required placeholder=" Enter Your Email">              
          </div>
          <div class="form-group">
            <label for="passport">Upload a profile picture</label>
            <input type="file" name="passport" id="passport" class="form-control" required>              
          </div>
          <div class="form-group">
            <input type="password" name="password" id="" class="form-control" required placeholder=" Enter Your Password" minlength="8">
            <small id="helpId" class="text-muted">Password must not be less than 8</small>
          </div>
          
          <button type="submit" class="btn btn-primary mr-5">Submit</button>
        <a href="index.php">Click here to Login</a>         
          
      </form>
    </div>
  </div>
</div>
    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
</body>
</html>
