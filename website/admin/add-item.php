<?php


// Include menu file
include('partials/menu.php');
if($loggedin){

?>
<?php

// Check if form is submitted
if(isset($_POST['submit'])) {
    // Process form data and insert into database

    // Validate and sanitize form inputs
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $sub_description = mysqli_real_escape_string($conn, $_POST['sub_description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $featured = isset($_POST['featured']) ? mysqli_real_escape_string($conn, $_POST['featured']) : "No";
    $active = isset($_POST['active']) ? mysqli_real_escape_string($conn, $_POST['active']) : "No";

    // Check if an image is uploaded
    if(isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        if($image_name != "") {
            // Rename the image
            $ext = pathinfo($image_name, PATHINFO_EXTENSION);
            $image_name = "item-Name-" . rand(0000,9999) . "." . $ext;

            // Upload the image
            $src = $_FILES['image']['tmp_name'];
            $dst = "../images/item/" . $image_name;
            $upload = move_uploaded_file($src, $dst);

            if($upload == false) {
                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                header('location:'.SITEURL.'admin/add-item.php');
                exit(); // Terminate script execution
            }
        }
    } else {
        $image_name = ""; // Set default value
    }

    // Insert into database
    $sql2 = "INSERT INTO tbl_item (title, description, sub_description, price, image_name, category_id, featured, active)
             VALUES ('$title', '$description', '$sub_description', $price, '$image_name', $category, '$featured', '$active')";
    $res2 = mysqli_query($conn, $sql2);

    if($res2 == true) {
        $_SESSION['add'] = "<div class='success'>Item Added Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-item.php');
        exit(); // Terminate script execution
    } else {
        $_SESSION['add'] = "<div class='error'>Failed to Add Item.</div>";
        header('location:'.SITEURL.'admin/add-item.php');
        exit(); // Terminate script execution
    }
}
?>

<div class="main-content">
    <div class="wrapper">
        <a href="manage-item.php" class="btn"><i class="fa-solid fa-arrow-left"></i></a>
        <br><br>
        <h1>Add item</h1>
        <br><br>

        <?php 
        if(isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Title of the item"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5" placeholder="Description of the item."></textarea></td>
                </tr>
                <tr>
                    <td> Sub-Description: </td>
                    <td><textarea name="sub_description" cols="30" rows="5" placeholder="Sub Description of the item."></textarea></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                   
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php 
                                //Create PHP Code to display categories from Database
                                //1. CReate SQL to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                
                                //Executing qUery
                                $res = mysqli_query($conn, $sql);

                                //Count Rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                //IF count is greater than zero, we have categories else we donot have categories
                                if($count>0)
                                {
                                    //WE have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $id = $row['categoryId'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    //WE do not have category
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            

                                //2. Display on Drpopdown
                            ?>

                        </select>
                    </td>
                </tr>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add item" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php');
} else{
    // Handle case where $loggedin is false
    $_SESSION['login'] = "<div class='error'>Please login to access admin pannel.</div>";
    header('location:'.SITEURL.'admin/login.php');
}
 ?>
 


