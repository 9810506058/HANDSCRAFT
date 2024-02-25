<?php

// Your database connection and constant definitions
include('./config/constant.php');

// Your login logic
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)) {
        $_SESSION['add'] = "<div class='error text-danger'>Fields must not be empty.</div>";
        header("location: loginModal.php");
        exit();
    } else {
        $sql = "SELECT * FROM tbl_user WHERE username='$username'";
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
