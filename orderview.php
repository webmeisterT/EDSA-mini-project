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
      <title>Order View</title>
      
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="css/style2.css">
      <!-- font awesome -->
      <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   </head>
   <body>
    <div class="px-4 px-lg-0">
      <!-- For demo purpose -->
      <div class="container text-white py-4 text-center">
        <a href="store.php"><img src="images/logo.png"></a>
        <h3 class="">Below are your past orders</h3>
      </div>
      <!-- End -->

  <div class="pb-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
        <p class="text-right">
          <a href="store.php" class="btn btn-primary"> Back to store</a>
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
                    <div class="py-2 text-uppercase">Quantity</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Price</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Date</div>
                  </th>
                </tr>
              </thead>
              <tbody>
                
              <?php  
              $user_id = $_SESSION['user'][0];
                $readrecs = new ReadRecord;
                $readrecs->setColumn("t1.name, t1.img, t2.quantity, t2.total_price, t2.order_time");
                $readrecs->setTable("products");
                $readrecs->setWhere("t2.user_id=$user_id ORDER BY t2.order_time DESC");
                $readrecs->setData([]);
                $orders = $readrecs->joinRecords("id", "product_id", "orders");
              if ($orders) {
                foreach ($orders as $order) { ?>
                <tr>
                  <th scope="row" class="border-0">
                    <div class="p-2">
                      <img src="images/<?= $order['img']?>" alt="" width="70" class="img-fluid rounded shadow-sm">
                      <div class="ml-3 d-inline-block align-middle">
                        <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle"><?= $order['name']?></a></h5>
                      </div>
                    </div>
                  </th>
                  <td class="border-0 align-middle"><strong><?= $order['quantity']?></strong></td>
                  <td class="border-0 align-middle"><strong>₦ <?= $order['total_price']?></strong></td>
                  <td class="border-0 align-middle"><strong><?= $order['order_time']?></strong></td>
                </tr>                
                    <?php
                   } 
                  }
                  ?>
                
              </tbody>
            </table>
          </div>
          <!-- End -->
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