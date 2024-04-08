<?php
include("connAct.php");

$id=$_SESSION["userID"];
$username=$_SESSION["username"];

if($id==1){
    $_SESSION["deleteAccountErr"]="unable to delete superadmin";
    //echo("id is 1");
    header("location: ../profile.php");
    //alert admin and return user to profile page
} else {
    if($_POST["username"]==$username){
        //echo("username is username");
        unset($_SESSION["deleteAccountErr"]);

        $sql="DELETE FROM useraccounts WHERE userID=$id";
        $result=mysqli_query($conn,$sql);
        /*if($result){
        echo'<script> 
            window.location.href = "../index.php";
            alert("success")</script>';
        } else {
        $_SESSION["deleteAccountErr"]="unknown error";
        header("location: ../profile.php")
        }*/
        session_destroy();
    } else {
        $_SESSION["deleteAccountErr"]="username did not match";
        //echo("username is not username");
        header("location: ../profile.php");
    }
}


//else delete account with sql query (query,conn)
