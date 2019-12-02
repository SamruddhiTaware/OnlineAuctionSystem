<?php

require_once("config.php");
//Prevent the user visiting the logged in page if he/she is already logged in
if(isUserLoggedIn()) {
    header("Location: myaccount.php");
    die();
}

//print_r($_POST);

//Forms posted
if(!empty($_POST)) {
    $errors = array();
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $password = trim($_POST["password"]);
    $confirm_pass = trim($_POST["passwordc"]);

    if($username == "") {
        $errors[] = "enter valid username";
    }

    if($firstname == "") {
        $errors[] = "enter valid first name";
    }

    if($lastname == "") {
        $errors[] = "enter valid last name";
    }

    if($password == "" && $confirm_pass == "") {
        $errors[] = "enter password";
    } else if($password != $confirm_pass) {
        $errors[] = "password do not match";
    }

    //End data validation
    if(count($errors) == 0) {
        $user = createNewUser($username, $firstname, $lastname, $email, $password);
        print_r($user);
        if($user <> 1) {
            $errors[] = "registration error";
        }
    }
    if(count($errors) == 0) {
        $successes[] = "registration successful";
    }
}

require_once("header.php");
?>

<body>
    <div id="wrapper">
        <div id="content">
            <h2>Register</h2>
            <div id="left-nav">
                <?php include("left-nav.php"); ?>
            </div>

            <div id="main">
				<pre>
					<?php
                    print_r($errors);
                    print_r($successes);
                    ?>
				</pre>

                <div id="regbox">
                    <form name="newUser" action="<?php $_SERVER["PHP_SELF"]; ?>" method="post">

                        <p>
                            <label>User Name:</label>
                            <input type="text" name="username"/>
                        </p>

                        <p>
                            <label>First Name:</label>
                            <input type="text" name="firstname"/>
                        </p>

                        <p>
                            <label>LastName Name:</label>
                            <input type="text" name="lastname"/>
                        </p>

                        <p>
                            <label>Password:</label>
                            <input type="password" name="password"/>
                        </p>

                        <p>
                            <label>Confirm:</label>
                            <input type="password" name="passwordc"/>
                        </p>

                        <p>
                            <label>Email:</label>
                            <input type="text" name="email"/>
                        </p>

                        <p>
                            <label>&nbsp;</label><br>
                            <input type="submit" value="Register"/>
                        </p>
                    </form>
                </div>
            </div>
            <div id="bottom"></div>
        </div>
    </div>
</body>
</html>