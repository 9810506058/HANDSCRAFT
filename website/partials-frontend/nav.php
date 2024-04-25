<?php
// Include constant file
include('./config/constant.php');

// I

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
  $userId = $_SESSION['userId'];
  $username = $_SESSION['username'];
}
else{
  $loggedin = false;
  $userId = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>handscraft Artistry</title>

    <!-- STYLE CSS LINK -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- BOOTSTRAP CDN LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- FONT AWESOME CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- GOOGLE FONTS LINK -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@600&display=swap" rel="stylesheet">
    <!-- link logo to the website -->
    <link rel="shortcut icon" href="images/logo.jpg" type="image/x-icon">
</head>
<body>
 
<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg justify-content-center " id="navbar">
  <a href="index.php" class="navbar-brand" id="logo"><img src="./images/logo.jpg" alt=""></a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
    <span><i class="fa-solid fa-bars"></i></span>
  </button>
  <div class="collapse navbar-collapse" id="mynavbar">
    <ul class="navbar-nav me-auto">
      <li class="nav-item">
        <a href="index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Category
        </a>
        <ul class="dropdown-menu">
          <?php
          // Display categories from the database
          $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' ";
          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);
          if ($count > 0) {
              while ($row = mysqli_fetch_assoc($res)) {
                  $id = $row['categoryId'];
                  $title = $row['title'];
                  // Modify the href attribute to redirect to viewitem.php with category ID as a parameter
                  echo '<li><a class="dropdown-item" href="category-items.php?category_id=' . $id . '">' . $title . '</a></li>';
              }
          }
          ?>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Item
        </a>
        <ul class="dropdown-menu">
          <?php
          // Display items from the database
          $sql = "SELECT * FROM tbl_item WHERE active='Yes' AND featured='Yes' ";
          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);
          if ($count > 0) {
              while ($row = mysqli_fetch_assoc($res)) {
                  $id = $row['itemId'];
                  $title = $row['title'];
                  // Modify the href attribute to redirect to viewitem.php with item ID as a parameter
                  echo '<li><a class="dropdown-item" href="viewitem.php?item_id=' . $id . '" style="font-size: 16px;">' . $title . '</a></li>';
                  // Adjust the font-size as needed, in this example, it's set to 16 pixels.
              }
          }
          ?>
        </ul>
      </li>
      <li class="nav-item">
        <a href="About-us.php" class="nav-link"> About us</a>
      </li>
      <li class="nav-item">
      <?php
if ($loggedin) {
    $countsql = "SELECT SUM(`itemQuantity`) AS totalQuantity FROM `viewcart` WHERE `userId` = $userId"; 
    $countresult = mysqli_query($conn, $countsql);
    $countrow = mysqli_fetch_assoc($countresult);      
    $count = $countrow['totalQuantity'];
    if (!$count) {
        $count = 0;
    }
    echo '<a href="order.php" class="nav-link">
            Cart(' . $count . ')
          </button></a>';
} else {
    echo '<a href="order.php" class="nav-link">
            Cart
          </button></a>';
}
?>
      </li>


      <li>
        <form class="d-flex" action="<?php echo SITEURL; ?>item-search.php" method="POST">
          <div class="input-group">
            <input type="text" class="form-control me-2" placeholder="Search your favourite items and artistry" id="search" name="search" required >
            <button type="submit" id="searchbt">
              <i class="bi bi-search"></i>
            </button>
          </div>
        </form>
      </li>
      <?php
      if ($loggedin) { 
        echo '<ul class="navbar-nav mr-2">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"> Welcome ' .$username. '</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="userlogout.php">Logout</a>
          </div>
        </li>
      </ul>
      <div class="text-center image-size-small position-relative">
        <a href="viewProfile.php"><img src="images/person-' .$userId. '.jpg" class="rounded-circle" onError="this.src = \'images/bb.jpg\'" style="width:50px; height:40px"></a>
      </div>';
    } else {
          echo '<li class="nav-item">
                  <a class="btn btn-success mx-2" href="userlogin.php">Login</a>
                </li>
                <li class="nav-item">
                  <a class="btn btn-success mx-2" href="userregistration.php">SignUp</a>
                </li>';
      }
      ?>
    </ul>
  </div>
</nav>
