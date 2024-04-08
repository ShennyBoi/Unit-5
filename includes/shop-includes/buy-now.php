<?php
include("../connAct.php");

if (isset($_SESSION["userID"])) {
    if (isset($_POST["id-Buy"])) {

        // sqlNewSale set post variables
        $productID = $_POST["id-Buy"];
        $productCost = $_POST["cost-Buy"];

        #echo ($id);

        $userID = $_SESSION["userID"];
        $date = date("Y-m-d");

        echo "user id is " . $userID . "<br>";

        //  create new processed order
        $sqlNewOrder = "INSERT INTO orders (UserID, TotalCost, Date, Processed)
                        VALUES ('$userID', '0', '$date', 'processed')";
        $addOrderResult = mysqli_query($conn, $sqlNewOrder);
        if ($addOrderResult) {
            echo "order add successful <br>";
            header("location:/shop.php?msg=Item purchace was successful#basket-popup");

        } else {
            echo "order add fail <br>";
            echo mysqli_error($conn) . "<br>";
        }
        //  get the new order id  from the new order
        $sqlSelectOrderID = "SELECT OrderID from orders WHERE UserID = '$userID' AND Processed = 'processed'";
        $selectOrderIDResult = mysqli_query($conn, $sqlSelectOrderID);
        $orderID = mysqli_fetch_assoc($selectOrderIDResult)["OrderID"];

        //  create single sale in this order with new order id
        $sqlNewSale = "INSERT INTO sales (OrderID, ProductID, Quantity, Subtotal)
        VALUES ('$orderID','$productID','1','$productCost')";
        $addSaleResult = mysqli_query($conn, $sqlNewSale);

        //  what this page does
        echo ("
        
        • I need to add a '' credit card check '' <br>
        <br>
        <a href = '/shop.php'> use this link to go back to the shop </a> <br>
        <a href = '/shop.php#basket-popup'> use this link to go back to the basket </a>
        ");

        // ALTER TABLE orders ADD INDEX(userID);
        // DUPLICATE user id field
        // fix then do basket checkout

    }
} else {
    header("location:/shop.php?err=You must be signed in to buy items#basket-popup");
}