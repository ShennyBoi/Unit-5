<?php
include("../connAct.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $orderID = $_POST["orderID"];

    // to empty the users basket
    //  -   find all the sales with the associated OrderID
    //  -   remove said sales
    //  -   go back to shop page
    //  -   using URL 

    // set and execute query to remove sales
    $sqlRemoveSales = "DELETE FROM sales WHERE OrderID = '$orderID';";
    $result = mysqli_query($conn, $sqlRemoveSales);

    //  If sql query executed successfully
    if ($result) {

        //send user back to shop basket popup, while sending success message
        header("location: /shop.php?msg=Basket Successfully Emptied#basket-popup");
    }

    //  If not
    else {

        //send user back to shop basket popup, while sending ERROR message
        header("location: /shop.php?err=Error Emptying Basket#basket-popup");
    }


}