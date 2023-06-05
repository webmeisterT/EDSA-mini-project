<?php 
    session_start();
    if (isset($_SESSION['is_logged_in'])) {
        header('location: store.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Login</title>
</head>
<body class="bg-dark">
    
<div class="vh-100 d-flex align-items-center justify-content-center pt-5">
        <div class="card" style="width: 20rem;">
            <div class="card-body">
                <h1 class="card-title text-center bg-light p-3">Login Page</h1>
        <?php
          if(isset($_SESSION['error'])){
            ?>
              <div class="alert alert-danger">
                <strong>Sorry!</strong> <?=$_SESSION['error']?>
              </div>
              <?php
              unset($_SESSION['error']);
          }

          if (isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $key => $value) {
              ?>
              <div class="alert alert-danger">
                <?=$value?>
              </div>
              <?php
              unset($_SESSION['errors']);
            }
          }
        ?>
        <form action="login_action.php" method="post">
            <div class="form-group">
              <input type="email" name="email" id="" class="form-control" placeholder="Your Email">              
            </div>

            <div class="form-group">
              <input type="password" name="password" id="" class="form-control" placeholder="Your Password" aria-describedby="helpId" minlength="4">
              <small id="helpId" class="text-muted">Password must be more than 4</small>
            </div>
            
            <button type="submit" class="btn btn-success">Submit</button>
            
        </form>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
</body>
</html>
