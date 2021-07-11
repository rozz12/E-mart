<?php
    include('NavigationOnly.php');
    $category = $_GET['category'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>Products By Category</title>
    <link rel="stylesheet" href="   Style/Homepage.css">
</head>

<body>
    <!--Navigation-->
    
    <!--Product List-->
    <div class="container-fluid p-4 category_product_container">
        <div class="row pb-5">
            <div class="col-12 d-flex justify-content-center">
                <p class="fs-3"><?php echo $category?></p>
            </div>
        </div>
        <div class="row">
            <?php
                //fetching all products of the same category
                $cat_qry = 'SELECT product_id, product_image, product_name, initial_price, selling_price, description, PRODUCT_RATING FROM product p , shop s WHERE p.shop_id = s.shop_id AND category(shoptype_id) = :category ';
                $cat_parse = oci_parse($conn, $cat_qry);
                oci_bind_by_name($cat_parse, ':category', $category);
                oci_execute($cat_parse);
                while ($ctgrize_prod = oci_fetch_assoc($cat_parse)) {
                    # code to fetch all products of same category
            ?>
            <div class="col-md-4 justify-content-center py-2 px-2">
                <a href="productDetails.php?product_id=<?php echo $ctgrize_prod['PRODUCT_ID']?>" class="text-decoration-none">
                    <div class="card flex-column px-2 py-2 card_product">
                        <div class="">
                            <img src="images/<?php echo $ctgrize_prod['PRODUCT_IMAGE']?>" class="img-fluid" style="height:300px; width:550px;" alt="product">
                        </div>
                        <div class="">
                            <p class="fs-3 text-dark"><?php echo $ctgrize_prod['PRODUCT_NAME']?></p>
                        </div>
                        <div class="d-inline-flex">
                            <?php 
                if($ctgrize_prod['PRODUCT_RATING'] == 5)
                  { 
                ?>
                  <p class="fs-6 pe-2"><i class="fas fa-star checked"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star checked"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star checked"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star checked"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star checked"></i></p>
                <?php 
                  }
                ?>
                <?php 
                if($ctgrize_prod['PRODUCT_RATING'] >= 4&&$ctgrize_prod['PRODUCT_RATING'] < 5)
                  { 
                ?>
                  <p class="fs-6 pe-2"><i class="fas fa-star checked"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star checked"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star checked"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star checked"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star"></i></p>
                <?php 
                  }
                ?>
                <?php 
                if($ctgrize_prod['PRODUCT_RATING'] >= 3&&$ctgrize_prod['PRODUCT_RATING'] < 4)
                  { 
                ?>
                  <p class="fs-6 pe-2"><i class="fas fa-star checked"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star checked"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star checked"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star"></i></p>
                <?php 
                  }
                ?>
                <?php 
                if($ctgrize_prod['PRODUCT_RATING'] >= 2&&$ctgrize_prod['PRODUCT_RATING'] < 3)
                  { 
                ?>
                  <p class="fs-6 pe-2"><i class="fas fa-star checked"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star checked"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star"></i></p>
                <?php 
                  }
                ?>
                        </div>
                        <div class="">
                            <div class="col d-flex justify-content-between">
                                <p class="fs-5 text-dark">&pound <?php echo $ctgrize_prod['INITIAL_PRICE']?></p>
                            </div>
                        </div>
                        <div class="">
                            <form action="php/managecart.php?item_id=<?php echo $ctgrize_prod['PRODUCT_ID']?>" method="POST">
                                <input type="hidden" name="quantity" id="prod_quantity" value="1">
                                <!--<input type="hidden" name="tot_price" id="tot_price" value="<?php echo $ctgrize_prod['SELLING_PRICE']?>">-->
                                <button type="submit" class="btn btn-warning w-100" name="Add_to_cart">Add To Cart</button>
                            </form>
                        </div>
                    </div>
                </a>
            </div>
            <?php
                //ending the previous while loop
                }
            ?>
        </div>
    </div>

    <!--Footer-->
    <div class="container-fluid footer_container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end col_paypal">
                <img title="paypal" src="images/paypalicon.png" alt="payment methods" width="170px" height="60px">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 col_logo">
                <img src="images/Logo.png" class="img-fluid" height="370px" width="400px">
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 pt-3">
                <p class="fs-2">Customer Service</p>
                <ul class="nav flex-column">
                    <p class="fs-5 border-top border-2 border-dark">
                        <a href="#" class="text-decoration-none">Home</a>
                    </p>
                    <p class="fs-5 border-top border-2 border-dark">
                        <a href="#" class="text-decoration-none">About</a>
                    </p>
                    <p class="fs-5 border-top border-2 border-dark">
                        <a href="#" class="text-decoration-none">Terms and Conditions</a>
                    </p>
                    <p class="fs-5 border-top border-2 border-dark">
                        <a href="mailto:manager@gmail.com" class="text-decoration-none">Write a mail</a>
                    </p>
                </ul>
            </div>
            <div
                class="col-lg-4 d-flex flex-column col-md-6 justify-content-md-start col-sm-12 col-xs-12 pt-3 col_social">
                <p class="fs-2">Find us on</p>
                <p class="fs-5">
                    <a href="https://www.facebook.com/"><i class="fab fa-facebook-square social fa-2x"></i></a>
                </p>
                <p class="fs-5">
                    <a href="https://www.instagram.com/accounts/login/?next=/direct/inbox/"><i
                            class="fab fa-instagram social fa-2x"></i></a>
                </p>
                <p class="fs-5">
                    <a href="https://twitter.com/?lang=en"><i class="fab fa-twitter-square social fa-2x"></i></a>
                </p>
            </div>
        </div>

        <div class="row footer_copyright">
            <div class="col d-inline-flex align-items-center col_copyright">
                <p class="fs-4 pe-2 pt-2"><i class="fas fa-copyright"></i></p>
                <p class="fs-5 pt-2">Copyright Cleckhuddersfax - All rights reserved 2021</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
        crossorigin="anonymous"></script>
</body>

</html>
