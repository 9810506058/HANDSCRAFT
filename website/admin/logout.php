<?php

// Start the session
session_start();

// Echo a message to inform the user
echo "Logging you out. Please wait...";

// Unset specific session variables
unset($_SESSION["loggedin"]);
unset($_SESSION["user"]);


// Redirect the user back to the index page
header("location: login.php");
exit; // Ensure no further script execution after redirection
?>
