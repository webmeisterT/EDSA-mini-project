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
			if(isset($_SESSION['message'])){
				?>
				<div class="alert alert-info text-center">
					<?php echo $_SESSION['message']; ?>
				</div>
				<?php
				unset($_SESSION['message']);
			}
 
			?>

  <!-- For demo purpose -->
  <div class="container text-white py-5 text-center">
    <h1 class="display-4">Shopping cart</h1>
  </div>
  <!-- End -->

  <div class="pb-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

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
                //initialize total
                $total = 0;
                if(!empty($_SESSION['cart'])){
                //create array of initail qty which is 1
                $index = 0;
                if(!isset($_SESSION['qty'])){
                    $_SESSION['qty'] = 1;
                }
                print_r($_SESSION['qty']);
                $ids = implode(',',$_SESSION['cart']);
                $readrecs = new ReadRecord;
                $readrecs->setColumn("*");
                $readrecs->setTable("products");
                $readrecs->setWhere("id IN ($ids)");
                $readrecs->setData([]);
                $products = $readrecs->readRecord();
                // $products = $config->read("products", "*","id IN ($ids)");
                foreach ($products as $prod) { ?>
                <tr>
                  <th scope="row" class="border-0">
                    <div class="p-2">
                      <img src="./images/<?= $prod['name']?>" alt="" width="70" class="img-fluid rounded shadow-sm">
                      <div class="ml-3 d-inline-block align-middle">
                        <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle"><?= $prod['name']?></a></h5>
                      </div>
                    </div>
                  </th>
                  <td class="border-0 align-middle"><strong>$<?= $prod['price']?></strong></td>
                  <td class="border-0 align-middle"><strong><?= $_SESSION['qty']?></strong></td>
                  <td class="border-0 align-middle"><a href="delete.php?id=<?= $prod['id']; ?>&index=<?= $index; ?>" class="text-danger"><i class="fa fa-trash"></i></a></td>
                </tr>
                <?php 
				$index ++;
                }
						}
						else{
							?>
							<tr>
								<td colspan="4" class="text-center">No Item in Cart</td>
							</tr>
							<?php
						}
 
					?>
              </tbody>
            </table>
          </div>
          <!-- End -->
        </div>
      </div>

      <div class="row py-5 p-4 bg-white rounded shadow-sm">
        
        <div class="col-lg-12">
          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
          <div class="p-4">
            <!-- <p class="font-italic mb-4">Shipping and additional costs are calculated based on values you have entered.</p> -->
            <ul class="list-unstyled mb-4">
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total Items </strong>
              <h5 class="font-weight-bold"><?=count($_SESSION['cart'])?></h5>
            </li>
              <!-- <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Shipping and handling</strong><strong>₦ 500.00</strong></li> -->
              <!-- <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Tax</strong><strong>₦ 0.00</strong></li> -->
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total Price</strong>
                <h5 class="font-weight-bold">₦ 0.00</h5>
              </li>
            </ul><a href="#" class="btn btn-dark rounded-pill py-2 btn-block">Procceed to checkout</a>
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