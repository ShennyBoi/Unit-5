<?php
include_once "./includes/connAct.php";


// Initialise Error messages

$usernameErr =
    $passwordErr =
    $loginErr = "";

// Initialise entry field variables

$username =
    $password = "";

$valid = True;
// Compare the method
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Presence Checks:

    if (empty ($_POST["user"])) {

        $usernameErr = "Name is required";
        $valid = False;
    }
    if (empty ($_POST["pass"])) {
        $passwordErr = "Password is required";
        $valid = False;
    }

    // Check Log In

    if ($valid) {
        $username = $_POST["user"];
        $password = $_POST["pass"];

        $hashword = password_hash($password, PASSWORD_DEFAULT);

        $sqlSelect = "SELECT * FROM useraccounts ";
        $result = mysqli_query($conn, $sqlSelect);

        $_SESSION["loggedIn"] = False;

        while ($row = mysqli_fetch_assoc($result)) {
            if ((($row["username"]) == $username) and (password_verify($password, $row["password"]))) {
                $_SESSION["loggedIn"] = True;

                $_SESSION["userID"] = $row['userID'];
                $_SESSION["username"] = $row["username"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["isAdmin"] = $row["isAdmin"];
                $_SESSION["firstName"] = $row["firstName"];
                $_SESSION["lastName"] = $row["lastName"];

                break;
            }
        }
        if ($_SESSION["loggedIn"] == True) {
            header("location:../profile.php");
        } else {
            $loginErr = "Username or Password is incorrect";
        }
        /* improve response on login sucess/fail AND REGISTER */
    }
}
function input_data($data)
{
    // Remove spaces slashes and special symbols
    // This is for you, bobby tables

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

include_once "./includes/nav.php";
?>

<html lang="en">

<!--head-->

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="./styles/all.css">
    <link rel="stylesheet" href="./styles/loginandregister.css">

</head>


<!--body-->

<body>

    <div class="center-div">
        <div id="form">

            <div class="column">
                <div class="center-div">
                    <h1>Login</h1>
                </div>

                <div class="center-div mono">
                    <h3>Login to an existing account</h3>
                </div>

                <?php if (!($loginErr == "")) {  // If login error is set ?>
                    <div class="center-div mono">
                        <h4 class="validation-div">
                            <?php echo ($loginErr) //  Echo login error ?>
                        </h4>
                    </div>
                <?php } ?>

            </div>
                    <!-- Login form -->
            <form name="loginForm" id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                method="POST">
                <div class="column">

                    <div class="row margin" for="username">
                        <div class="third left-div">
                            <label for="username" class="mono">Username:</label>
                        </div>
                        <div class="third center-div">
                            <input class="input" type="text" id="user" name="user" value="<?php if (isset ($_POST['user'])) {
                                echo $_POST['user'];
                            } ?>" />
                        </div>
                        <div class="third right-div">
                            <div class="validation-div">
                                <?php echo $usernameErr; //  Echo login error  ?>
                            </div>
                        </div>
                    </div>

                    <div class="row margin" for="password">
                        <div class="third left-div">
                            <label for="password" class="mono">Password:</label>
                        </div>
                        <div class="third center-div">
                            <input class="input" type="password" id="pass" name="pass" value="<?php if (isset ($_POST['pass'])) {
                                echo $_POST['pass'];
                            } ?>" />
                        </div>
                        <div class="third right-div">
                            <div class="validation-div">
                                <?php echo $passwordErr; //  Echo login error  ?>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="center-div margin">
                    <div class="row margin">
                        <input type="submit" id="btn" value="Login" name="submit" />
                        <a href="/register.php">
                            <input type="button" id="btn2" value="Go to Register" name="goToRegister" />
                        </a>
                    </div>
                </div>

            </form>

        </div>
    </div>
</body>

</html>