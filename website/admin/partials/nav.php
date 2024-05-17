<?php
// Include constant file
include('../config/constant.php');

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    $loggedin = true;
    $username = $_SESSION['user'];
} else {
    $loggedin = false;
    $userId = 0;
}
?>

<html>
<head>
    <title>Handscraft ordering system</title>
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        /* Custom CSS for the menu */
        .menu {
            border-bottom: 1px solid black;
        } 
        .menu ul {
            list-style-type: none;
        }
        .menu ul li {
            display: inline;
            padding: 3%;
        }
        .menu ul li a {
            text-decoration: none;
            color: brown;
            font-weight: bold;
        }
        .menu ul li a:hover {
            color: blue;
        }
        
        /* Dropdown styles */
        .dropdown {
            color:brown;
            position: relative;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #fff;
            color:brown;
            min-width: 120px;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .dropdown-content a {
            color: #333;
            padding: 10px;
            display: block;
            text-decoration: none;
        }
        .dropdown-content a:hover {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
   <!-- menu section starts--->
   <div class="menu">
    
        <ul>
            <li> <a href="index.php"> Home</a></li>
            <li> <a href="manage-admin.php"> Admin</a></li>
            <li> <a href="manage-category.php"> category</a></li>
            <li> <a href="manage-item.php"> Item</a></li>
            <li> <a href="manage-order.php"> order</a></li>
            <li> <a href="manage-user.php">users</a></li>
            <?php if($loggedin): ?>
                <li class="dropdown">
                    <span class="dropdown-toggle"> <?php echo $username ?></span>
                    <div class="dropdown-content">
                        <a href="logout.php">Logout</a>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
    </div>
  
    <!-- menu section ends-->
</body>
</html>
