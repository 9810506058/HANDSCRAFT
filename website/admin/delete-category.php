<?php
//delete the category and image

include('../config/constant.php');

if(isset($_GET['id']) AND isset($_GET['image_name'])){

$id=$_GET['id'];
$image_name=$_GET['image_name'];

//remove the physical image file
if($image_name !=""){
    $path="../images/category/".$image_name;
    $remove=unlink($path);
if($remove==false ){
    $_SESSION['remove']="<div class='error'>Failed to remove category.</div>";
    header('location:'.SITEURL.'admin/manage-category.php');
    die();

}

}
//delete from database
$sql = "DELETE FROM tbl_category WHERE categoryId = $id";
$res = mysqli_query($conn, $sql);
if ($res) {
    //redirect
    $_SESSION['delete'] = "<div class='success'>Category deleted successfully.</div>";
    header('location:'.SITEURL.'admin/manage-category.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
        }
    }


else{
    //redirect to manage category page
    header('location:'.SITEURL.'admin/manage-category.php');

}


?>