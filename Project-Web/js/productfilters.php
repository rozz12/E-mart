<?php
include('../php/connection.php');
	$sortorder  =$_POST['sortorder'];
	$sorttype  =$_POST['sorttype'];
	
	if (isset($_POST['Price_range'])&&isset($_POST['Rating'])&&isset($_POST['Discount'])) {
		$dis = explode('-', $_POST['Discount']);
			$init_dis = $dis[0];
			$final_dis = $dis[1];
			$product_rating = $_POST['Rating'];
			$price = $_POST['Price_range'];
				if ($sorttype == 'SELLING_PRICE'&&$sortorder == 'Asc') {
					$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating,Discount_name FROM Product P, Discount D WHERE D.discount_id = P.discount_id AND Initial_price<=:price AND Product_Rating>=:product_rating AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY  SELLING_PRICE asc';
				}
				else if ($sorttype == 'DISCOUNT_PERCENTAGE'&&$sortorder == 'Asc') {
					$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating,Discount_name FROM Product P, Discount D WHERE D.discount_id = P.discount_id AND Initial_price<=:price AND Product_Rating>=:product_rating AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY  DISCOUNT_PERCENTAGE asc';
				}
				else if ($sorttype == 'PRODUCT_NAME'&&$sortorder == 'Asc') {
					$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating,Discount_name FROM Product P, Discount D WHERE D.discount_id = P.discount_id AND Initial_price<=:price AND Product_Rating>=:product_rating AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY PRODUCT_NAME asc';
				}
				else if ($sorttype == 'SELLING_PRICE'&&$sortorder == 'Desc') {
					$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating,Discount_name FROM Product P, Discount D WHERE D.discount_id = P.discount_id AND Initial_price<=:price AND Product_Rating>=:product_rating AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY  SELLING_PRICE desc';
				}
				else if ($sorttype == 'DISCOUNT_PERCENTAGE'&&$sortorder == 'Desc') {
					$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating,Discount_name FROM Product P, Discount D WHERE D.discount_id = P.discount_id AND Initial_price<=:price AND Product_Rating>=:product_rating AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY  DISCOUNT_PERCENTAGE desc';
				}
				else{
					$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating,Discount_name FROM Product P, Discount D WHERE D.discount_id = P.discount_id AND Initial_price<=:price AND Product_Rating>=:product_rating AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY  PRODUCT_NAME desc';	
				}

				$parse = oci_parse($conn, $sql);
			
			oci_bind_by_name($parse, ':price', $price);
			oci_bind_by_name($parse, ':product_rating', $product_rating);
			oci_bind_by_name($parse, ':init_dis', $init_dis);
			oci_bind_by_name($parse,':final_dis',$final_dis);
			oci_execute($parse);
			while ($rows = oci_fetch_assoc($parse)) {
				echo "<div class='col-md-4 justify-content-center py-2 px-2'>
	           		<a href='#' class='text-decoration-none'>
		              <div class='card flex-column px-2 py-2 card_product'>
		                <div class='image-div'>
		                  <img src='images/".$rows['PRODUCT_IMAGE']."' class='img-fluid' alt='product'>
		                </div>
		                <div class=''>
		                  <p class='fs-2 text-dark'>".$rows['PRODUCT_NAME']."</p>
		                  </div>
		                  <div class=''>
		                  <p class='fs-2 text-dark'>".$rows['DISCOUNT_NAME']."</p>
		                  </div>
		                <div class=''>
		                <div class='col d-flex justify-content-between'>
			              <p class='fs-4 text-dark'>&pound".$rows['SELLING_PRICE']."</p>
			                    <p class='fs-4 text-decoration-line-through fw-light text-dark'>&pound". $rows['INITIAL_PRICE']."</p>
			                  </div>
			                </div>
			                <div class=''>".$rows['PRODUCT_RATING']."
			                  <div class='col-12 d-inline-flex rating text-dark'>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star-half-alt'></i></p>
			                  </div>
			                </div>
			                <div class='card-footer'>
			                  <div class='d-grid gap-2 my-4'> <a href='php/managecart.php' class='btn btn-warning'>Add to cart</a> </div>
			                </div>
			              </div>
			            </a>
			          </div>";
			}
	}
	elseif(isset($_POST['Price_range'])&&isset($_POST['Rating'])||isset($_POST['Discount'])&&isset($_POST['Rating'])||isset($_POST['Discount'])&&isset($_POST['Price_range'])){

		echo 'TWO SET';
		
		//enters this if price range and rating are set
		if(isset($_POST['Price_range'])&&isset($_POST['Rating'])){
			$product_rating = $_POST['Rating'];
			
			if ($sorttype == 'SELLING_PRICE'&& $sortorder == 'Asc') {
				$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating FROM (SELECT * FROM Product WHERE selling_price>1)  WHERE Product_Rating>=:product_rating AND Selling_price<= :price_range ORDER BY SELLING_PRICE asc';

			}
			elseif($sorttype == 'DISCOUNT_PERCENTAGE'&& $sortorder == 'Asc'){
				$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating FROM (SELECT * FROM Product WHERE selling_price>1)  WHERE Product_Rating>=:product_rating AND Selling_price<= :price_range ORDER BY DISCOUNT_PERCENTAGE asc';				
			}
			elseif($sorttype == 'PRODUCT_NAME'&& $sortorder == 'Asc'){
				$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating FROM (SELECT * FROM Product WHERE selling_price>1)  WHERE Product_Rating>=:product_rating AND Selling_price<= :price_range ORDER BY PRODUCT_NAME asc';				
			}
			elseif($sorttype == 'SELLING_PRICE'&& $sortorder == 'Desc'){
				$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating FROM (SELECT * FROM Product WHERE selling_price>1)  WHERE Product_Rating>=:product_rating AND Selling_price<= :price_range ORDER BY SELLING_PRICE desc';				
			}
			elseif($sorttype == 'DISCOUNT_PERCENTAGE'&& $sortorder == 'Desc'){
				$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating FROM (SELECT * FROM Product WHERE selling_price>1)  WHERE Product_Rating>=:product_rating AND Selling_price<= :price_range ORDER BY DISCOUNT_PERCENTAGE desc';				
			}

			else{
				$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating FROM (SELECT * FROM Product WHERE selling_price>1)  WHERE Product_Rating>=:product_rating AND Selling_price<= :price_range ORDER BY PRODUCT_NAME desc';
			}
			$parse = oci_parse($conn, $sql);
			oci_bind_by_name($parse, ':price_range', $_POST['Price_range']);
			oci_bind_by_name($parse, ':product_rating', $product_rating);
			oci_execute($parse);
			while ($rows = oci_fetch_assoc($parse)) {
				echo "<div class='col-md-4 justify-content-center py-2 px-2'>
	           		<a href='#' class='text-decoration-none'>
		              <div class='card flex-column px-2 py-2 card_product'>
		                <div class='image-div'>
		                  <img src='images/".$rows['PRODUCT_IMAGE']."' class='img-fluid' alt='product'>
		                </div>
		                <div class=''>
		                  <p class='fs-2 text-dark'>".$rows['PRODUCT_NAME']."</p>
		                  </div>
		                <div class=''>
		                <div class='col d-flex justify-content-between'>
			              <p class='fs-4 text-dark'>&pound".$rows['SELLING_PRICE']."</p>
			                    <p class='fs-4 text-decoration-line-through fw-light text-dark'>&pound". $rows['INITIAL_PRICE']."</p>
			                  </div>
			                </div>
			                <div class=''>".$price_prod['PRODUCT_RATING']."
			                  <div class='col-12 d-inline-flex rating text-dark'>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star-half-alt'></i></p>
			                  </div>
			                </div>
			                <div class='card-footer'>
			                  <div class='d-grid gap-2 my-4'> <a href='php/managecart.php' class='btn btn-warning'>Add to cart</a> </div>
			                </div>
			              </div>
			            </a>
			          </div>";
			}
		}
		//enters this if discount and rating are set
		elseif(isset($_POST['Discount'])&&isset($_POST['Rating'])){
			$dis = explode('-', $_POST['Discount']);
			$init_dis = $dis[0];
			$final_dis = $dis[1];
			$product_rating = $_POST['Rating'];
			if ($sorttype == 'SELLING_PRICE' && $sortorder =='Asc') {
				$sql = 'SELECT Product_name,Product_Image,Selling_price,Discount_name,Product_Rating FROM Product p, Discount d WHERE p.discount_id = d.discount_id AND Product_Rating>= :product_rating AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY SELLING_PRICE asc';
			}
			elseif ($sorttype=='DISCOUNT_PERCENTAGE'&& $sortorder =='Asc') {
				$sql = 'SELECT Product_name,Product_Image,Selling_price,Discount_name,Product_Rating FROM Product p, Discount d WHERE p.discount_id = d.discount_id AND Product_Rating>= :product_rating AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY DISCOUNT_PERCENTAGE asc';
			}
			elseif ($sorttype=='PRODUCT_NAME'&& $sortorder =='Asc') {
				$sql = 'SELECT Product_name,Product_Image,Selling_price,Discount_name,Product_Rating FROM Product p, Discount d WHERE p.discount_id = d.discount_id AND Product_Rating>= :product_rating AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY PRODUCT_NAME asc';
			}
			elseif ($sorttype=='SELLING_PRICE'&& $sortorder =='Desc') {
				$sql = 'SELECT Product_name,Product_Image,Selling_price,Discount_name,Product_Rating FROM Product p, Discount d WHERE p.discount_id = d.discount_id AND Product_Rating>= :product_rating AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY SELLING_PRICE desc';
			}
			elseif ($sorttype=='DISCOUNT_PERCENTAGE'&& $sortorder =='Desc') {
				$sql = 'SELECT Product_name,Product_Image,Selling_price,Discount_name,Product_Rating FROM Product p, Discount d WHERE p.discount_id = d.discount_id AND Product_Rating>= :product_rating AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY DISCOUNT_PERCENTAGE desc';
			}
			else{
				$sql = 'SELECT Product_name,Product_Image,Selling_price,Discount_name,Product_Rating FROM Product p, Discount d WHERE p.discount_id = d.discount_id AND Product_Rating>= :product_rating AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY PRODUCT_NAME desc';
			}
				
				$parse = oci_parse($conn, $sql);
			oci_bind_by_name($parse, ':product_rating', $product_rating);
			oci_bind_by_name($parse, ':init_dis', $init_dis);
			oci_bind_by_name($parse, ':final_dis', $final_dis);
			oci_execute($parse);
			while ($rows = oci_fetch_assoc($parse)) {
				echo "<div class='col-md-4 justify-content-center py-2 px-2'>
	           		<a href='#' class='text-decoration-none'>
		              <div class='card flex-column px-2 py-2 card_product'>
		                <div class='image-div'>
		                  <img src='images/".$rows['PRODUCT_IMAGE']."' class='img-fluid' alt='product'>
		                </div>
		                <div class=''>
		                  <p class='fs-2 text-dark'>".$rows['PRODUCT_NAME']."</p>
		                  </div>
		                <div class=''>
		                <div class='col d-flex justify-content-between'>
			              <p class='fs-4 text-dark'>&pound".$rows['SELLING_PRICE']."</p>
			                    <p class='fs-4 text-decoration-line-through fw-light text-dark'>". $rows['DISCOUNT_NAME']."</p>
			                  </div>
			                </div>
			                <div class=''>".$price_prod['PRODUCT_RATING']."
			                  <div class='col-12 d-inline-flex rating text-dark'>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star-half-alt'></i></p>
			                  </div>
			                </div>
			                <div class='card-footer'>
			                  <div class='d-grid gap-2 my-4'> <a href='php/managecart.php' class='btn btn-warning'>Add to cart</a> </div>
			                </div>
			              </div>
			            </a>
			          </div>";
			}
		}
		//enters this if discount and price range are set
		elseif(isset($_POST['Discount'])&&isset($_POST['Price_range'])){
			$dis = explode('-', $_POST['Discount']);
			$init_dis = $dis[0];
			$final_dis = $dis[1];
			$price_range = $_POST['Price_range'];
			if($sorttype=='SELLING_PRICE' && $sortorder = 'Asc'){
				$sql = 'SELECT Product_name,Product_Image,Initial_Price,Selling_price,Discount_name,Product_Rating FROM Product p, Discount d WHERE p.discount_id = d.discount_id AND Selling_price<=:price_range AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY SELLING_PRICE asc';
			}
			elseif($sorttype=='DISCOUNT_PERCENTAGE'&& $sortorder = 'Asc'){
				$sql = 'SELECT Product_name,Product_Image,Initial_Price,Selling_price,Discount_name,Product_Rating FROM Product p, Discount d WHERE p.discount_id = d.discount_id AND Selling_price<=:price_range AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY DISCOUNT_PERCENTAGE asc';
			}
			elseif($sorttype=='PRODUCT_NAME'&& $sortorder = 'Asc'){
				$sql = 'SELECT Product_name,Product_Image,Initial_Price,Selling_price,Discount_name,Product_Rating FROM Product p, Discount d WHERE p.discount_id = d.discount_id AND Selling_price<=:price_range AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY PRODUCT_NAME asc';
			}
			elseif($sorttype=='SELLING_PRICE'&& $sortorder = 'Desc'){
				$sql = 'SELECT Product_name,Product_Image,Initial_Price,Selling_price,Discount_name,Product_Rating FROM Product p, Discount d WHERE p.discount_id = d.discount_id AND Selling_price<=:price_range AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY SELLING_PRICE desc';
			}
			elseif($sorttype=='DISCOUNT_PERCENTAGE'&& $sortorder = 'Desc'){
				$sql = 'SELECT Product_name,Product_Image,Initial_Price,Selling_price,Discount_name,Product_Rating FROM Product p, Discount d WHERE p.discount_id = d.discount_id AND Selling_price<=:price_range AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY DISCOUNT_PERCENTAGE desc';
			}
			else{
				$sql = 'SELECT Product_name,Product_Image,Initial_Price,Selling_price,Discount_name,Product_Rating FROM Product p, Discount d WHERE p.discount_id = d.discount_id AND Selling_price<=:price_range AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY PRODUCT_NAME desc';
			}
				
			$parse = oci_parse($conn, $sql);
			oci_bind_by_name($parse, ':price_range', $price_range);
			oci_bind_by_name($parse, ':init_dis', $init_dis);
			oci_bind_by_name($parse, ':final_dis', $final_dis);
			oci_execute($parse);
			while ($rows = oci_fetch_assoc($parse)) {
				echo "<div class='col-md-4 justify-content-center py-2 px-2'>
	           		<a href='#' class='text-decoration-none'>
		              <div class='card flex-column px-2 py-2 card_product'>
		                <div class='image-div'>
		                  <img src='images/".$rows['PRODUCT_IMAGE']."' class='img-fluid' alt='product'>
		                </div>
		                <div class=''>
		                  <p class='fs-2 text-dark'>".$rows['PRODUCT_NAME']."</p>
		                  </div>
		                <div class=''>
		                <div class='col d-flex justify-content-between'>
			              <p class='fs-4 text-dark'>&pound".$rows['SELLING_PRICE']."</p>
			 
			                  </div>
			                </div>
			                <div class=''>
		                <div class='col d-flex justify-content-between'>
			              <p class='fs-4 text-dark'>".$rows['DISCOUNT_NAME']."</p>
			                    <p class='fs-4 text-decoration-line-through fw-light text-dark'>&pound". $rows['INITIAL_PRICE']."</p>
			                  </div>
			                </div>
			                <div class=''>".$rows['PRODUCT_RATING']."
			                  <div class='col-12 d-inline-flex rating text-dark'>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star-half-alt'></i></p>
			                  </div>
			                </div>
			                <div class='card-footer'>
			                  <div class='d-grid gap-2 my-4'> <a href='php/managecart.php' class='btn btn-warning'>Add to cart</a> </div>
			                </div>
			              </div>
			            </a>
			          </div>";
			}
		}
	}

	elseif (isset($_POST['Price_range'])||isset($_POST['Rating'])||isset($_POST['Discount'])) {
		
		//enters if only discount is set
		if(!empty($_POST['Discount'])){
			$dis = explode('-', $_POST['Discount']);
			$init_dis = $dis[0];
			$final_dis = $dis[1];

			if ($sortype == 'SELLING_PRICE' && $sortorder == 'Asc') {
				
				$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating,Discount_name FROM Product P, Discount D WHERE D.discount_id = P.discount_id AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY SELLING_PRICE asc';	
			}
			elseif($sorttype == 'DISCOUNT_PERCENTAGE' && $sortorder == 'Asc'){
				$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating,Discount_name FROM Product P, Discount D WHERE D.discount_id = P.discount_id AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY DISCOUNT_PERCENTAGE asc';
			}
			elseif($sorttype == 'PRODUCT_NAME' && $sortorder == 'Asc'){
				$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating,Discount_name FROM Product P, Discount D WHERE D.discount_id = P.discount_id AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY PRODUCT_NAME asc';
			}
			elseif($sorttype == 'SELLING_PRICE'&& $sortorder == 'Desc'){
				$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating,Discount_name FROM Product P, Discount D WHERE D.discount_id = P.discount_id AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY SELLING_PRICE desc';
			}
			elseif($sorttype == 'DISCOUNT_PERCENTAGE'&& $sortorder == 'Desc'){
				$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating,Discount_name FROM Product P, Discount D WHERE D.discount_id = P.discount_id AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY DISCOUNT_PERCENTAGE desc';
			}
			else{
				$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating,Discount_name FROM Product P, Discount D WHERE D.discount_id = P.discount_id AND Discount_percentage BETWEEN :init_dis AND :final_dis ORDER BY PRODUCT_NAME desc';
			}
			$parse = oci_parse($conn, $sql);
			
			oci_bind_by_name($parse, ':init_dis', $init_dis);
			oci_bind_by_name($parse,':final_dis',$final_dis);
			oci_execute($parse);
			while ($rows = oci_fetch_assoc($parse)) {
				echo "<div class='col-md-4 justify-content-center py-2 px-2'>
	           		<a href='#' class='text-decoration-none'>
		              <div class='card flex-column px-2 py-2 card_product'>
		                <div class='image-div'>
		                  <img src='images/".$rows['PRODUCT_IMAGE']."' class='img-fluid' alt='product'>
		                </div>
		                <div class=''>
		                  <p class='fs-2 text-dark'>".$rows['PRODUCT_NAME']."</p>
		                  </div>
		                  <div class=''>
		                  <p class='fs-2 text-dark'>".$rows['DISCOUNT_NAME']."</p>
		                  </div>
		                <div class=''>
		                <div class='col d-flex justify-content-between'>
			              <p class='fs-4 text-dark'>&pound".$rows['SELLING_PRICE']."</p>
			                    <p class='fs-4 text-decoration-line-through fw-light text-dark'>&pound". $rows['INITIAL_PRICE']."</p>
			                  </div>
			                </div>
			                <div class=''>".$rows['PRODUCT_RATING']."
			                  <div class='col-12 d-inline-flex rating text-dark'>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star-half-alt'></i></p>
			                  </div>
			                </div>
			                <div class='card-footer'>
			                  <div class='d-grid gap-2 my-4'> <a href='php/managecart.php' class='btn btn-warning'>Add to cart</a> </div>
			                </div>
			              </div>
			            </a>
			          </div>";
			}
		}
		//enters if only rating is set
		elseif (isset($_POST['Rating'])) {
			if ($sorttype == 'SELLING_PRICE' && $sortorder == 'Asc') {
				$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating FROM Product  WHERE Product_Rating>=:rating ORDER BY SELLING_PRICE asc';
			}
			elseif($sorttype == 'DISCOUNT_PERCENTAGE'&& $sortorder == 'Asc'){
				$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating FROM Product  WHERE Product_Rating>=:rating ORDER BY DISCOUNT_PERCENTAGE asc';
			}
			elseif($sorttype == 'PRODUCT_NAME'&& $sortorder == 'Asc'){
				$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating FROM Product  WHERE Product_Rating>=:rating ORDER BY Product_name asc';
			}
			elseif($sorttype == 'DISCOUNT_PERCENTAGE' && $sortorder == 'Desc'){
				$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating FROM Product  WHERE Product_Rating>=:rating ORDER BY DISCOUNT_PERCENTAGE desc';
			}
			elseif($sorttype == 'SELLING_PRICE' && $sortorder == 'Desc'){
				$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating FROM Product  WHERE Product_Rating>=:rating ORDER BY SELLING_PRICE desc';
			}
			else{
				$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating FROM Product  WHERE Product_Rating>=:rating ORDER BY PRODUCT_NAME desc';
			}
				
			$parse = oci_parse($conn, $sql);
			oci_bind_by_name($parse, ':rating', $_POST['Rating']);
			
			oci_execute($parse);
			while ($rating_prod = oci_fetch_assoc($parse)) {
				echo "<div class='col-md-4 justify-content-center py-2 px-2'>
	           		<a href='#' class='text-decoration-none'>
		              <div class='card flex-column px-2 py-2 card_product'>
		                <div class='image-div'>
		                  <img src='images/". $rating_prod['PRODUCT_IMAGE']."' class='img-fluid' alt='product'>
		                </div>
		                <div class=''>
		                  <p class='fs-2 text-dark'>".$rating_prod['PRODUCT_NAME']."</p>
		                  </div>
		                <div class=''>
		                <div class='col d-flex justify-content-between'>
			              <p class='fs-4 text-dark'>&pound". $rating_prod['SELLING_PRICE']."</p>
			                    <p class='fs-4 text-decoration-line-through fw-light text-dark'>&pound". $rating_prod['INITIAL_PRICE']."</p>
			                  </div>
			                </div>
			                <div class=''>".$price_prod['PRODUCT_RATING']."
			                  <div class='col-12 d-inline-flex rating text-dark'>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
			                    <p class='fs-5 pe-2'><i class='fas fa-star-half-alt'></i></p>
			                  </div>
			                </div>
			                <div class='card-footer'>
			                  <div class='d-grid gap-2 my-4'> <a href='php/managecart.php' class='btn btn-warning'>Add to cart</a> </div>
			                </div>
			              </div>
			            </a>
			          </div>";
			}
		}
		//enters if only price range is set
		elseif (isset($_POST['Price_range'])) {
				$price_range = $_POST['Price_range'];
				if ($sorttype == 'SELLING_PRICE' && $sortorder == 'Asc') {
					$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating FROM Product  WHERE  Selling_Price<=:price_range ORDER BY SELLING_PRICE asc';
				}
				elseif($sorttype == 'DISCOUNT_PERCENTAGE' && $sortorder == 'Asc'){
					$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating,Discount_name FROM Product P, Discount D WHERE D.discount_id = P.discount_id AND Selling_Price<=:price_range ORDER BY DISCOUNT_PERCENTAGE asc' ;
				}
				elseif($sorttype == 'PRODUCT_NAME' && $sortorder == 'Asc'){
					$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating FROM Product  WHERE  Selling_Price<=:price_range ORDER BY PRODUCT_NAME asc';
				}
				elseif($sorttype == 'SELLING_PRICE' && $sortorder == 'Desc'){
					$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating FROM Product  WHERE  Selling_Price<=:price_range ORDER BY SELLING_PRICE desc';
				}
				elseif($sorttype == 'DISCOUNT_PERCENTAGE' && $sortorder == 'Desc'){
					$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating,Discount_name FROM Product P, Discount D WHERE D.discount_id = P.discount_id AND Selling_Price<=:price_range ORDER BY DISCOUNT_PERCENTAGE desc';
				}
				else{
					$sql = 'SELECT Product_name,Product_Image,Initial_price,Selling_price,Product_Rating FROM Product  WHERE Selling_Price<=:price_range ORDER BY PRODUCT_NAME desc';
				}
				
				$parse = oci_parse($conn, $sql);
				oci_bind_by_name($parse, ':price_range', $price_range);
			oci_execute($parse);
			while ($price_prod = oci_fetch_assoc($parse)) {
				echo "<div class='col-md-4 justify-content-center py-2 px-2'>
            		<a href='#' class='text-decoration-none'>
		              <div class='card flex-column px-2 py-2 card_product'>
		                <div class='image-div'>
		                  <img src='images/".$price_prod['PRODUCT_IMAGE']."' class='img-fluid' alt='product'>
		                </div>
		                <div class=''>
		                  <p class='fs-2 text-dark'>".$price_prod['PRODUCT_NAME']."</p>
		                </div>
		                <div class=''>
		                  <div class='col d-flex justify-content-between'>
		                    <p class='fs-4 text-dark'>&pound".$price_prod['SELLING_PRICE']."</p>
		                    <p class='fs-4 text-decoration-line-through fw-light text-dark'>&pound". $price_prod['INITIAL_PRICE']."</p>
		                  </div>
		                </div>
		                <div class=''>".$price_prod['PRODUCT_RATING']."
		                  <div class='col-12 d-inline-flex rating text-dark'>
		                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
		                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
		                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
		                    <p class='fs-5 pe-2'><i class='fas fa-star'></i></p>
		                    <p class='fs-5 pe-2'><i class='fas fa-star-half-alt'></i></p>
		                  </div>
		                </div>
		                <div class='card-footer'>
		                  <div class='d-grid gap-2 my-4'> <a href='php/managecart.php' class='btn btn-warning'>Add to cart</a> </div>
		                </div>
		              </div>
		            </a>
		          </div>";
			}
		}
	
	}
	else{
		//Do nothing
	}
?>