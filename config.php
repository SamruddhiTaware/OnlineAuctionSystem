<?php

ob_start();

if (!ini_get('date.timezone')) {
    date_default_timezone_set('GMT');
}

require_once("db-settings.php"); //Require DB connection
require_once("functions.php"); // database and other functions are written in this file
require_once("class.user.php"); // Include loggedInUser class for login

session_start();

//loggedInUser can be used globally if constructed
if(isset($_SESSION["ThisUser"]) && is_object($_SESSION["ThisUser"]))
{
    $loggedInUser = $_SESSION["ThisUser"];
}
/*echo "<pre>";
print_r($_SESSION);
echo "</pre>";*/
?>



