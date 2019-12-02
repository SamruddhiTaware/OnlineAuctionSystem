
<ul>
    <li><a href='myaccount.php'>Account Home</a></li>
</ul>

<?php
require_once("config.php");

$thisProductID = $_GET['productid'];
/*echo $thisProductID;*/

$deletedRecord  = updateStatus($thisProductID,0);
echo 'Record flag set to 0 successfully!!';
?>

