<?php
session_start();

session_destroy();

$_SESSION['loggedIn'] = null;

header('Location: ../login.php');
exit;