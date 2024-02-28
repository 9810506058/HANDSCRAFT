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
        $userType = $_POST["userType"];
        $password = $_POST["password"];
        
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
                
                $sql = "INSERT INTO `tbl_users` ( `username`, `email`, `phone`, `userType`, `password`, `joinDate`) VALUES ('$username','$email', '$phone', '$userType', '$hash', current_timestamp())";   
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
    
   
    
}
?>