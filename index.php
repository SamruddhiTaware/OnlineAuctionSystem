
<?php
require_once("config.php");
require_once("header.php");


//Prevent the user visiting the logged in page if he/she is already logged in
if(isUserLoggedIn()) {
    header("Location: myaccount.php");
    die();
}

?>

<body>
    <div id="left-nav">
        <?php include("left-nav.php");  //navigation menu bar. ?>
    </div> <!--- leftnav div ends -->


</body>
</html>
