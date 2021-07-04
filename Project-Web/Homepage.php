<!DOCTYPE html>
<html lang="en">

<head>
	<title>CleckHuddersFax Communal E-mart</title>
	<meta charset="utf-8" />
	<meta name="author" content="Group1" />
	<meta name="viewport" content="width = device-width,initial-scale = 1.0">
	<meta name="keyword" content="CleckHuddersFax-E-Shopping-Cart-Trader-Products-Shops" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../Style/Homepage.css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
		integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

	<!--Ashim-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

	<!--Trending Items-->
	<link rel="stylesheet" href="Style/owl.carousel.min.css">
	<link rel="stylesheet" href="Style/owl.theme.default.min.css">
	<link rel="stylesheet" href="Style/trendingItems.css">

	<!-- custom sstyle  CSS (Unik) -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
	<?php
		include('NavigationOnly.php');
	?>

	<!--Image Slider-->
	<div class="Image-slider">
		<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="../images/image2.jpg" class="d-block w-100" alt="Image1" style="max-height:40%;">
					<div class="carousel-caption d-none d-md-block">
						<h5>First slide label</h5>
						<p>Some representative placeholder content for the first slide.</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="../images/cart.jpeg" class="d-block w-100" alt="Image2" style="max-height:40%;">
					<div class="carousel-caption d-none d-md-block">
						<h5>First slide label</h5>
						<p>Some representative placeholder content for the first slide.</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="../images/image2.jpg" class="d-block w-100" alt="Image3" style="max-height:40%;">
					<div class="carousel-caption d-none d-md-block">
						<h5>First slide label</h5>
						<p>Some representative placeholder content for the first slide.</p>
					</div>
				</div>
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
				data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
				data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>
	</div>

	<!--Search by category-->
	<div class="container-fluid border border-1 border-dark p-4">
		<div class="row pb-5">
			<div class="col-12 d-flex justify-content-center">
				<p class="fs-3">Search by Category</p>
			</div>
		</div>
		<div class="row">
			<?php
				include('php/connection.php');
				$qry = 'SELECT product_id,product_name,product_image,allergy_information,initial_price,category(shoptype_id) from product p,shop s WHERE p.shop_id = s.shop_id AND ROWNUM<=6';
				$cat_fetch = oci_parse($conn, $qry);
				oci_execute($cat_fetch);
				while ( $row = oci_fetch_assoc($cat_fetch)) {
					//starting of while loop to display items
			 ?>
			<div class="col-md-4 justify-content-center py-2 px-2">
				<a href="categoryProductList.php?category=<?php echo $row['CATEGORY(SHOPTYPE_ID)']?>" class="text-decoration-none">
					<div class="card flex-column px-2 py-2 card_product">
						<div class="">
							<img src="images/<?php echo $row['PRODUCT_IMAGE']?>" class="img-fluid" alt="<?php echo $row['PRODUCT_IMAGE']?>">
						</div>
						<div class="">
							<p class="fs-3 text-dark"><?php echo $row['PRODUCT_NAME']?></p>
						</div>
						<div class="">
							<p class="fs-5 text-dark"><?php echo $row['ALLERGY_INFORMATION']?></p>
						</div>
						<div class="">
							<p class="fs-5 text-dark"><?php echo $row['CATEGORY(SHOPTYPE_ID)']?></p>
						</div>
						<div class="">
							<div class="col d-flex justify-content-between">
								<p class="fs-5 text-dark">&pound<?php echo $row['INITIAL_PRICE']?></p>
							</div>
						</div>
					</div>
				</a>
			</div>
			<?php
				//ending of the previous while loop 
				}
			?>
		</div>
	</div>

	<!--Trending Products-->
	<div class="container-fluid border border-1 border-dark p-4">
		<div class="row pb-5">
			<div class="col-12 d-flex justify-content-start">
				<p class="fs-3">Trending Products</p>
			</div>
		</div>
		<!--Owl Carousel-->
		<div class="row">
			<div class="owl-carousel owl-theme">
				<?php
					$trend_qry = 'SELECT product_name,product_image,allergy_information,initial_price,product_rating from product p WHERE product_rating>=4.0 AND ROWNUM <=10';
					$trend_fetch = oci_parse($conn, $trend_qry);
					oci_execute($trend_fetch);
					while($trend_row = oci_fetch_assoc($trend_fetch)){
						//starting of the while loop to fetch product rated above 4.0
				?>
				<a href="productDetails.php?product_id = <?php echo $row['PRODUCT_ID']?>" class="text-decoration-none">
					<div class="card flex-column p-2 card_product mx-2">
						<div class="">
							<img data-src="images/<?php echo $trend_row['PRODUCT_IMAGE']?>" class="img-fluid card_image owl-lazy" alt="<?php echo $trend_row['PRODUCT_IMAGE']?>">
						</div>
						<div class="">
							<p class="fs-3 text-dark"><?php echo $trend_row['PRODUCT_NAME']?></p>
						</div>
						<div class="">
							<p class="fs-5 text-dark"><?php echo $trend_row['ALLERGY_INFORMATION']?></p>
						</div>
						<div class="">
							<p class="fs-5 text-dark">Rating: <?php echo $trend_row['PRODUCT_RATING']?></p>
						</div>
						<div class="">
							<div class="col d-flex justify-content-between">
								<p class="fs-5 text-dark">&pound<?php echo $trend_row['INITIAL_PRICE']?></p>
							</div>
						</div>
						<div class="">
							<button type="button" class="btn btn-warning w-100">Add To Cart</button>
						</div>
					</div>
				</a>
				<?php
					//ending of the previous while loop
					}
				?>
			</div>
		</div>
	</div>
	<!--JQuery for owl carousel-->
	<script src="Javascript/trendingItemsJq.js"></script>
	<script src="Javascript/owl.carousel.min.js"></script>
	<script src="Javascript/script.js"></script>

	<!--About Us-->
	<div class="container-fluid">
		<div class="row col_aboutus">
			<div class="col-lg-6 custom-div d-flex justify-content-end col-md-6 col-sm-12">
				<div class="card" style="width: 100%;">
					<img src="../images/discount.jpeg" class="card-img-top" alt="discountImage">
					<div class="card-body">
						<h5 class="card-title">Card title</h5>
						<p class="card-text">Some quick example text to build on the card title and make up the bulk
							of
							the card's content.</p>
						<a href="#" class="btn btn-primary">Read..</a>
					</div>
				</div>
			</div>
			<div class="col-lg-6 custom-div d-flex justify-content-start col-md-6 col-sm-12">
				<div class="card" style="width: 100%;">
					<img src="../images/new.jpg" class="card-img-top" alt="saleImage">
					<div class="card-body">
						<h5 class="card-title">Discount</h5>
						<p class="card-text">Some quick example text to build on the card title and make up the bulk
							of
							the card's content.</p>
						<a href="#" class="btn btn-primary">Read..</a>
					</div>
				</div>
			</div>
		</div>

		<!--Script-->
		<script>
			$(document).ready(function () {
				$('.custom-div').hover(
					//trigger when mouse hover
					function () {
						$(this).animate({
							marginTop: "0%",
						}, 200);
					},

					//trigger when mouse out
					function () {
						$(this).animate({
							marginTop: "0%",
						}, 200);
					}
				);
			});
		</script>

		<div class="row pt-5">
			<div class="row">
				<div class="col-12 d-flex justify-content-center">
					<p class="fs-1 fw-light">ABOUT US</p>
				</div>
			</div>
			<div class="row">
				<div class="col-12 text-center pb-3">
					<p class="fs-5 fw-lighter">Cleckhuddersfax Communal E-Mart is an online shopping website brought up by the combination of several traders
					running their local businesses in Cleckhuddersfax. This e-commerce site was created with the major goal of promoting the local business
					by providing services to the customers. The goods that customers will be buying from this portal are all locally produced fresh products.</p>
				</div>
			</div>
		</div>
	</div>

	<!--Footer-->
	<?php
		include('footerOnly.php');
	?>

	<!--<article>
		<?php
			include('php/shop_by_cat.php');
		?>
	</article>-->

	<!--Ashim-->
	<!--Bootstrap Link-->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
		integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
		integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
		crossorigin="anonymous"></script>

	<!--Unik-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
		crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
		crossorigin="anonymous"></script>
</body>
<script>
	// Get the button, and when the user clicks on it, execute myFunction
	document.getElementById("cat_button").onclick = function () { myFunction() };

	/* myFunction toggles between adding and removing the show class, which is used to hide and show the dropdown content */
	function myFunction() {
		document.getElementById("myDropdown").classList.toggle("show");
	}
</script>

</html>
