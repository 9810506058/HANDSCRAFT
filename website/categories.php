<?php
include("partials-frontend/nav.php");



?>

<html>
<head>
   
</head>
<body>
<section class="item" id="item">
    <h1 class="text-danger text-center">Category</h1>
    <div class="container">
        <div class="line" style="width: 100%; height: 2px; background-color: #e53937;"></div>
    </div>
    <div class="row" style="margin-top: 50px;">
        <?php
        //Display categories that are active
        $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes'";
        //Execute the Query
        $res = mysqli_query($conn, $sql);
        //Check whether the categories are available or not
        if ($res && mysqli_num_rows($res) > 0) {
            //Categories Available
            while ($row = mysqli_fetch_assoc($res)) {
                //Get the Values
                $id = $row['categoryId'];
                $title = $row['title'];
                $image_name = $row['image_name'];
                
                ?>
                <div class="col-md-3 py-3 py-md-0">
                    <a href="<?php echo SITEURL; ?>category-items.php?category_id=<?php echo $id; ?>"
                       style="text-decoration: none;">
                        <div class="card">
                            <?php
                            //Check whether image available or not
                            if ($image_name == "") {
                                //Image not Available
                                echo "<div class='error'>Image not Available.</div>";
                            } else {
                                //Image Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>"
                                     alt="handscraft artistry" style="height: 240px";>
                                <?php
                            }
                            ?>
                            <div class="card-body">
                                <h3 class="card-title text-center text-danger"><?php echo $title; ?></h3>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            }
        } else {
            //Categories not Available
            echo "<div class='col-md-12'><div class='error'>Category not found.</div></div>";
        }
        ?>
    </div>
    <div class="clearfix"></div>
</section>
<?php include("partials-frontend/footer.php"); ?>
</body>
</html>
