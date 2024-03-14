<?php
// Consider replacing 'include' with 'require_once' if 'menu.php' and 'footer.php' are essential for the functionality
require_once('partials/menu.php');

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container">
    <div class="wrapper">
        <h1>Manage Items</h1>
        <br><br>
        
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
        
        ?>
              

<a href="add-item.php" class="btn btn-primary">Add Item</a>
<br> <br> <br>
<div class="table-responsive-sm">
        <table class="table w-55 h-30 table-bordered">
    <thead class="table-danger">
    <tr>
        <th>S.N</th>
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Category</th>
        <th>Feature</th>
        <th>Active</th>
        <th>Actions</th>
    </tr>
    </thead>
    <?php
   
    $sql = "SELECT * FROM tbl_item";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $sn = 1;
        while ($rows = mysqli_fetch_assoc($res)) {
            $id = $rows['itemId'];
            $title = $rows['title'];
            $price = $rows["price"];
            $image_name = $rows['image_name'];
            $featured = $rows['featured'];
            $active = $rows['active'];

            ?>
            <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo htmlspecialchars($title); ?></td>
                <td><?php echo htmlspecialchars($price); ?></td>
                <td><?php 
                    if ($image_name != "") {
                        // Use SITEURL for consistency
                        echo "<img src='" . SITEURL . "images/item/" . htmlspecialchars($image_name) . "' width='100px'>";
                    } else {
                        echo "<div class='error'>Image not added</div>";
                    }
                ?></td>
                <td><?php 
                    // Fetch and display category correctly
                    $sql2 = "SELECT * FROM tbl_category WHERE categoryId = {$rows['category_id']}";
                    $res2 = mysqli_query($conn, $sql2);
                    if ($res2 && mysqli_num_rows($res2) > 0) {
                        $row2 = mysqli_fetch_assoc($res2);
                        echo htmlspecialchars($row2['title']);
                    } else {
                        echo "<div class='error'>Category not added</div>";
                    }
                ?></td>
                <td><?php echo htmlspecialchars($featured); ?></td>
                <td><?php echo htmlspecialchars($active); ?></td>
                <td>
                    <a href="<?php echo SITEURL; ?>admin/update-item.php?id=<?php echo $id; ?>" class="btn btn-secondary">Update</a>
                    <!-- Utilize FontAwesome  -->
                    <a href="#" onclick="confirmDelete('<?php echo SITEURL; ?>admin/delete-item.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>');">
                        <i class="fas fa-trash"></i>
                    </a>
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
// Include footer
require_once('partials/footer.php');
?>

<!-- Include FontAwesome library if you haven't already -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<script>
function confirmDelete(deleteUrl) {
    var confirmDelete = confirm("Are you sure you want to delete this item?");
    if (confirmDelete) {
        window.location.href = deleteUrl;
    }
}
</script>
