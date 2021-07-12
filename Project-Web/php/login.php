<?php
	include('connection.php');
	$_SESSION['userid'] = '';
	$_SESSION['username'] = '';
	$_SESSION['user_type'] = '';
	$_SESSION['Trader_id'] = '';
	$_SESSION['Customer_id'] = '';
	if (isset($_POST['login'])) {
		extract($_POST);
		if (emptyfields($Email,$password) == false){
				$Userexists = Userexists($Email,$user_type);
				if ( $Userexists == false) {
					header('Location:../signin.php?error=User does not exist OR User has not been verified!');
				}	
				$stored_psd = $Userexists['PASSWORD'];
				$entered_psd = $password;     //md5 encryption required
				if ($stored_psd === $entered_psd) {
					session_start();
					$_SESSION['userid'] = $Userexists['USER_ID'];
					$_SESSION['username'] = $Userexists['FIRSTNAME'];
					$_SESSION['user_type'] = $Userexists['USER_TYPE'];
					if ($user_type == 'Customer') {
						$_SESSION['Customer_id'] = $Userexists['CUSTOMER_ID'];
						header('Location: ../Homepage.php');
					}
					else{
						$_SESSION['Trader_id'] = $Userexists['TRADER_ID'];
						header('Location: ../TraderUI.php');
					}
				}
				else{
					header('Location: ../signin.php?error=Invalid password!');
				}				
		}
		else{
			header('Location:../signin.php?error=Please fill in all fields!');
		}
	}
	else
		header('Location:../signin.php');

	//functions
	function emptyfields($Email,$password){
		if (empty($Email) || empty($password)) {
			return true;
		}
		else
			return false;
	}

	function Userexists($Email,$user_type){
		include('connection.php');
			if ($user_type=='Trader') {
				$sql = 'SELECT * FROM Trader  WHERE Email = :Email AND status = 1';
				$stmt = oci_parse($conn, $sql);
				oci_bind_by_name($stmt,':Email',$Email);
				oci_execute($stmt);
				$row = oci_fetch_assoc($stmt);
			}
			else{
				$sql = 'SELECT * FROM Customer  WHERE Email = :Email AND status = 1';
				$stmt = oci_parse($conn, $sql);	
				oci_bind_by_name($stmt,':Email',$Email);
				oci_execute($stmt);
				$row = oci_fetch_assoc($stmt);
			}
			//$sql = "SELECT * FROM Users WHERE Email = :Email AND User_type = :user_type ";
			//preparing the statement for sql
			
			/*if (!$stmt) {
				header('Location:../signin.php?error=preparefailed');
			}*/
			//binding the parameters to the prepared statement
			
			//oci_bind_by_name($stmt,':user_type',$user_type);
			//executing the prepared statement
			
			//making an associative array of the results
			if ($row) {
				return $row;
			}
			else
				return false;
			//closing the prepared statement
			oci_close($stmt);
	}

?>