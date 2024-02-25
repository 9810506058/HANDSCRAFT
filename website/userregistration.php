<?php
include('config/constant.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Register Form</title>
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <h2>Register Window</h2>
            <form method="post" action="">
                <input class="input-box" type="text" name="username" placeholder="Your Name">
                <input class="input-box" type="email" name="email" placeholder="Your Email Address">
                <input class="input-box" type="text" name="address" placeholder="Your Email Address">
                <input class="input-box" type="password" name="password" placeholder="Your Password">
                <label class="text-color-white">
                    <input type="checkbox">
                    Agree with <a href="#" class="text-color-white">Terms & Condition</a>
                </label>
                <button class="login-btn"  type="submit" name="submit">Register</button>
                <button class="secondary-btn"><a href="signin.php" class="text-color-white text-decoration-none">Already a User?</a></button>
            </form>
        </div>
    </div>
</body>
</html><?php

if(isset($_POST['submit'])){
    // Get the data from the registration form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = md5($_POST['password']); // Note: Consider using stronger password hashing methods like bcrypt

    // Check if the username already exists
    $sql = "SELECT * FROM tbl_user WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0){
        header("Location: index.php?error=usernametaken");
        exit();
    } else {
        // Insert the user data into the database
        $sql = "INSERT INTO tbl_user (username, email, address, password) VALUES ('$username', '$email', '$address', '$password')";
        $result = mysqli_query($conn, $sql);
        if($result){
            header("Location: userlogin.php?signup=success");
            exit();
        } else {
            header("Location: index.php?error=sqlerror");
            exit();
        }
    }
}
?>
