<?php
 
    include('partials/menu.php');
    ?>
    <?php
    if($loggedin){
        

    // Check if 'id' parameter is set
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        // SQL Query to get selected item
        $sql2 = "SELECT * FROM tbl_item WHERE itemId=$id";
        $res2 = mysqli_query($conn, $sql2);

        if($res2) {
            $row2 = mysqli_fetch_assoc($res2);
            $title = $row2['title'];
            $description = $row2['description'];
            $sub_description = $row2['sub_description'];
            $price = $row2['price'];
            $current_image = $row2['image_name'];
            $current_category = $row2['category_id'];
            $featured = $row2['featured'];
            $active = $row2['active'];
        } else {
            // Redirect to Manage item if query fails
            $_SESSION['error'] = "Failed to fetch item details.";
            header('location:'.SITEURL.'admin/manage-item.php');
            exit();
        }
    } else {
        // Redirect to Manage item if 'id' parameter is not set
        header('location:'.SITEURL.'admin/manage-item.php');
        exit();
    }

    // Check if the form is submitted
    if(isset($_POST['submit'])) {
        // Retrieve form data
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $sub_description = $_POST['sub_description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];
        $current_image = $_POST['current_image'];

        // Handle image upload
        if(isset($_FILES['image']['name']))
        {
            //Upload BUtton Clicked
            $image_name = $_FILES['image']['name']; //New Image NAme

            //CHeck whether th file is available or not
            if($image_name!="")
            {
                //IMage is Available
                //A. Uploading New Image

                //REname the Image
                $ext = end(explode('.', $image_name)); //Gets the extension of the image

                $image_name = "item-Name-".rand(0000, 9999).'.'.$ext; //THis will be renamed image

                //Get the Source Path and DEstination PAth
                $src_path = $_FILES['image']['tmp_name']; //Source Path
                $dest_path = "../images/item/".$image_name; //DEstination Path

                //Upload the image
                $upload = move_uploaded_file($src_path, $dest_path);

                /// CHeck whether the image is uploaded or not
                if($upload==false)
                {
                    //FAiled to Upload
                    $_SESSION['upload'] = "<div class='error'>Failed to Upload new Image.</div>";
                    //REdirect to Manage item 
                    header('location:'.SITEURL.'admin/manage-item.php');
                    //Stop the Process
                    die();
                }
                //3. Remove the image if new image is uploaded and current image exists
                //B. Remove current Image if Available
                if($current_image!="")
                {
                    //Current Image is Available
                    //REmove the image
                    $remove_path = "../images/item/".$current_image;

                    $remove = unlink($remove_path);

                    //Check whether the image is removed or not
                    if($remove==false)
                    {
                        //failed to remove current image
                        $_SESSION['remove-failed'] = "<div class='error'>Faile to remove current image.</div>";
                        //redirect to manage item
                        header('location:'.SITEURL.'admin/manage-item.php');
                        //stop the process
                        die();
                    }
                }
            }
            else
            {
                $image_name = $current_image; //Default Image when Image is Not Selected
            }
        }
        else
        {
            $image_name = $current_image; //Default Image when Button is not Clicked
        }

        // Update item in the database
        $sql3 = "UPDATE tbl_item SET 
            title = '$title',
            description = '$description',
            sub_description = '$sub_description',
            price = $price,
            image_name = '$image_name',
            category_id = '$category',
            featured = '$featured',
            active = '$active'
            WHERE itemId=$id";

        $res3 = mysqli_query($conn, $sql3);

        if($res3) {
            $_SESSION['add'] = "<div class='success'>Item updated Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-item.php');
            exit();
        } else {
            $_SESSION['error'] = "Failed to update item.";
            header('location:'.SITEURL.'admin/manage-item.php');
            exit();
        }
    }
?>

<div class="main-content">
    <div class="wrapper">
        <a href="manage-item.php" class="btn"><i class="fa-solid fa-arrow-left"></i></a>
        <br>
        <br>
        <h1>Update item</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea></td>
                </tr>
                <tr>
                    <td>Sub-Description: </td>
                    <td><textarea name="sub_description" cols="30" rows="5"><?php echo $sub_description; ?></textarea></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php if($current_image == "") {
                            echo "<div class='error'>Image not Available.</div>";
                        } else { ?>
                            <img src="<?php echo SITEURL; ?>images/item/<?php echo $current_image; ?>" width="150px">
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php 
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                $res = mysqli_query($conn, $sql);
                                if($res && mysqli_num_rows($res) > 0) {
                                    while($row = mysqli_fetch_assoc($res)) {
                                        $category_title = $row['title'];
                                        $category_id = $row['categoryId'];
                            ?>
                                <option <?php if($current_category == $category_id) {echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                            <?php 
                                    }
                                } else {
                                    echo "<option value='0'>Category Not Available.</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes 
                        <input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No"> No 
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> Yes 
                        <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No"> No 
                    </td>
                </tr>
                <tr>
                    <td><input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update item" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>
<?php
    }

    else {
        // Redirect to login page if user is not logged in
        $_SESSION ['login'] = "<div class='error'>Please login to access admin pannel.</div>";
        header('location:'.SITEURL.'admin/login.php');
        exit();
    }
