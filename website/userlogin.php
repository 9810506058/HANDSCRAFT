<?php
include('./config/constant.php');

?>
<html>
    <head></head>
    <title>login</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="shortcut icon" href="images/logo.jpg" type="image/x-icon">


   

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
    
    if(isset($_SESSION['add'])){
        
        echo $_SESSION['add'];
        unset($_SESSION['add']);

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
</html>
<?php


// Check whether the submit button is clicked or not
if(isset($_POST['submit'])){
    // Get the data from the login form
    $username = $_POST['username'];
    //use password hashing
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
   

    if( empty($username) || empty($password)) {
        $_SESSION['add'] = "<div class='error text-danger'>Fields must not be empty.</div>";
        header("location: userlogin.php");
        exit(); // Terminate script execution after redirect
    } else {
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
            $_SESSION['login']= "<div class='success text-center text-success'>Welcome $username. You are logged in.</div>";
            header("Location: " . SITEURL . "index.php?loginsuccess=true");

            exit();
        } else {
            header("Location: " . SITEURL . "userlogin.php?loginsuccess=false");
            $_SESSION['login'] = "<div class='error text-center'style='color:red'>Incorrect password. Please try again.</div>";
            exit();
        }
    } else {
        $_SESSION['login'] = "<div class='error text-center'style='color:red'>Username does not exist. Please try again.</div>";

        header("Location: " . SITEURL . "userlogin.php?loginsuccess=false");


        exit();
    }
} 
}   
?>
