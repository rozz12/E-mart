<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="../Style/InvoiceCss.css">
    <link rel="stylesheet" href="../Style/Homepage.css">
    <title>Invoice</title>
</head>

<body>
    <!--Navigation-->
    <div class="container-fluid border border-dark">
        <div class="container-fluid">
            <div class="row d-flex justify-content-between justify-content-center">
                <div class="col-md-6 col-sm-12">
                    <a class="navbar-brand" href="#">
                        <img src="../images/C.png" alt="" width="200" height="90">
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
            <div class="row py-4 d-flex align-items-center bg-light">
                <div class="col-lg-2 d-inline-flex justify-content-between mb-2 col-md-2 col-sm-12 col-xs-12">
                    <a class="nav-link home" style="color:black;" href="index.php"><i class="fas fa-home fa-2x"></i></a>
                    <button class="btn btn-secondary" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i
                            class="fas fa-bars fa-2x"></i></button>

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                        aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h3 id="offcanvasRightLabel">Categories</h3>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <a class="dropdown-item text-decoration-none" href="#">
                                <p class="fs-5">Category 1</p>
                            </a>
                            <a class="dropdown-item text-decoration-none" href="#">
                                <p class="fs-5">Category 2</p>
                            </a>
                            <a class="dropdown-item text-decoration-none" href="#">
                                <p class="fs-5">Category 3</p>
                            </a>
                            <a class="dropdown-item text-decoration-none" href="#">
                                <p class="fs-5">Category 4</p>
                            </a>
                            <a class="dropdown-item text-decoration-none" href="#">
                                <p class="fs-5">Category 5</p>
                            </a>
                        </div>
                    </div>

                    <!--<a class="nav-link home" style="color:black;" href="index.php"><i class="fas fa-home fa-2x"></i></a>
                <button class="btn dropdown cate" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i
                        class="fas fa-bars fa-2x"></i></button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Category 1</a></li>
                    <li><a class="dropdown-item" href="#">Category 2</a></li>
                    <li><a class="dropdown-item" href="#">Category 3</a></li>
                    <li><a class="dropdown-item" href="#">Category 4</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>-->
                </div>

                <div class="col-lg-5 mb-1 col-md-10 col-sm-12 col-xs-12">
                    <form class="d-flex search_prod" action="search.php" method="GET">
                        <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
                        <input class="form-control" type="search" placeholder="Search for Products" aria-label="Search">
                    </form>
                </div>
                <div class="col-lg-5 d-flex justify-content-end col-md-12 col-sm-12 col-xs-12 button_end">
                    <button type="button" class="btn btn-warning me-3 w-100"><i class="fas fa-shopping-cart"></i>
                        Cart</button>
                    <button type="button" class="btn btn-warning me-5 w-100">Login/Signup</button>
                    <button type="button" class="btn btn-secondary w-100"><i class="fas fa-user"></i> My
                        Profile</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid border border-1 border-dark mb-3">
        <div class="row d-flex justify-content-center">
            <div class="card">
                <div class="row">
                    <div class="d-flex justify-content-center">
                        <img src="../images/Logo.png" class="img-fluid" height="370px" width="400px">
                    </div>
                    <p class="fs-1 fw-bolder text-center">INVOICE</p>
                    <hr>
                    <div class="col-md-6 d-flex justify-content-center">
                        <ul class="border border-1 border-dark w-50">
                            <li>
                                <p class="fs-5 text-decoration-none">Username:</p>
                            </li>
                            <li>
                                <p class="fs-5">Address:</p>
                            </li>
                            <li>
                                <p class="fs-5">Contact Number:</p>
                            </li>
                            <li>
                                <p class="fs-5">E-mail:</p>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center">
                        <ul class="border border-1 border-dark w-50">
                            <li>
                                <p class="fs-5 text-decoration-none">Invoice Number:</p>
                            </li>
                            <li>
                                <p class="fs-5">Date:</p>
                            </li>
                            <li>
                                <p class="fs-5">Order Number:</p>
                            </li>
                            <li>
                                <p class="fs-5">Order Date:</p>
                            </li>
                            <li>
                                <p class="fs-5">Payment Method:</p>
                            </li>
                        </ul>
                    </div>
                    <!--<table class="table table-borderless p-2">
                            <tbody>
                                <tr class="content">
                                    <td class="font-weight-bold">Username:<br>Address:<br>Contact Number:</br>E-mail:
                                    </td>
                                    <td class="font-weight-bold">Invoice Number:<br>Invoice Date:<br>Order Number:
                                        </br>Order Date:</br> Payment Method:</td>
                                </tr>
                            </tbody>
                        </table>-->

                    <hr>
                </div>

                <div class="row">
                    <div class="products p-2">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr class="add">
                                    <th scope="col">
                                        <p class="fs-3 text-center">S.N</p>
                                    </th>
                                    <th scope="col">
                                        <p class="fs-3 text-center">Product</p>
                                    </th>
                                    <th scope="col">
                                        <p class="fs-3 text-center">Quantity</p>
                                    </th>
                                    <th scope="col">
                                        <p class="fs-3 text-center">Price</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="fs-4 text-center">1</p>
                                    </td>
                                    <td>
                                        <p class="fs-4 text-center">1</p>
                                    </td>
                                    <td>
                                        <p class="fs-4 text-center">1</p>
                                    </td>
                                    <td>
                                        <p class="fs-4 text-center">1</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="fs-4 text-center">1</p>
                                    </td>
                                    <td>
                                        <p class="fs-4 text-center">1</p>
                                    </td>
                                    <td>
                                        <p class="fs-4 text-center">1</p>
                                    </td>
                                    <td>
                                        <p class="fs-4 text-center">1</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="fs-4 text-center">1</p>
                                    </td>
                                    <td>
                                        <p class="fs-4 text-center">1</p>
                                    </td>
                                    <td>
                                        <p class="fs-4 text-center">1</p>
                                    </td>
                                    <td>
                                        <p class="fs-4 text-center">1</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row d-flex justify-content-end">
                    <div class="col-md-6 d-flex justify-content-end">
                        <ul class="border border-1 border-dark w-50">
                            <li>
                                <p class="fs-5 fw-bolder text-decoration-none">Sub Total:</p>
                            </li>
                            <li>
                                <p class="fs-5 fw-bolder">Extra Charge:</p>
                            </li>
                            <li>
                                <p class="fs-5 fw-bolder">Total:</p>
                            </li>
                        </ul>
                    </div>

                    <!--<div class="products p-2">
                        <table class="table mt-2 mb-5 table-hover">
                            <thead>
                                <tr class="add">
                                    <th scope="col">
                                        <p class="fs-3 text-center">Subtotal</p>
                                    </th>
                                    <th scope="col">
                                        <p class="fs-3 text-center">Extra-Charge</p>
                                    </th>
                                    <th scope="col">
                                        <p class="fs-3 text-center">Total</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="fs-4 text-center">$1</p>
                                    </td>
                                    <td>
                                        <p class="fs-4 text-center">$1</p>
                                    </td>
                                    <td>
                                        <p class="fs-4 text-center">$1</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>-->
                </div>
            </div>
        </div>
    </div>

    <!--Footer-->
    <div class="container-fluid">
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>
</body>

</html>