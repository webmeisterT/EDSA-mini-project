<?php
	session_start();
 echo $_GET['idx'];
	//remove the id from our cart array
	$key = array_search($_GET['idx'], $_SESSION['cart']);	
	unset($_SESSION['cart'][$key]);
 
	unset($_SESSION['qty_array'][$_GET['idx']]);
	//rearrange array after unset
	$_SESSION['qty_array'] = array_values($_SESSION['qty_array']);
 
	$_SESSION['message'] = "Product deleted from cart";
	header('location: cart.php');
?>