<?php


$filepath = "Database-Backups\mathartdb_new.sql"; // set file to read


$servername = "localhost";                  // provide initial server details
$dbusername = $dbpassword = "root";         // along with database account logins

//  Create connection to localhost
$conn = mysqli_connect($servername, $dbusername, $dbpassword);

//  Check connection
if (!$conn) {                               //if the connection failed
    die ("Connection Failed: " . mysqli_connect_error());           // stops running of code, echoing connection failed 
}
echo '<script>console.log("Connected to SQL server"); </script>';   // if did not die, will continue, echoing connected to sql server

$DBCreate = "CREATE DATABASE mathartdb";        //        sets database creation variable
$createDB = mysqli_query($conn, $DBCreate);     //        runs database creation variable

if ($createDB) {            // if the data base creation query is successful, i.e if the database was not there previously, then runs following code

    mysqli_select_db($conn, "mathartdb");

    $filesize = filesize($filepath);    // get length of file to read

    $myfile = fopen($filepath, "r") or die ("Unable to open file!");
    $sql = fread($myfile, $filesize);
    fclose($myfile);


    if (mysqli_multi_query($conn, $sql)) {

        echo '<script>console.log("DB tables setup"); </script>';

    } else {
        $connError = mysqli_error($conn);
        echo '<script>console.log(' . $connError . '); </script>';

    }

} else {    //      else, if the database connection query was unsuccessful, i.e. if the database was already there, then runs following code
    echo '<script>console.log("DB tables were already setup"); </script>';
}