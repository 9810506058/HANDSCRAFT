<?php
    include 'config/constant.php';
    $userId = $_SESSION['userId'];
    
    
    if(isset($_POST["updateProfilePic"])){
       
            $image_name = $_FILES['image']['name'];
            if($image_name != "") {
                // Rename the image
                $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                $image_name = "users-Name-" . $userId . "." . $ext;

        
                // Upload the image
                $src = $_FILES['image']['tmp_name'];
                $dst = "./images/" . $image_name;
                $upload = move_uploaded_file($src, $dst);echo "<script>alert('success');
                        window.location=document.referrer;
                    </script>";
        
                if($upload == false) {
                    $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                    echo "<script>alert('image upload failed, please try again.');
                    window.location=document.referrer;
                </script>";
                    exit(); // Terminate script execution
                }
            }
        } else {
            $image_name = ""; 
            // Set default value
        }
    

    if(isset($_POST["updateProfileDetail"])){
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password =$_POST["password"];

        $passSql = "SELECT * FROM users WHERE id='$userId'"; 
        $passResult = mysqli_query($conn, $passSql);
        $passRow=mysqli_fetch_assoc($passResult);
        if (password_verify($password, $passRow['password'])){ 
            $sql = "UPDATE `users` SET `firstName` = '$firstName', `lastName` = '$lastName', `email` = '$email', `phone` = '$phone' WHERE `id` ='$userId'";   
            $result = mysqli_query($conn, $sql);
            if($result){
                echo '<script>alert("Update successfully.");
                        window.history.back(1);
                    </script>';
            }else{
                echo '<script>alert("Update failed, please try again.");
                        window.history.back(1);
                    </script>';
            } 
        }
        else {
            echo '<script>alert("Password is incorrect.");
                        window.history.back(1);
                    </script>';
        }
    }
    
   
    if(isset($_POST["removeProfilePic"])){
        $filename = $_SERVER['DOCUMENT_ROOT']."/HANDSCRAFT/website/images/users-Name-".$userId.".jpg";
        if (file_exists($filename)) {
            unlink($filename);
            echo "<script>alert('Removed');
                window.location=document.referrer;
            </script>";
        }
        else {
            echo "<script>alert('no photo available.');
                window.location=document.referrer;
            </script>";
        }
    }
    
?>