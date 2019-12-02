<?php
//Links for logged in user



if(isUserLoggedIn()) { ?>
    <ul>
    <?php
    if ($loggedInUser->role == "admin") { ?>
        <h3>Admin Console</h3>
        <li><a href='myaccount.php'>Account Home</a></li>
        <li><a href='viewallusersadmin.php'>View All Users</a></li>
        <li><a href='viewallproductsadmin.php'>View All Products</a></li>
        <li><a href='logout.php'>Logout</a></li>
    <?php } else {
        ?>
        <li><a href='myaccount.php'>Account Home</a></li>
        <li><a href='addNewProduct.php'>Add a New Product</a></li>
        <li><a href='deleteRecord.php'>Delete your Products</a></li>
        <li><a href='viewMyProducts.php'>View all My Products</a></li>
        <li><a href='viewallproducts.php'>View All Products</a></li>


        <li><a href='logout.php'>Logout</a></li>

    <?php } ?>
    </ul>
<?php }

//Links for users not logged in
else { ?>
    <ul>
        <li><a href='login.php'>Login</a></li>
        <li><a href='register.php'>Register</a></li>
    </ul>
<?php } ?>


