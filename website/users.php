<?php
include('./config/constant.php');

?>
<html>
    <head></head>
    <title>login</title>
    <link rel="stylesheet" href="./css/login.css">

   

</head>
<body>
    


<div class="login-container">
        <div class="login-form">
            <h2>Login </h2>
    <?php

    if(isset($_SESSION['login'])){
        
        echo $_SESSION['login'];
        unset($_SESSION['login']);

    }
    if(isset($_SESSION['failed-access'])){
        
        echo $_SESSION['failed-access'];
        unset($_SESSION['failed-access']);

    }
  

    
    if(isset($_SESSION['no-login-message'])){
        
        echo $_SESSION['no-login-message'];
        unset($_SESSION['no-login-message']);

    }

    ?>
          <form action="" method="POST">
                <input class="input-box" type="username" name="username" placeholder="Your username" required>
                <input class="input-box" type="password" name="password" placeholder="Your Password" required>
                
                <button class="login-btn btn-primary" type="submit" name="submit">Login</button>
              
            </form>
        </div>
    </div>
</body>
</html><?php
// Start the session

// Establish database connection (assuming $conn is defined elsewhere)
// $conn = mysqli_connect($servername, $username, $password, $dbname);

// Check whether the submit button is clicked or not
if(isset($_POST['submit'])){
    // Get the data from the login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // SQL query to check whether the user with username exists or not
    $sql = "SELECT * FROM tbl_user WHERE username='$username'"; 
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);
        $userId = $row['id'];
        
        // Verify password
        if ($password == $row['password']) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['userId'] = $userId;
            header("Location: " . SITEURL . "index.php?loginsuccess=true");
            
            exit();
        } else {
            header("Location: " . SITEURL . "index.php?loginsuccess=false");
            exit();
        }
    } else {
        header("Location: " . SITEURL . "index.php?loginsuccess=false");
        exit();
    }
}    
?>
