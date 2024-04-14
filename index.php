<?php
require_once "./Database-Backups/initialiseDatabase.php";

include_once "./includes/connAct.php";
include_once "./includes/nav.php";


?>





<html lang="en">

<!--head-->

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MathArt</title>

    <link rel="stylesheet" href="./styles/all.css">
    <link rel="stylesheet" href="./styles/index.css">

</head>



<!--body-->

<body>
    <div class="column">
        <div class="title center-div">
            <h1 class="text">Welcome To MathArt!</h1>
        </div>
        <div class="center-div">
            <?php if (!isset($_SESSION["firstName"])): ?>
                <div class="button-div">
                    <div class=side-padded>
                        <a href="login.php"><button class="button mono raise">Login</button></a>
                    </div>
                    <div class=side-padded>
                        <a href="register.php"><button class="button mono raise">Register</button></a>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION["firstName"])): ?>
                <h2>Welcome,
                    <?php echo $_SESSION['firstName']; ?>
                </h2>
            <?php endif; ?>
        </div>
        <div class="horizontal-section-container">
            <div class="horizontal-section">
                <div class="column grow center-div">
                    <div class="subtitle center-div">
                        <h2>Information</h2>
                    </div>
                    <div class="center-div text-div">
                        Welcome to mathart, have a look around! <br><br>
                    </div>
                </div>
            </div>
            <div class="horizontal-section">
                <div class="column">
                    <div class="subtitle">
                        <h2>About us</h2>
                    </div>
                    <div class="center-div grow">
                        <div class=column >
                            <h3> Get in Contact </h3>
                            <ul>
                                <li>Instagram: MathArtIG-UK</li>
                                <li>YouTube: MathArtYT </li>
                                <li>Twitter/X: MathArtX-UK </li>
                                <li>Email us: CustomerService@Mathart.com</li>
                                <li>Call our gallery: (+44) 07877 112 344</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>