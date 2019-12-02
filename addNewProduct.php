<?php
/**
 * Created by PhpStorm.
 * User: samru
 * Date: 5/5/2019
 * Time: 6:36 PM
 */
?>

<html>
<body>
    <php
    if(isUserLoggedIn()) {
    <ul>
        <li><a href='myaccount.php'>Account Home</a></li>
    </ul>


        <?php require_once("config.php"); ?>

        <form name="createNewRecord" action="addNewProduct_DBINSERT.php" method="post" enctype="multipart/form-data">
            <!-- Table goes in the document BODY -->
            <table class="table-style-three" border="1px solid black" align="center">

                    <!-- Display CRUD options in TH format -->
                    <tr>
                        <th>Product Name</th>
                        <td><input type="text" required name="productname" value=""></td>
                    </tr>

                    <tr>
                        <th>Product Description</th>
                        <td><input type="text" name="productdescription" value=""></td>
                    </tr>


                    <tr>
                        <th>Category</th>
                        <td>
                            <select name="category" required>
                                <option value="1">Furniture</option>
                                <option value="2">Footwear</option>
                                <option value="3">Clothing</option>
                                <option value="4">Kitchenware</option>
                                <option value="5">Electronics</option>
                                <option value="5">Others</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th>Product Price</th>
                        <td><input type="number" name="productprice" value="" required></td>
                    </tr>


                    <tr>
                    <th>Sale Time</th>
                    <td>
                        <select name="saletime" required>
                            <option value="24">24 hrs</option>
                            <option value="48">48 hrs</option>
                        </select>
                    </td>
                    </tr>

                    <tr>
                        <th>Upload Image</th>
                        <td>
                            <input type="file" name="image" required/>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" align="center"><input type="submit" name="submit"></td>
                    </tr>



</table>

</form>
</body>
</html>


