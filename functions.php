<?php

//$password = md5("Smith");
//echo $password."<br><br>";
//$code = md5(uniqid(rand(), TRUE));
//echo $code;

//Generate a unique code
function getUniqueCode($length = "") {
    $code = md5(uniqid(rand(), TRUE));
    if ($length != "") {
        return substr($code, 0, $length);
    } else {
        return $code;
    }
}

//$plainText = getUniqueCode(15);
//echo $plainText;


function generateHash($plainText, $salt = NULL) {
    if ($salt === NULL) {
        $salt = substr(md5(uniqid(rand(), TRUE)), 0, 25);
    } else {
        $salt = substr($salt, 0, 25);
    }
    return $salt . sha1($salt . $plainText);
}


//echo $newpassword;
//$compare = generateHash($_POST['password'], $newpassword);
//echo $compare;

function createNewUser($username, $firstname, $lastname, $email, $password) {
    global $mysqli, $db_table_prefix;
    //Generate A random userid

    $character_array = array_merge(range("a", "z"), range(0, 9));
    $rand_string = "";
    for ($i = 0; $i < 6; $i++) {
        $rand_string .= $character_array[rand(
            0, (count($character_array) - 1)
        )];
    }
    //echo $rand_string;
    //echo $username;
    //echo $firstname;
    //echo $lastname;
    //echo $email;
    //echo $password;

    $newpassword = generateHash($password);

    //echo $newpassword;

    $stmt = $mysqli->prepare(
        "INSERT INTO " . $db_table_prefix . "UserDetails (
		UserID,
		UserName,
		FirstName,
		LastName,
		Email,
		Password,
		MemberSince,
		Active
		)
		VALUES (
		'" . $rand_string . "',
		?,
		?,
		?,
		?,
		?,
        '" . time() . "',
        1
		)"
    );
    $stmt->bind_param("sssss", $username, $firstname, $lastname, $email, $newpassword);
    //print_r($stmt);
    $result = $stmt->execute();
    //print_r($result);
    $stmt->close();
    return $result;

}

//Retrieve complete user information by username
function fetchUserDetails($username) {
    global $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("SELECT
		UserID,
		UserName,
		FirstName,
		LastName,
		Email,
		Password,
		MemberSince,
		Active,
		Role
		FROM ".$db_table_prefix."UserDetails
		WHERE
		UserName = ?
		LIMIT 1");
    $stmt->bind_param("s", $username);

    $stmt->execute();
    $stmt->bind_result($UserID, $UserName, $FirstName, $LastName, $Email, $Password, $MemberSince, $Active,$Role);
    while ($stmt->fetch()){
        $row = array('UserID' => $UserID,
            'UserName' => $UserName,
            'FirstName' => $FirstName,
            'LastName' => $LastName,
            'Email' => $Email,
            'Password' => $Password,
            'MemberSince' => $MemberSince,
            'Active' => $Active,
            'Role' => $Role);
    }
    $stmt->close();
    return ($row);
}

//Check if a user is logged in
function isUserLoggedIn() {
    global $loggedInUser,$mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("SELECT
		UserID,
		Password
		FROM ".$db_table_prefix."UserDetails
		WHERE
		UserID = ?
		AND
		Password = ?
		AND
		active = 1
		LIMIT 1");
    $stmt->bind_param("is", $loggedInUser->user_id, $loggedInUser->hash_pw);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if($loggedInUser == NULL)
    {
        return false;
    }
    else
    {
        if ($num_returns > 0)
        {
            return true;
        }
        else
        {
            destroySession("ThisUser");
            return false;
        }
    }
}


//Destroys a session as part of logout
function destroySession($name) {
    if(isset($_SESSION[$name]))
    {
        $_SESSION[$name] = NULL;
        unset($_SESSION[$name]);
    }
}

//Retrieve complete user information of all users
function fetchAllUsers() {

    global $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("SELECT
		UserID,
		UserName,
		FirstName,
		LastName,
		Email,
		Password,
		MemberSince,
		Active
		FROM ".$db_table_prefix."UserDetails
		");

    $stmt->execute();
    $stmt->bind_result($UserID, $UserName, $FirstName, $LastName, $Email, $Password, $MemberSince, $Active);
    while ($stmt->fetch()){
        $row[] = array('UserID' => $UserID,
            'UserName' => $UserName,
            'FirstName' => $FirstName,
            'LastName' => $LastName,
            'Email' => $Email,
            'Password' => $Password,
            'MemberSince' => $MemberSince,
            'Active' => $Active);
    }
    $stmt->close();
    return ($row);
}

//add product
function addNewProduct($UID, $productname, $productdescription, $category, $productprice, $saletime) {
    global $mysqli, $db_table_prefix;
    $expireTime = 0;
    if($saletime == '24'){
        $expireTime = 86400 + time();
    }else{
        $expireTime = 172800 + time();
    }
    $stmt = $mysqli->prepare(
        "INSERT INTO " . $db_table_prefix . "ProductDetails (
		UID,
		ProductName,
		ProductDescription,
		CategoryID,
		Price,
		Curr_time,
		Expiration_time,
		Active
		)
		VALUES (
		?,
		?,
		?,
		?,
		?,
        '" . time() . "',
        '" . $expireTime. "',
        1
		)"
    );
    $stmt->bind_param("sssss", $UID, $productname, $productdescription, $category, $productprice);
    //print_r($stmt);
    $result = $stmt->execute();
    //print_r($result);
    $stmt->close();
    return mysqli_insert_id($mysqli);

}

//fetch all products
function fetchAllProducts($uid)
{
    global $mysqli;
    $stmt = $mysqli->prepare(
        "SELECT
		p.productid,
		p.ProductName,
		p.ProductDescription,
		c.CategoryName,
		p.Price,
		FROM_UNIXTIME(Expiration_time),
		p.active,
        b.BidAmount,
        p.image

		FROM productdetails p left join bid b on p.productid = b.productid join category c on p.categoryID = c.categoryID 
		WHERE p.uid <> ? and UNIX_TIMESTAMP() < p.Expiration_time"
    );
    $stmt->bind_param("s", $uid);
    $stmt->execute();
    $stmt->bind_result(
        $productid,
        $ProductName,
        $ProductDescription,
        $CategoryID,
        $Price,
        $Curr_Time,
        $active,
        $BidAmount,
        $image
    );

    while ($stmt->fetch()) {

        $row[] = array(
            'productid' => $productid,
            'productname' => $ProductName,
            'productdescription' => $ProductDescription,
            'category' => $CategoryID,
            'price' => $Price,
            'saletime' => $Curr_Time,
            'active' => $active,
            'BidAmount' => $BidAmount,
            'image' => $image
        );
    }
    $stmt->close();
    return ($row);
}

//fetch particular product
function fetchThisProduct($productid)
{
    global $mysqli;
    $stmt = $mysqli->prepare(
        "
    SELECT
    p.uid,
        p.productid,
		p.ProductName,
		p.ProductDescription,
		c.CategoryName,
		p.Price,
		FROM_UNIXTIME(p.Expiration_time),
		p.active,
		b.BidAmount,
		p.image

    FROM productdetails p left join bid b on p.productid = b.productid join category c on p.categoryID = c.categoryID
    WHERE 
    p.productid = ?
    LIMIT 1"
    );
    $stmt->bind_param("s", $productid);
    $stmt->execute();
    $stmt->bind_result($uid,$productid, $ProductName, $ProductDescription, $CategoryID, $Price, $expire_Time, $active, $ActiveBidAmt, $image);
    $stmt->execute();
    while ($stmt->fetch()) {
        $row1[] = array(
            'uid' => $uid,
            'productid' => $productid,
            'productname' => $ProductName,
            'productdescription' => $ProductDescription,
            'categoryid' => $CategoryID,
            'price' => $Price,
            'expire_Time' => $expire_Time,
            'active' => $active,
            'ActiveBidAmt' => $ActiveBidAmt,
            'image' => $image
        );
    }
    $stmt->close();
    return ($row1);
}


function updateThisRecord($uid,$productid,$bidamount)
{
    global $mysqli, $db_table_prefix;

    $stmt = $mysqli->prepare(
        "UPDATE " . $db_table_prefix . "Bid SET
		UID = ?,
		BidAmount = ?,
		timestamp = '" . time() . "'
		WHERE productid = ?"
    );
    $stmt->bind_param("sss", $uid, $bidamount, $productid);
    //print_r($stmt);
    $result = $stmt->execute();
    //print_r($result);
    $stmt->close();
    return $result;

}

//insert bid amount for the first time
function insertBidRecord($uid,$productid,$bidamount, $productname)
{
    global $mysqli, $db_table_prefix;

    $stmt = $mysqli->prepare(
        "INSERT INTO " . $db_table_prefix . "Bid (
		UID,
		productid,
		productname,
		BidAmount,
		timestamp)
		VALUES (
		?,
		?,
		?,
		?,
		'" . time() . "'
		)"
    );
    $stmt->bind_param("ssss", $uid, $productid, $productname, $bidamount);
    //print_r($stmt);
    $result = $stmt->execute();
    //print_r($result);
    $stmt->close();
    return $result;

}

// update image location for productid
function updateImageRecord($productid,$image)
{
    global $mysqli, $db_table_prefix;

    $stmt = $mysqli->prepare(
        "UPDATE " . $db_table_prefix . "Productdetails SET
		image = ?
		WHERE productid = ?"
    );
    $stmt->bind_param("ss", $image, $productid);
    //print_r($stmt);
    $result = $stmt->execute();
    //print_r($result);
    $stmt->close();
    return $result;

}

//fetch all my products
function fetchAllMyProducts($uid)
{
    global $mysqli;
    $stmt = $mysqli->prepare(
        "SELECT
		p.productid,
		p.ProductName,
		p.ProductDescription,
		c.CategoryName,
		p.Price,
		FROM_UNIXTIME(Expiration_time),
		p.active,
        b.BidAmount,
        p.image,
        u.firstname,
        u.lastname

		FROM productdetails p left join bid b on p.productid = b.productid left join userdetails u on u.userid = b.uid join category c on p.categoryID = c.categoryID 
		WHERE p.uid = ? and UNIX_TIMESTAMP() < p.Expiration_time"
    );
    $stmt->bind_param("s", $uid);
    $stmt->execute();
    $stmt->bind_result(
        $productid,
        $ProductName,
        $ProductDescription,
        $CategoryID,
        $Price,
        $Curr_Time,
        $active,
        $BidAmount,
        $image,
        $firstname,
        $lastname
    );

    while ($stmt->fetch()) {

        $row[] = array(
            'productid' => $productid,
            'productname' => $ProductName,
            'productdescription' => $ProductDescription,
            'category' => $CategoryID,
            'price' => $Price,
            'saletime' => $Curr_Time,
            'active' => $active,
            'BidAmount' => $BidAmount,
            'image' => $image,
            'winner' => $firstname." ".$lastname
        );
    }
    $stmt->close();
    return ($row);
}

//fetch completed auctions
function fetchAllMyPastProducts($uid)
{
    global $mysqli;
    $stmt = $mysqli->prepare(
        "SELECT
		p.productid,
		p.ProductName,
		p.ProductDescription,
		c.CategoryName,
		p.Price,
		FROM_UNIXTIME(Expiration_time),
		p.active,
        b.BidAmount,
        p.image,
        u.firstname,
        u.lastname

		FROM productdetails p left join bid b on p.productid = b.productid left join userdetails u on u.userid = b.uid join category c on p.categoryID = c.categoryID 
		WHERE p.uid = ? and UNIX_TIMESTAMP() > p.Expiration_time"
    );
    $stmt->bind_param("s", $uid);
    $stmt->execute();
    $stmt->bind_result(
        $productid,
        $ProductName,
        $ProductDescription,
        $CategoryID,
        $Price,
        $Curr_Time,
        $active,
        $BidAmount,
        $image,
        $firstname,
        $lastname
    );

    while ($stmt->fetch()) {

        $row[] = array(
            'productid' => $productid,
            'productname' => $ProductName,
            'productdescription' => $ProductDescription,
            'category' => $CategoryID,
            'price' => $Price,
            'saletime' => $Curr_Time,
            'active' => $active,
            'BidAmount' => $BidAmount,
            'image' => $image,
            'winner' => $firstname." ".$lastname
        );
    }
    $stmt->close();
    return ($row);
}

//delete product admin
function deleteProductAdmin($productid)
{
    global $mysqli;
    $stmt = $mysqli->prepare(
        "delete from productdetails where productid= ?"

    );
    $stmt->bind_param("s", $productid);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}

//delete user admin
function deleteUserAdmin($user_id)
{
    global $mysqli;
    $stmt = $mysqli->prepare(
        "delete from userdetails where UserID = ?"

    );
    $stmt->bind_param("s", $user_id);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}

//update status (delete product -> flag status set to 0)
    function updateStatus($productid, $status)
    {
        global $mysqli;
        $stmt = $mysqli->prepare(
            "UPDATE productdetails
                SET
                active = ?
                WHERE
                productid = ?"
        );
        $stmt->bind_param("ss",$status, $productid);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }


