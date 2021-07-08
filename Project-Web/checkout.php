<?php
	session_start();
	include('NavigationOnly.php');
	if (!isset($_SESSION['Trader_id'])&&!isset($_SESSION['User_id'])) {
		header('Location: signin.php ');
	}
	else{
			//to get the total number of items and total price
		$total_quantity = 0;
		$price = 0;
			foreach ($_SESSION['cart'] as $key => $value) {
				echo $value['item_name'].' '.$value['quantity'].' '.$value['selling_price'];
				$total_quantity += $value['quantity'];
				$price = $price + ($value['quantity'] * $value['selling_price']) ;				
			}
			$grandtotal = $price + 1.24;
			echo 'Total items: '.$total_quantity.'<br/>';
			echo 'Total Price: '.$grandtotal;
			echo $_SESSION['Collection_day'];
			

			 echo "<form action='https://www.sandbox.paypal.com/cgi-bin/webscr'
	            method='post' target='_top'>
	            <input type='hidden' name='business'
	                value='sb-gwwn26626056@business.example.com'> <input type='hidden'
	                name='customer_id' value='".$_SESSION['Trader_id']."'>
	                 <input type='hidden'
	                name='amount' value='".$grandtotal."'> <input type='hidden'
	                name='no_shipping' value='1'> <input type='hidden'
	                name='currency_code' value='GBP'> <input type='hidden'
	                name='notify_url'
	                value='http://localhost/Project-Web/php/notify.php'>
	            <input type='hidden' name='cancel_return'
	                value='http://localhost/Project-Web/php/cancel.php'>
	            <input type='hidden' name='return'
	                value='http://localhost/Project-Web/php/return.php'>
	            <input type='hidden' name='cmd' value='_xclick'> <input
	                type='submit' name='pay_now' id='pay_now'
	                Value='Pay Now'>
        		</form>" ;




		}
?>