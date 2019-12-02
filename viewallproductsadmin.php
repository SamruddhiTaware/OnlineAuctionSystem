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
<table border="1px">
    <thead style="border-width: thick">
        <!-- display user details header  -->
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Product Image</th>
        <th>Product Category</th>
        <th>Product Description</th>
        <th>Product Price</th>
        <th>Current Bidding Amount</th>
        <th>Sale Time</th>

        <th>Delete</th>
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
                <td><a href="deleteproductadmin.php?productid=<?php print $displayRecords['productid']; ?>"> Delete </a>

                </td>


            </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>
