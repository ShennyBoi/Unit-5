<?php
include_once "./includes/connAct.php";
include_once "./includes/nav.php";
?>

<html lang="en">

<!--head-->

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <link rel="stylesheet" href="./styles/all.css">
    <link rel="stylesheet" href="./styles/profile.css">

</head>

<!--body-->

<body>
    <?php

    if (isset($_SESSION["deleteAccountErr"])) {
        //echo($_SESSION["deleteAccountErr"]);
        //echo("<br>we are here ");
        echo "<script>document.getElementById('popup1-link').click();</script>";
        //header("location: ./profile.php#popup1"); use javascript click to open #popup1
    }
    ?>
    <div class="total-body-wrapper">
        <div class="body-heading-div">
            <div class="center-div">
                <h1>My Profile</h1>
            </div>
        </div>
        <div class="body-content-div">
            <div class="horizontal-section-container">
                <div class="horizontal-section">
                    <div class="column">
                        <h1> Your Details </h1> <!-- if user is logged in, display their details -->
                        <?php if (isset($_SESSION["firstName"])) { ?>
                            <ul>
                                <li>UserID:
                                    <?php echo ($_SESSION["userID"]) ?>
                                </li>
                                <li>UserName:
                                    <?php echo ($_SESSION["username"]) ?>
                                </li>
                                <li>Email:
                                    <?php echo ($_SESSION["email"]) ?>
                                </li>
                                <li>IsAdmin?
                                    <?php echo ($_SESSION["isAdmin"]) ?>
                                </li>
                                <li>FirstName:
                                    <?php echo ($_SESSION["firstName"]) ?>
                                </li>
                                <li>LastName:
                                    <?php echo ($_SESSION["lastName"]) ?>
                                </li>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
                <div class="horizontal-section">
                    <div class="column">
                        <h1>
                            <?php
                            if (isset($_SESSION["firstName"])) {  // If user is logged in, welcome them
                                echo ("Welcome, " . $_SESSION["firstName"] . "!");
                            } else {
                                echo ("Welcome, Guest user.");
                            }
                            ?>
                        </h1>
                        <?php
                        if (!isset($_SESSION["firstName"])):    //  If user is not logged in, tell them to login
                            ?>
                            Please login or create an account to view more information!
                        <?php endif; ?>
                    </div>
                </div>
                <div class="horizontal-section">
                    <div class="column center-div">
                        <div class="grow center-div">
                            <h1> Functionality </h1>
                        </div>
                        <div class="center-div">
                            <?php if (isset($_SESSION["firstName"])) { //If user logged in, display logout and delete account buttons ?>
                                <div class="row">
                                    <div class="side-padded">
                                        <a href="./includes/logoutAct.php">
                                            <button class="button mono raise">Log Out</button>
                                        </a>
                                    </div>
                                    <div class="side-padded">
                                        <a href="#popup1"> <!--./includes/deleteAccountAct.php-->
                                            <button class="button mono raise " id="popup1-link">Delete Account</button>
                                        </a>
                                    </div>
                                    <!-- POPUP START -->
                                    <div id="popup1" class="overlay">
                                        <div class="popup">
                                            <h2>Are you sure?</h2>
                                            <a class="close" href="#">&times;</a>
                                            <div class="content">
                                                <form method="POST" action="./includes/deleteAccountAct.php">
                                                    <h4 class="mono">
                                                        Type your username to commence acount deletion
                                                    </h4>
                                                    <input class="text" name="username" />
                                                    <button type="submit" class="submit">confirm</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- POPUP END   -->
                                </div>
                            <?php } else { //  If user not logged in, display login and register buttons    ?>
                                <div class="row">
                                    <div class="side-padded">
                                        <a href="login.php">
                                            <button class="button mono raise log-out">Login</button>
                                        </a>
                                    </div>
                                    <div class="side-padded">
                                        <a href="register.php">
                                            <button class="button mono raise delete-account">Register</button>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>