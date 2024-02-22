
<?php
include('../config/constant.php');

?>
<html>
    <head></head>
    <title>login</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/login.css">

   

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
</html>
<?php
//check whether the submit button is clicked or not
if(isset($_POST['submit'])){
    //process for login
    //1.get the data from login form
     echo"$username";
    $username=$_POST['username'];
    $password= md5(($_POST['password'])) ;

    //2.sql query to check whether the user with username and password exists or not

    $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    //3.execute the query
   
    
    $res=mysqli_query($conn,$sql);

    //4.count rows to check whether the user exists or not
    $count=mysqli_num_rows($res);
    if($count==1){
        //user available and login success
        $_SESSION['login']="<div class='success'>Login Successful </div>";
       $_SESSION['user']=$username;
       
       //redirect
    
       header('location:'.SITEURL.'admin/');
    }

else{
    //user not available and login failed
    $_SESSION['login']="<div class='error text-center'>Login Failed.</div>";
    header("location: " . SITEURL . 'admin/login.php');
}
}
?>