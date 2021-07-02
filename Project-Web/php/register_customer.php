<?php
	require('connection.php');
//An array containing the value as names of the input field of the form
	$textFields = array('firstname','lastname','email','phone','Gender','address','age','password','repassword');
	
	//An empty array to store the errors
	$error = array( );
	
	//enters if the Register button has been set
	if (isset($_POST['Register'])) {
		$count = 0;
		$finalerror='';
		$sql='';
		
		//extracts all input field values with their respective form-name as variable name
		extract($_POST);
		

		//traversing through each value of array stored in textfield in order to see if its respective $_POST variable is empty or not
		foreach($textFields as $value){
			if(empty($_POST[$value])){
				array_push($error,ucfirst($value).' cannot be empty');
				//increase count value if any input field is empty
				$count++;
			}
		}

		//enters this block if none of the input field is empty in the form in order to process the input values in the form
		if ($count==0){
				$password = filter_var(trim($password),FILTER_SANITIZE_STRING);
				$firstname = filter_var(trim($fullname),FILTER_SANITIZE_STRING);
				$lastname = filter_var(trim($lastname),FILTER_SANITIZE_STRING);
				$email = filter_var(trim($email),FILTER_SANITIZE_EMAIL);
				$age = filter_var(trim($age),FILTER_SANITIZE_NUMBER_INT);
				$phone = filter_var(trim($phone),FILTER_SANITIZE_NUMBER_INT);

				//validate email
				if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
					$finalerror = 'Please enter a valid email adress'; 
				}

				//check the password field for specified regex pattern
				$pwd_pattern = '/^(?=.*[!@#$%&*-+])(?=.*[a-zA-Z])(?=.*\d).{8,20}$/';
				if (preg_match($pwd_pattern, $password)!=1) {
					$finalerror .= '<br/>Password does not match required criterias';
					$count++;
				}
				else
					$password = md5($password);
			}
		
		//only enters this block if all criteria for the input values is cleared for final input into DB
		if ($count==0) {
			$qry = "INSERT INTO customer(FirstName,LastName,'Email','Contact','Gender','Address','Age','Password') VALUES ('$firstname','$lastname','$email','$phone','$Gender','$address','$age','$password')";
			$sql = mysqli_query($connection,$qry);

		}

		//checks if data inserted sucessfully or not
		if ($sql) {
				$scs = 'Registered Sucessfully';
			}
		//if data not inserted sucessfully
		else{
			//if there are multiple errors during previous processing then error message is displayed with the same respect
			if(count($error)>1&&$count>1){
				$finalerror = 'Please fill in all the fields';
			}
			else {
				foreach ($error as $value) {
					$finalerror = $value;	
				}
			}
		}

		//checks if the sucess msg or the error msg has been set and enters the if block in that respect 
		if (isset($scs)) {
			echo '<h6 style= "color:green;text-align:center">'.$scs.'</h6>';
		}
		elseif (isset($finalerror)) {
			echo '<h6 style="color:red;text-align:center">'.$finalerror.'</h6>';
		}
	}
	
?>