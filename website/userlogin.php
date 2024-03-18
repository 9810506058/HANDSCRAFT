<?php
include('./config/constant.php')

?>
<html>
    <head></head>
    <title>login</title>
    <link rel="stylesheet" href="./css/admin.css">
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
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'config/constant.php';
    $username = $_POST["username"];
    $password = $_POST["password"]; 
    
    $sql = "Select * from users where username='$username'"; 
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        $row=mysqli_fetch_assoc($result);
        $userId = $row['id'];
        if (password_verify($password, $row['password'])){ 
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['userId'] = $userId;
            
            $_SESSION['login']="<div class='success'> Welcome $username  ! You are logged in.</div>";
            header('location:'.SITEURL.'index.php?loginsuccess=true');
            exit();
        } 
        else{ 
            $_SESSION['failed-access']="<div class='error' style='font-size : 18px'> login failed incorrect password.</div>";
            header('location:'.SITEURL.'userlogin.php?loginsuccess=false');
        }
    } 
    else{
        $_SESSION['failed-access']="<div class='error' style='font-size : 18px'> login failed please try again.</div>";
        header('location:'.SITEURL.'userlogin.php?loginsuccess=false');
    }
}    
?>