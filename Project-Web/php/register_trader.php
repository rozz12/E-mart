<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	//Load Composer's autoloader
	require '../../vendor/autoload.php';

	//enters if the Register button has been set
	if (isset($_POST['Register'])) {

		require('connection.php');
		//extracts all input field values with their respective form-name as variable name
		extract($_POST);

		if(empty($firstname)||empty($lastname)||empty($email)||empty($phone)||empty($Shop_name)){
        	header("Location: ../trader_reg.php?register=empty");
    	}
    	 //validate phone number
        else if(strlen($phone)<10 || strlen($phone)!=10){
            header("Location: ../trader_reg.php?ph=invalid");
        }

    	else{
    		$password = filter_var(trim($password),FILTER_SANITIZE_STRING);
			$firstname = filter_var(trim($firstname),FILTER_SANITIZE_STRING);
			$lastname = filter_var(trim($lastname),FILTER_SANITIZE_STRING);
			$email = filter_var(trim($email),FILTER_SANITIZE_EMAIL);
			$phone = filter_var(trim($phone),FILTER_SANITIZE_NUMBER_INT);
			$Shop_name = filter_var(trim($Shop_name),FILTER_SANITIZE_STRING);
			$user_type = 'Trader';

			 //chk if email already exists
		        $chk_qry = "SELECT email FROM Trader WHERE email = '".$email."'";
		        $chk_parse = oci_parse($conn, $chk_qry);
		        oci_execute($chk_parse);
		         oci_fetch_assoc($chk_parse);
		        if (oci_num_rows($chk_parse)!=0) {
		         	header("Location: ../trader_reg.php?register=alreadyexist");
		         } 

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

						$msg = 'Registered Sucessfully. Please check your mail for verification.';
						//send mail for verification

						
						function sendmail($email,$vkey,$user_type){

							//Create an instance; passing `true` enables exceptions
							$mail = new PHPMailer(true);

							try {
							    //Server settings
							    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
							    $mail->isSMTP();                                            //Send using SMTP
							    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
							    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
							    $mail->Username   = 'srojan19@tbc.edu.np';                     //SMTP username
							    $mail->Password   = 'bsc@3310';                               //SMTP password
							    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
							    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

							    //Recipients
							    $mail->setFrom('Ceckhuddersfaxcommunal@gmail.com', 'Mailer');
							    $mail->addAddress($email);     //Add a recipient

							    //Content
							    $mail->isHTML(true);                                  //Set email format to HTML
							    $mail->Subject = 'CleckhHuddersFax Registration Verification';
							    $mail->Body    = "<b>Please verify your cleckhuddersfax E-Mart account by clicking this link </b><a href = 'http://localhost/E-mart-main/Project-web/verify_user.php?vkey=$vkey&user=$user_type'>Register Account</a>
							    	<p>For you Trader needs we have provided you with an oracle apex account to make your business easy</p><br/>
							    	<p>So, in order to login to your apex account use these credentials</p>
							    	<ol>
							    		<li>Your email adress or username</li>
							    		<li>Your website password</li>
							    	</ol>
							    	";

							    $mail->send();
							    echo 'Message has been sent';
							} catch (Exception $e) {
							    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
							}

						}
						sendmail($email,$vkey,$user_type);


						$shop_qry = 'INSERT INTO Shop (Shop_name,Shoptype_id,Trader_id,Established_date) VALUES (:Shop_name,:Shop_type,:pk,SYSDATE)';
						$shop_parse = oci_parse($conn, $shop_qry);
						oci_bind_by_name($shop_parse, ':Shop_name', $Shop_name);
						oci_bind_by_name($shop_parse, ':Shop_type', $shoptype['SHOPTYPE_ID']);
						oci_bind_by_name($shop_parse, ':pk', $pk['CURRVAL']);
						oci_execute($shop_parse);
						//header('Location:../trader_reg.php?msg='.$msg);

					}
				}
			}
    	}
	}

?>