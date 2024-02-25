<?php
include('../config/constants.php');

//destroy the session and redirect to the login page
session_destroy();
unset($_SESSION["username"]);

//regenerate the session id
session_regenerate_id(true);


header("Location: userlogin.php");
exit();
?>