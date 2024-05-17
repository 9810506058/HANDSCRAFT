<?php
include("partials-frontend/nav.php");
?>
<div class="container">
  <div class="line" style="width: 100%; height: 2px; background-color: #e53937;"></div>
</div>
<br>
<?php

// Check if item ID is provided in the URL
if(isset($_GET['item_id'])) {
    $item_id = $_GET['item_id'];
    
    
    // Query to fetch item details based on item ID
    $sql = "SELECT * FROM tbl_item WHERE itemId = $item_id";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        // Item found, display its details
        $row = mysqli_fetch_assoc($result);
        $id = $row['itemId'];
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $image_name = $row['image_name'];
        ?>
        <div class="container justify-content-center  mt-5" style="width: 100%">
            <div class="card mb-3" style="width: 100%; background-color: wheat;">
                <div class="row g-0">
                    <div class="col-md-6 position-relative">
                        <?php 
                        // Check whether image available or not
                        if ($image_name == "") {
                            // Image not Available
                            echo "<div class='text-danger'>Image not Available.</div>";
                        } else {
                            // Image Available
                        ?>
                        <div class="zoom-container">
                            <img src="<?php echo SITEURL; ?>images/item/<?php echo $image_name; ?>" alt="handscraft artistry" style="height: 400px; width: 100%">
                          
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-md-3 mt-5">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $title; ?></h5>
                            <p class="card-text">Rs <?php echo $price; ?></p>
                            <p class="card-text"><?php echo $description; ?></p>
                            <?php
                  
                  
                 if($loggedin){
                  $quaSql = "SELECT `itemQuantity` FROM `viewcart` WHERE itemId = '$id' AND `userId`='$userId'"; 
                  $quaresult = mysqli_query($conn, $quaSql);
                  $quaExistRows = mysqli_num_rows($quaresult);
                  if($quaExistRows == 0) {
                      echo '<form action="_manageCart.php" method="POST"  class="d-inline">
                            <input type="hidden" name="itemId" value="'.$id. '">
                            <button type="submit" name="addToCart" class="btn btn-primary mx-7 my-3">Add to Cart</button>';
                  } else {
                      echo '<a href="cart.php"><button class="btn btn-success mx-7" >Go to Cart</button></a>';
                  }
              
              echo '</form>';
              }
              else{
                  echo '<a href="userlogin.php"><button class="btn btn-primary mx-7" >Add to Cart</button></a>';
              }
              ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        // Item not found
        echo "Item not found.";
    }
} else {
    // Redirect or handle the case where item ID is not provided in the URL
}
?>
<br><br><br>

<?php

include("partials-frontend/footer.php");
?>
