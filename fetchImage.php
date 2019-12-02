<?php
// include database connection
require_once("config.php");

global $mysqli, $db_table_prefix;

$stmt = $mysqli->prepare(
    "select image from productdetails WHERE productid = ?"
);
$stmt->bind_param("s",$_GET['id']);
//print_r($stmt);
$result = $stmt->execute();
//print_r($result);
$stmt->bind_result($image);
while ($stmt->fetch()) {
    header("Content-type: image/png");
    print $image;
    exit;
}
$stmt->close();
return $result;
?>