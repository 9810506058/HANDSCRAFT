<?php 
include("partials-frontend/nav.php");

// Display login message if set
if(isset($_SESSION['login'])){
    echo $_SESSION['login'];
    unset($_SESSION['login']);
}
?>

<div class="container">
    <div class="line" style="width: 100%; height: 2px; background-color: purple;"></div>
</div>

<section class="item" id="item">
    <h1 class="text-center text-danger">CATEGORIES</h1>
    <div class="row">
        <?php 
        // Display categories
        $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 5 " ;
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0) {
            while($row = mysqli_fetch_assoc($res)) {
                $id = $row['categoryId'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>
        <div class="col-md-3 py-2">
            <a href="<?php echo SITEURL; ?>category-items.php?category_id=<?php echo $id; ?>" style="text-decoration: none;">
                <div class="card">
                    <?php 
                    // Check if image available
                    if($image_name == "") {
                        echo "<div class='error'>Image not Available</div>";
                    } else {
                    ?>
                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" style="height:200px;">
                    <?php
                    }
                    ?>
                    <div class="card-body text-center text-danger">
                        <h3><?php echo $title; ?></h3>
                    </div>
                </div>
            </a>
        </div>
        <?php
            }
        } else {
            // No categories available
            echo "<div class='col-md-12'><div class='error'>Category not Added.</div></div>";
        }
        ?>
    </div>
    <p class="text-center text-danger">
        <a href="categories.php" class="text-danger" style="text-decoration: none;">More categories</a>
        <a href="categories.php" class="btn text-danger"><i class="fa-solid fa-arrow-down"></i></a>
    </p>
</section>
<!-- <div class="container">
    <div class="line" style="width: 100%; height: 2px; background-color: #e53937;"></div>
</div> -->
<section class="item" id="item">
    <h1 class="text-center text-danger">ITEMS</h1>
    <div class="row">
        <?php 
        // Display items
        $sql2 = "SELECT * FROM tbl_item WHERE active='Yes' AND featured='Yes' LIMIT 5";
        $res2 = mysqli_query($conn, $sql2);
        if(mysqli_num_rows($res2) > 0) {
            while($row = mysqli_fetch_assoc($res2)) {
                $id = $row['itemId'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $sub_description = $row['sub_description'];
                $image_name = $row['image_name'];
        ?>
         <div class="col-md-3 py-2 py-md-0">
            <div class="card">
                <?php 
                // Check if image available
                if($image_name == "") {
                    echo "<div class='text-danger'>Image not available.</div>";
                } else {
                ?>
                <img src="<?php echo SITEURL; ?>images/item/<?php echo $image_name; ?>" alt="handicrafts" style="height:240px;">
                <?php
                }
                ?>
                <div class="card-body text-center">
                    <h3><?php echo $title ?></h3>
                    <p class="text-center text-danger"> Rs <?php echo $price ?> </p>
                    <p class="text-center text-danger"> <?php echo $sub_description?></p>
                    <?php

if ($loggedin) {
    $quaSql = "SELECT `itemQuantity` FROM `viewcart` WHERE itemId = '$id' AND `userId`='$userId'";
    $quaresult = mysqli_query($conn, $quaSql);
    $quaExistRows = mysqli_num_rows($quaresult);
    if($quaExistRows == 0) {
        echo '<form action="_manageCart.php" method="POST"  class="d-inline">
              <input type="hidden" name="itemId" value="'.$id. '">
              <button type="submit" name="addToCart" class="btn btn-primary mx-7 my-3 " >Add to Cart</button>';
    } else {
        echo '<a href="cart.php"><button class="btn btn-success mx-7" >Go to Cart</button></a>';
    }

echo '</form>';
}
else{
    echo '<a href="userlogin.php"><button class="btn btn-primary mx-7" >Add to Cart</button></a>';
}
?>
<a href="viewitem.php?item_id=<?php echo $id;?>" class="btn btn-primary " >Quick View</a>
  </div>

            </div>
        </div>
        <?php
            }
        } else {
            // No items available
            echo "<div class='col-md-12'><div class='error'>Items not available.</div></div>";
        }
        ?>
    </div>
</section>

<div class="clearfix"></div>
<p class="text-center text-danger">
    <a href="item.php" class="text-danger" style="text-decoration: none;">More items</a>
    <a href="item.php" class="btn text-danger"><i class="fa-solid fa-arrow-down"></i></a>
</p>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<?php include("partials-frontend/footer.php"); ?>
