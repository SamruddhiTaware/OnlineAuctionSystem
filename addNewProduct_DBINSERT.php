
  <php
    if(isUserLoggedIn()) {
    <ul>
        <li><a href='myaccount.php'>Account Home</a></li>
    </ul>



<?php
    print_r($_POST);
    require_once("config.php");

    // Assigning $_POST values to individual variables for reuse.
    $UID = $loggedInUser->user_id;
    $pname = $_POST['productname'];
    $pdescription = $_POST['productdescription'];
    $category = $_POST['category'];
    $productprice = $_POST['productprice'];
    $saletime = $_POST['saletime'];
    $image = $_FILES['image']['tmp_name'];
    $imageName = $_FILES['image']['name'];
    $productid = addNewProduct($UID,$pname, $pdescription,$category, $productprice,$saletime);
    if($productid != 0) {
        $imageFilePath = 'images/image' . $productid . $imageName;
        copy($image, $imageFilePath);

        updateImageRecord($productid, $imageFilePath);
    }

?>


