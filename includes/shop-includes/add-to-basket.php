<?php
include ("../connAct.php");

date_default_timezone_set('Europe/London');

if (isset ($_SESSION["userID"])) {
    if (isset ($_POST["id-Add"])) {

        $productID = $_POST["id-Add"];

        $productCost = $_POST["cost-Add"];

        $userID = $_SESSION["userID"];

        $date = date("Y-m-d");

        // $price = $_POST["price"];
        // $subtotal = $quantity * $price;

        //  Attepts to get order ID of users current basket
        $sqlSelectOrder = "SELECT OrderID from orders WHERE UserID = '$userID' AND Processed = 'unprocessed'";
        $selectOrderResult = mysqli_query($conn, $sqlSelectOrder);


        //      If no current basket exists ( THIS SHOULD NOT HAPPEN )


        if (mysqli_num_rows($selectOrderResult) == 0) {

            //          Create a new order (basket) and set its id to current basket id variable

            $sqlAddOrder = "INSERT INTO orders (UserID, TotalCost, Date, Processed)
                        VALUES ('$userID', '0', '$date', 'unprocessed')";
            $addOrderResult = mysqli_query($conn, $sqlAddOrder);

            $sqlSelectOrderID = "SELECT OrderID from orders WHERE UserID = '$userID' AND Processed = 'unprocessed'";
            $selectOrderIDResult = mysqli_query($conn, $sqlSelectOrderID);
            $orderID = mysqli_fetch_assoc($selectOrderIDResult)["OrderID"];

            if ($addOrderResult) {
                echo ("success");
            } else {
                echo ("fail");
                die ("<br>" . $conn->error . " " . "<br>" . $conn->errno);
            }

        } else {

            //  If there is already a basket ( SHOULD HAPPEN EVERY TIME )

            //  Then add sale to that order
            $orderID = mysqli_fetch_assoc($selectOrderResult)["OrderID"];

        }

        //          Add sale to corresponding order 

        // CHECK ITEM IS NOT ALREADY IN BASKET

        // Sql query checks all sales in the current basket which have the same product ID as the user input
        $sqlCopyCheck = "SELECT productID FROM sales WHERE productID = '$productID' AND OrderID = '$orderID'";
        $copyCheckResult = mysqli_query($conn, $sqlCopyCheck);

        //  If the copy check query found the item in their basket already 

        if (mysqli_num_rows($copyCheckResult) > 0) {

            //  Then send the user back to the shopping basket with a message letting them know the item is already in their basket
            header("location: /shop.php?msg=This item is already in your basket, please update the quantity here.#basket-popup");

        } else {

            //  If no matches were found, carry on as usual

            //  Set and execute the add-sale query
            $sqlAddSale = "INSERT INTO sales (OrderID, ProductID, Quantity, Subtotal)
                    VALUES ('$orderID','$productID','1','$productCost')";
            $addSaleResult = mysqli_query($conn, $sqlAddSale);

            // If the query worked

            if ($addSaleResult) {

                //  Send user back to basket with success message
                header("location: /shop.php?msg=Item Successfully Added #basket-popup");

            } else {
                $error = mysqli_error($conn);
                //  Send user back to basket with Error message
                header("location: /shop.php?err=Error Adding Item:$error#basket-popup");

            }
        }
    }
} else {
    header("location:/shop.php?err=You must be signed in to add items to a basket#basket-popup");
}