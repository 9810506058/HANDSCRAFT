<?php 
    include('partials/menu.php');
    
?>
<?php
    if($loggedin){
        
    ?>

<div class="main-content">
    <div class="wrapper">
        <a href="manage-admin.php" class="btn"><i class="fa-solid fa-arrow-left"></i></a>
        <br><br>
        <h1>Add Admin</h1>
        <br><br>

        <?php 
            // Display session message if set
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']); // Remove session message after displaying
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Your Username"></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Your Password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php 
  

    if(isset($_POST['submit'])) {
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); // MD5 hash for password

        if(empty($full_name) || empty($username) || empty($password)) {
            $_SESSION['add'] = "<div class='error'>Fields must not be empty.</div>";
            header("location: add-admin.php");
            exit(); // Terminate script execution after redirect
        } else {
            $sql = "SELECT * FROM tbl_admin WHERE username = '$username'";
            $res = mysqli_query($conn, $sql);
            if(mysqli_num_rows($res) > 0) {
                $_SESSION['add'] = "<div class='error'>Username already exists.</div>";
                header("location: add-admin.php");
                exit(); // Terminate script execution after redirect
            } else {
                $sql = "INSERT INTO tbl_admin (full_name, username, password) VALUES ('$full_name', '$username', '$password')";
                $res = mysqli_query($conn, $sql);
                if($res) {
                    $_SESSION['add'] = "<div class='success'>Admin added successfully.</div>";
                    header("location: manage-admin.php");
                    exit(); // Terminate script execution after redirect
                } else {
                    $_SESSION['add'] = "<div class='error'>Failed to add admin.</div>";
                    header("location: add-admin.php");
                    exit(); // Terminate script execution after redirect
                }
            }
        }
    }
?>

<?php

    } else {
        // Redirect to login page if user is not logged in
        $_SESSION ['login'] = "<div class='error'>Please login to access admin pannel.</div>";
        header('location:'.SITEURL.'admin/login.php');
        exit();
    }