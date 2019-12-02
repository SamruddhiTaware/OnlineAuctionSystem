<ul>
    <li><a href='myaccount.php'>Account Home</a></li>
</ul>

<?php
require_once("config.php");

$thisUserID = $_GET['UserID'];
/*echo $thisProductID;*/

$deletedProduct  = deleteUserAdmin($thisUserID);
echo 'User deleted Successfully!!';
?>

