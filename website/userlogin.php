<?php
include('config/constant.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/style.css">
    
    <title>login Form</title>
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <h2>login Window</h2>
            <form method="post" action="">
                <input class="input-box" type="text" name="username" placeholder="Your Name">
              
                <input class="input-box" type="password" name="password" placeholder="Your Password">
                <label class="text-color-white">
                   
                <button class="secondary-btn"  type="submit" name="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html><?php


// Your login logic
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)) {
        $_SESSION['add'] = "<div class='error text-danger'>Fields must not be empty.</div>";
        header("location: loginModal.php");
        exit();
    } else {
        $sql = "SELECT * FROM tbl_users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);

        if ($num == 1) {
            $row = mysqli_fetch_assoc($result);
            $userId = $row['id'];

            if (password_verify($password, $row['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['userId'] = $userId;
                $_SESSION['login'] = "<div class='success text-center text-success'>Welcome $username. You are logged in.</div>";
                header("Location: " . SITEURL . "index.php?loginsuccess=true");
                exit();
            } else {
                $_SESSION['login'] = "<div class='error text-center' style='color:red'>Incorrect password. Please try again.</div>";
                header("Location: " . SITEURL . "loginModal.php?loginsuccess=false");
                exit();
            }
        } else {
            $_SESSION['login'] = "<div class='error text-center' style='color:red'>Username does not exist. Please try again.</div>";
            header("Location: " . SITEURL . "loginModal.php?loginsuccess=false");
            exit();
        }
    } 
}   
?>
