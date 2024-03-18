<?php
include('partials/menu.php');



?>
<?php
if($loggedin){
    ?>
    <div class="main-content">
    <div class="wrapper">
        <h1>Main category</h1>
    </div>
</div>

<?php
include('partials/footer.php');


?>

<?php
}
else{
    // Handle case where $loggedin is false
    $_SESSION['login'] = "<div class='error'>Please login to access admin pannel.</div>";
    header('location:'.SITEURL.'admin/login.php');
}
