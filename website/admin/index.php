<?php
include('partials/menu.php');

// Assuming $loggedin is defined somewhere in your code
if ($loggedin) {
    ?>

    <!-- main content starts--->
    <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1>
            <br><br>
            <?php
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            ?>

            <br><br>
            <div class="col-4 text-center">
                <a href="manage-category.php" style="text-decoration: none;  color: black;">
               
            <?php 
                        //Sql Query 
                        $sql = "SELECT * FROM tbl_category";
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count Rows
                        $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count; ?></h1>
                    <br>
                    Categories
                </a>
                </div>
            <div class="col-4 text-center">
            <a href="manage-item.php" style="text-decoration: none;  color: black;">
                <?php   
                //Sql Query 
                $sql2 = "SELECT * FROM tbl_item";
                //Execute Query
                $res2 = mysqli_query($conn, $sql2);
                //Count Rows
                $count2 = mysqli_num_rows($res2);

                ?>
                  <h1><?php echo $count2; ?></h1>
                <br>
               items
        </a>
            </div>
            <a href="manage-user.php" style="text-decoration: none; color:black">
            <div class="col-4 text-center">
                <?php 
                //Sql Query
                $sql3 = "SELECT * FROM users";
                //Execute Query
                $res3 = mysqli_query($conn, $sql3);
                //Count Rows
                $count3 = mysqli_num_rows($res3);
                ?>

                <h1><?php echo $count3; ?></h1>
                <br>
             users
            </div>
        </a>
        <?php

$sql4 = "SELECT * FROM tbl_orders";
$res4 = mysqli_query($conn, $sql4);
$count4 = mysqli_num_rows($res4);

?>

<a href="manage-order.php" style="text-decoration: none; color:black">
    <div class="col-4 text-center">
        <h1><?php echo $count4; ?></h1>
        <br>
        orders
    </div>
</a>

            <div class="clearfix"></div>
        </div>
    </div>
    <!-- main content ends-->

    <?php
    include('partials/footer.php');
} else {
    $_SESSION['login'] = "<div class='error text-center'>Please login to access admin panel.</div>";
    header('location: ' . SITEURL . 'admin/login.php');
}
?>
