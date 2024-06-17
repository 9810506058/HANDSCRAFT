<?php
include("partials-frontend/nav.php");

// Initialize an empty variable to store the category title
$categoryTitle = "";

?>

<html>
<head>
    <title><?php echo $categoryTitle; ?></title>
</head>
<body>

<?php 
//Check whether id is passed or not
if(isset($_GET['category_id'])) {
    //Category id is set and get the id
    $category_id = $_GET['category_id'];
    // Get the Category Title Based on Category ID
    $sql = "SELECT title FROM tbl_category WHERE categoryId=$category_id active='Yes' AND featured='Yes'" ;

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Get the value from Database
    $row = mysqli_fetch_assoc($res);
    //Get the Title
    $category_title = $row['title'];
    //Set the Category Title in Variable
    $categoryTitle = $category_title;
} else {
    //Category not passed
    //Redirect to Home page
    header('location:'.SITEURL);
}
?>

<!-- item Menu Section Starts Here -->
<section class="item" id="item">
    <h1 class="text-center text-danger">Items on  Category</h1><h1 class="text-center text-success">"<?php echo $category_title;?>"</h1>
    <div class="row">
        <?php 
        //Create SQL Query to Get items based on Selected Category
        $sql2 = "SELECT * FROM tbl_item WHERE category_id=$category_id";
        
        //Execute the Query
        $res2 = mysqli_query($conn, $sql2);
        //Count the Rows
        $count2 = mysqli_num_rows($res2);
        //Check whether item is available or not
        if($count2 > 0) {
            //Item is Available
            while($row2 = mysqli_fetch_assoc($res2)) {
                $id = $row2['itemId'];
                $title = $row2['title'];
                $price = $row2['price'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];
        ?>
        <div class="col-md-3 py-2 py-md-0">
            <div class="card">
                <?php 
                if($image_name == "") {
                    //Image not Available, you can use a placeholder image here
                    echo "<img src='placeholder-image.jpg' alt='Placeholder Image' class='img-responsive img-curve'>";
                } else {
                    //Image Available
                ?>
                <img src="<?php echo SITEURL; ?>images/item/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" style="height:240px";>
                <?php
                }
                ?>
                <div class="card-body text-center text-success">
                    <h4><?php echo $title; ?></h4>
                    <p >Rs <?php echo $price; ?></p>
                  
                    <br>
                    <?php
                  
                   // Check if user is logged in
                   if($loggedin){
                    $quaSql = "SELECT `itemQuantity` FROM `viewcart` WHERE itemId = '$id' AND `userId`='$userId'"; 
                    $quaresult = mysqli_query($conn, $quaSql);
                    $quaExistRows = mysqli_num_rows($quaresult);
                    if($quaExistRows == 0) {
                        echo '<form action="_manageCart.php" method="POST" class="d-inline">
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
            //Item not available
            echo "<div class='col-md-12'><div class='error'>Items not Available.</div></div>";
        }
        ?>
    </div>
</section>
<!-- item Menu Section Ends Here -->

<?php include('partials-frontend/footer.php'); ?>
