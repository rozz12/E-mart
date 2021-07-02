<?php
/*<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Edit Products</title>
</head>

<body>
    <div class="container-fluid">*/
    echo'

        <!-- Modal -->
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
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="discount"
                                            aria-label="product-discount" aria-describedby="basic-addon1"
                                            name="discount">
                                    </div>
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
    '/*</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>

</html>*/
?>