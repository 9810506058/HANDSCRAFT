<?php
include('../config/constants.php');

//destroy the session and redirect to the login page
session_destroy();
//regenerate the session id
session_regenerate_id(true);


header("Location: users.php");
exit();
?>