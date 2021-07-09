<?php
	@session_start();
	include('php/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
		integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="Style/Homepage.css" />
    <title>Navigation Section</title>
</head>
<body>
	<div class="container-fluid border border-dark nav_container">
		<div class="">
			<div class="row d-flex justify-content-between justify-content-center">
				<div class="col-md-6 col-sm-12">
					<a class="navbar-brand" href="#">
						<img src="images/C.png" alt="" width="200" height="90">
					</a>
				</div>
				<div class="col-md-6 d-flex justify-content-end align-items-top col-sm-12">
					<p class="fs-5 pe-4 mt-1 d-none d-md-block">Connect with us</p>
					<div class="connect d-flex">
						<p class="fs-4 pe-4 mt-1">
							<a href="https://twitter.com/?lang=en"><i
									class="fab fa-twitter-square social fa-1x twitter"></i></a>
						</p>
						<p class="fs-4 pe-4 mt-1">
							<a href="https://www.facebook.com/"><i
									class="fab fa-facebook-square social fa-1x Facebook"></i></a>
						</p>
						<p class="fs-4 mt-1">
							<a href="https://www.instagram.com/accounts/login/?next=/direct/inbox/"><i
									class="fab fa-instagram social fa-1x Instagram"></i></a>
						</p>
					</div>
				</div>
			</div>
			<div class="row py-4 d-flex align-items-center bg-light lower_nav_row">
				<div class="col-lg-2 d-inline-flex justify-content-between mb-2 col-md-2 col-sm-12 col-xs-12">
					<a class="nav-link home" style="color:black;" href="Homepage.php"><i class="fas fa-home fa-2x"></i></a>
					<button class="btn btn-secondary" type="button" data-bs-toggle="offcanvas"
						data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i
							class="fas fa-bars fa-x"></i></button>

					<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
						aria-labelledby="offcanvasRightLabel">
						<div class="offcanvas-header">
							<h3 id="offcanvasRightLabel">Categories</h3>
							<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
								aria-label="Close"></button>
						</div>
						<div class="offcanvas-body">
							<?php
								$ava_cat_qry = 'SELECT Shop_type FROM Shop_type ';
								$ava_cat_parse = oci_parse($conn, $ava_cat_qry);
								oci_execute($ava_cat_parse);
								while ($category = oci_fetch_assoc($ava_cat_parse)) {
								//fetching available categories
							?>
							<a class="dropdown-item text-decoration-none" href="categoryProductList.php?category=<?php echo $category['SHOP_TYPE']?>">
								<p class="fs-5"><?php echo $category['SHOP_TYPE']?></p>
							</a>
							<?php
								//ending the previous while block
								}

								//counting the number of item in cart
								$count = 0;
								if (isset($_SESSION['cart'])) {
									foreach ($_SESSION['cart'] as $key => $value) {
										$count += $_SESSION['cart'][$key]['quantity'];
									}
									if ($count>20) {
										echo "<script>
										alert('Your cart has exceeded max capacity, Please remove some items. (Only upto 20 items');
										</script>";
									}
								}
							?>
						</div>
					</div>
				</div>

				<div class="col-lg-5 mb-1 col-md-10 col-sm-12 col-xs-12">
					<form class="d-flex search_prod" action="search.php" method="GET">
						<button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
						<input class="form-control" name="search" type="search" placeholder="Search for Products" aria-label="Search">
					</form>
				</div>
					<!-- display cart only to customers-->
					<!--display cart button to customer-->
					<?php
						if (isset($_SESSION['Customer_id']) && !isset($_SESSION['Trader_id'])) {
					?>
						<div class="col-lg-5 d-flex justify-content-end col-md-12 col-sm-12 col-xs-12 button_end">
							<button type="button" class="btn btn-warning me-5 w-100 mt-1 d-flex justify-content-center align-items-center cart_button" id="cart_id" onclick="cartFunction()"><i
									class="fas fa-shopping-cart pt-1 pe-1"></i>
								Cart<?php echo ' ('. $count.')'?></button>
							<button type="button" class="btn btn-warning me-5 w-100 mt-1 d-flex justify-content-center align-items-center Profile_button" id="profile_id" onclick="profileFunction()"><i
								class="fas fa-user pe-1"></i> My Profile</button>
							<button type="button" class="btn btn-warning me-5 w-100 mt-1 d-flex justify-content-center align-items-center Logout_button" id="profile_id" onclick="LogoutFunction()"><i
								class="fas fa-user pe-1"></i> Logout</button>
						</div>
					<?php
						}
					?>
					<?php
						//if user is not logged in
						if (!isset($_SESSION['Trader_id']) && !isset($_SESSION['Customer_id'])) {
							//display login/signup button
					?>
						<div class="col-lg-5 d-flex justify-content-end col-md-12 col-sm-12 col-xs-12 button_end">
							<button type="button" class="btn btn-warning me-3 w-100 mt-1 d-flex justify-content-center align-items-center cart_button" id="cart_id" onclick="cartFunction()"><i
									class="fas fa-shopping-cart pt-1 pe-1"></i>
								Cart<?php echo ' ('. $count.')'?></button>
								
							<button type="button" class="btn btn-warning me-5 w-100 mt-1 d-flex justify-content-center align-items-center Login_button" id="login_id"
								onclick="loginFunction()">Login/Signup</button>
						</div>
					<?php
					//ending the first if-block to check if login has been done
						}
						if(isset($_SESSION['Trader_id'])&&!isset($_SESSION['Customer_id'])){
					?>
					<div class="col-lg-5 d-flex justify-content-end col-md-12 col-sm-12 col-xs-12 button_end">
						<button type="button" class="btn btn-warning me-5 w-100 mt-1 d-flex justify-content-center align-items-center Profile_button" id="profile_id" onclick="ShopFunction()"><i
								class="fas fa-home pe-1"></i>My Shops</button>
						<button type="button" class="btn btn-warning me-5 w-100 mt-1 d-flex justify-content-center align-items-center Profile_button" id="profile_id" onclick="profileFunction()"><i
								class="fas fa-user pe-1"></i> My Profile</button>
						<button type="button" class="btn btn-warning me-5 w-100 mt-1 d-flex justify-content-center align-items-center Logout_button" id="profile_id" onclick="LogoutFunction()"><i
								class="fas fa-user pe-1"></i> Logout</button>
					</div>
					<?php
						//ending the if block
						}
					?>
			</div>
		</div>
	</div>

    <!--Bootstrap Link-->
    <script>
						function cartFunction() {
							document.getElementById("cart_id").onclick = function(e){
								window.location.href = "cart.php";
							};
						}
						function loginFunction() {
							document.getElementById("login_id").onclick = function(e){
								window.location.href = "signin.php";
							};
						}
						function profileFunction() {
									document.getElementById('profile_id').onclick = function(e){
										window.location.href = "userProfile.php";
									};
								}
						function LogoutFunction(){
							window.location.href = 'php/logout.php';
						}

						function ShopFunction(){
							window.location.href = 'TraderUI.php';
						}


					</script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
	
</body>
</html>