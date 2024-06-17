<?php 
include("partials-frontend/nav.php");
?>
<section class="item" id="item">
  <h1 class="text-danger text-center">Our Item</h1>
  <div class="container">
  <div class="line" style="width: 100%; height: 2px; background-color: #e53937;"></div>
  </div>
  <div class="row" style="margin-top: 30px;">
    <?php 
    //Display items that are Active
    $sql = "SELECT * FROM tbl_item WHERE active='Yes' AND featured='Yes'";
    //Execute the Query
    $res = mysqli_query($conn, $sql);
    //Check whether the items are available or not
    if ($res && mysqli_num_rows($res) > 0) {
        //Items Available
        while ($row = mysqli_fetch_assoc($res)) {
            //Get the Values
            $id = $row['itemId'];
            $title = $row['title'];
            $description = $row['description'];
            $price = $row['price'];
            $image_name = $row['image_name'];
    ?>
            <div class="col-md-3 py-3 py-md-0 mt-3">
              <div class="card">
                <?php 
                //Check whether image available or not
                if ($image_name == "") {
                    //Image not Available
                    echo "<div class='text-danger'>Image not Available.</div>";
                } else {
                    //Image Available
                ?>
                    <img src="<?php echo SITEURL; ?>images/item/<?php echo $image_name; ?>" alt="handscraft artistry" style="height:240px";>
                <?php
                }
                ?>
                <div class="card-body text-center">
                  <h3><?php echo $title;?></h3>
                  <h6></h6>
                  <p class="text-danger"> Rs <?php echo $price;?></p>
                 <?php
                  
                 // Check if user is logged in
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
              <a href="viewitem.php?item_id=<?php echo $id;?>" class="btn btn-primary ">Quick View</a>
                </div>
              </div>
            </div>
    <?php
        }
    } else {
        //Item not Available
        echo "<div class='col-md-12'><div class='error'>Item not found.</div></div>";
    }
    ?>
  </div>
  <div class="clearfix"></div>
</section>
<?php include("partials-frontend/footer.php"); ?>
