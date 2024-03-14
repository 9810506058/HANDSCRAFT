<?php
include('partials/menu.php');
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container">
    <div class="wrapper">
        <h1>Manage Category</h1>
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
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        
        
        ?>
       
        <br> 
        <a href="add-category.php" class="btn btn-primary"> Add Category</a>
        <br> <br> <br>
        <div class="table-responsive-sm">
            <table class="table w-55 h-30 table-bordered">
                <thead class="table-danger">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Feature</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM tbl_category";
                $res = mysqli_query($conn, $sql);

                if ($res) {
                    $sn = 1;
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['categoryId'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>
                            <td>
                                <?php 
                                if ($image_name != "") {
                                    // Display the image if available
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" width="100px">
                                    <?php
                                } else {
                                    echo "<div class='error'>Image not added</div>";
                                }
                                ?>
                            </td>
                            <td><?php echo $featured; ?></td> 
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class=" btn btn-secondary">Update</a>
                                <a href="#" onclick="confirmDelete('<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>');" class=" btn "><i class="fas fa-trash"></i></a>
                               <script>
function confirmDelete(deleteUrl) {
    // Display a confirmation dialog
    var confirmDelete = confirm("Are you sure you want to delete this category?");
    
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
                ?>
            </table>   
        </div>
    </div>
</div>

<?php
include('partials/footer.php');
?>
