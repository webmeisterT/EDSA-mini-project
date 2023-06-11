<?php
session_start();
require "vendor/autoload.php";
use App\Model\CreateRecord;


if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
foreach ($_SESSION['cart'] as $key => $crt) {

    $readrecs = new CreateRecord;
    $readrecs->setColumn("user_id, product_id, quantity, total_price");
    $readrecs->setTable("orders");
    $readrecs->setValue(":user_id, :product_id, :quantity, :total_price");

    $readrecs->setData([
        'user_id' => $_SESSION['user'][0],
        'product_id' => $crt,
        'quantity' => $_SESSION['qty_array'][$key] ,
        'total_price' => $_SESSION['total'][$key]
    ]);
    $products = $readrecs->create();

    }
}

unset($_SESSION['total']);
unset($_SESSION['cart']);
unset($_SESSION['qty_array']);
header('location: store.php');