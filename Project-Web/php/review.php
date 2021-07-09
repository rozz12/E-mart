<?php
	session_start();
	include('connection.php');
	if (!isset($_SESSION['Customer_id'])) {
		echo "<script>
				alert('You need to login in order to review our products');
				window.location.href= '../productDetails.php?product_id=".$_POST['product_id']."';
			</script>";
	}
	elseif (isset($_POST['send'])) {
		extract($_POST);
		$msg = filter_var(trim($msg),FILTER_SANITIZE_STRING);

		$qry = "INSERT INTO review (review_date,rating,comments,product_id,customer_id) VALUES(sysdate,:rating,:comments,:product_id,:customer_id)";
		$parse = oci_parse($conn, $qry);
		oci_bind_by_name($parse, ':rating', $rating);
		oci_bind_by_name($parse, ':comments', $msg);
		oci_bind_by_name($parse, ':product_id',$prod_id);
		oci_bind_by_name($parse, ':customer_id', $_SESSION['Customer_id']);

		$r = oci_execute($parse);
		if ($r) {
			echo "<script>
					alert('Thank you for your review');
					window.location.href= '../productDetails.php?product_id=".$prod_id."';
				</script>";
				
		}
		else{
			echo "<script>
					alert('Your review could not be sent at the moment. Sorry for the inconvenience.');
					window.location.href= '../productDetails.php?product_id=".$prod_id."';
				</script>";
			
		}
	}
?>