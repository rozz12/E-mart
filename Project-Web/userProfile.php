<?php
    @session_start();
    if (!isset($_SESSION['userid'])) {
        header('Location: signin.php');
    }
    else{

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
    <link rel="stylesheet" href="Style/userprofile.css">
    <link rel="stylesheet" href="Style/Homepage.css">
    <link rel="stylesheet" type="text/css" href="css/edit_trader.css"/>
    <title>User Profile</title>
</head>

<body>
    <!--Navigation-->
    <?php
        include('NavigationOnly.php');
    ?>

    <?php
        if ($_SESSION['user_type'] == 'Customer') {
            //display following if user type is Customer
    ?>
    <!-- aastha user profile -->
    <div class="container-fluid border border-dark p-5">
        <div class="row user_hello_row d-flex ">
            <div class="col-lg-4 col-sm-12 col-xs-12 justify-content-sm-center">
                <p class="fs-4 text-center"><i class="fas fa-user fa-2x "></i></p>
                <p class="fs-3 text-center"><?php echo 'Hello '. $_SESSION['username']?></p>
            </div>
            <div class="col-lg-4 col-sm-12 col-xs-12 purchase_button">
                <a href="#" class="text-decoration-none"><button type="button"
                        class="btn btn-primary purchase_button p-3 mt-2 w-100">Purchase
                        History</button></a>
            </div>
            <div class="col-lg-4 col-sm-12 col-xs-12 pickup_button">
                <a href="#" class="text-decoration-none"><button type="button"
                        class="btn btn-primary purchase_button p-3 mt-2 w-100">Pickup
                        History</button></a>
            </div>


        </div>
        <div class="row pt-5">
            <div class="col-lg-3 col-md-6 col_options">
                <h3>Manage Account</h3>
                <ul class="nav flex-column">
                    <p class="fs-5">
                        <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="edituser text-decoration-none">Profile</a>
                    </p>
                    <p class="fs-5">
                        <a href="#" class="text-decoration-none">Payment Methods</a>
                    </p>
                    <p class="fs-5">
                        <a href="#" class="text-decoration-none">Vouchers</a>
                    </p>
                    <p class="fs-5">
                        <a href="#" class="text-decoration-none">Communications and Privacy</a>
                    </p>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 col_options">
                <h3>Orders</h3>
                <ul class="nav flex-column">
                    <p class="fs-5">
                        <a href="#" class="text-decoration-none">My Orders</a>
                    </p>
                    <p class="fs-5">
                        <a href="#" class="text-decoration-none">My Returns</a>
                    </p>
                    <p class="fs-5">
                        <a href="#" class="text-decoration-none">My Cancellations</a>
                    </p>
                    <p class="fs-5">
                        <a href="#" class="text-decoration-none">My Reviews</a>
                    </p>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 col_options">
                <h3>Privacy</h3>
                <ul class="nav flex-column">
                    <p class="fs-5">
                        <a href="#" class="text-decoration-none">Privacy Policy</a>
                    </p>
                    <p class="fs-5">
                        <a href="#" class="text-decoration-none">Request My Personal Information</a>
                    </p>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 col_options">
                <h3>Customer Service</h3>
                <ul class="nav flex-column">
                    <p class="fs-5">
                        <a href="#" class="text-decoration-none">Collection Slots Help</a>
                    </p>
                    <p class="fs-5">
                        <a href="#" class="text-decoration-none">Feedback</a>
                    </p>
                    <p class="fs-5">
                        <a href="#" class="text-decoration-none">Terms of Use</a>
                    </p>
                </ul>
            </div>
        </div>
        <?php
            //ending of customer if block
            }
            //show this if trader is logged in
            else
            {
        ?>
         <div class="container-fluid border border-dark p-5">
        <div class="row user_hello_row d-flex ">
            <div class="col-lg-4 col-sm-12 col-xs-12 justify-content-sm-center">
                <p class="fs-4 text-center"><i class="fas fa-user fa-2x "></i></p>
                <p class="fs-3 text-center"><?php echo 'Hello '. $_SESSION['username']?></p>
            </div>
            <div class="col-lg-4 col-sm-12 col-xs-12 purchase_button">
                <a href="#" class="text-decoration-none"><button type="button"
                        class="btn btn-primary purchase_button p-3 mt-2 w-100">My Shop</button></a>
            </div>
            <div class="col-lg-4 col-sm-12 col-xs-12 pickup_button">
                <a href="#" class="text-decoration-none"><button type="button"
                        class="btn btn-primary purchase_button p-3 mt-2 w-100">My Products</button></a>
            </div>


        </div>
        <div class="row pt-5">
            <div class="col-lg-4 col-md-6 col_options">
                <h3>Manage Account</h3>
                <ul class="nav flex-column">
                   <p class="fs-5">
                        <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="edituser text-decoration-none">Profile</a>
                    </p>
                    <p class="fs-5">
                        <a href="#" class="text-decoration-none">Password</a>
                    </p>
                    <p class="fs-5">
                        <a href="#" class="text-decoration-none">Communications and Privacy</a>
                    </p>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6 col_options">
                <h3>Privacy</h3>
                <ul class="nav flex-column">
                    <p class="fs-5">
                        <a href="#" class="text-decoration-none">Privacy Policy</a>
                    </p>
                    <p class="fs-5">
                        <a href="#" class="text-decoration-none">Request My Personal Information</a>
                    </p>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6 col_options">
                <h3>Customer Service</h3>
                <ul class="nav flex-column">
                    <p class="fs-5">
                        <a href="#" class="text-decoration-none">Collection Slots Help</a>
                    </p>
                    <p class="fs-5">
                        <a href="#" class="text-decoration-none">Feedback</a>
                    </p>
                    <p class="fs-5">
                        <a href="#" class="text-decoration-none">Terms of Use</a>
                    </p>
                </ul>
            </div>
        </div>
        <?php
            //end of previous trader if block
            }
        ?>
        <div class="row">
            <div class="col-12 d-flex justify-content-end my-4">
                <a href="php/logout.php" class="btn btn-secondary btn-lg py-2 px-3 border border-top border-2 signout_button"
                    role="button"><i class="fas fa-door-open"></i> Sign Out</a>
            </div>
        </div>
    </div>

    <!--Footer-->
    <div class="container-fluid pt-4">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end col_paypal">
                <img title="paypal" src="../images/paypalicon.png" alt="payment methods" width="170px"
                    height="60px">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 col_logo">
                <img src="../images/Logo.png" class="img-fluid" height="370px" width="400px">
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

        <div class="row">
            <div class="col d-inline-flex align-items-center col_copyright">
                <p class="fs-4 pe-2"><i class="fas fa-copyright"></i></p>
                <p class="fs-5 col_text">Copyright Cleckhuddersfax - All rights reserved 2021</p>
            </div>
        </div>
    </div>
    <?php
        include_once('php/connection.php');
        $user_type = $_SESSION['user_type'];
        //retrieve data from the user_type respective table 
        if ($user_type == 'Trader') {
            $qry = "SELECT * FROM Trader WHERE Trader_ID = :user_id";
            $user_id = $_SESSION['Trader_id'];
        }
        else{
            $qry = "SELECT * FROM Customer WHERE Customer_ID = :user_id";
            $user_id = $_SESSION['Customer_id'];    
        }
        $parse = oci_parse($conn, $qry);
        oci_bind_by_name($parse, ':user_id', $user_id);
        oci_execute($parse);
        $row = oci_fetch_assoc($parse);

    ?>

        <!--Edit User Modal################################################################################# -->
       <div class="modal fade" id="editusermodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit User Details</h5>
                      <?php
                            if(isset($_GET['update'])){
                                echo "<span class='message'>".$_GET['update']."</span>";
                            }
                            $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            if (strpos($fullurl, "input=empty")==true) {
                                echo "<h3 class='error'>Please fill in all the fields</h3>";
                            }
                            if (strpos($fullurl, "input=invalidpswd")==true) {
                                echo "<h3 class='error'>The password does not match required criterias</h3>";
                            }
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="php/update_product.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="hidden" name="hiddenuserid" id="upd_id">
                                    <label for="exampleCustomerName" class="form-label mt-4">Customer Name:</label>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group form-inline mb-3">
                                        <input type="text" class=" form-control form-inline mb-1" name="firstname" id="first_name"
                                            aria-label="first-name" aria-describedby="basic-addon1" placeholder="FirstName" 
                                            value="<?php echo $row['FIRSTNAME']; ?>">
                                        <input type="text" class="form-control mb-4" name="lastname" id="last_name"
                                            aria-label="last-name" aria-describedby="basic-addon1" placeholder="LastName" value="<?php echo $row['SURNAME']; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <label for="exampleContactNumber" class="form-label">Contact number:</label>
                                </div>
                                <div class="col-md-7">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="phone" id="phone"
                                            aria-label="Contact" aria-describedby="basic-addon1" value="<?php echo $row['CONTACT_NO']; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <label for="exampleEmailAdress" class="form-label">Email Adress</label>
                                </div>
                                <div class="col-md-7">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="email" id="email" value="<?php echo $row['EMAIL']; ?>" aria-label="Email" aria-describedby="basic-addon1" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <label for="exampleNewPassword" class="form-label">New Password</label>
                                </div>
                                <div class="col-md-7">
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" name="password" id="upd_pswd"
                                            aria-label="New_Password" aria-describedby="basic-addon1">
                                        <div class="input-group-append"><i class="far fa-eye btn" id = "togglePassword"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="exampleRePassword"  class="form-label">Confirm Password:</label>
                                </div>
                                <div class="col-md-7">
                                      <div class="input-group mb-3">
                                        <input type="password" class="form-control" name="password" id="upd_pswd"
                                            aria-label="Repeat_Password" aria-describedby="basic-addon1"><div class="input-group-append"><i class="far fa-eye btn" id = "togglePassword1"></i></div>
                                    </div>
                                </div>
                            </div>
                             <div class="modal-footer d-flex justify-content-md-end edit_userbuttons">
                                <button type="submit" name="Save_Changes" class="btn btn-primary">Save Changes</button>
                                <button type="reset" name="Cancel" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                   
                </div>
            </div>
        </div>
    <!--######################################################################################################-->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
        crossorigin="anonymous"></script>

    <script>
        
        $(document).ready(function(){
            $('.edituser').on('click', function(){
                $('#editusermodal').modal('show');
            });
        });

    </script>

</body>

</html>
<?php
    //ending the else block of the first if
    }
?>