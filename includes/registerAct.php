<?php
include("connAct.php");
if (isset($_POST["submit"])) {
    $firstName = $_POST["fName"];
    $lastName = $_POST["lName"];
    $email = $_POST["email"];
    $username = $_POST["user"];
    $password = $_POST["pass1"];

    $hashword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO useraccounts (username,password,email,isAdmin,firstName,lastName) VALUES ('$username', '$hashword', '$email', 0, '$firstName', '$lastName')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo '<script>
                window.location.href = "../login.php";
                alert("Registration Success. Please log in.")
                </script>';
    } else {
        echo mysqli_error($conn);
        echo '<script>
                window.location.href = "../register.php";
                alert("Registration failed (womp womp)")
                </script>';
    }
}

