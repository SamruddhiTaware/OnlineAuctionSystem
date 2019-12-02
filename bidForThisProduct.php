
<ul>
    <li><a href='myaccount.php'>Account Home</a></li>
</ul>



<?php

require_once("config.php");

// print_r is to display the contents of an array() in PHP.
//print_r($_POST);

// Assigning $_POST values to individual variables for reuse.
$uid = $loggedInUser->user_id;
$productid = $_POST['productid'];
$productname = $_POST['productname'];
$productdescription = $_POST['productdescription'];
$categoryid = $_POST['categoryid'];
$price = $_POST['price'];
$expire_Time = $_POST['expire_Time'];
$bidamount = $_POST['bidamount'];
$activeBidAmt = $_POST['activeBidAmt'];
$thisproductid = $_POST['productid'];


if($activeBidAmt == null){
    if($bidamount >= $price){
        $updatedRecord = insertBidRecord($uid, $productid, $bidamount, $productname);

        if($updatedRecord == 1){
        echo 'Your bid is successfully placed!!';}
        else {
            echo 'Your bid is not successfully placed!!';

        }
    }else
        echo 'The bid amount you enetered is less than Price!!';

}else{
    if($bidamount > $activeBidAmt){
        $updatedRecord = updateThisRecord($uid, $productid, $bidamount);
        if($updatedRecord == 1){
            echo 'Your bid is successfully placed!!';}
        else {
            echo 'Your bid is not successfully placed!!';
        }
    }else{
        echo 'The bid amount you enetered is less than or equal to active Bid Amount!!';
    }
}

/*if($bidamount > $price || $bidamount > $activeBidAmt) {
    if($activeBidAmt != null) {
        $updatedRecord = updateThisRecord($uid, $productid, $bidamount);
    }else{
        $updatedRecord = insertBidRecord($uid, $productid, $bidamount, $productname);
    }
    //display the result that was returned by the createNewUser function - in this case we usually get a 1 when the
    //update is completed successfully.
    echo $updatedRecord;
}else{
    echo 'The bid amount you enetered is less than or equal to active Bid Amount!!';
}*/


?>


