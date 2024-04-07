<?php
    include '../config/constant.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['removeUser'])) {
        $Id = $_POST["Id"];
        $sql = "DELETE FROM `users` WHERE `id`='$Id'";   
        $result = mysqli_query($conn, $sql);
        echo "<script>alert('Removed');
            window.location=document.referrer;
            </script>";
    }
    
    if(isset($_POST['createUser'])) {
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
        echo "<script>alert('Username Already Exists');
                window.location=document.referrer;
            </script>";
    }
    else{
          $hash = password_hash($password, PASSWORD_DEFAULT);
          $sql = "INSERT INTO `users` ( `username`, `firstName`, `lastName`, `email`, `phone`, `address`, `password`, `joinDate`) VALUES ('$username', '$firstName', '$lastName', '$email', '$phone', '$address','$hash', current_timestamp())";   
          $result = mysqli_query($conn, $sql);
          if ($result){
            echo "<script>alert('Success');
                    window.location=document.referrer;
                </script>";
        }else {
            echo "<script>alert('Failed');
                    window.location=document.referrer;
                </script>";
        }
    }
                }
                if(isset($_POST['editUser'])) {
                    $id = $_POST["userId"];
                    $username= $_POST["username"];
                    $firstName = $_POST["firstName"];
                    $lastName = $_POST["lastName"];
                    $phone = $_POST["phone"];
                    $address = $_POST["address"];
                    $email = $_POST["email"];
                
                    $sql = "UPDATE `users` SET  `username`='$username', `firstName`='$firstName', `lastName`='$lastName', `email`='$email', `phone`='$phone', `address`='$address' WHERE `id`='$id'";   
                    $result = mysqli_query($conn, $sql);
                    if ($result){
                        echo "<script>alert('update successfully');
                            window.location=document.referrer;
                            </script>";
                    }
                    else {
                        echo "<script>alert('failed');
                            window.location=document.referrer;
                            </script>";
                    }
                 } }
            
                ?>
                