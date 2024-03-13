<?php
   include ("../config/constant.php"); 


if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['removeUser'])) {
        $Id = $_POST["Id"];
        $sql = "DELETE FROM `tbl_users` WHERE `id`='$Id'";   
        $result = mysqli_query($conn, $sql);
        echo "<script>alert('Removed');
            window.location=document.referrer;
            </script>";
    }
    
    if(isset($_POST['createUser'])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
 
        $password = md5($_POST['password']); 
        
        // Check whether this username exists
        $existSql = "SELECT * FROM `tbl_users` WHERE username = '$username'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if($numExistRows > 0){
            echo "<script>alert('Username Already Exists');
                    window.location=document.referrer;
                </script>";
        }
        else{
          
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `tbl_users` ( `username`, `email`, `phone`,  `password`, `joinDate`) VALUES ('$username','$email', '$phone', '$hash', current_timestamp())";   
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
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $userType = $_POST["userType"];

        $sql = "UPDATE `tbl_users` SET `username` = '$username', `email`='$email', `phone`='$phone' WHERE `id`='$id'";
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
    }
    
   
    
}
?>