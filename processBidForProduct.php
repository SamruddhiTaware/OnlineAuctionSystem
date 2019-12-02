<?php

require_once("config.php");

$thisProductID = $_GET['productid'];
//echo $thisProductID;

$foundProduct = fetchThisProduct($thisProductID);
//print_r($foundProduct);
//echo "<pre>";

//echo "</pre>";
?>

<php
        if(isUserLoggedIn()) {
<ul>
    <li><a href='myaccount.php'>Account Home</a></li>
</ul>


<form name="getUserDetails" method="post" action="bidForThisProduct.php">
    <table class="table-style-three" border="1px solid black" align="center">
        <?php foreach ($foundProduct as $productdetails) { ?>
            <tr><td colspan="2" align="center"><img align="center" width="auto" height="20%" src=<?php print $productdetails['image']; ?>></td></tr>
            <tr><td>User ID :</td>      <td><input type="text" name="uid" value="<?php print $productdetails['uid']; ?>" readonly></td></tr>
            <tr><td>Product ID :</td>      <td><input type="text" name="productid" value="<?php print $productdetails['productid']; ?>" readonly></td></tr>
            <tr><td>Product Name :</td>      <td><input type="text" name="productname" value="<?php print $productdetails['productname']; ?>" readonly></td></tr>
            <tr><td>Product Description :</td>       <td><input type="text" name="productdescription" value="<?php print $productdetails['productdescription']; ?>" readonly></td></tr>
            <tr><td>Category ID :</td>      <td><input type="text" name="categoryid" value="<?php print $productdetails['categoryid']; ?>" readonly></td></tr>
            <tr><td>Price :</td>      <td><input type="text" name="price" value="<?php print $productdetails['price']; ?>" readonly></td></tr>
            <tr><td>Active Bid Amount :</td>      <td><input type="text" name="activeBidAmt" value="<?php print $productdetails['ActiveBidAmt']; ?>" readonly></td></tr>
            <tr><td>Sale time :</td>      <td><input type="text" name="expire_Time" value="<?php print $productdetails['expire_Time']; ?>" readonly></td></tr>
            <tr><td>Bid Amount :</td>      <td><input type="text" name="bidamount" value=""></td></tr>
            <tr><td colspan="2" align="center"><input type="submit" name="submit" value="Submit Bid"></td></tr>
        <?php } ?>
    </table>



</form>


</body>
</html>