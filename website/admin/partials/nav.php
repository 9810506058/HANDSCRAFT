<?php
// Check if the admin is logged in
include('login-check.php');
?>

<html>
<head>
    <title>
        Handscraft ordering system
    </title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>
<body>
    <!-- menu section starts--->
    <div class="menu text-center">
    <div class="wrapper">
        <ul>
            
            <li> <a href="index.php"> Home</a></li>
            <li> <a href="manage-admin.php"> Admin</a></li>
            <li> <a href="manage-category.php"> category</a></li>
            <li> <a href="manage-item.php"> Item</a></li>
            <li> <a href="manage-order.php"> order</a></li>
            <li> <a href="logout.php"> Logout</a></li>
           
        </ul>
    </div>
    
    </div>
    <!-- menu section ends-->
</body>
</html>
