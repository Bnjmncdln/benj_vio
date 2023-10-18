<!doctype html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>SHOE INVENTORY</title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
<body>

<!-- Add Stock -->
<div class="modal fade" id="stockAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Stock</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="saveStock">
            <div class="modal-body">

                <div id="errorMessage" class="alert alert-warning d-none"></div>

                <div class="mb-3">
                    <label for="">Product Name</label>
                    <input type="text" name="productName" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Description</label>
                    <input type="text" name="description" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Price</label>
                    <input type="text" name="price" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Quantity</label>
                    <input type="text" name="quantity" class="form-control" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Stock</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Edit Stock Modal -->
<div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Stock</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="editStock">
            <div class="modal-body">

                <div id="errorMessage" class="alert alert-warning d-none"></div>

                <div class="mb-3">
                    <label for="">Product Name</label>
                    <input type="text" name="productName" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Description</label>
                    <input type="text" name="description" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Price</label>
                    <input type="text" name="price" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Quantity</label>
                    <input type="text" name="quantity" class="form-control" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Edit Stock</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- View Stock Modal -->
<div class="modal fade" id="studentViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Stock</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label for="">Product Name</label>
                    <p id="view_productName" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Description</label>
                    <p id="view_description" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Price</label>
                    <p id="view_price" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Quantity</label>
                    <p id="view_quantity" class="form-control"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>SHOE INVENTORY
                        
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#stockAddModal">
                            Add Stock
                        </button>
                    </h4>
                </div>
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Quantity In Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                          
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        $(document).on('submit', '#saveStock', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessage').addClass('d-none');
                        $('#stockAddModal').modal('hide');
                        $('#saveStock')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        
    </script>

    <?php 
            if(isset($_POST['save_student']))
        {
            $productName = mysqli_real_escape_string($con, $_POST['productName']);
            $description = mysqli_real_escape_string($con, $_POST['description']);
            $price = mysqli_real_escape_string($con, $_POST['price']);
            $quantityInStock = mysqli_real_escape_string($con, $_POST['quantityInStock']);

            if($productName == NULL || $description == NULL || $price == NULL || $quantityInStock == NULL)
            {
                $res = [
                    'status' => 422,
                    'message' => 'All fields are mandatory'
                ];
                echo json_encode($res);
                return;
            }

            $query = "INSERT INTO product (productName,description,price,quantityInStock) VALUES ('$productName','$description','$price','$quantityInStock')";
            $query_run = mysqli_query($con, $query);

            if($query_run)
            {
                $res = [
                    'status' => 200,
                    'message' => 'Student Created Successfully'
                ];
                echo json_encode($res);
                return;
            }
            else
            {
                $res = [
                    'status' => 500,
                    'message' => 'Student Not Created'
                ];
                echo json_encode($res);
                return;
            }
        }
    ?>
</body>
</html>