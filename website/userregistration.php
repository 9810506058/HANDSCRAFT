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
                <input class="input-box" type="text" name="firstName" placeholder="Your First Name">
                <input class="input-box" type="text" name="lastName" placeholder="Your Last Name">

                <input class="input-box" type="email" name="email" placeholder="Your Email Address">
                <input class="input-box" type="text" name="address" placeholder="Your Address">
                <input type="tel" class="input-box" id="phone" name="phone" placeholder="Enter Phone No" required pattern="[0-9]{10}" maxlength="10">

                <input class="input-box" type="password" name="password" placeholder="Your Password">
                <label class="text-color-white">
                    <input type="checkbox">
                    Agree with <a href="#" class="text-color-white">Terms & Condition</a>
                </label>
                <button class="login-btn"  type="submit" name="submit">Register</button>
                <button class="secondary-btn"><a href="userlogin.php" class="text-color-white text-decoration-none">Already a User?</a></button>
            </form>
        </div>
    </div>
</body>
</html><?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'Config/constant.php';
    $username = $_POST["username"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $password = $_POST["password"];
    // Check whether this username exists
    $existSql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        $showError = "Username Already Exists";
        header('location:'.SITEURL.'userregistration.php?signupsuccess=false&error='.$showError);
    }
    else{
          $hash = password_hash($password, PASSWORD_DEFAULT);
          $sql = "INSERT INTO `users` ( `username`, `firstName`, `lastName`, `email`, `phone`, `address`, `password`, `joinDate`) VALUES ('$username', '$firstName', '$lastName', '$email', '$phone', '$address','$hash', current_timestamp())";   
          $result = mysqli_query($conn, $sql);
          if ($result){
              $showAlert = true;
              header('location:'.SITEURL.'userlogin.php?signupsuccess=true');
          }
      }
     
    }

    
?>