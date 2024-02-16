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
    $sql = "SELECT * FROM tbl_item WHERE id = $item_id";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        // Item found, display its details
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $image_name = $row['image_name'];
        ?>
        <div class="container justify-content-center  mt-5" style="width: 100%";>
        <div class="card mb-3" style="width: 100%; background-color: wheat;">

  <div class="row g-0">
    <div class="col-md-6 ">
    <?php 
                  //Check whether image available or not
                  if ($image_name == "") {
                      //Image not Available
                      echo "<div class='text-danger'>Image not Available.</div>";
                  } else {
                      //Image Available
                      
                  ?>
                      <img src="<?php echo SITEURL; ?>images/item/<?php echo $image_name; ?>" alt="handscraft artistry" style="height: 400px" width="70%">
                  <?php
                  }
                  ?>
    </div>
    <div class="col-md-3 mt-5">
      <div class="card-body">
        <h5 class="card-title"><?php echo $title; ?></h5>
        <p class="card-text">Rs <?php echo $price; ?></p>
        <p class="card-text"><?php echo $description; ?></p>
       
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
<br>
<br><br>

<?php

include("partials-frontend/footer.php");
?>
