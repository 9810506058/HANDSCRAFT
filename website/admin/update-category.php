<?php require_once('partials/menu.php'); ?>
<?php
if($loggedin){
    ?>

<div class="main-content">
    <div class="wrapper">
        <a href="manage-category.php" class="btn"><i class="fa-solid fa-arrow-left"></i></a>
        <br><br>
        <h1>Update Category</h1>
        <br><br>

        <?php 
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_category WHERE categoryId=$id";
            $res = mysqli_query($conn, $sql);

            if(mysqli_num_rows($res) == 1) {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                $_SESSION['no-category-found'] = "<div class='error'>Category not found.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                exit;
            }
        } else {
            header('location:'.SITEURL.'admin/manage-category.php');
            exit;
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php 
                        if($current_image != "") {
                            echo "<img src='".SITEURL."images/category/$current_image' width='150px'>";
                        } else {
                            echo "<div class='error'>Image Not Added.</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes") { echo "checked"; } ?> type="radio" name="featured" value="Yes"> Yes 
                        <input <?php if($featured=="No") { echo "checked"; } ?> type="radio" name="featured" value="No"> No 
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes") { echo "checked"; } ?> type="radio" name="active" value="Yes"> Yes 
                        <input <?php if($active=="No") { echo "checked"; } ?> type="radio" name="active" value="No"> No 
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
        if(isset($_POST['submit'])) {
            $id = $_POST['categoryId'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
            $active = isset($_POST['active']) ? $_POST['active'] : "No";

            // Check if a new image is uploaded
            if(isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];
                if($image_name != "") {
                    $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                    $allowed_extensions = array("jpg", "jpeg", "png", "gif");
                    if(in_array($ext, $allowed_extensions)) {
                        $image_name = "item_Category_" . rand(000, 999) . '_' . time() . '.' . $ext;
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/" . $image_name;
                        $upload = move_uploaded_file($source_path, $destination_path);
                        if(!$upload) {
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            exit;
                        }
                    } else {
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image. Only JPG, JPEG, PNG, and GIF files are allowed.</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                        exit;
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            $sql2 = "UPDATE tbl_category SET 
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active' 
                WHERE categoryId=$id
            ";

            $res2 = mysqli_query($conn, $sql2);

            if($res2) {
                $_SESSION['update'] = "<div class='success'>Category updated successfully.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                exit;
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to update category.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                exit;
            }
        }
        ?>

    </div>
</div>

<?php require_once('partials/footer.php'); ?>
<?php
}
else{
    // Redirect to login page if user is not logged in
    $_SESSION ['login'] = "<div class='error'>Please login to access admin pannel.</div>";
    header('location:'.SITEURL.'admin/login.php');
}
?>
