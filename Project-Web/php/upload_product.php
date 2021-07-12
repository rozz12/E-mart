<?php
	include('connection.php');

	if (isset($_POST['Save'])) {

		if (empty($_POST['shop_id'])) {
			echo "<script>
						alert('Please choose a shop first');
						window.location.href = '../TraderUI.php';
				</script>";
		}	
		else{
			extract($_POST);

			if (empty($product_name)||empty($product_price)||empty($product_quantity)||empty($description)) {
				$add = 'Please fill in all fields in the Add Product Form';
				header('Location:../TraderUI.php?add='.$add);
			}
			else{
			
				//making sure all fields are validated and not empty
				$product_name = filter_var(trim($product_name),FILTER_SANITIZE_STRING);
				$product_price = filter_var(trim($product_price),FILTER_SANITIZE_NUMBER_FLOAT);
				$product_quantity = filter_var(trim($product_quantity),FILTER_SANITIZE_NUMBER_INT);
				$description = filter_var(trim($description),FILTER_SANITIZE_STRING);
				$allergy_info = filter_var(trim($allergy_info),FILTER_SANITIZE_STRING);

				//check if such product already exists
				$chk = "SELECT shop_id,product_name FROM product WHERE product_name=:pname AND shop_id!=:shop_id";
				$chk_parse = oci_parse($conn, $chk);
				oci_bind_by_name($chk_parse, ':pname', $product_name);
				oci_bind_by_name($chk_parse, ':shop_id', $_POST['shop_id']);
				oci_execute($chk_parse);
				oci_fetch_assoc($chk_parse);
				if (oci_num_rows($chk_parse)!=0) {
					$add = 'We are sorry.The product is already being marketed by a different Trader. Our policies do not allow us to market same products from different traders.';
					header('Location:../TraderUI.php?add='.$add);
				}

				else{
					$discount = filter_var(trim($discount),FILTER_SANITIZE_STRING);
					//getting discount_id from discount according to discount scheme entered
					$qry_dis = 'SELECT DISCOUNT_ID,DISCOUNT_PERCENTAGE FROM Discount WHERE Discount_name = :discount';
					$stmt1 = oci_parse($conn, $qry_dis);
					oci_bind_by_name($stmt1, ':discount', $discount);
					oci_execute($stmt1);
					//fetching the associative array returned by stmt1
					$d_id = oci_fetch_assoc($stmt1);
					$discount_id = $d_id['DISCOUNT_ID'];

					//calculating selling price based on discount
					$selling_price = $product_price - (($d_id['DISCOUNT_PERCENTAGE']/100)*$product_price);
					
					//store the file in a variable
					$img_file = $_FILES['img_file'];
					$filename = basename($_FILES['img_file']['name']);
					$filetype = $_FILES['img_file']['type'];
					$file_tmp_loc = $_FILES['img_file']['tmp_name'];
					$file_err = $_FILES['img_file']['error'];
					$file_size = $_FILES['img_file']['size'];

					//seperate the file name and extension in to an array
					$file_split = explode('.', $filename);
					//store ext part of file in seperate variable
					$file_ext = strtolower(end($file_split));
					
					//definig some allowed file types
					$allowed_ext = array('jpg','jpeg','png','svg','gif','tiff');
					if (in_array($file_ext, $allowed_ext)) {
						
						//checks if any errors were in file upload
						if ($file_err===0) {
								//check file size
								if ($file_size <= 500000) {
									//setting the destination for uploaded files
									$uploaddestination = '../images/'.$filename;
									//moving the uploaded file from tmp destination to actual destination
									move_uploaded_file($file_tmp_loc, $uploaddestination);
								}
								else{
									$add = ' The file size is too big';
								}

							}	
						else{
							$add = 'There was an error during file upload due to image type.';
						}
					}
					else{
						$add = '<h1>You can upload only';
						foreach ($allowed_ext as $key => $value) {
							echo $value.', ';
						}
						$add += 'file types </h1>';
					}

					$max_order = 20;
					$min_order = 1;
					$availability = 'available';
					//echo $shop_id.'<br/>';
					//echo $discount_id.'<br/>';

					//inserting into Oracle
					$qry = 'INSERT INTO Product ( DISCOUNT_ID,  SHOP_ID, PRODUCT_NAME, PRODUCT_IMAGE, DESCRIPTION, INITIAL_PRICE, SELLING_PRICE, STOCK_QUANTITY, MAX_ORDER, MIN_ORDER, AVAILABILITY,ALLERGY_INFORMATION) VALUES ( :DISCOUNT_ID,:SHOP_ID, :PRODUCT_NAME, :PRODUCT_IMAGE, :DESCRIPTION, :INITIAL_PRICE, :SELLING_PRICE, :QUANTITY, :MAX_ORDER, :MIN_ORDER, :AVAILABILITY,:ALLERGY_INFO)';
					$stmt = oci_parse($conn, $qry);
					oci_bind_by_name($stmt, ':DISCOUNT_ID', $discount_id);
					oci_bind_by_name($stmt, ':SHOP_ID', $shop_id);
					oci_bind_by_name($stmt, ':PRODUCT_NAME', $product_name);
					oci_bind_by_name($stmt, ':PRODUCT_IMAGE', $filename);
					oci_bind_by_name($stmt, ':DESCRIPTION', $description);
					oci_bind_by_name($stmt, ':INITIAL_PRICE', $product_price);
					oci_bind_by_name($stmt, ':SELLING_PRICE', $selling_price);
					oci_bind_by_name($stmt, ':QUANTITY', $product_quantity);
					oci_bind_by_name($stmt, ':MAX_ORDER', $max_order);
					oci_bind_by_name($stmt, ':MIN_ORDER', $min_order);
					oci_bind_by_name($stmt, ':AVAILABILITY', $availability);
					oci_bind_by_name($stmt, ':ALLERGY_INFO', $allergy_info);
					$r = oci_execute($stmt);

					if ($r) {
						$add = 'Product uploaded';
					}
					else{
						$add = "Product upload failed";
					}
					header('Location: ../TraderUI.php?add='.$add);
				}

				
			}

			
		}
	}	
?>