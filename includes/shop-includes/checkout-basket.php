<?php
include("../connAct.php");

if (isset($_POST["id-Checkout"])) { //  If the post index 'id checkout' is set

    $orderID = $_POST["id-Checkout"];       //  Gets the order ID from the post
    $userID = $_SESSION["userID"];
    $date = date("Y-m-d");

    # echo ("orderID: " . $orderID . "<br>");     #  Tells developer current order id

    //  Update the order status to processed

    $sqlStatusUpdate = "UPDATE orders SET Processed = 'processed' WHERE OrderID = '$orderID'";
    $statusUpdateResult = mysqli_query($conn, $sqlStatusUpdate);
    if (!$statusUpdateResult) {
        header("location:/shop.php?err=issue updating basket/order status on order $orderID#basket-popup");
        exit;
    }
    //  Query to create new unprocessed order (basket) 
    $sqlCreateNewBasket = "INSERT INTO orders (UserID, TotalCost, Date, Processed) VALUES ('$userID', '0', '$date', 'unprocessed')";
    $createNewBasketResult = mysqli_query($conn, $sqlCreateNewBasket);
    if (!$createNewBasketResult) {
        header("location:/shop.php?err=issue creating new basket#basket-popup");
        exit;
    }

    header("location:/shop.php?msg=Basket checked out successfully#basket-popup");
    // echo ("
    // This page should simply:<br>

    // • Update the order status to processed <br>
    // • Create a new order (basket) for the user <br>


    // • I need to add a '' credit card check '' <br>
    // <br>
    // <a href = '/shop.php'> use this link to go back to the shop </a> <br>
    // <a href = '/shop.php#basket-popup'> use this link to go back to the basket </a>
    // "
    // );

}