<?php
	include('connection.php');

	$qry = 'SELECT * FROM Products';
	$sql = mysqli_query($connection,$qry);
	while ($row = mysqli_fetch_assoc($sql)){
		echo "
		<section class='container shop_by_cat'>
			<h5 class='text-center'>Shop By Category</h5>
			<div class='row'>
				<div class='d-sm-flex flex-wrap'>
					<div class='p-2 m-2 bg-info flex-sm-fill'><img src ='../images/".$row['Product_Image']."' alt = '".$row['Product_Image']."'>
					</div>
				</div>
			</div>
		</section>
		";
	}
	
?>