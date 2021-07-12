<?php
	session_start();
	date_default_timezone_set('Asia/Kathmandu');
	if (!isset($_SESSION['Customer_id'])&&!isset($_SESSION['User_id'])) {
		header('Location: signin.php ');
	}
	elseif(!isset($_SESSION['cart'])||!isset($_SESSION['Collection_day'])){
		echo '<script> 
					alert(\'Please check if you have selected some items or assigned the collection slot details.\');
					window.location.href = \'cart.php \';
			 </script>';
	}
	else{
		//counting the number of item in cart
		$count = 0;
		if (isset($_SESSION['cart'])) {
			foreach ($_SESSION['cart'] as $key => $value) {
				$count += $_SESSION['cart'][$key]['quantity'];
			}
			if ($count>20) {
			echo "<script>
					window.location.href = 'cart.php';
			</script>";
			}
		}
		include('NavigationOnly.php');

			//to get the total number of items and total price
		$total_quantity = 0;
		$price = 0;
		echo "<table class='checkout_table'>
            <tr>
            <th>S.N</th>
            <th>Products</th>
            <th>Quantity</th>
            <th>Collection Date</th>
            <th>Grand Total</th>
            </tr>";
		echo "<style>
				.checkout_table{
					padding: 40px;
					margin-left: 15%;
					border: #E4E4E4 1px solid;
					display: inline-block;
					text-align: center;
					border-radius: 3px;
				}
				.checkout_table th{
					padding-right: 30px;
					font-size: 24px;
				}
				.checkout_table td{
					padding-right: 30px;
					font-size: 20px;
				}
				.pay_button {
					padding: 10px 30px;
					background: #09f;
					border: #038fec 1px solid;
					border-radius: 3px;
					color: #FFF;
					width: 100%;
					cursor: pointer;
					margin: 0px auto;
				}
			</style>";
		//to get the total number of items and total price
		$total_quantity = 0;
		$price = 0;
		$i=1;
			foreach ($_SESSION['cart'] as $key => $value) {
					$total_quantity += $value['quantity'];
					$price = $price + ($value['quantity'] * $value['selling_price']) ;	
					echo "<tr>
							<td>".$i."</td>
	               		 <td>".$value['item_name']."</td>
	                	<td>".$value['quantity']."</td>
	                  	";
	                 $i++;
				}
				$grandtotal = $price + 1.24;
				$collection_date = date('d-m-Y',strtotime($_SESSION['Collection_day']));
				echo "<td rowspan = '".$i."'>".$collection_date."</td>
                	<td rowspan = '".$i."'>&pound".$grandtotal."</td>
                	</tr>";
			
				echo "<tr><form action='https://www.sandbox.paypal.com/cgi-bin/webscr'
	            method='post' target='_top'>
	            <input type='hidden' name='business'
	                value='sb-gwwn26626056@business.example.com'> <input type='hidden'
	                name='customer_id' value='".$_SESSION['Customer_id']."'>
	                 <input type='hidden'
	                name='amount' value='".$grandtotal."'> <input type='hidden'
	                name='no_shipping' value='1'> <input type='hidden'
	                name='currency_code' value='GBP'> <input type='hidden'
	                name='notify_url'
	                value='http://localhost/E-mart-main/Project-Web/php/notify.php'>
	            <input type='hidden' name='cancel_return'
	                value='http://localhost/E-mart-main/Project-Web/php/cancel.php'>
	            <input type='hidden' name='return'
	                value='http://localhost/E-mart-main/Project-Web/php/return.php'>
	            <input type='hidden' name='cmd' value='_xclick'>
	                 <input type='submit' class='pay_button' id='pay_now' value='Pay Now'>
        		</form></tr></table>" ;

        		echo "</div>";


		}
?>