<?php 
include("partials-frontend/nav.php");
?>
<?php

if(isset($_SESSION['login'])){
    
    echo $_SESSION['login'];
    unset($_SESSION['login']);

}
?>
<div class="container">
  <div class="line" style="width: 100%; height: 2px; background-color: purple;"></div>
</div>


<section class="item" id="item">
  <h1 class="text-center text-danger">CATEGORY</h1>
  <div class="row">
    <?php 
    //Create SQL Query to Display Categories from Database
    $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
    //Execute the Query
    $res = mysqli_query($conn, $sql);
    //Check whether the category is available or not
    if(mysqli_num_rows($res) > 0) {
        //Categories Available
        while($row = mysqli_fetch_assoc($res)) {
            //Get the Values like id, title, image_name
            $id = $row['id'];
            $title = $row['title'];
            $image_name = $row['image_name'];
    ?>
            <div class="col-md-4 py-3">
              <a href="<?php echo SITEURL; ?>category-items.php?category_id=<?php echo $id; ?>"  style="text-decoration: none;">
                <div class="card">
                  <?php 
                  //Check whether Image is available or not
                  if($image_name == "") {
                      //Display Message
                      echo "<div class='error'>Image not Available</div>";
                  } else {
                      //Image Available
                  ?>
                      <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" style="height:300px";>
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
        //Categories not Available
        echo "<div class='col-md-12'><div class='error'>Category not Added.</div></div>";
    }
    ?>
  </div>
  <p class="text-center text-danger">

<a href="categories.php" class="text-danger" style="text-decoration: none;" >
more categories </a><a href="categories.php" class="btn text-danger"><i class="fa-solid fa-arrow-down"></i></a>
</p>
</section>

<div class="container">
  <div class="line" style="width: 100%; height: 2px; background-color: #e53937;"></div>
</div>

<section class="item" id="item">
<h1 class="text-center text-danger">ITEMS</h1>
  <div class="row">
    <?php 
    //Getting items from Database that are active and featured
    //SQL Query
    $sql2 = "SELECT * FROM tbl_item WHERE active='Yes' AND featured='Yes' LIMIT 3";
    //Execute the Query
    $res2 = mysqli_query($conn, $sql2);
    //Check whether items are available or not
    if(mysqli_num_rows($res2) > 0) {
        //Items Available
        while($row = mysqli_fetch_assoc($res2)) {
            //Get all the values
            $id = $row['id'];
            $title = $row['title'];
            $price = $row['price'];
            $description = $row['description'];
            $sub_description = $row['sub_description'];
            $image_name = $row['image_name'];
    ?>
            <div class="col-md-3 py-3">
              <div class="card">
                <?php 
                //Check whether image available or not
                if($image_name == "") {
                    //Image not Available
                    echo "<div class='text-danger'>Image not available.</div>";
                } else {
                    //Image Available
                ?>
                    <img src="<?php echo SITEURL; ?>images/item/<?php echo $image_name; ?>" alt="handscrafts" style="height:240px";>
                <?php
                }
                ?>
             <div class="card-body text-center">
    <h3><?php echo $title ?></h3>
    <!-- <h6><?php echo $description ?></h6> -->
    <p class="text-center text-danger"> Rs <?php echo $price ?> </p>
    <p class="text-center text-danger"> <?php echo $sub_description?></p>
    <!-- Check if the user is logged in -->
    <?php
   
    if (!isset($_SESSION['user'])) {
        // User is not logged in, display login form or redirect to login page
        echo "<a href='users.php' class='btn btn-primary'>Add to cart</a>";
    } else {
      echo "<a href='order.php?item_id=" . $id . "' class='btn btn-primary'>Add to cart</a>";
    }
    
    ?>
    <a href="viewitem.php?item_id=<?php echo $id;?>" class="btn btn-primary">Quick View</a>
</div>
</div>
</div>


    <?php
        }
    } else {
        //Items Not Available 
        echo "<div class='col-md-12'><div class='error'>Items not available.</div></div>";
    }
    ?>
  </div>
</section>

<div class="clearfix"></div>
<p class="text-center text-danger">

<a href="items.php" class="text-danger" style="text-decoration: none;" >
more items</a><a href="item.php" class="btn text-danger"><i class="fa-solid fa-arrow-down"></i></a>


</p>


       




<?php include("partials-frontend/footer.php"); ?>
