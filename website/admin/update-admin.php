<?php
include('partials/menu.php');

?>
<?php
if($loggedin){
    
?>

<div class="main-content">

    <div class="wrapper">
        <a href="manage-admin.php" class="btn"><i class="fa-solid fa-arrow-left"></i></a>
        <br>
        <br>
        <h1>Update Admin</h1>
        <br><br>
        <?php
        // get the id of the selected admin
        if (isset($_GET['id'])) {
            
            $id = $_GET['id'];
            // create a sql queery to get the details
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            if($res){
                //check whether the data is available or not
                $count=mysqli_num_rows($res);
                //check whether the admin data is available or not
                if($count==1){
                    //get the details
                    $rows = mysqli_fetch_assoc($res);
                    $full_name = $rows['full_name'];
                    $username = $rows['username'];

                }
                else{
                     //redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                
            
        }}}
        ?>
        <form action=""method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name;?>">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username;?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">


            </table>
        </form>
    </div>
</div>
<?php
//check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    //get all the values from form
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    //create an sql query
    $sql = "UPDATE tbl_admin SET
    full_name='$full_name',
    username='$username'
    WHERE id=$id
    ";
    //execute the query
    $res = mysqli_query($conn, $sql);
    if ($res) {
        
        $_SESSION['update'] = "<div class='success'>Admin updated successfully.</div>";
        header("location: " . SITEURL . 'admin/manage-admin.php');
    }
    else{
        
        $_SESSION['update'] = "<div class='error'>Failed to update admin.</div>";
        header("location: " . SITEURL . 'admin/manage-admin.php');
    }
}
?>




<?php
include('partials/footer.php');

?>
<?php
}
else{
    // Redirect to login page if user is not logged in
    $_SESSION ['login'] = "<div class='error'>Please login to access admin pannel.</div>";
    header('location:'.SITEURL.'admin/login.php');
}
?>
