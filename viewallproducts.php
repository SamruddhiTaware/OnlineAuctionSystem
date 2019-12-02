<?php
?>

<php
        if(isUserLoggedIn()) {
<ul>
    <li><a href='myaccount.php'>Account Home</a></li>
</ul>


<?php require_once("config.php");

$allrecords = fetchAllProducts($loggedInUser->user_id);
?>

<!-- Table goes in the document BODY -->
<table border="1px" style="margin-top: 3%">
    <thead style="border-width: thin">
    <!-- display user details header  -->
    <th>Product ID</th>
    <th>Product Name</th>
    <th>Product Image</th>
    <th>Product Category</th>
    <th>Product Description</th>
    <th>Product Price</th>
    <th>Current Bidding Amount</th>
    <th>Sale Time</th>
    <th>Bidding</th>
    </thead>
    <tbody>
    <?php

    foreach($allrecords as $displayRecords) { ?>
        <tr>
            <td><?php print $displayRecords['productid']; ?></td>
            <td><?php print $displayRecords['productname']; ?></td>
            <td><img class="image1" width="auto" height="8%" src=<?php print $displayRecords['image'];?> ></td>
            <td><?php print $displayRecords['category']; ?></td>
            <td><?php print $displayRecords['productdescription']; ?></td>
            <td><?php print $displayRecords['price']; ?></td>
            <td><?php print $displayRecords['BidAmount']; ?></td>
            <td><?php print $displayRecords['saletime']; ?></td>
            <td align="center">
            <?php if ($displayRecords['active'] == 0){
                echo "NA";
            } else { ?>
                <a href="processBidForProduct.php?productid=<?php print $displayRecords['productid']; ?>"> Enter Bid Amount </a>
            <?php } ?>
            </td>


        </tr>
    <?php } ?>
    </tbody>
</table>

</body>
</html>
