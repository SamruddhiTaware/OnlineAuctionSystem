<ul>
    <li><a href='myaccount.php'>Account Home</a></li>
</ul>

<?php
require_once("config.php");

$thisProductID = $_GET['productid'];
/*echo $thisProductID;*/

$deletedProduct  = deleteProductAdmin($thisProductID);
echo 'Product deleted Successfully!!';
?>

