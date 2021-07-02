<?php
	session_start();
	include('connection.php');
	if (isset($_POST['Save_Changes'])){
		extract($_POST);
		if (empty($firstname)||empty($lastname)||empty($phone)||empty($email)) {
			header('Location: ../edit_user_details.php?input=empty');
		}
		else{
				$firstname = filter_var(trim($firstname),FILTER_SANITIZE_STRING);
				$lastname = filter_var(trim($lastname),FILTER_SANITIZE_STRING);
				$email = filter_var(trim($email),FILTER_SANITIZE_EMAIL);
				$area_code = filter_var(trim($area_code),FILTER_SANITIZE_NUMBER_INT);
				$phone = filter_var(trim($phone),FILTER_SANITIZE_NUMBER_INT);
				if (empty($newpswd)) {
					if ($_SESSION['user_type'] == 'Trader') {
						$qry = 'UPDATE Trader SET firstname = :firstname, surname = :lastname, Contact_no = :phone WHERE Trader_id = :hiddenuserid';
					}
					else{
						$qry = 'UPDATE Customer SET firstname = :firstname, surname = :lastname, Contact_no = :phone WHERE Customer_id = :hiddenuserid';
					}
					
					$upd_parse = oci_parse($conn, $qry);
				}
				else{
					$newpswd = filter_var(trim($newpswd),FILTER_SANITIZE_STRING);
					//check the password field for specified regex pattern
					$pwd_pattern = '/^(?=.*[!@#$%&*-+])(?=.*[a-zA-Z])(?=.*\d).{8,20}$/';
					if (preg_match($pwd_pattern, $newpswd)!=1) {
						header('Location: ../edit_user_details.php?input=inavlidpswd');
					}
					$newpswd = md5($newpswd);				
					//$Shop_name = filter_var(trim($Shop_name),FILTER_SANITIZE_STRING);
					//$shop_type = filter_var(trim($shop_type),FILTER_SANITIZE_STRING);
					if ($_SESSION['user_type'] == 'Trader') {
						$qry = 'UPDATE Trader SET firstname = :firstname, surname = :lastname, password = :password, Contact_no = :phone WHERE Trader_id = :hiddenuserid';
					}
					else{
						$qry = 'UPDATE Customer SET firstname = :firstname, surname = :lastname, password = :password, Contact_no = :phone WHERE Customer_id = :hiddenuserid';
					}
					
					$upd_parse = oci_parse($conn, $qry);
					oci_bind_by_name($upd_parse, ':password', $newpswd);
				}
				
				oci_bind_by_name($upd_parse, ':firstname', $firstname);
				oci_bind_by_name($upd_parse, ':lastname', $lastname);
				oci_bind_by_name($upd_parse, ':phone', $phone);
				oci_bind_by_name($upd_parse, ':hiddenuserid', $hiddenuserid);
				$r = oci_execute($upd_parse);

				//updating some fields of the users super table
				//$qry_users = 'UPDATE Users SET firstname = :firstname,surname = :lastname WHERE User_id =';

				if (!$r) {
					$msg = "!Edit Unsucessful!";
					header('Location: ../edit_user_details.php?update='.$msg);
				}
				else{
					$msg = "!Account Details edited sucessfully!";
					header('Location: ../edit_user_details.php?update='.$msg);
				}
		}
	}
	else{
		header('Location: ../edit_user_details.php');
	}
?>