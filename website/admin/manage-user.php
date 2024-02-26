<?php
    include('partials/menu.php');
?>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container ">
    <div class="wrapper">
        <h1>Manage user</h1>
        <br>
        <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }
        
        if (isset($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        }
        
        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        }
        
        

        ?>
        <br>
        <br>
        <a href="add-users.php" class="btn-primary">Add user</a>
        <br>
        <br>
        <br>
        <div class="table-responsive-sm">
        <table class="table w-55 h-30 table-bordered">
    <thead class="table-danger">
            <tr>
                <th>S.N</th>
                <th>Username</th>
                <th>Address</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>   
    </thead>
            <?php
            $sql = "SELECT * FROM tbl_users";
            $res = mysqli_query($conn, $sql);

            if ($res == TRUE) {
                $counts = mysqli_num_rows($res);
                $sn = 1;

                if ($counts > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $username = $rows['username'];
                        $address = $rows['address'];
                        $email= $rows['email'];

                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $username; ?></td>
                            <td><?php echo $address; ?></td>
                            <td><?php echo $email; ?></td>
                            <td >
                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class=" btn  btn-secondary">Update password</a>

                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class=" btn btn-secondary">Update</a>
                                <a href="#" onclick="confirmDelete('<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>');"> <i class="fa-solid fa-trash"></i></a>

<script>
function confirmDelete(deleteUrl) {
    // Display a confirmation dialog
    var confirmDelete = confirm("Are you sure you want to delete this admin?");
    
    // If the user clicks OK, navigate to the delete URL
    if (confirmDelete) {
        window.location.href = deleteUrl;
    }
}
</script>

                            </td>
                        </tr>
                        <?php
                    }
                }
            }
            ?>
  
        </table>
        </div>
    </div>
</div>

<?php
include('partials/footer.php');
?>