<?php
session_start();        # Starts the session - required before any session reference
date_default_timezone_set('UTC');       # Sets default timezone to override system defaults

# Sets database connection information
$serverName = "localhost";  # Server Name
$dbUsername = "root";       # Database Username
$dbPassword = "root";       # Database Password
$dbName = "mathartdb";      # Database Name

$conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);     # Creates connection to database under variable "$conn"
if ($conn->connect_error) {        # Catches any returned errors
    die ("Connection failed" . $conn->connect_error);    # Stops any running code, outputting the error message
}