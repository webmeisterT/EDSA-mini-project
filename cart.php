<?php
session_start();
require "vendor/autoload.php";
use App\Model\ReadRecord;


?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Cart</title>
      
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="css/style2.css">
      <!-- font awesome -->
      <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   </head>
   <body>
    <div class="px-4 px-lg-0">
    <?php 
			if(isset($_SESSION['message'])){ ?>
				<div class="alert alert-info text-center alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
					<?php echo $_SESSION['message']; 
                unset($_SESSION['message']); ?>
				</div>
		<?php } ?>

  <!-- For demo purpose -->
  <div class="container text-white py-4 text-center">
    <a href="store.php"><img src="images/logo.png"></a>
    <!-- <h1 class="display-4">Shopping cart</h1> -->
  </div>
  <!-- End -->

  <div class="pb-5">
    <div class="container">
			<form method="POST" action="update.php">
      <div class="row">
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
        <p class="text-right">
          <a href="store.php" class="btn btn-primary"> Back to store</a>
          <a href="clear_cart.php" class="btn btn-danger"> Clear Cart</a>
        </p>
          

          <!-- Shopping cart table -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Product</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Price</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Quantity</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Remove</div>
                  </th>
                </tr>
              </thead>
              <tbody>
                
              <?php
                $total = 0;
                $qt = 0;
              if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                $idx = 0;
                if(!isset($_SESSION['qty_array'])){
                  $_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
                }
                if(!isset($_SESSION['total'])){
                  $_SESSION['total'] = array();
                }

                $ids = implode(',',$_SESSION['cart']);
                $readrecs = new ReadRecord;
                $readrecs->setColumn("*");
                $readrecs->setTable("products");
                $readrecs->setWhere("id IN ($ids)");
                $readrecs->setData([]);
                $products = $readrecs->readRecord();
              
                foreach ($products as $prod) { ?>
                <tr>
                  <th scope="row" class="border-0">
                    <div class="p-2">
                      <img src="images/<?= $prod['img']?>" alt="" width="70" class="img-fluid rounded shadow-sm">
                      <div class="ml-3 d-inline-block align-middle">
                        <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle"><?= $prod['name']?></a></h5>
                      </div>
                    </div>
                  </th>
                  <td class="border-0 align-middle"><strong>$<?= $prod['price']?></strong></td>
                  <input type="hidden" name="indexes[]" value="<?= $idx; ?>">
                  <td class="border-0 align-middle"><strong><input type="number" style="width: 5rem;" value="<?= $_SESSION['qty_array'][$idx]; ?>" name="qty_<?= $idx; ?>"></strong></td>
                  <td class="border-0 align-middle"><a href="delete.php?id=<?= $prod['id']?>&idx=<?= $idx; ?>" class="text-danger"><i class="fa fa-trash"></i></a></td>
                </tr>
                <?php $total += $_SESSION['qty_array'][$idx]*$prod['price'] ?>
                <?php 
                      $_SESSION['total'][$idx] = $_SESSION['qty_array'][$idx]*$prod['price'] ?>
                <?php $idx++; }
                   $qt = array_sum($_SESSION['qty_array']); ?>
                    <tr>
                      <td>
                        <button type="submit" class="btn btn-success" name="save">Save Changes</button>
                      </td>
                    </tr>
                    <?php
                   }
                  else { ?>
                <tr>
                  <td colspan="4" class="text-center">No Item in Cart</td>
                </tr>
							<?php } ?>
              </tbody>
            </table>
          </div>
          <!-- End -->
        </div>
      </div>
                  </form>
      <div class="row py-5 p-4 bg-white rounded shadow-sm">
        
        <div class="col-lg-12">
          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
          <div class="p-4">
            <ul class="list-unstyled mb-4">
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total Items </strong>
              <h5 class="font-weight-bold"><?=$qt ?></h5>
            </li>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total Price</strong>
                <h5 class="font-weight-bold">₦ <?=$total ?></h5>
              </li>
            </ul><a href="order.php" class="btn btn-dark rounded-pill py-2 btn-block">Procceed to checkout</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-3.0.0.min.js"></script>
</body>
</html>