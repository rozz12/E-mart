<?php
session_start();
date_default_timezone_set('Asia/Kathmandu');
	include_once("connection.php");
	//Store transaction information into database
	if (isset($_SESSION['Trader_id'])) {
		$customer_id = $_SESSION['Trader_id'];
	}
	else{
		$customer_id = $_SESSION['Customer_id'];
	}
	echo $customer_id;
	$price = 0;
	$total_quantity= 0	;

	//calculate the price paid for all products 
	foreach ($_SESSION['cart'] as $key => $value) {
		echo $value['item_name'].' '.$value['quantity'].' '.$value['selling_price'];
		$total_quantity += $value['quantity'];
		$price = $price + ($value['quantity'] * $value['selling_price']) ;				
	}
	$grandtotal = $price + 1.24;
	    //Insert tansaction data into the database

		//need to login as customer for testing use static customer_id
	    $sql =  "INSERT INTO payment(payment_date,paid_amount,customer_id) VALUES(sysdate,:amt,3)";

		

		$parse = oci_parse($conn, $sql);
		oci_bind_by_name($parse, ':amt', $grandtotal);		
		// use it when proper data exists	oci_bind_by_name($parse, ':customer_id', $customer_id);		
		$r = oci_execute($parse);
		if (!$r) {
			echo 'Payment unsucessful';
		}
		$insert_pid = "SELECT payment_id_seq.currval FROM Dual";
		$parse = oci_parse($conn, $insert_pid);
		oci_execute($parse);
		$pid = oci_fetch_assoc($parse);
		$pid = $pid['CURRVAL'];
		echo $pid;
		
		$collect_date = $_SESSION['Collection_day'];
		$collect_time = $_SESSION['Time_slot'];
		echo $collect_date;
		$collect_day = date('l',strtotime($collect_date));
		echo $collect_day;

		$order_sql = "INSERT INTO orders(total_product_quantity, total_price, collection_time, collection_date, collection_day, order_date, customer_id, payment_id) VALUES(:total_quantity, :grandtotal, :collect_time, to_date('".$collect_date ."','MM/DD/YYYY hh24:mi:ss'), :collect_day, sysdate, 3, :pid)";
		$order_parse = oci_parse($conn, $order_sql);
		oci_bind_by_name($order_parse, ':total_quantity', $total_quantity);
		oci_bind_by_name($order_parse, ':grandtotal', $grandtotal);
		oci_bind_by_name($order_parse, ':collect_time', $collect_time);
		//oci_bind_by_name($order_parse, ':collect_date', $collect_date);
		oci_bind_by_name($order_parse, ':collect_day', $collect_day);
		//oci_bind_by_name($order_parse, ':customer_id', $customer_id);
		oci_bind_by_name($order_parse, ':pid', $pid);
		$o =oci_execute($order_parse);


		oci_free_statement($order_parse);  
		
		

	if($r && $o){
		echo '<h1>Your payment has been successfully saved.</h1>';
	}
	else{
		echo '<h1>Your payment has failed.</h1>';
	}

?>