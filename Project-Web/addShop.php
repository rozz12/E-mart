<?php
    //include('connection.php');

    $errors = [];

    $shop_name = $_POST['shopName'];
    $est_date = $_POST['estDate'];
    $shop_type = $_POST['shopType'];

    $var_type = gettype($shop_name);

    if(empty($shop_name))
    {
        $errors['shopName'] = "Shop name can not be empty";
    }

    if(($shop_name)!='string')
    {
        $errors['shopName'] = "Shop name must be alphabetical";
    }

    if(empty($est_date))
    {
        $errors['estDate'] = "Established date can not be empty";
    }

    if(empty($shop_type))
    {
        $errors['shopType'] = "Shop type can not be empty";
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Add Shop</title>
</head>

<body>
    <div class="container-fluid">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Shop
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Shop</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form method="post" action="">
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
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer d-flex justify-content-md-end edit_productbuttons">
                        <button type="button" class="btn btn-primary" name="add_button">Add</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>

</html>