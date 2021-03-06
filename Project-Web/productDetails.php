   <?php
   session_start();
     $product_id = $_GET['product_id'];
      if (!isset($product_id)) {
        header('Location: Homepage.php');
      }
      else{
        include('NavigationOnly.php');
        
        //qry to fetch the data of selected product
        $sel_prod_qry = 'SELECT * FROM Product WHERE product_id = :product_id';
        $parse = oci_parse($conn, $sel_prod_qry);
        oci_bind_by_name($parse, ':product_id', $product_id);
        oci_execute($parse);
        $products_rows = oci_fetch_assoc($parse);
        $discount_id = $products_rows['DISCOUNT_ID'];  

        //fetching the discount from disocunt_id in product
        $prod_discount = 'SELECT Discount_name FROM Discount WHERE discount_id = :discount_id';
        $parse_disc = oci_parse($conn, $prod_discount);
        oci_bind_by_name($parse_disc, ':discount_id', $discount_id);
        oci_execute($parse_disc);
        $discount = oci_fetch_assoc($parse_disc);

        //fetching the trader and shop name for the product
        $shop_qry = 'SELECT firstname,surname,shop_name,product_name FROM Trader JOIN Shop ON Trader.trader_ID ='.$products_rows['SHOP_ID'].' JOIN Product ON Product.shop_id ='.$products_rows['SHOP_ID'];
        $shop_parse = oci_parse($conn, $shop_qry);
        oci_execute($shop_parse);
        $shop_rows = oci_fetch_assoc($shop_parse);
      }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
    integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link rel="stylesheet" href="Style/productdetails.css">
  <link rel="stylesheet" href="Style/Homepage.css">

  <!--Owl Carousel CSS-->
  <link rel="stylesheet" href="Style/owl.carousel.min.css">
  <link rel="stylesheet" href="Style/owl.theme.default.min.css">
  <link rel="stylesheet" href="Style/trendingItems.css">

  <title>Product Details</title>
</head>

<body>
  <!--Navigation-->
  <!--Product Details-->
  <div class="container-fluid product_details_container">
    <!--Breadcrumb-->
    <div class="row">
      <div class="col-md-12 pb-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="Homepage.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product</li>
          </ol>
        </nav>
      </div>
    </div>

    <!--whole row-->
    <!--Lightbox for vertical images-->
    <div id="lbOuter">
      <div id="lbInner"></div>
    </div>
    <div class="row">
      <!--Images section-->
      <div class="col-lg-6 d-inline-flex col-md-12 col-sm-12 pb-4">
        <div class="row">
          <!--vertical images-->
          <div class="col-lg-2 d-none d-lg-block image-vertical">
            <p><img src="images/<?php echo $products_rows['PRODUCT_IMAGE']?>" class="img-fluid image1" name="image1" id="img1"></p>
            <p><img src="images/<?php echo $products_rows['PRODUCT_IMAGE']?>" class="img-fluid image2" name="image2" id="img2"></p>
            <p><img src="images/<?php echo $products_rows['PRODUCT_IMAGE']?>" class="img-fluid image3" name="image3" id="img3"></p>
          </div>
          <!--horizontal images-->
          <div class="col-lg-10 col-sm-12 col-xs-12 Image ps-3">
            <div class="product_img" id="img-container">
              <img src="images/<?php echo $products_rows['PRODUCT_IMAGE']?>" id="fullimage" class="img-fluid w-100 full_image">    
            </div>
          </div>
          
          <script src="https://unpkg.com/js-image-zoom@0.7.0/js-image-zoom.js" type="application/javascript"></script>
          <script>
                    var options = {
                        zoomWidth: 600,
                        offset: {vertical: 0, horizontal: 120}
                    };
                
                    
                    new ImageZoom(document.getElementById("img-container"), options);           
          </script>
        </div>
      </div>
      <!--Product Details-->
      <div class="col-lg-6 gy-3 col-md-12 col-sm-12 justify-content-sm-center ps-5">
        <div class="row">
          <p class="fs-3 fw-bold"><?php echo $products_rows['PRODUCT_NAME']?></p>
        </div>
        <div class="row">
          <div class="col-3">
            <p class="fs-4"><?php echo $products_rows['INITIAL_PRICE']?></p>
          </div>
          <div class="col-9 gy-2">
            <p class="fs-6"><?php echo $discount['DISCOUNT_NAME']?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-12 d-inline-flex">
            <?php 
                if($products_rows['PRODUCT_RATING'] == 5)
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
                if($products_rows['PRODUCT_RATING'] >= 4&&$products_rows['PRODUCT_RATING'] <5)
                  { 
                ?>
                  <p class="fs-6 pe-2"><i class="fas fa-star"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star checked"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star checked"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star checked"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star checked"></i></p>
                <?php 
                  }
                ?>
                <?php 
                if($products_rows['PRODUCT_RATING'] >= 3&&$products_rows['PRODUCT_RATING'] <4)
                  { 
                ?>
                  <p class="fs-6 pe-2"><i class="fas fa-star"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star checked"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star checked"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star checked"></i></p>
                <?php 
                  }
                ?>
                <?php 
                if($products_rows['PRODUCT_RATING'] >= 2&& $products_rows['PRODUCT_RATING'] < 3)
                  { 
                ?>
                  <p class="fs-6 pe-2"><i class="fas fa-star"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star"></i></p>
                        <p class="fs-6 pe-2"><i class="fas fa-star checked"></i></p>
                <?php 
                  }
                ?>
          </div>
        </div>
        <div class="row mt-4 d-flex justify-content-start quantity_row">
          <p class="fs-5">Quantity</p>
          <button type="button" class="btn btn-primary minus-btn disabled ms-2" style="width:40px;">-</button>
          <input type="text" class="form-control ms-2" name="quantity" id="quantity" aria-describedby="emailHelp" value="1"
            style="width:45px;">
          <button type="button" class="btn btn-primary plus-btn ms-2" style="width:40px;">+</button>
        </div>
        <div class="row product_price pt-4">
          <span class="fs-3"><p>Total: <i class="fas fa-pound-sign"></i><span class="fs-3 ps-2" id="stated_price"><?php echo $products_rows['SELLING_PRICE']?></span></p></span>
        </div>
        <div style="display: none;opacity: 0;color: orange;font-size: 18px;" class = "stock">
            <?php echo 'In Stock:'. $products_rows['STOCK_QUANTITY']; ?>
        </div>
      </div>

      <script>
        //setting default attribute to diabled minus button
        document.querySelector(".minus-btn").setAttribute("disabled", "disabled");

        //taking value to increase or deacrease the imput value
        var valueCount;

        //price variable
        var price = document.getElementById("stated_price").innerText;

        //price calculation function
        function priceTotal(){
          var total = valueCount * price;
          document.getElementById("stated_price").innerText = total;
          document.querySelector('#tot_price').value= total;

        }

        //plus button
        document.querySelector(".plus-btn").addEventListener("click", function () {
          //getting value from the input
          valueCount = document.getElementById("quantity").value;

          //input value increment by 1
          valueCount++;

          //setting increased value in input field
          document.getElementById("quantity").value = valueCount;
          document.querySelector('#prod_quantity').value= valueCount;


          if (valueCount > 1) {
            document.querySelector(".minus-btn").removeAttribute("disabled");
            document.querySelector(".minus-btn").classList.remove("disabled");
          }

          //calling price calculating function
          priceTotal();
        });

        //minus button
        document.querySelector(".minus-btn").addEventListener("click", function () {
          //getting value from the input
          valueCount = document.getElementById("quantity").value;

          //input value decrement by 1
          valueCount--;

          //setting decreased value in input field
          document.getElementById("quantity").value = valueCount;
          document.querySelector('#prod_quantity').value= valueCount;

          if (valueCount == 1) {
            document.querySelector(".minus-btn").setAttribute("disabled", "disabled");
          }
          priceTotal();
        });
      </script>
    </div>

    <!--Cart and availability buttons-->
    <div class="container-fluid">
      <div class="row">
           <div class="col-md-6 d-flex justify-content-center col-sm-12 cart_availability_col">
          <form action="php/managecart.php?item_id=<?php echo $products_rows['PRODUCT_ID']?>" method="POST" class="col-md-6 d-flex justify-content-center col-sm-12 py-1">

            <input type="hidden" name="quantity" id="prod_quantity" value="1">
            <input type="hidden" name="tot_price" id="tot_price" value="<?php echo $products_rows['SELLING_PRICE']?>">
            <button type="submit" name="Add_to_cart" class="btn btn-danger p-3 btn-cart">Add To Cart</button>
          </form>
        </div>
        <div class="col-md-6 d-flex justify-content-center col-sm-12 py-1">
            <button type="submit" class="btn btn-danger p-3 btn-availability ava" name="availability">Check
            Availability</button>
        </div>
      </div>

      <!--Description-->
      <div class="row py-5">
        <div class="col-md-6 col-sm-12 product_first">
          <p class="fs-4 fw-bold">Product Description</p>
          <p class="fs-6"><?php echo $products_rows['DESCRIPTION'] ?></p>
        </div>
        <div class="col-md-6 col-sm-12 product_second">
          <p class="fs-4 fw-bold">Trader Details</p>
          <p class="fs-6"><?php echo $shop_rows['FIRSTNAME'].' '.$shop_rows['SURNAME'] ?></p>
          <p class="fs-6"><?php echo $shop_rows['SHOP_NAME'] ?></p>
        </div>
      </div>
      <div class="row pb-4">
        <div class="col-md-6 col-sm-12 product_third">
          <p class="fs-4 fw-bold">Allergy Description</p>
          <p class="fs-6"><?php echo $products_rows['ALLERGY_INFORMATION'] ?></p>
        </div>
      </div>
    </div>

    <!--Review and rating-->
    <div class="row py-5">
      <div class="col-lg-4 d-flex flex-column col-md-4 col-sm-12 justify-content-md-center rating_col">
        <div class="row">
          <p class="fs-4 fw-bold text-center">Customer's Rating</p>
        </div>
        <div class="row star_rating">
          <div class="col d-inline-flex justify-content-center">
            <p class="fs-3 pe-2"><i class="fas fa-star"></i></p>
            <p class="fs-3 fw-bold"><?php echo $products_rows['PRODUCT_RATING']?></p>
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-md-8 col-sm-12 justify-content-md-center">
        <div class="d-flex justify-content-end pe-2">
          <button type="button" class="btn btn-outline-danger my-4 btn-rate" data-bs-toggle="modal" data-bs-target="#exampleModal">Rate This Product</button>
        </div>
        <div class="row pb-1">
          <div class="col-2 d-flex flex-column">
            <p class="fs-6 pe-2"><i class="fas fa-star d-flex justify-content-end pe-2">5</i></p>
            <p class="fs-6 pe-2"><i class="fas fa-star d-flex justify-content-end pe-2">4</i></p>
            <p class="fs-6 pe-2"><i class="fas fa-star d-flex justify-content-end pe-2">3</i></p>
            <p class="fs-6 pe-2"><i class="fas fa-star d-flex justify-content-end pe-2">2</i></p>
            <p class="fs-6 pe-2"><i class="fas fa-star d-flex justify-content-end pe-2">1</i></p>
          </div>
          <div class="col-10 pb-2">
            <div class="progress mb-3" style="border:0px solid white;">
              <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuemin="100" aria-valuemax="0">
              </div>
            </div>
            <div class="progress mb-3" style="border:0px solid white;">
              <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
            <div class="progress mb-3" style="border:0px solid white;">
              <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
            <div class="progress mb-3" style="border:0px solid white;">
              <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
            <div class="progress" style="border:0px solid white;">
              <div class="progress-bar" role="progressbar" style="width:0%" aria-valuenow="0" aria-valuemin="100"
                aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--Customer's Reviews-->
    <div class="mt-5 customer_review_container">
      <div class="row p-4 my-2">
        <p class="fs-4 fw-bold">Customer's Reviews</p>
         <?php
            //fetching reviews if any
            $rvw_qry = 'SELECT comments, review_date, firstname, surname from review JOIN Customer ON Customer.customer_id = review.customer_id AND review.product_id ='.$product_id ;
            $rvw_parse = oci_parse($conn, $rvw_qry);
            oci_execute($rvw_parse);
            while($rvw_rows = oci_fetch_assoc($rvw_parse)){
              //starting of the while loop
           ?>
        <div class="col-md-6 col-sm-12">
          <div class="card m-3">
            <div class="card-body">
              <?php echo $rvw_rows['COMMENTS']?>
            </div>
          </div>
        </div>
        <?php
          //ending the previous while block
          }
          //select category of product
          $cat_qry = 'SELECT category(shoptype_id) FROM shop WHERE shop.shop_id = '.$products_rows['SHOP_ID'];
          $cat_parse = oci_parse($conn, $cat_qry);
          oci_execute($cat_parse);
          $category = oci_fetch_assoc($cat_parse);
          $category = $category['CATEGORY(SHOPTYPE_ID)'];
          //selecting products of the same category
          $same_cat_prod = 'SELECT product_id,product_name,product_image,category(shoptype_id),initial_price,allergy_information,selling_price FROM product, shop WHERE product.shop_id = shop.shop_id AND category(shoptype_id) = \''.$category.'\' AND ROWNUM<=60';
          $same_cat_parse = oci_parse($conn, $same_cat_prod);
          oci_execute($same_cat_parse);
        ?>
      </div>
    </div>

    <!--Similar Products-->
    <div class="p-4 similar_products_container">
      <div class="row pb-5">
        <div class="col-12 d-flex justify-content-start">
          <p class="fs-3">Similar Products</p>
        </div>
      </div>
      <!--Owl Carousel-->
      <div class="row">
        <div class="owl-carousel owl-theme">
           <?php
                while ($cat_prod_rows = oci_fetch_assoc($same_cat_parse)) {
                //selecting all related category products
          ?>  
          <a href="productDetails.php?product_id=<?php echo $cat_prod_rows['PRODUCT_ID']?>" class="text-decoration-none">
            <div class="card flex-column p-2 card_product mx-2">
              <div class="">
                <img data-src="images/<?php echo $cat_prod_rows['PRODUCT_IMAGE']?>" class="img-fluid card_image owl-lazy" alt="product">
              </div>
              <div class="">
                <p class="fs-3 text-dark"><?php echo $cat_prod_rows['PRODUCT_NAME']?></p>
              </div>
              <div class="">
                <p class="fs-5 text-dark"><?php echo $category?></p>
              </div>
              <div class="">
                <div class="col d-flex justify-content-between">
                  <p class="fs-5 text-dark">&pound<?php echo $cat_prod_rows['INITIAL_PRICE']?></p>
                </div>
              </div>
              <div class="">
              <form action="php/managecart.php?item_id=<?php echo $cat_prod_rows['PRODUCT_ID']?>" method="POST">
                <input type="hidden" name="quantity" id="prod_quantity" value="1">
                      <input type="hidden" name="tot_price" id="tot_price" value="<?php echo $cat_prod_rows['SELLING_PRICE']?>">
                <button type="submit" class="btn btn-warning w-100" name="Add_to_cart">Add To Cart</button>
              </form>
            </div>
            </div>
          </a>
                        <?php
            //ending the previous while block displaying all same category products
            }
          ?>
        </div>
      </div>
    </div>


    <!-- Modal  For Review-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Review</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="text-center">
              <p class="fs-5 font-color-secondary">
                <strong>"Your opinion matters"</strong>
              </p>
              <p class="fs-5">
                Have some ideas on how to improve our product?
              </p>
              <p class="fs-5">
                Give us your feedback.
              </p>
            </div>

            <hr>

            <!-- Radio -->
            <p class="fs-5 text-center">
              <strong>Your rating</strong>
            </p>
            <form action="php/review.php" method="POST">
              <input type="hidden" name="prod_id" value="<?php echo $product_id?>">
              <div class="form-check mb-4">
                <input class="form-check-input" name="rating" type="radio" id="radio-179" value="5" checked>
                <label class="form-check-label" for="radio-179">Very good</label>
              </div>

              <div class="form-check mb-4">
                <input class="form-check-input" name="rating" type="radio" id="radio-279" value="4">
                <label class="form-check-label" for="radio-279">Good</label>
              </div>

              <div class="form-check mb-4">
                <input class="form-check-input" name="rating" type="radio" id="radio-379" value="3">
                <label class="form-check-label" for="radio-379">Mediocre</label>
              </div>
              <div class="form-check mb-4">
                <input class="form-check-input" name="rating" type="radio" id="radio-479" value="2">
                <label class="form-check-label" for="radio-479">Bad</label>
              </div>
              <div class="form-check mb-4">
                <input class="form-check-input" name="rating" type="radio" id="radio-579" value="1">
                <label class="form-check-label" for="radio-579">Very bad</label>
              </div>

              <p class="fs-5 text-center">
                <strong>What could we improve?</strong>
              </p>
              <!--textarea-->
              <div class="md-form">
                <textarea type="text" id="form79textarea" class="md-textarea form-control" name="msg" rows="3"></textarea>
                <label for="form79textarea">Your message</label>
              </div>
              <div class="modal-footer d-flex justify-content-md-end edit_productbuttons">
            <button type="submit" name="send" class="btn btn-outline-danger waves-effect waves-light">Send
              <i class="fa fa-paper-plane ml-1"></i>
            </button>
            <button type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Cancel</button>
          </div>
          </form>
          </div>
          
        </div>
      </div>
    </div>

    <!--Footer-->
    <?php
      include('footerOnly.php');
    ?>

    <!--Image Vertical Zoom js-->
    <script>
      var zoomImg = function () {
        //Clone Image
        var clone = this.cloneNode();
        clone.classList.remove("image1");

        //Append clone
        var lb = document.getElementById("lbInner");
        lb.innerHTML = "";
        lb.appendChild(clone);

        //show
        lb = document.getElementById("lbOuter");
        lb.classList.add("show");
      };


      window.addEventListener("load", function () {
        //onclick images
        var images = document.getElementsByClassName("image1");
        if (images.length > 0) {
          for (let img of images) {
            img.addEventListener("click", zoomImg);
          }
        }

        //close overlay
        document.getElementById("lbOuter").addEventListener("click", function () {
          this.classList.remove("show");
        });
      });
    </script>

    <script>
      var zoomImg = function () {
        //Clone Image
        var clone = this.cloneNode();
        clone.classList.remove("image2");

        //Append clone
        var lb = document.getElementById("lbInner");
        lb.innerHTML = "";
        lb.appendChild(clone);

        //show
        lb = document.getElementById("lbOuter");
        lb.classList.add("show");
      };


      window.addEventListener("load", function () {
        //onclick images
        var images = document.getElementsByClassName("image2");
        if (images.length > 0) {
          for (let img of images) {
            img.addEventListener("click", zoomImg);
          }
        }

        //close overlay
        document.getElementById("lbOuter").addEventListener("click", function () {
          this.classList.remove("show");
        });
      });
    </script>

    <script>
      var zoomImg = function () {
        //Clone Image
        var clone = this.cloneNode();
        clone.classList.remove("image3");

        //Append clone
        var lb = document.getElementById("lbInner");
        lb.innerHTML = "";
        lb.appendChild(clone);

        //show
        lb = document.getElementById("lbOuter");
        lb.classList.add("show");
      };
      //script to animate the availability 
      $(document).ready(function(){
          $('.ava').click(function(){
            $('.stock').show().animate({
                opacity: '1'
            },1000);
          })

      })


      window.addEventListener("load", function () {
        //onclick images
        var images = document.getElementsByClassName("image3");
        if (images.length > 0) {
          for (let img of images) {
            img.addEventListener("click", zoomImg);
          }
        }

        //close overlay
        document.getElementById("lbOuter").addEventListener("click", function () {
          this.classList.remove("show");
        });
      });
    </script>

    <!--JQuery for owl carousel for similar products-->
    <script src="Javascript/trendingItemsJq.js"></script>
    <script src="Javascript/owl.carousel.min.js"></script>
    <script src="Javascript/script.js"></script>

    <!--JQuery for image zoom-->
    <script src="z/jquery.js"></script>
    <script src="z/zoom.js"></script>

    <!--Bootstrap Links-->
</body>

</html>