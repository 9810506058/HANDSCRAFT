<?php
include('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <a href="manage-admin.php"><i class="fa-solid fa-arrow-left"></i></a>
        <br>
        <br>
        
        <h1>Change password</h1>
        <?php

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>
        <br><br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>current password</td>
                    <td>
                        <input type="password" name="current_password">
                    </td>
                </tr>
                <tr>
                    <td>
                        new password
                    </td>
                    <td style=>
                        <input type="password" name="new_password">
                    </td>
                </tr>
                <tr>
                    <td>
                        Confirm password
                    </td>
                    <td>
                        <input type="password" name="confirm_password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $current_password = md5(($_POST['current_password']));
    $new_password = md5(($_POST['new_password']));
    $confirm_password = md5(($_POST['confirm_password']));

    // Check whether the user with the current id and current password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        // Check whether the data exists or not
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            // User exists, update the password
            $row = mysqli_fetch_assoc($res);
            
            // Check if new password and confirm password match
            if ($new_password == $confirm_password) {
                // Update the password in the database
                $sql_update = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";
                $res_update = mysqli_query($conn, $sql_update);

                if ($res_update) {
                    $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                } else {
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password.</div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                }
            } 
            else {
                $_SESSION['pwd-not-match'] = "<div class='error'>New Password and Confirm Password do not match.</div>";
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        } else {
            $_SESSION['user-not-found'] = "<div class='error'>User not found</div>";
            header('location:' . SITEURL . 'admin/manage-admin.php');
        }
    } 
}
?>

<?php
include('partials/footer.php');
?>
