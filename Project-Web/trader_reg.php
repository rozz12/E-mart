<!DOCTYPE html>
<html>

<head>
	<title>Trader Registration</title>
	<meta charset="utf-8" />
	<meta name="author" content="Group1" />
	<meta name="viewport" content="width = device-width,initial-scale = 1.0">
	<meta name="keyword" content="CleckHuddersFax-E-Trader-Registration-New-Shop-Sell" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="Style/trader_reg.css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
		integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body style="background-color:#b7d87b;">
	<article style="width: 100%; background-color:#b7d87b;">
			<div class="form-content">
				<div class="upper_header_contents">
					<img src="images/C.png" class="logo_img_upper" style="width: 400px ; height: 200px;">
					<h2 class="trader_reg_head">Trader Registration Form</h2>
				</div>
						<?php
            				if(isset($_GET['msg'])){
                				echo "<span class='message'>".$_GET['msg']."</span>";
            				}
            				$fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							if (strpos($fullurl, "register=empty")==true) {
								echo "<h3 class='error'>Please fill in all the fields!</h3>";
							}
							if (isset($_GET['register'])&&$_GET['register'] == 'inavlidemail') {
								echo "<h3 class='error'>Please fill in a valid email address!</h3>";
							}
							if (isset($_GET['register'])&&$_GET['register'] == 'inavlidpswd') {
								echo "<h3 class='error'>The password does not match required criterias!</h3>";
							}
							if (isset($_GET['register'])&&$_GET['register'] == 'alreadyexist') {
								echo "<h3 class='error'>You have already been registered with this email</h3>";
							}
							if (strpos($fullurl, "ph=invalid")==true) {
								echo "<h3 class='error'>Phone number must be 10 digits!</h3>";
							}
        				?>
						<form action="php/register_trader.php" method="POST" class="w-50 p-4 border border-dark" style="background-color:#fff;">
							<div class="">
								<div class="form-inline form-group">
									<label>Business Owner</label>

									<!-- uses value and php to persist the entered value in the form-->
									<input type="text" name="firstname" class="form-control mr-md-4 first_trader_name" value="<?php if(isset($_POST['firstname'])){
										echo $_POST['firstname'];
									} ?>" />
									<input type="text" name="lastname" class="form-control" value="<?php if(isset($_POST['lastname'])){
										echo $_POST['lastname'];
									} ?>" />
								</div>
								<div class="form-inline form-group">
									<label>Business Name</label>
									<input type="text" name="Shop_name" class="form-control" value="<?php if(isset($_POST['Shop_name'])){
										echo $_POST['Shop_name'];
									} ?>" />
								</div>
								<div class="form-inline form-group">
									<label>Contact Number</label>
									<input type="text" name="phone" class="form-control" value="<?php if(isset($_POST['phone'])){
										echo $_POST['phone'];
									} ?>" />
								</div>
								<div class="form-inline form-group">
									<label>Email Address</label>
									<input type="email" name="email" class="form-control" value="<?php if(isset($_POST['email'])){
										echo $_POST['email'];
									} ?>" />
								</div>

								<div class="form-inline form-group">
									<label>Business Type</label>
									<select name="Shop_type" class="form-control">
										<option value="Bakery" <?php
											if(isset($_POST["shop_type"])&&$_POST['shop_type']=='Bakery' ){
											echo 'selected' ; }?>> Bakery</option>
										<option value="Delicatessen" <?php
											if(isset($_POST['shop_type'])&&$_POST['shop_type']=='Delicatessen' ){
											echo 'selected' ; } ?> >Delicatessen</option>
										<option value="FishMonger" <?php
											if(isset($_POST['shop_type'])&&$_POST['shop_type']=='FishMonger' ){
											echo 'selected' ; } ?> >FishMonger</option>
										<option value="Butcher" <?php
											if(isset($_POST['shop_type'])&&$_POST['shop_type']=='Butcher' ){
											echo 'selected' ; } ?> >Butcher</option>
										<option value="Grocery" <?php
											if(isset($_POST['shop_type'])&&$_POST['shop_type']=='Grocery' ){
											echo 'selected' ; } ?> >Grocery</option>
									</select>
								</div>
								<div class="form-inline form-group">
									<label>Password</label>
									<div class="input-group ">
										<input type="Password" name="password" id="password" class="form-control" value="<?php if(isset($_POST['password'])){
											echo $_POST['password'];
										} ?>" />
										<div class="input-group-append"><i class="far fa-eye btn"
												id="togglePassword"></i></div>
									</div>
									<div id="passwordHelpBlock" class="form-text">
                                		Your password must include atleast one uppercase letter, one lowercase letter,a special
                                		character and a number.
                            		</div>
								</div>
								<div class="form-inline form-group">
									<label for="conf-password">Re-enter Password</label>
									<input type="password" name="psd" id="confupwd" class="form-control"
										onfocusout="pwdcheck()" />
									<div class="input-group-append"><i class="far fa-eye btn" id="togglePassword1"></i>
									</div><label id="pmatch" style="color: red; visibility: hidden;"></label>
								</div>
								<div class="checkboxes">
									<div class="custom-control custom-checkbox form-group">
										<input type="checkbox" class="custom-control-input" id="Agreement"
											name="terms_agree">
										<label class="custom-control-label" for="Agreement">Keep me signed in<br> By
											clicking on <a href=#><b>Register</b></a>, you acknowledge to have read our
											<a href=#><b>Terms & Conditions</b></a> </label>
									</div>
									<br>
									<div class="custom-control custom-checkbox form-group">
										<input type="checkbox" class="custom-control-input" id="Email_new"
											name="new_item_email">
										<label class="custom-control-label" for="Email_new">Email me about new
											items/newsletters/offers and more</label>
									</div>
								</div>
								<div class="d-flex flex-column align-content-around form-inline form-group">
									<input type="Submit" name="Register" value="Register"
										class="btn btn-primary mb-1 w-100 px-3 mb-4" />
									<h5>--- OR ---</h5>
									<input name="Register_as_customer" value="Register As Customer"
										class="btn btn-secondary mb-1 w-100 mb-2 mt-2 customer_reg" />
									<p class="mt-2"> Already have an account?</p>
									<input name="Sign_in" value="Sign In" class="btn btn-success w-100 signin" />
								</div>
							</div>
						</form>
			</div>
		<?php
			
		?>
	</article>
	<script type="text/javascript">

		//button click actions
        document.querySelector('.customer_reg').addEventListener('click', function(){
                window.location.href = 'php/register_customer.php';
            });

         document.querySelector('.signin').addEventListener('click', function(){
                window.location.href = 'signin.php';
            });



		const togglePassword = document.querySelector('#togglePassword');
		const password = document.querySelector("#password");

		togglePassword.addEventListener('click', function (e) {
			// toggle the type attribute
			const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
			password.setAttribute('type', type);
			// toggle the eye slash icon
			this.classList.toggle('fa-eye-slash');
		});
		const togglePassword1 = document.querySelector('#togglePassword1');
		const repassword = document.querySelector("#confupwd");

		togglePassword1.addEventListener('click', function (e) {
			// toggle the type attribute
			const type = repassword.getAttribute('type') === 'password' ? 'text' : 'password';
			repassword.setAttribute('type', type);
			// toggle the eye slash icon
			this.classList.toggle('fa-eye-slash');
		});

		function pwdcheck() {
			var userpwd = document.getElementById('password').value;
			var confirm_pwd = document.getElementById('confupwd').value;

			if (confirm_pwd === userpwd) {
				document.getElementById('pmatch').style.visibility = 'visible';
				document.getElementById('pmatch').style.color = 'green';
				document.getElementById('pmatch').innerHTML = 'Password Match';
			}
			else {
				document.getElementById('pmatch').style.visibility = 'visible';
				document.getElementById('pmatch').style.color = 'red';
				document.getElementById('pmatch').innerHTML = 'Password Mismatch';
			}
		}
	</script>

</body>

</html>