<?php
require_once("config.php");
require_once("header.php");
?>

<body>
    <div id="wrapper">
        <div id="content">
            <h2>My Account</h2>
            <div id="left-nav">
                <?php include("left-nav.php"); ?>
            </div>

            <div id="main">
                <br><br><br>
                Hey, <?php print $loggedInUser->first_name . " " . $loggedInUser->last_name; ?>
                This is an example page designed to demonstrate user authentication examples.
                Just so you know, you registered this account on <?php print date("M d, Y", $loggedInUser->member_since); ?>.
            </div>

            <div id="bottom"></div>
        </div>
    </div>
</body>
</html>