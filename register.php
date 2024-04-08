<?php
include_once "./includes/connAct.php";

$fNameErr =
    $lNameErr =
    $emailErr =
    $usernameErr =
    $password1Err =
    $password2Err = "";

$registerErr = "";

$username =
    $password = "";

$valid = True;


//      Compare the method

if ($_SERVER['REQUEST_METHOD'] == "POST") {


    // first name

    if (empty ($_POST["fName"])) {               // presence check
        $fNameErr = "First Name is required";
        $valid = False;
    } elseif (!(strlen($_POST["fName"]) < 100)) {                // length check
        $fNameErr = "First Name length must be <100 ";
        $valid = False;
    }

    // last name

    if (empty ($_POST["lName"])) {               // presence check
        $lNameErr = "Last Name is required";
        $valid = False;
    } elseif (!(strlen($_POST["lName"]) < 100)) {                // length check
        $lNameErr = "Last Name length must be <100 ";
        $valid = False;
    }

    // email

    if (empty ($_POST["email"])) {               // presence check
        $emailErr = "Email is required";
        $valid = False;
    } elseif (strlen($_POST["email"]) > 100) {                // length check
        $emailErr = "Email length must be <100 ";
        $valid = False;
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {        // format check
        // invalid emailaddress
        $emailErr = "Email must be in valid format";
        $valid = False;
    }

    // username

    $postUser = $_POST["username"];

    if (empty ($postUser)) {            // presence check
        $usernameErr = "Username is required";
        $valid = False;
    } elseif (strlen($postUser) > 100) {             // length check
        $usernameErr = "Username length must be <100 ";
        $valid = False;
    } else {
        $sqlFindUsernames = "SELECT * FROM useraccounts WHERE username='$postUser'";
        $result = mysqli_query($conn, $sqlFindUsernames);
        if (mysqli_num_rows($result) > 0) {
            $usernameErr = "Username is already in use";
            $valid = False;
        }
        //  $findError = mysqli_error($conn);
    }

    if (empty ($_POST["password1"])) {           // presence check
        $password1Err = "Password is required";
        $valid = False;
    } elseif (strlen($_POST["password1"]) > 100) {            // upper length check
        $password1Err = "Password length must be < 100 ";
        $valid = False;
    } elseif (strlen($_POST["password1"]) < 8) {                // lower length check
        $password1Err = "Password length must be > 8 ";
        $valid = False;
    } elseif (!preg_match('/[\'^£!$%&*()}{@#~?><>,|=_+¬-]/', $_POST["password1"])) {        // special character check
        $password1Err = "Password must contain special character";
        $valid = False;
    }

    if (empty ($_POST["password2"])) {           // presence check
        $password2Err = "Confirmation is required";
        $valid = False;
    } elseif ($_POST["password1"] != $_POST["password2"]) {                 // double key
        $password2Err = "Passwords do not match ";
        $valid = False;
    }

    // REGISTER NEW ACCOUNT

    if ($valid) {
        $firstName = $_POST["fName"];
        $lastName = $_POST["lName"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password1"];

        $hashword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO useraccounts (username,password,email,isAdmin,firstName,lastName) VALUES ('$username', '$hashword', '$email', 0, '$firstName', '$lastName')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo '<script>
                    window.location.href = "../login.php"
                    alert("Registration Success. Please log in.")
                    </script>';
        } else {
            $registerErr = mysqli_error($conn);
        }
    }
}
function input_data($data)
{
    // remove spaces slashes and special symbols
    // this is for you, bobby tables

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
                    <h1>Create new account</h1>
                </div>

                <div class="center-div">
                    <h3 class="mono">Please enter your details below</h3>
                </div>

                <?php if (!($registerErr == "")) { ?>
                    <div class="center-div mono">
                        <h4 class="validation-div">
                            <?php echo ($registerErr) ?>
                        </h4>
                    </div>
                <?php } ?>

            </div>


            <form name="registerForm" id="registerForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                method="POST">
                <div class="column">

                    <div class="row margin" for="fName">
                        <div class="third left-div">
                            <label for="fName" class="mono">First Name:</label>
                        </div>
                        <div class="third center-div">
                            <input class="input" type="text" id="fName" name="fName" value="<?php if (isset ($_POST['fName'])) {
                                echo $_POST['fName'];
                            } ?>" />
                        </div>
                        <div class="third right-div">
                            <div class="validation-div">
                                <?php echo $fNameErr; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row margin" for="lName">
                        <div class="third left-div">
                            <label for="lName" class="mono">Last Name:</label>
                        </div>
                        <div class="third center-div">
                            <input class="input" type="text" id="lName" name="lName" value="<?php if (isset ($_POST['lName'])) {
                                echo $_POST['lName'];
                            } ?>" />
                        </div>
                        <div class="third right-div">
                            <div class="validation-div">
                                <?php echo $lNameErr; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row margin" for="email">
                        <div class="third left-div">
                            <label for="email" class="mono">Email:</label>
                        </div>
                        <div class="third center-div">
                            <input class="input" type="text" id="email" name="email" value="<?php if (isset ($_POST['email'])) {
                                echo $_POST['email'];
                            } ?>" />
                        </div>
                        <div class="third right-div">
                            <div class="validation-div">
                                <?php echo $emailErr; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row margin" for="username">
                        <div class="third left-div">
                            <label for="username" class="mono">Username:</label>
                        </div>
                        <div class="third center-div">
                            <input class="input" type="text" id="username" name="username" value="<?php if (isset ($_POST['username'])) {
                                echo $_POST['username'];
                            } ?>" />
                        </div>
                        <div class="third right-div">
                            <div class="validation-div">
                                <?php echo $usernameErr; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row margin" for="password1">
                        <div class="third left-div">
                            <label for="password1" class="mono">Password:</label>
                        </div>
                        <div class="third center-div">
                            <input class="input" type="password" id="password1" name="password1" value="<?php if (isset ($_POST['password1'])) {
                                echo $_POST['password1'];
                            } ?>" />
                        </div>
                        <div class="third right-div">
                            <div class="validation-div">
                                <?php echo $password1Err; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row margin" for="password2">
                        <div class="third left-div">
                            <label for="password2" class="mono">Confirm Password:</label>
                        </div>
                        <div class="third center-div">
                            <input class="input" type="password" id="password2" name="password2" value="<?php if (isset ($_POST['password2'])) {
                                echo $_POST['password2'];
                            } ?>" />
                        </div>
                        <div class="third right-div">
                            <div class="validation-div">
                                <?php echo $password2Err; ?>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="center-div">

                    <div class="row margin">
                        <input type="submit" id="btn" value="Register" name="submit">
                        <a href="/login.php">
                            <input type="button" id="btn2" value="Go to Login" name="goToLogin" />
                        </a>
                    </div>

                </div>

            </form>

        </div>
    </div>


</body>

</html>