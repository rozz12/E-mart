<?php
    session_start();
    if (!isset($_SESSION['Trader_id'])) {
        header('Location: signin.php');
    }
    else{
        include('php/connection.php');
        $trader_id = $_SESSION['Trader_id'];
        //select all products if a shop is not selected
        if (!isset($_GET['shop_name'])) {

            //select all products of the trader
            $trd_prod_qry =  'SELECT Product_id, Product_name, Product_image, Description, Allergy_information, Initial_price, stock_quantity  FROM product p RIGHT JOIN shop s ON p.shop_id = s.shop_id INNER JOIN Trader t ON s.trader_id = t.trader_id and t.trader_id = :trader_id ';
             $trd_parse = oci_parse($conn, $trd_prod_qry);
            oci_bind_by_name($trd_parse, ':trader_id', $trader_id);
        }
        //select only products in selected shop 
        else{
            $trd_prod_qry = ' SELECT Product_id, Product_name, Product_image, Description, Allergy_information, Initial_price, stock_quantity  FROM product p,shop s WHERE p.shop_id = s.shop_id AND s.shop_name =\''.$_GET['shop_name'].'\'';
             $trd_parse = oci_parse($conn, $trd_prod_qry);
        }
            //parsing,binding and executing the trd_prod_qry
           
            oci_execute($trd_parse);

             //fetching the registered shop of the logged in trader
            $shop_qry = ' SELECT Shop_name FROM shop WHERE Trader_id = :trader_id';
             $shop_parse = oci_parse($conn, $shop_qry);
            oci_bind_by_name($shop_parse, ':trader_id', $trader_id);
            oci_execute($shop_parse);

            //fetching discount schemes for all rpoducts
            $d_qry = 'SELECT discount_name FROM Product p ,discount d WHERE d.discount_id = p.discount_id AND shop_id = (SELECT shop_id FROM shop s WHERE trader_id = :trader_id)';
            $d_parse = oci_parse($conn, $d_qry);
            oci_bind_by_name($d_parse, ':trader_id', $trader_id);
            oci_execute($d_parse);
       
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
    <title>Trader UI</title>
    <link rel="stylesheet" href="Style/Homepage.css">
    <link rel="stylesheet" href="Style/TraderUI.css">
</head>

<body>
    <!-- nav bar -->
    <?php
        include('NavigationOnly.php');
    ?>

    <!--Trader UI-->
    <div class="container-fluid py-3">
        <div class="row">
            <div class="col-12">
                <p class="fs-3 d-flex justify-content-lg-center justify-content-md-center justify-content-sm-start justify-content-xs-start">
                    <?php if(isset($_GET['shop_name']))
                    echo $_GET['shop_name']?>
                    Product List</p>
            </div>
        </div>

        <div class="container border border-dark p-2">
            <!--Buttons and Dropdowns-->
            <div class="row pb-3">
                <div class="col-md-4 d-flex justify-content-evenly col-sm-12 col-xs-12">
                    <button type="button" class="btn btn-primary mt-2 product_button "  data-bs-toggle="modal" data-bs-target="#ShopModal">Add Shop</button>
                </div>
                <div class="col-md-4 d-flex justify-content-evenly col-sm-12 col-xs-12">
                    <div class="dropdown shop_dropdown">
                        <button class="btn btn-primary dropdown-toggle mt-2 shop_button" type="button"
                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Select a shop
                        </button>
                        <ul class="dropdown-menu shop_list" aria-labelledby="dropdownMenuButton1">
                            <?php
                                while ($shops = oci_fetch_assoc($shop_parse)) {
                                //fetching shops
                            ?>
                            <li><a class="dropdown-item" href="TraderUI.php?shop_name=<?php echo $shops['SHOP_NAME']?>"><?php echo $shops['SHOP_NAME']  ?></a></li>
                            <?php
                                //ending previous while block
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 d-flex justify-content-evenly col-sm-12 col-xs-12">
                     <button type="button" class="btn btn-primary add" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add Product 
                     </button>
                </div>
            </div>
            <!--Products List-->
            <div class="row p-4">
                 <?php
                         while ($prods = oci_fetch_assoc($trd_parse)) {
                        //fetching all products
                    ?>
                <div class="col-md-3 justify-content-center py-2 px-2">
                   
                    <div class="card flex-column px-2 py-2 card_product">
                        <div class="">
                            <img src="images/<?php echo $prods['PRODUCT_IMAGE']?>" class="img-fluid" alt="product">
                        </div>
                            <p style="display: none;"><?php echo $prods['PRODUCT_ID'] ?></p>
                            <p class="fs-3"><?php echo $prods['PRODUCT_NAME']?></p>
                            <p class="fs-5">&pound <?php echo $prods['INITIAL_PRICE']?></p>
                            <p class="fs-5">In Stock: <?php echo $prods['STOCK_QUANTITY']?></p>
                            <p class="fs-8"><?php echo $prods['DESCRIPTION']?></p>
                            <p class="fs-8">Allergy info: <?php echo $prods['ALLERGY_INFORMATION']?></p>
                        <div class="">
                        
                            <div class="col d-flex justify-content-between">
                                    <button type="button" class="btn btn-primary w-100 me-1 edit" data-bs-toggle='modal' data-bs-target='#exampleModal'>Edit</button>
                                    
                                    <button type="button" class="btn btn-primary w-100 delete">Delete</button>
                                  
                            </div>
                          
                            
                        </div>
                    </div>
                </div>
                <?php
                        //ending of the previous while block
                        }
                    ?>

        </div>
    </div>
</div>

    <!--Footer-->
    <?php
        include('footerOnly.php');
    ?>
    <!--ADD SHOP-->
     <div class="modal fade" id="ShopModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Shop</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form method="post" action="addShop.php">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="exampleInputShopName" class="form-label">Shop Name:</label>
                                </div>
                                <div class="col-md-7">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="shop-name"
                                            aria-label="shop-name" aria-describedby="basic-addon1" name="shopName"
                                            value="<?php if(isset($_POST['add_button'])){echo $_POST['shopName'];} ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <label for="exampleInputDate" class="form-label">Established Date:</label>
                                </div>
                                <div class="col-md-7">
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" id="est-date"
                                            aria-label="est-date" aria-describedby="basic-addon1" name="estDate" value="<?php
                                            if(isset($_POST['add_button']))
                                                {
                                                    echo $_POST['estDate'];
                                                }
                                            ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <label for="exampleInputProductPrice" class="form-label">Shop Type:</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-select" name="shopType" value="<?php 
                                    if(isset($_POST['add_button']))
                                        {
                                            echo $_POST['shopType'];
                                        }
                                    ?>">
                                        <option selected>Select a type</option>
                                        <option value="Fishmonger">Fishmonger</option>
                                        <option value="Butcher">Butcher</option>
                                        <option value="Delicatessen">Delicatessen</option>
                                        <option value="Bakery">Bakery</option>
                                        <option value="Greengrocer">Greengrocer</option>
                                    </select>
                                </div>
                            </div>
                              <div class="modal-footer d-flex justify-content-md-end edit_productbuttons">
                                  <button type="submit" class="btn btn-primary" name="add_button">Add</button>
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
<!--  Add Product Modal -->
        <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="php/upload_product.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="exampleInputProductName" class="form-label">Product Name:</label>
                                </div>
                                <div class="col-md-7">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="product_name"
                                            aria-label="product-name" aria-describedby="basic-addon1"
                                            name="product_name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <label for="exampleInputProductImage" class="form-label">Product Image:</label>
                                </div>
                                <div class="col-md-7">
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" id="img_file"
                                            aria-label="product-image" aria-describedby="basic-addon1" name="img_file">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <label for="exampleInputProductPrice" class="form-label">Price:</label>
                                </div>
                                <div class="col-md-7">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="product_price"
                                            aria-label="product-price" aria-describedby="basic-addon1"
                                            name="product_price">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <label for="exampleInputProductQuantity" class="form-label">Product
                                        Quantity:</label>
                                </div>
                                <div class="col-md-7">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="product_quantity"
                                            aria-label="product-quantity" aria-describedby="basic-addon1"
                                            name="product_quantity">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="exampleInputDescription" class="form-label">Description:</label>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" id="description" name="description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="exampleInputDescription" class="form-label">Allergy Information:</label>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" id="allergy-info" name="allergy_info"></textarea>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-5">
                                    <label for="exampleInputProductPrice" class="form-label">Discount Scheme:</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-select" name="discount" value="<?php 
                                    if(isset($_POST['add_button']))
                                        {
                                            echo $_POST['discount'];
                                        }
                                    ?>">
                                        <option selected>Select a type</option>
                                        <option value="No Discount">No Discount</option>
                                        <option value="3% Discount">3% Discount</option>
                                        <option value="5% Discount">5% Discount</option>
                                        <option value="8% Discount">8% Discount</option>
                                        <option value="10% Discount">10% Discount</option>
                                        <option value="15% Discount">15% Discount</option>
                                        <option value="20% Discount">20% Discount</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-md-end edit_productbuttons">
                                <button type="Submit" class="btn btn-primary" name="Save">Save</button>
                                <button type="Reset" class="btn btn-secondary" data-bs-dismiss="modal"
                                    name="Cancel">Cancel</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>

<!-- --->

<!--###################################################################################EDIT MODAL-->
 <!-- Modal -->
         <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="php/update_product.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="hidden" name="hiddenprodid" id="upd_id">
                                    <label for="exampleInputProductName" class="form-label">Product Name:</label>
                                </div>
                                <div class="col-md-7">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="product_name" id="upd_name"
                                            aria-label="product-name" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <label for="exampleInputProductImage" class="form-label">Product Image:</label>
                                </div>
                                <div class="col-md-7">
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" name="product_image" id="product-image"
                                            aria-label="product-image" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <label for="exampleInputProductPrice" class="form-label">Price:</label>
                                </div>
                                <div class="col-md-7">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="product_price" id="upd_price"
                                            aria-label="product-price" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <label for="exampleInputProductQuantity" class="form-label">Product
                                        Quantity:</label>
                                </div>
                                <div class="col-md-7">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="product_quantity" id="upd_quan"
                                            aria-label="product-quantity" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="exampleInputDescription"  class="form-label">Description:</label>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" name="description" id="upd_desc"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="exampleInputDescription" class="form-label">Allergy Information:</label>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" name="allergy_info" id="upd_allergy"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="exampleInputProductPrice" class="form-label">Discount:</label>
                                </div>
                                <div class="col-md-7">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="discount" id="discount"
                                            aria-label="product-discount" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                             <div class="modal-footer d-flex justify-content-md-end edit_productbuttons">
                                <button type="submit" name="Save" class="btn btn-primary">Save</button>
                                <button type="reset" name="Cancel" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                   
                </div>
            </div>
        </div>
<!----##########################################################################################################-->

<div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex">
                        <form action="php/update_product.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="hidden" name="delprodid" id="del_id">
                                 
                             <div class="modal-footer d-flex justify-content-md-end edit_productbuttons">
                                <button type="submit" name="Delete" class="btn btn-primary">Delete</button>
                                <button type="reset" name="Cancel" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                   
                </div>
            </div>
        </div>
<!--###################################################################################-->

    <script type="text/javascript">
        $(document).ready(function(){
            $('.edit').on('click', function(){
                $('#editmodal').modal('show');
                $in = $(this).closest('.card_product');

                var data = $in.children('p').map(function(){
                    return $(this).text();
                }).get();
                
                console.log(data);
                //window.location.href+="?product_id="+ data;
                $('#upd_id').val(data[0]);
                $('#upd_name').val(data[1]);
                $('#upd_price').val(data[2]);
                $('#upd_quan').val(data[3]);
                $('#upd_desc').val(data[4]);
                $('#upd_allergy').val(data[5]);
            });
        });

        $(document).ready(function(){
            $('.add').on('click', function(){
                $('#addmodal').modal('show');
            });
        });

         $(document).ready(function(){
            $('.delete').on('click', function(){
                $('#deletemodal').modal('show');

                $del = $(this).closest('.card_product');

                var del_data = $del.children('p').map(function(){
                    return $(this).text();
                }).get();
                
                console.log(del_data);
                //window.location.href+="?product_id="+ data;
                $('#del_id').val(del_data[0]);
            });
        });
</script>

</body>
</html>
<?php
    }
?>