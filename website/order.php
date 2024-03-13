<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>Cart</title>
    <link rel = "icon" href ="images/logo.jpg" type = "image/x-icon">
    <style>
    #cont{
        min-height : 626px;
    }
    </style>
</head>
<body>

    <?php require 'partials-frontend/nav.php' ?>
    
    
    <div class="container" id="cont">
        <div class="row">
            
            <div class="col-lg-12 text-center border rounded bg-light my-3">
                <h1 class="text-success">My Cart</h1>
            </div>
            <div class="col-lg-8">
                <div class="card wish-list mb-3">
                    <table class="table text-center">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Item Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">
                                    
                                        <button name="removeAllItem" class="btn btn-sm btn-outline-danger">Remove All</button>

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM `viewcart` WHERE `userId`= $userId";
                                $result = mysqli_query($conn, $sql);
                                $counter = 0;
                                $totalPrice = 0;
                                while($row = mysqli_fetch_assoc($result)){
                                    $itemId = $row['itemId'];
                                    $Quantity = $row['itemQuantity'];
                                    $mysql = "SELECT * FROM `tbl_item` WHERE id = $id";
                                    $myresult = mysqli_query($conn, $mysql);
                                    $myrow = mysqli_fetch_assoc($myresult);
                                    $title = $myrow['title'];
                                    $price = $myrow['price'];
                                    $subdesc= $myrow['sub_description'];
                                    
                                    $total = $pizzaPrice * $Quantity;
                                    $counter++;
                                    $totalPrice = $totalPrice + $total;

                                    echo '<tr>
                                            <td>' . $counter . '</td>
                                            <td>' . $title . '</td>
                                            <td>' . $price . '</td>
                                            <td>
                                                <form id="frm' . $pizzaId . '">
                                                    <input type="hidden" name="pizzaId" value="' . $id . '">
                                                    <input type="number" name="quantity" value="' . $Quantity . '" class="text-center" onchange="updateCart(' . $pizzaId . ')" onkeyup="return false" style="width:60px" min=1 oninput="check(this)" onClick="this.select();">
                                                </form>
                                            </td>
                                            <td>' . $total . '</td>
                                            <td>
                                                <form action="partials/_manageCart.php" method="POST">
                                                    <button name="removeItem" class="btn btn-sm btn-outline-danger">Remove</button>
                                                    <input type="hidden" name="itemId" value="'.$id. '">
                                                </form>
                                            </td>
                                        </tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card wish-list mb-3">
                    <div class="pt-4 border bg-light rounded p-3">
                        <h5 class="mb-3 text-uppercase font-weight-bold text-center">Order summary</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0 bg-light">Total Price<span>Rs. <?php echo $totalPrice ?></span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-light">Delivery<span>Rs. 0</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3 bg-light">
                                <div>
                                    <strong>The total amount of</strong>
                                    <strong><p class="mb-0">(including Tax & Charge)</p></strong>
                                </div>
                                <span><strong>Rs. <?php echo $totalPrice ?></strong></span>
                            </li>
                        </ul>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Cash On Delivery 
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault1" id="flexRadioDefault1" disabled>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Online Payment 
                            </label>
                        </div><br>
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#checkoutModal">go to checkout</button>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="pt-4">
                        <a class="dark-grey-text d-flex justify-content-between" style="text-decoration: none; color: #050607;" data-toggle="collapse" href="#collapseExample"
                            aria-expanded="false" aria-controls="collapseExample">
                            Add a discount code (optional)
                            <span><i class="fas fa-chevron-down pt-1"></i></span>
                        </a>
                        <div class="collapse" id="collapseExample">
                            <div class="mt-3">
                                <div class="md-form md-outline mb-0">
                                    <input type="text" id="discount-code" class="form-control font-weight-light"
                                    placeholder="Enter discount code">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                                
    <br>

   
    <?php require 'partials-frontend/footer.php' ?>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
    <script>
        function check(input) {
            if (input.value <= 0) {
                input.value = 1;
            }
        }
        function updateCart(id) {
            $.ajax({
                url: 'partials/_manageCart.php',
                type: 'POST',
                data:$("#frm"+id).serialize(),
                success:function(res) {
                    location.reload();
                } 
            })
        }
    </script>
</body>
</html>