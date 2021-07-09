<?php
	session_start();
	$count=0;
	include('connection.php');
	$qry = 'SELECT product_id, product_name,product_image,discount_name, initial_price,selling_price,description FROM Product,Discount WHERE product_id =:product_id and product.discount_id = discount.discount_id  ';
	if (isset($_GET['item_id'])) {
			$product_id = $_GET['item_id'];
		$parse = oci_parse($conn, $qry);
		oci_bind_by_name($parse, ':product_id', $product_id) ;
		oci_execute($parse);
		$row = oci_fetch_assoc($parse);
	}

	if (!isset($_POST['Add_to_cart'])) {
		//header('Location: javascript://history.go(-1)');
	}
	else {
		if (isset($_SESSION['cart'])) {
			//checks if item has been previously added or not
			//check if cart has 20 items or not
			foreach ($_SESSION['cart'] as $key => $value) {
				$count += $_SESSION['cart'][$key]['quantity'];
			}
			$count+$_POST['upd_quantity'];
			if ($count<20) {
				$added_items = array_column($_SESSION['cart'], 'item_name');
				if (in_array($row['PRODUCT_NAME'], $added_items)) {
					echo "<script>
						alert('Item has already been added');
						window.location.href = '../productDetails.php?product_id=".$product_id."';
						</script>";
				}
				else{
						if ($_POST['quantity']<=20) {
							//enters this part even if an item has been previously set
							$_SESSION['cart'][$count] = array('item_id' => $row['PRODUCT_ID'], 'item_img' => $row['PRODUCT_IMAGE'], 'item_name' => $row['PRODUCT_NAME'] , 'initial_price' => $row['INITIAL_PRICE'], 'selling_price' => $row['SELLING_PRICE'], 'desc' => $row['DESCRIPTION'], 'quantity' => $_POST['quantity'], 'price' => $_POST['tot_price'], 'discount' => $row['DISCOUNT_NAME']);	
							echo "<script>
							alert('Item added');
							window.location.href = '../productDetails.php?product_id=".$product_id."';
							</script>";
						}
						else{
							echo "<script>
							alert('Your cart has already exceeded max capacity');
							window.location.href = '../productDetails.php?product_id=".$product_id."';
							</script>";
						}	
						
					}
			}
			//disble add product if there are more than 20 items in cart
			else{
				echo "<script>
						alert('Your cart has already exceeded max capacity');
						window.location.href = '../productDetails.php?product_id=".$product_id."';
						</script>";
			}	
				
		}
		else{
			if ($_POST['quantity']<=20) {
				//enters this part if no item has been added to cart previously
				$_SESSION['cart'][0] = array('item_id' => $row['PRODUCT_ID'], 'item_img' => $row['PRODUCT_IMAGE'], 'item_name' => $row['PRODUCT_NAME'] , 'initial_price' => $row['INITIAL_PRICE'], 'selling_price' => $row['SELLING_PRICE'], 'desc' => $row['DESCRIPTION'], 'quantity' => $_POST['quantity'], 'price' => $_POST['tot_price'], 'discount' => $row['DISCOUNT_NAME']);	
				echo "<script>
					alert('Item added');
					window.location.href = '../productDetails.php?product_id=".$product_id."';
				</script>";
			}
			else{
				echo "<script>
				alert('Your cart has already exceeded max capacity');
				window.location.href = '../cart.php';
				</script>";
			}
		}
	}
//remove item code
if (isset($_POST['remove_item'])) {
	foreach ($_SESSION['cart'] as $key => $value) {
		if ($value['item_id'] == $_POST['item']) {
			unset($_SESSION['cart'][$key]);
			//rearranging all the values in session cart array by passing the changed values into new one
			$_SESSION['cart'] = array_values($_SESSION['cart']);
			header('Location: ../cart.php'); 			
		}
	}
}
//update item quqntity
if (isset($_POST['upd_quantity'])) {
	foreach ($_SESSION['cart'] as $key => $value) {

		$count += $_SESSION['cart'][$key]['quantity'];
		if ($value['item_id'] == $_POST['item'] && $count<=20) {
			$_SESSION['cart'][$key]['quantity'] = $_POST['upd_quantity'];
			print_r($_SESSION['cart']);
			header('Location: ../cart.php'); 			
		}
		else{
				echo "<script>
				alert('Your cart has already exceeded max capacity');
				window.location.href = '../cart.php';
				</script>";
			}
	}
}
?>