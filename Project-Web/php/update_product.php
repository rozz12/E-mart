<?php
	include('connection.php');
	if (isset($_POST['Save'])) {
		extract($_POST);

		if (empty($product_name)||empty($product_price)||empty($product_quantity)||empty($description)) {
			header('Location: ../TraderUI.php?product_id='.$hiddenprodid);
		}
		else{
			//store the file in a variable
			$img_file = $_FILES['product_image'];
			$filename = basename($_FILES['product_image']['name']);
			$filetype = $_FILES['product_image']['type'];
			$file_tmp_loc = $_FILES['product_image']['tmp_name'];
			$file_err = $_FILES['product_image']['error'];
			$file_size = $_FILES['product_image']['size'];

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
							echo ' The file size is too big';
						}

					}	
				else{
					echo 'There was an error during file upload';
				}
			}
			else{
					echo '<h1>You can upload only';
					foreach ($allowed_ext as $key => $value) {
						echo $value.', ';
					}
					echo 'file types </h1>';
				}
			
				$qry2 = "SELECT Product_Name FROM Product WHERE Product_ID = '".$hiddenprodid."'";
				$parse = oci_parse($conn,$qry2);
				oci_execute($parse);
				$updprodname = oci_fetch_assoc($parse);

				//making sure all fields are validated and not empty
				$product_name = filter_var(trim($product_name),FILTER_SANITIZE_STRING);
				$product_price = filter_var(trim($product_price),FILTER_SANITIZE_NUMBER_FLOAT);
				$product_quantity = filter_var(trim($product_quantity),FILTER_SANITIZE_NUMBER_INT);
				$description = filter_var(trim($description),FILTER_SANITIZE_STRING);
				$allergy_info = filter_var(trim($allergy_info),FILTER_SANITIZE_STRING);
				$discount = filter_var(trim($discount),FILTER_SANITIZE_STRING);
				
				//selecting respective discount_id from discount table
				$qry_dis = 'SELECT DISCOUNT_ID FROM Discount WHERE DISCOUNT_NAME = :discount';
				
				$stmt1 = oci_parse($conn, $qry_dis);
				oci_bind_by_name($stmt1, ':discount', $discount);
				oci_execute($stmt1);
				//fetching the associative array returned by stmt1
				$d_id = oci_fetch_assoc($stmt1);
				$discount_id = $d_id['DISCOUNT_ID'];

				$qry_upd = "UPDATE Product SET  Discount_id = :discount_id, Product_Name = :product_name, Product_Image = :filename, Initial_Price = :product_price, stock_quantity = :product_quantity, Description = :description, Allergy_information =: allergy_info WHERE Product_ID = :hiddenproductid";
				$upd_parse = oci_parse($conn, $qry_upd);
				oci_bind_by_name($upd_parse, ':discount_id', $discount_id);
				oci_bind_by_name($upd_parse, ':product_name', $product_name);
				oci_bind_by_name($upd_parse, ':filename', $filename);
				oci_bind_by_name($upd_parse, ':product_price', $product_price);
				oci_bind_by_name($upd_parse, ':product_quantity', $product_quantity);
				oci_bind_by_name($upd_parse, ':description', $description);
				oci_bind_by_name($upd_parse, ':allergy_info', $allergy_info);
				oci_bind_by_name($upd_parse, ':hiddenproductid', $hiddenprodid);

				$result = oci_execute($upd_parse);
				
				if ($result) {
					echo "<h1>Product updated sucessfully!</h1>";
				}
				else{
					echo "<h1>Error! connecting to DB</h1>";
				}
			}
	}
else if (isset($_POST['Delete'])) {
			extract($_POST);
			$del_qry = 'DELETE FROM Product WHERE Product_id = :delprodid';
			$del_parse = oci_parse($conn, $del_qry);
			oci_bind_by_name($del_parse, ':delprodid', $delprodid);
			oci_execute($del_parse);
			/*if (oci_execute($del_parse)) {
				echo 'Product deleted';
			}
			else{
				echo "Error";
			}*/
		}		
else{
	header('Location: ../editProducts.php?product_id='.$hiddenprodid);
}

?>