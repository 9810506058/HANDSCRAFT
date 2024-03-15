<?php
//delete the category and image

include('../config/constant.php');

if(isset($_GET['id']) AND isset($_GET['image_name'])){

$id=$_GET['id'];
$image_name=$_GET['image_name'];

//remove the physical image file
if($image_name !=""){
    $path="../images/item/".$image_name;
    $remove=unlink($path);
if($remove==false ){
    $_SESSION['remove']="<div class='error'>Failed to remove item.</div>";
    header('location:'.SITEURL.'admin/manage-category.php');
    die();

}

}
//delete from database
$sql = "DELETE FROM tbl_item WHERE itemId = $id";
$res = mysqli_query($conn, $sql);
if ($res) {
    //redirect
    $_SESSION['delete'] = "<div class='success'> item deleted successfully.</div>";
    header('location:'.SITEURL.'admin/manage-item.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete item</div>";
        header('location:'.SITEURL.'admin/manage-item.php');
        }
    }


else{
    //redirect to manage category page
    header('location:'.SITEURL.'admin/manage-item.php');

}


?>