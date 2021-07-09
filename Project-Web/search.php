<?php
    include('NavigationOnly.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/search.css">
  <title>Search</title>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.search').click(function(){
        $('#product_display').load('js/productfilters.php', {
          //pass values to the php page for data filtering
          Price_range: $('#myRange').val(),
          Rating: $('input[name="Rating"]:checked').val(),
          Discount: $('input[name="discount"]:checked').val(),
          sorttype : $( "#sorttype" ).val(),
          sortorder : $("#sortorder").val()
        });
      });
    });
</script>
</head>

<body>
  <!-- sort product options -->
  <div class="col-12">
      <div class="row">
            <div class="topnav">
              <!--<form method="POST">-->
                <input type="submit" name="sort" class="sort_btn" value="Sort By:"/>
                <select id="sorttype" name="sortbytype">
                   <option value="SELLING_PRICE"
                          <?php //echo (isset($_POST['sortbytype']) && $_POST['sortbytype']=="Price") ? 'selected="selected"' : '';?>>Price
                  </option>
                <option value="DISCOUNT_PERCENTAGE"
                        <?php //echo (isset($_POST['sortbytype']) && $_POST['sortbytype']=="Discount") ? 'selected="selected"' : '';?>>Discount
                </option>
                  <option value="PRODUCT_NAME"
                      <?php //echo (isset($_POST['sortbytype']) && $_POST['sortbytype']=="Alphabet") ? 'selected="selected"' : '';?>>Alphabet
                  </option>
                </select>
                <select id="sortorder" name="sortbyorder">
                    <option value="Asc"
                      <?php //echo (isset($_POST['sortbyorder']) && $_POST['sortbyorder']=="Ascending") ? 'selected="selected"' : '';?>>Ascending
                    </option>
                    <option value="Desc"
                      <?php //echo (isset($_POST['sortbyorder']) && $_POST['sortbyorder']=="Descending") ? 'selected="selected"' : '';?>>Descending
                   </option>
               </select>

             <!--</form>-->
          </div>
      </div>
    </div>

  <!--Search Options-->
  <div class="container-fluid pb-3">
    <div class="row">
      <div class="col-xl-3 col-lg-3 col-md-3">
          <div class="sidebar-categories">
            <div class="head">Trader Type
            </div>
            <ul class="main-categories">
              <li class="common-filter">
                <ul>
                   <?php
                      $cat_qry = 'SELECT DISTINCT(SHOP_TYPE) from Shop_type';
                      $cat_parse = oci_parse($conn, $cat_qry);
                      oci_execute($cat_parse);
                      while ($cat = oci_fetch_assoc($cat_parse)) {
                      //fetch all categories
                  ?>
                  <li class="filter-list">
                    <a href="search.php?shoptype=<?php echo $cat['SHOP_TYPE']?>"><?php echo $cat['SHOP_TYPE'] ?>
                    </a>
                  </li>
                  <?php
                    //ending of previous while block
                    }
                  ?>
                </ul>
              </li>
            </ul>
          </div>
        <!--Search options colum
        <div class="col-md-3 border border-dark col-sm-12">
        <div class="row">
          <div class="">
            <p class="fs-4 fw-bolder">Search by Trader</p>
          </div>
          <div class="d-flex justify-content-center pt-4 pb-4">
            <div class="dropdown w-100">
              <button class="btn btn-secondary dropdown-toggle  w-100" type="button" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false">
                Choose Trader Type
              </button>
              <ul class="dropdown-menu w-100 category" aria-labelledby="dropdownMenuButton1">
                <?php
                  $cat_qry = 'SELECT DISTINCT(SHOP_TYPE) from Shop_type';
                  $cat_parse = oci_parse($conn, $cat_qry);
                  oci_execute($cat_parse);
                  while ($cat = oci_fetch_assoc($cat_parse)) {
                      //fetch all categories
                ?>
                <li><a class="dropdown-item" ><?php echo $cat['SHOP_TYPE'] ?></a></li>
                <?php
                  //ending of previous while block
                  }
                ?>
              </ul>
            </div>
          </div>
        </div>-->
        <hr>
        <!--Price Option-->
        <div class="row">
          <div class="">
            <p class="fs-4 fw-bolder">Price</p>
          </div>
          <div class="d-flex flex-column justify-content-center">
            <input type="range" class="form-range slider" id="myRange" min="0" max="50" value="25">
            <div class="">
              <p class="fs-5">Cost: <span id="demo"></span></p>
            </div>

          <script>
            var slider = document.getElementById("myRange");
            var output = document.getElementById("demo");
            output.innerHTML = slider.value; // Display the default slider value

            // Update the current slider value (each time you drag the slider handle)
            slider.oninput = function () {
              output.innerHTML = this.value;
            }
          </script>
          </div>
        </div>
        <hr>
        <!--Discount Option-->
        <div class="row">
          <div class="">
            <p class="fs-4 fw-bolder">Discount</p>
          </div>
          <div class="d-flex flex-column align-items-start">
            <div class="">
              <input class="form-check-input" type="radio" name="discount" value="0-10" id="flexCheckDefault">
              <label class="" for="flexCheckDefault">
                <p class="fs-4" style="margin-top:-6px;">0-10</p>
              </label>
            </div>
            <div class="">
              <input class="form-check-input" type="radio" name="discount" value="10-20" id="flexCheckChecked">
              <label class="" for="flexCheckChecked">
                <p class="fs-4" style="margin-top:-6px;">10-20</p>
              </label>
            </div>
            <div class="">
              <input class="form-check-input" type="radio" name="discount" value="20-30" id="flexCheckChecked">
              <label class="" for="flexCheckChecked">
                <p class="fs-4" style="margin-top:-6px;">20-30</p>
              </label>
            </div>
            <div class="">
              <input class="form-check-input" type="radio" name="discount" value="30-40" id="flexCheckChecked">
              <label class="" for="flexCheckChecked">
                <p class="fs-4" style="margin-top:-6px;">30-40</p>
              </label>
            </div>
            <div class="">
              <input class="form-check-input" type="radio" name="discount" value="40-50" id="flexCheckChecked">
              <label class="" for="flexCheckChecked">
                <p class="fs-4" style="margin-top:-6px;">40-50</p>
              </label>
            </div>
          </div>
        </div>
        <hr>
        <!--Rating Option-->
        <div class="row">
          <div class="">
            <p class="fs-4 fw-bolder">Rating</p>
          </div>
          <div class="d-flex flex-column align-items-start">
            <div class="">
              <input class="form-check-input" type="radio" name="Rating" value="5" id="flexRadioDefault1">
              <label class="d-inline-flex" for="flexRadioDefault1">
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="fas fa-star"></i></p>
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="fas fa-star"></i></p>
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="fas fa-star"></i></p>
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="fas fa-star"></i></p>
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="fas fa-star"></i></p>
              </label>
            </div>
            <div class="">
              <input class="form-check-input" type="radio" name="Rating" value="4" id="flexRadioDefault2">
              <label class="d-inline-flex" for="flexRadioDefault1">
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="fas fa-star"></i></p>
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="fas fa-star"></i></p>
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="fas fa-star"></i></p>
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="fas fa-star"></i></p>
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="far fa-star"></i></p>
              </label>
            </div>
            <div class="">
              <input class="form-check-input" type="radio" name="Rating" value="3" id="flexRadioDefault2">
              <label class="d-inline-flex" for="flexRadioDefault1">
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="fas fa-star"></i></p>
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="fas fa-star"></i></p>
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="fas fa-star"></i></p>
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="far fa-star"></i></p>
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="far fa-star"></i></p>
              </label>
            </div>
            <div class="">
              <input class="form-check-input" type="radio" name="Rating" value="2" id="flexRadioDefault2">
              <label class="d-inline-flex" for="flexRadioDefault1">
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="fas fa-star"></i></p>
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="fas fa-star"></i></p>
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="far fa-star"></i></p>
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="far fa-star"></i></p>
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="far fa-star"></i></p>
              </label>
            </div>
            <div class="">
              <input class="form-check-input" type="radio" name="Rating" value="1" id="flexRadioDefault2">
              <label class="d-inline-flex" for="flexRadioDefault1">
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="fas fa-star"></i></p>
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="far fa-star"></i></p>
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="far fa-star"></i></p>
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="far fa-star"></i></p>
                <p class="fs-5 pe-2" style="margin-top:-6px;"><i class="far fa-star"></i></p>
              </label>
            </div>
          </div>
        </div>
        <!--Search Button-->
        <div class="row">
          <div class="">
            <button type="button" class="btn btn-primary w-100 mt-5 mb-3 search">
              Search</button>
          </div>
        </div>
      </div>

      <!--Products section column-->
      <div class="col-md-9 border border-dark col-sm-12">
        <!--Upper Row-->
        <?php
            //check if trader type has been selected or not
        if (isset($_GET['shoptype'])) {
            if($_GET['shoptype']=='Butcher'){
                $qry="Select * from product where SHOP_ID=1";
            }
           else if($_GET['shoptype']=='Greengrocer'){
                $qry="Select * from product where SHOP_ID=2";
            }
            else if($_GET['shoptype']=='Fishmonger'){
                $qry="Select * from product where SHOP_ID=3";
              }
             else if($_GET['shoptype']=='Bakery'){
                $qry="Select * from product where SHOP_ID=4";
            }
             else if($_GET['shoptype']=='Delicatessen'){
                $qry="Select * from product where SHOP_ID=5";
            }
        }
        else if (isset($_GET['search'])) {
          $search = $_GET['search'];
          $qry = "SELECT * FROM Product WHERE Product_name LIKE '%$search%'";
        }
        else{
            $qry = 'SELECT * FROM product WHERE  ROWNUM <=15';
        }
            $parse = oci_parse($conn, $qry);
            oci_execute($parse);
             //$num = oci_($parse,$res);
  
        ?>
       

        <!--Lower Row-->
        <div class="row" id="product_display">
          <?php
              while ($rows= oci_fetch_assoc($parse)){
                
                  //fetch 15 products without any filters

          ?>
          <div class="col-md-4 justify-content-center py-1 px-1">
            <a href="productDetails.php?product_id=<?php echo $rows['PRODUCT_ID']?>" class="text-decoration-none">
              <div class="card flex-column px-2 py-2 card_product">
                <div class="">
                  <img src="images/<?php echo $rows['PRODUCT_IMAGE']?>" class="img-fluid" style="height:300px; width:550px;" alt="product">
                </div>
                <div class="">
                  <p class="fs-2 text-dark"><?php echo $rows['PRODUCT_NAME']?></p>
                </div>
                <div class="">
                  <div class="col d-flex justify-content-between">
                    <p class="fs-4 text-dark">&pound <?php echo $rows['SELLING_PRICE']?></p>
                    <p class="fs-4 text-decoration-line-through fw-light text-dark">&pound <?php echo $rows['INITIAL_PRICE']?></p>
                  </div>
                </div>
                <div class="">
                  <div class="col-12 d-inline-flex rating text-dark">
                    <p class="fs-5 pe-2"><i class="fas fa-star"></i></p>
                    <p class="fs-5 pe-2"><i class="fas fa-star"></i></p>
                    <p class="fs-5 pe-2"><i class="fas fa-star"></i></p>
                    <p class="fs-5 pe-2"><i class="fas fa-star"></i></p>
                    <p class="fs-5 pe-2"><i class="fas fa-star-half-alt"></i></p>
                  </div>
                </div>
                <div class="card-footer">
                  <form action="php/managecart.php?item_id=<?php echo $rows['PRODUCT_ID']?>" method="POST">
                       <input type="hidden" name="quantity" id="prod_quantity" value="1">
                      <input type="hidden" name="tot_price" id="tot_price" value="<?php echo $rows['SELLING_PRICE']?>">
                     <button type="submit" class="btn btn-warning w-100" name="Add_to_cart">Add To Cart</button>
              </form>
                </div>
              </div>
            </a>
          </div>
          <?php
            //end the previous while loop
            }
          ?>

 

        </div>
      </div>
    </div>
  </div>

  <!--Footer-->
<?php
  include('footerOnly.php');
?>

</body>

</html>