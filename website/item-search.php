<?php 
include("partials-frontend/nav.php");
?>
<div class="container text-center text-danger">
<?php 

$search = mysqli_real_escape_string($conn, $_POST['search']);

?>


<h1>Items on Your Search <span class="text-success font-weight-bold font-italic" style="font-size:40 px;">"<?php echo $search; ?>"</span></h1>
</div>
<div class="container">
  <div class="line" style="width: 100%; height: 2px; background-color: #e53937;"></div>
</div>
<br>
<div class="container">
    <div class="row ">
        <?php 
        $sql = "SELECT * FROM tbl_item WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
        $res = mysqli_query($conn, $sql);
        if ($res && mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['itemId'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                ?>
                <div class="col-md-4 mt-3">

                    <div class="card mb-4">
                        <?php 
                        if ($image_name == "") {
                            echo "<div class='error text-danger text-center'>Image not Available.</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/Item/<?php echo $image_name; ?>" class="card-img-top" alt="Handscraft Image" style="height: 300px";>
                        <?php
                        }
                        ?>
                        <div class="card-body text-center">
                            <h1 class="card-title"><?php echo $title;?></h1>
                            <p class="card-text text-success">Rs <?php echo $price;?></p>
                            <?php

                            // Check if user is logged in
                    if($loggedin){
                        $quaSql = "SELECT `itemQuantity` FROM `viewcart` WHERE itemId = '$id' AND `userId`='$userId'"; 
                        $quaresult = mysqli_query($conn, $quaSql);
                        $quaExistRows = mysqli_num_rows($quaresult);
                        if($quaExistRows == 0) {
                            echo '<form action="_manageCart.php" method="POST">
                                  <input type="hidden" name="itemId" value="'.$id. '">
                                  <button type="submit" name="addToCart" class="btn btn-primary mx-7 my-3">Add to Cart</button>';
                        } else {
                            echo '<a href="order.php"><button class="btn btn-success mx-7" >Go to Cart</button></a>';
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
            echo "<div class='col-md-12'><div class='error text-danger'>Item not found.</div></div>";?>
            <script>
                alert("Item not found")
            </script>
            <?php
        }
        ?>
    </div>
</div>

<?php include("partials-frontend/footer.php"); ?>
