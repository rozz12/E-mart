<?php
	include('NavigationOnly.php');
	if (!isset($_SESSION['Trader_id'])||!isset($_SESSION['User_id'])) {
		header('Location: signin.php?error=PLease Login in order to checkout');
	}
	else{
		//display the checkout options 
?>