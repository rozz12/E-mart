<?php
session_start();
    include('NavigationOnly.php');
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
    <title>Cart</title>
    <link rel="stylesheet" href="Style/Homepage.css">

    <link rel="stylesheet" href="Style/owl.carousel.min.css">
    <link rel="stylesheet" href="Style/owl.theme.default.min.css">
    <link rel="stylesheet" href="Style/trendingItems.css">

</head>

<body>
    <!--Navigation-->

    <!--Cart-->
    <div class="container-fluid cart_container">
        <div class="row">
            <!--Items and quantity-->
            <div class="col-lg-9 border border-dark col-md-12 cart_left_col">
                <!--Number of Items-->
                <div class="row pt-2">
                    <p class="fs-3" id='cart_items'></p>
                    <hr style="color: black;">
                </div>
                <!--Items List-->
                 <?php 
                        if (empty($_SESSION['cart'])) {
                            echo '<h1>0 Items</h1>';
                            $tax = 0;
                        }
                        else{
                            $tax = 1.24;
                            foreach ( $_SESSION['cart'] as $key => $value) { 
                            //starting the foreach loop traversing all the details stored in the seesion cart variable
                    ?>
                <div class="row border border-dark mt-1 ms-1 mb-2 me-1 Item_box">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <img src="images/<?php echo $value['item_img']?>" class="img-fluid float-start p-2" alt="<?php echo $value['item_img']?>">
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <p class="fs-5"><?php echo $value['item_name']?></p>
                        <p class="fs-6"><?php echo $value['desc']?></p>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12 d-inline-flex align-items-center">
                        <p class="fs-6 pe-2 pt-2">Quantity</p>
                        <form action="php/managecart.php" method="POST">
                            <input class="form-control item_quantity" type="number" onchange="this.form.submit()" value="<?php echo $value['quantity']?>" name='upd_quantity' aria-label="Quantity" style="height:38px; width:70px;"/>
                            <input type="hidden" name="item" value="<?php echo $value['item_id'] ?>">
                        </form>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 d-flex flex-column align-items-center pt-3">
                        <div class="d-flex justify-content-around">
                            <p>&pound</p>
                            <p class="fs-5 pe-4 fw-bolder isub_price"></p>
                            <input type="hidden" name="i_price" class="i_price" value="<?php echo $value['selling_price']?>">
                            <p class="fs-5 fw-lighter text-decoration-line-through">&pound <?php echo $value['initial_price']?></p>
                        </div>
                        <div class="">
                            <p class="fs-6"><?php echo $value['discount']?></p>
                        </div>
                        <div class="">
                            <form action="php/managecart.php" method="POST">
                                <button type="submit" class="btn btn-outline-danger btn-custom mb-4" style="width: 100px;" name="remove_item">Remove</button>
                                <input type="hidden" name="item" value="<?php echo $value['item_id'] ?>">
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                        //ending the foreach

                        }
                        //ending the else block
                    }
                ?>
            </div>
            <!--Total Cost Details-->
            <div class="col-lg-3 border border-dark col-md-12 cart_right_col">
                <div class="row d-flex justify-content-around">
                    <div class="col ms-3">
                        <p class="fs-5 fw-light">Sub total</p>
                    </div>
                    <div class="col d-flex justify-content-end me-3">
                        <p>&pound</p>
                        <p class="fs-5 fw-light" id="subtotal"> </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col ms-3">
                        <p class="fs-5 fw-light">Tax and charges</p>
                    </div>
                    <div class="col d-flex justify-content-end me-3">
                        <p>&pound </p>
                        <p class="fs-5 fw-light"><?php echo $tax?></p>
                        <input type="hidden" class="tax" value="<?php echo $tax?>">
                    </div>
                </div>
                <div class="row border-top border-bottom border-2 border-dark">
                    <div class="col ms-3">
                        <p class="fs-5 fw-light pt-1">Grand total</p>
                    </div>
                    <div class="col d-flex justify-content-end me-3">
                        <p>&pound</p>
                        <p class="fs-5 fw-bolder pt-1" id="grandtotal"></p>
                    </div>
                </div>

                <!--Buttons-->
                <div class="row d-flex justify-content-center px-3 ">
                    <button type="button" class="btn btn-success mt-4 mb-3 w-100" data-bs-toggle="modal" data-bs-target="#mymodal"> Choose Collection Slot
                </button>
                </div>
                <div class="row d-flex justify-content-center px-3">
                    <button type="button"
                        class="btn btn-secondary mb-3 w-100 d-flex align-items-center justify-content-center chkout"
                        style="height: 50px;"><i class="far fa-check-square" style="width: 30px;" onclick="checkout()"></i>Proceed To
                        Checkout</button>
                </div>
                <?php 
                    //to not display login button if already logged in
                    if (!isset($_SESSION['userid'])) {
                ?>
                <div class="row d-flex justify-content-center px-3">
                    <button type="button" class="btn btn-primary mt-5 mb-3 w-100 login" style="height: 50px;">Login</button>
                </div>
                <div class="row d-flex justify-content-center px-3">
                    <button type="button" class="btn btn-primary mb-3 w-100 signup" style="height: 50px;">Signup</button>
                </div>
                <?php
                    //ending of previous if block
                    }
                ?>
            </div>
        </div>
    </div>

    <!--Customer also bought-->
    <div class="container-fluid also_bought_container">
        <div class="row border border-dark p-4 my-2">
            <p class="fs-4">Customer also bought these items</p>
                <!--Owl Carousel-->
                <div class="row">
                    <div class="owl-carousel owl-theme">
                        <?php
                            $trend_qry = 'SELECT product_id,product_name,product_image,allergy_information,initial_price,selling_price,product_rating from product p WHERE ROWNUM <=10';
                            $trend_fetch = oci_parse($conn, $trend_qry);
                            oci_execute($trend_fetch);
                            while($trend_row = oci_fetch_assoc($trend_fetch)){
                                //starting of the while loop to fetch product
                        ?>
                        <a href="productDetails.php?product_id=<?php echo $trend_row['PRODUCT_ID']?>" class="text-decoration-none">
                            <div class="card flex-column p-2 card_product mx-2">
                                <div class="">
                                    <img data-src="images/<?php echo $trend_row['PRODUCT_IMAGE']?>" class="img-fluid card_image owl-lazy" alt="<?php echo $trend_row['PRODUCT_IMAGE']?>">
                                </div>
                                <div class="">
                                    <p class="fs-3 text-dark"><?php echo $trend_row['PRODUCT_NAME']?></p>
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
                                    <form action="php/managecart.php?item_id=<?php echo $trend_row['PRODUCT_ID']?>" method="POST">
                                        <input type="hidden" name="quantity" id="prod_quantity" value="1">
                                        <input type="hidden" name="tot_price" id="tot_price" value="<?php echo $trend_row['SELLING_PRICE']?>">
                                        <button type="submit" class="btn btn-warning w-100" name="Add_to_cart">Add To Cart</button>
                                    </form>
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
    </div>
    
    <!--JQuery for owl carousel-->
    <script src="Javascript/trendingItemsJq.js"></script>
    <script src="Javascript/owl.carousel.min.js"></script>
    <script src="Javascript/script.js"></script>

    <!-----Modal For Collection----------------------->
                    <div class="modal fade" id="mymodal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <!-- Modal-header -->
                            <div class="modal-header modal_head">
                                <h5 class="modal-title d-flex" id="exampleModalLabel">COLLECTION DETAILS</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal-body -->
                            <div class="modal-body">
                                <?php
                                include('php/collection.php');
                                ?>
                                
                            </div>
                        </div>
                    </div>
                </div>


    <!--Footer-->
    <?php
        include('footerOnly.php');
    ?>
     <script type="text/javascript">
                var st = 0;
                var gt = 0;
                var isub_price = document.querySelectorAll('.isub_price');
                var item_quantity = document.querySelectorAll('.item_quantity');
                var i_price = document.querySelectorAll('.i_price');
                var subtotal = document.querySelector('#subtotal');
                var tax = document.querySelector('.tax').value;
                var grandtotal = document.querySelector('#grandtotal');
                //function to calculate subtotal of each item as quantity changes
                function item_subtotal(){
                    //again set subtotal 0 on each call as quantity changes
                    st = 0;
                    gt = 0;
                    //loop to go through each items price and quantity field 
                    for (var i = 0; i < i_price.length; i++) {
                        isub_price[i].innerText = (i_price[i].value)*(item_quantity[i].value);
                        st = st + (i_price[i].value)*(item_quantity[i].value);
                    }
                         subtotal.innerText = st;
                         gt = st + Number(tax);
                         grandtotal.innerText = gt.toFixed(2);
                }
                 //calling the funcion
                 item_subtotal();

                 //button functions
                document.querySelector('.chkout').addEventListener('click', function(){document.location.href = "checkout.php"});

                 document.querySelector('.login').addEventListener('click', function(){document.location.href = "signin.php"});
                  document.querySelector('.signup').addEventListener('click', function(){document.location.href = "php/register_customer.php"});
            </script>

    <!--<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
        crossorigin="anonymous"></script>-->
</body>

</html>