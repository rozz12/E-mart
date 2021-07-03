<?php
	//enters if the Register button has been set
	if (isset($_POST['Register'])) {

		require('connection.php');
		//extracts all input field values with their respective form-name as variable name
		extract($_POST);

		if(empty($firstname)||empty($lastname)||empty($email)||empty($phone)||empty($Shop_name)){
        	header("Location: ../trader_reg.php?register=empty");
    	}
    	else{
    		$password = filter_var(trim($password),FILTER_SANITIZE_STRING);
			$firstname = filter_var(trim($firstname),FILTER_SANITIZE_STRING);
			$lastname = filter_var(trim($lastname),FILTER_SANITIZE_STRING);
			$email = filter_var(trim($email),FILTER_SANITIZE_EMAIL);
			$area_code = filter_var(trim($area_code),FILTER_SANITIZE_NUMBER_INT);
			$phone = filter_var(trim($phone),FILTER_SANITIZE_NUMBER_INT);
			$phone = $area_code.'-'.$phone;
			$Shop_name = filter_var(trim($Shop_name),FILTER_SANITIZE_STRING);
			$user_type = 'Trader';

			//validate email
			if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
				header("Location: ../trader_reg.php?register=invalidemail");
			}
			else{
				//check the password field for specified regex pattern
				$pwd_pattern = '/^(?=.*[!@#$%&*-+])(?=.*[a-zA-Z])(?=.*\d).{8,20}$/';
				if (preg_match($pwd_pattern, $password)!=1) {
					header('Location: ../trader_reg.php?register=inavlidpswd');
				}
				else{
					$password = md5($password);

					//create a vkey for verification
					$vkey = md5(time());

					//only enters this block if all criteria for the input values is cleared for final input into DB
					$user_type = 'Trader';
					$qry = "INSERT INTO trader(username, email, password, firstname, surname, user_type, contact_no,verify_key,status)
		             VALUES (:username,:email,:password,:firstname,:lastname,:user_type,:contact,:vkey,0)";
		            $insert=oci_parse($conn,$qry);
		            oci_bind_by_name($insert,':username',$email);
		            oci_bind_by_name($insert,':email',$email);
		            oci_bind_by_name($insert,':password', $password);
		            oci_bind_by_name($insert,':firstname', $firstname);
		            oci_bind_by_name($insert,':lastname', $lastname);
		            oci_bind_by_name($insert,':user_type', $user_type);
		            oci_bind_by_name($insert,':contact', $phone);
		            oci_bind_by_name($insert,':vkey', $vkey);

					$r = oci_execute($insert);
					//checks if data inserted sucessfully or not
					if (!$r) {
							//if there are multiple errors during previous processing then error message is displayed with the same respect
							$message = 'Register unsuccesful';	
							//header('Location:../trader_reg.php?msg='.$message);
						}
					else{
						//check the pk of the trader first
						$pk_qry = 'SELECT trader_id_seq.currval from DUAL';
						$pk_parse = oci_parse($conn, $pk_qry);
						oci_execute($pk_parse);
						$pk = oci_fetch_assoc($pk_parse);
						echo $pk['CURRVAL'];

						//fetch the shoptype_id from shoptype according to chosen shoptype
						$shoptype_qry = "SELECT shoptype_id from SHOP_TYPE WHERE shop_type = '$Shop_type'";
						$shoptype_parse = oci_parse($conn, $shoptype_qry);
						oci_execute($shoptype_parse);
						$shoptype = oci_fetch_assoc($shoptype_parse);
						echo $shoptype['SHOPTYPE_ID'];

						$msg = 'Registered Sucessfully. PLease check your mail for verification.';
						//send mail for verification
						$to = $email;
						$subject = "CleckHuddersFax User Email Verification";
						$message = "<a href = 'http://localhost/Project-web/verify_user.php?vkey=$vkey'>Register Account</a>";
						//headers for html content
						$headers = "From:srojan19@tbc.edu.np \r\n";
						$headers .= "MIME-Version: 1.0". "\r\n";
						$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";

						mail($to, $subject, $message,$headers) ;

						$shop_qry = 'INSERT INTO Shop (Shop_name,Shoptype_id,Trader_id,Established_date) VALUES (:Shop_name,:Shop_type,:pk,SYSDATE)';
						$shop_parse = oci_parse($conn, $shop_qry);
						oci_bind_by_name($shop_parse, ':Shop_name', $Shop_name);
						oci_bind_by_name($shop_parse, ':Shop_type', $shoptype['SHOPTYPE_ID']);
						oci_bind_by_name($shop_parse, ':pk', $pk['CURRVAL']);
						oci_execute($shop_parse);
						header('Location:../trader_reg.php?msg='.$msg);

					}
				}
			}
    	}
	}

?>