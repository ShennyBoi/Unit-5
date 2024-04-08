<?php

include_once "./includes/connAct.php";      # Includes database connection variable
include_once "./includes/nav.php";      # Includes nav bar

?>

<html lang="en">

<!--head-->

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>

    <link rel="stylesheet" href="./styles/all.css">
    <link rel="stylesheet" href="./styles/shop.css">

</head>

<!--body-->

<body>


    <!-- APPLY FILTERING FUNCTIONS with SESSION/POSTED VARIABLES-->

    <?php

    //  <For ease of finding> SEARCH QUERIES SEARCH QUERY SEARCH TERM
    
    //  1ST STEP IN PRODUCT DISCOVERY FUNCTIONS
    
    //  Initialise Search/Sort/Filter to empty strings 
    //  (Order of priority IS: BLANK < SESSION < POST) 
    
    $sqlSearchAppend = "";
    $sqlSortAppend = "";
    $sqlFilterAppend = "";

    //  Set functions for appending sql queries
    
    function searchQuery($term) //  Function to turn search term into appendable sql query end
    {
        return "WHERE productTitle LIKE '%$term%'";
    }
    function sortQuery($term)   //  Function to turn sort term into appendable sql query end
    {

        $append = " ORDER BY ";  //  Beginning of appended sort term
    
        if (strpos($term, "Pric") !== FALSE) {        //  If user sorted by Price
            $append .= "productCost";                   // Appends relevant SQL for Price
            //$_POST['sort-term'] = "Cost";
        } elseif (strpos($term, "Date") !== FALSE) {  //  If user sorted by Date
            $append .= "releaseDate";                   // Appends relevant SQL for Date
            //$_POST['sort-term'] = "Date";
        } elseif (strpos($term, "Titl") !== FALSE) {  //  If user sorted by Title
            $append .= "productTitle";                  // Appends relevant SQL for Title
            //$_POST['sort-term'] = "Title";
        } elseif (strpos($term, "Stoc") !== FALSE) {  //  If user sorted by Stock
            $append .= "stock";                         // Appends relevant SQL for Stock
        } else
            return "";                              //  If error, just return empty string
    
        $append .= " ";

        if (strpos($term, "Asc") !== FALSE) {             //  If user chose ascending
            $append .= "ASC";                               // Appends relevant SQL for ascending
        } elseif (strpos($term, "Desc") !== FALSE) {      //  If user chose descending
            $append .= "DESC";                              // Appends relevant SQL for descending
        } else
            return "";                              //  If error, just return empty string
        $append .= " ";
        return $append;

    }
    //  If field is price, term may be any price, tail may be: over/under. -- e.g. WHERE PRICE > or < 10
    //  If field is colour, term may be any colour, tail will be BLANK. -- e.g. WHERE COLOUR == "BLUE"
    //  If field is date, term may be: any date, tail may be: before/after -- e.g. WHERE DATE > or < 10
    //  If field is type, term may be any type (e.g.impossible shape, optical illusion, etc.), tail will be BLANK -- e.g. where type == "OPTICAL ILLUSION"
    function filterPriceQuery($value, $tail)     //  Function to turn posted PRICE filter terms into appendable sql query end
    {
        $price_filter_query = " AND productCost ";                      //  Beginning of the filter by price query including price field reference
    
        if ($tail == "Less Than")          //  Check for lower tail
            $price_filter_query .= "< ";                           //  Append lower tail 
        elseif ($tail == "More Than")       //  Else check for upper tail
            $price_filter_query .= "> ";                               //  Append upper tail 
        else
            echo "<script> alert('Error with filter term'); </script>";     //  Else inform developer an error occured 
    
        $price_filter_query .= $value;        //  Append filter value to filter query
    
        return $price_filter_query;
    }

    //  2ND STEP IN PRODUCT DISCOVERY FUNCTIONS
    
    //  SESSION OVERRIDES
    
    //  If SESSION variables are set, they will override their corresponding (blank) search/sort/filter
    

    if (isset($_SESSION["shop-search-term"])) {     //  If there is one...
        $sqlSearch = $_SESSION["shop-search-term"];     //  Gets old search term from session data 
        $sqlSearchAppend = searchQuery($sqlSearch);         //  Creates the search query section to be appended
    }
    if (isset($_SESSION["shop-sort-term"])) {       //  If there is one...
        $sqlSort = $_SESSION["shop-sort-term"];         //  Gets old sort term from session data  
    }

    //  Filters are not stored in a single session variable... 
//                    if (isset($_SESSION["shop-filter-term"])) {    //  If there is one...
//                        $sqlfilter = $_SESSION["shop-filter-term"];    //  Gets old filter term from session data  
//                    }       //  currently redundant
    
    //  POST OVERRIDES

    if (!isset($_SESSION["filter-by-price"])){
        $_SESSION["filter-by-price"] = FALSE;
    }

    //  If POST variables are set, they will override their corresponding search/sort/filter and update the session variables 

    if ($_SERVER['REQUEST_METHOD'] == "POST") {             //  If method is post from a form (looking for any search, sorts, or filters)
    
        if (isset($_POST["search-term"])) {                 //  If SEARCH term is set in the post e.g. the post was from a SEARCH
            $sqlSearch = $_POST["search-term"];             //  Then update the search term to the corresponding post value, overriding previous search queries
            $_SESSION["shop-search-term"] = $sqlSearch;     //  Update session to store search next time
            $sqlSearchAppend = searchQuery($sqlSearch);     //  Uses previous searchQuery function to get relevant SQL from user chosen term
        }


        if (isset($_POST["sort-term"])) {                   //  If SORT term is set in the post e.g. the post was from a SORT
            $sqlSort = $_POST["sort-term"];                 //  Then update the sort term to the corresponding post value, overriding previous sort queries
            $_SESSION["shop-sort-term"] = $sqlSort;         //  Update session to store sort next time
            $sqlSortAppend = sortQuery($sqlSort);           //  Uses previous sortQuery function to get relevant SQL from user chosen term
        }

        //  First make sure no filters have been removed
        if (isset($_POST["remove-price-filter"])) {
            $_SESSION["filter-by-price"] = FALSE;           //  Remove price filter
        }

        if (isset($_POST["remove-colour-filter"])) {
            $_SESSION["filter-by-colour"] = FALSE;
        }

        if (isset($_POST["remove-type-filter"])) {
            $_SESSION["filter-by-type"] = FALSE;
        }

        if (isset($_POST["remove-stock-filter"])) {
            $_SESSION["filter-by-stock"] = FALSE;
        }


        //  An if statement for each filter
    
        if (isset($_POST["filter-by-price"])) {                 //  If FILTER BY PRICE term is set in the post e.g. the post was from an ADD PRICE FILTER
            //  If the filter was on the price then
            $_SESSION["filter-by-price"] = TRUE;                //  SET CORRESPIONDING SESSION VALUE TO TRUE
            $price_filter_query = filterPriceQuery($_POST["price-filter-value"], $_POST["price-filter-tail"]);
            $sqlFilterAppend .= $price_filter_query;
        }

        if (isset($_POST["filter-by-colour"])) {
            $price_filter_query = $_POST[""];     // colour table and product-colour link table comparison
            $price_filter_query = "";

        }
        if (isset($_POST["filter-by-type"])) {
            $price_filter_query = $_POST[""];     // tag table and product-tag link table comparison
            $price_filter_query = "";

        }
        if (isset($_POST["filter-by-stock"])) {
            $price_filter_query = $_POST["stock-filter-value"];
            $price_filter_query = "";

        }

        //  $sqlFilterAppend = $price_filter_query;
    
        //  $_POST["filter-price-tail"];
    




    } ?>







    <?php

    //  If user is logged in 
    //      - Ensure basket is created
    //      - Retrieve basket item count
    
    if (isset($_SESSION["loggedIn"])) {

        // Set user id variable
        $userID = $_SESSION["userID"];

        // Check for this users basket (unprocessed order) 
        $sqlSelectOrder = "SELECT OrderID from orders WHERE UserID = '$userID' AND Processed = 'unprocessed'";
        $oldSelectOrderResult = mysqli_query($conn, $sqlSelectOrder);


        //      If NO current order (basket) exists
    

        if (mysqli_num_rows($oldSelectOrderResult) == 0) {

            //      Set current date variable
            $date = date("Y-m-d");
            echo $date . "<br>";

            //      Create a new order
            $sqlAddOrder = "INSERT INTO orders (UserID, TotalCost, Date, Processed)
                        VALUES ('$userID', '0', '$date', 'unprocessed')";
            $addOrderResult = mysqli_query($conn, $sqlAddOrder);

            //      New select to retrieve new basket ID
            $sqlNewSelectOrder = "SELECT OrderID from orders WHERE UserID = '$userID' AND Processed = 'unprocessed'";
            $newSelectOrderResult = mysqli_query($conn, $sqlNewSelectOrder);

            //      Set currrent basket id variable
            $orderID = mysqli_fetch_assoc($newSelectOrderResult)["OrderID"];

            //      Set basket item count to 0 as this is a new basket
            $basketItemCount = 0;
        }


        //      If current order DOES exist  ( i.e: if there is already a basket )
    

        if (mysqli_num_rows($oldSelectOrderResult) == 1) {

            //      Set order id to old select result
            $orderID = mysqli_fetch_assoc($oldSelectOrderResult)["OrderID"];

            //      Using the old order ID...
            $sqlSalesCount = "SELECT * FROM sales WHERE OrderID = '$orderID' ";
            $salesCountResult = mysqli_query($conn, $sqlSalesCount);

            //      Get the count of products in basket from sales table
            $basketItemCount = mysqli_num_rows($salesCountResult);
        }

        if (mysqli_num_rows($oldSelectOrderResult) > 1) {

            $error = "There are multiple baskets, please contact support";
            echo "<script>alert('error : " . $error . "');</script>";

            $basketItemCount = "error";

        }

    } ?>

    <!-- TITLE ROW START-->

    <div class="row"> <!-- title row -->

        <div class="third left-div">
            <?php
            if (isset($_SESSION["loggedIn"])) {
                if ($_SESSION["isAdmin"] == 1) {
                    ?>
                    <div class="row add-item-row">
                        <a href="#admin-add-item-popup">
                            <img class="add-item-icon raise" src="./assets/add-icon.png" />
                        </a>
                        <div class="add-item-text"> Add Item </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        <!-- ADMIN ADD ITEM POPUP START  -->

        <?php

        //ADMIN FIELD VALIDATION
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_SESSION["loggedIn"]) && (isset($_SESSION["isAdmin"]))) {
                if ($_SESSION["isAdmin"] == 1) {

                    // add item validation
                    $titleErr = $imageErr = $descriptionErr = $costErr = $stockErr = $dateErr = "";

                    // title
                    // image
                    // description
                    // cost
                    // stock
                    // date
        
                    $valid = TRUE;

                    //      Check the method is post
        
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {


                        //  Title validation
        
                        if (empty($_POST["title"])) {               // presence check
                            $titleErr = "Title is required";
                            $valid = False;
                        } elseif (strlen($_POST["title"]) > 100) {                // length check
                            $titleErr = "Title length must be <100 ";
                            $valid = False;
                        }

                        //  Image validation
        
                        if (empty($_POST["image"])) {               // presence check
                            $imageErr = "Image is required";
                            $valid = False;
                        }

                        //  Description validation
        
                        if (empty($_POST["description"])) {               // presence check
                            $descriptionErr = "Description is required";
                            $valid = False;
                        } elseif (strlen($_POST["description"]) > 1000) {                // length check
                            $descriptionErr = "Description must be <1000 characters";
                            $valid = False;
                        }

                        //  Cost validation
        
                        if (empty($_POST["cost"])) {            // presence check
                            $costErr = "Cost is required";
                            $valid = False;
                        } elseif ($_POST["cost"] > 1000) {            // range check
                            $stockErr = "Cost must be < £1,000 ";
                            $valid = False;
                        }

                        //  Stock validation 
        
                        if (empty($_POST["stock"])) {           // presence check
                            $stockErr = "Stock is required";
                            $valid = False;
                        } elseif ($_POST["stock"] > 1000) {            // range check
                            $stockErr = "Stock must be < 1,000 ";
                            $valid = False;
                        }

                        //  Date validation
        
                        $currentDate = date("m-d-Y");

                        if (empty($_POST["date"])) {           // presence check
                            $dateErr = "Date is required";
                            $valid = False;
                        } elseif ($_POST["date"] > $currentDate) {                 // double key
                            $dateErr = "Dates can not be in the future";
                            $valid = False;
                        }

                        // ADD THIS PRODUCT
        
                        if ($valid) {
                            $title = $_POST["title"];
                            $image = $_POST["image"];
                            $description = $_POST["description"];
                            $cost = $_POST["cost"];
                            $date = $_POST["date"];

                            $sql = "INSERT INTO products (productID, productTitle, productImageLink, description, productCost, stock, releaseDate) VALUES ('$title', '$image', '$description', '$cost', '$date')";
                            $result = mysqli_query($conn, $sql);
                            if ($result) {
                                header("location:/shop.php?msg=product successfully added#admin-add-item-popup");
                            } else {
                                $addErr = mysqli_error($conn);
                                header("location:/shop.php?msg=$addErr#admin-add-item-popup");
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

                    ?>
                    <div id="admin-add-item-popup" class="overlay">
                        <div class="popup">
                            <h2>Add a new product</h2>
                            <a class="close" href="/shop.php">&times;</a>
                            <?php if (isset($_GET["msg"])) { ?>
                                <div class="success-message">
                                    <?php echo $_GET["msg"]; ?>
                                </div>
                            <?php } ?>
                            <?php if (isset($_GET["err"])) { ?>
                                <div class="error-message">
                                    <?php echo $_GET["err"]; ?>
                                </div>
                            <?php } ?>
                            <div class="content">

                                <form name="registerForm" id="registerForm"
                                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                    <div class="column">

                                        <div class="row margin" for="title">
                                            <div class="third left-div">
                                                <label for="title" class="mono">Product Title:</label>
                                            </div>
                                            <div class="third center-div">
                                                <input class="input" type="text" id="title" name="title" value="<?php if (isset($_POST['title'])) {
                                                    echo $_POST['title'];
                                                } ?>" />
                                            </div>
                                            <div class="third right-div">
                                                <div class="validation-div">
                                                    <?php echo $titleErr; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row margin" for="image">
                                            <div class="third left-div">
                                                <label for="image" class="mono">Product Image</label>
                                            </div>
                                            <div class="third center-div">
                                                <input class="input" type="file" id="image" name="image" value="<?php if (isset($_POST['image'])) {
                                                    echo $_POST['image'];
                                                } ?>" />
                                            </div>
                                            <div class="third right-div">
                                                <div class="validation-div">
                                                    <?php echo $imageErr; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row margin" for="description">
                                            <div class="third left-div">
                                                <label for="description" class="mono">Product Description:</label>
                                            </div>
                                            <div class="third center-div">
                                                <input class="input" width="100px" height="100px" type="text" id="description"
                                                    name="description" value="<?php if (isset($_POST['description'])) {
                                                        echo $_POST['description'];
                                                    } ?>" />
                                            </div>
                                            <div class="third right-div">
                                                <div class="validation-div">
                                                    <?php echo $descriptionErr; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row margin" for="cost">
                                            <div class="third left-div">
                                                <label for="cost" class="mono">Cost:</label>
                                            </div>
                                            <div class="third center-div">
                                                <input class="input" type="text" id="cost" name="cost" value="<?php if (isset($_POST['cost'])) {
                                                    echo $_POST['cost'];
                                                } ?>" />
                                            </div>
                                            <div class="third right-div">
                                                <div class="validation-div">
                                                    <?php echo $costErr; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row margin" for="stock">
                                            <div class="third left-div">
                                                <label for="stock" class="mono">In stock:</label>
                                            </div>
                                            <div class="third center-div">
                                                <input class="input" type="stock" id="stock" name="stock" value="<?php if (isset($_POST['stock'])) {
                                                    echo $_POST['stock'];
                                                } ?>" />
                                            </div>
                                            <div class="third right-div">
                                                <div class="validation-div">
                                                    <?php echo $stockErr; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row margin" for="date">
                                            <div class="third left-div">
                                                <label for="date" class="mono">Release Date:</label>
                                            </div>
                                            <div class="third center-div">
                                                <input class="input" type="date" id="date" name="date" value="<?php if (isset($_POST['date'])) {
                                                    echo $_POST['date'];
                                                } ?>" />
                                            </div>
                                            <div class="third right-div">
                                                <div class="validation-div">
                                                    <?php echo $dateErr; ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="center-div">

                                        <div class="row margin">
                                            <input type="submit" id="btn" value="Add Product" name="submit">
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
        }
        ?>
        <!-- ADMIN ADD ITEM POPUP END -->

        <!-- TITLE CENTER DIV -->
        <div class="center-div third">
            <h1>MathArt's Store</h1>
        </div>

        <!-- BASKET OPEN BUTTON-->
        <div class="third right-div basket">
            <?php if (isset($_SESSION["loggedIn"])) { ?>
                <p>
                    <?php echo ($basketItemCount) ?>
                </p>
            <?php } ?>
            <div class="padded-button row">

                <a href="#basket-popup">
                    <img class="raise" src="./assets/Basket.png" width=40px height=40px>
                </a>
            </div>
        </div>

        <!-- BASKET POPUP START  -->

        <div id="basket-popup" class="overlay">
            <div class="popup">
                <h2>Your Basket</h2>
                <a class="close" href="/shop.php">&times;</a>
                <?php if (isset($_GET["msg"])) { ?>
                    <div class="success-message">
                        <?php echo $_GET["msg"]; ?>
                    </div>
                <?php } ?>
                <?php if (isset($_GET["err"])) { ?>
                    <div class="error-message">
                        <?php echo $_GET["err"]; ?>
                    </div>
                <?php } ?>

                <div class="content">
                    <?php
                    if (isset($_SESSION["userID"])) {

                        //  Select sales (product sales) in basket with current order ID
                        $sqlSalesSelect = "SELECT * FROM sales WHERE OrderID='$orderID'";
                        $salesSelectResult = mysqli_query($conn, $sqlSalesSelect);

                        if (mysqli_num_rows($salesSelectResult) == 0) {
                            ?>
                            <hr>
                            <div class="basket-empty center-div grow column">
                                <div class="center-div">
                                    <h3>Your Basket is empty</h3>
                                </div>
                                <div class="center-div">
                                    <p> Have a look around and add some items! </p>
                                </div>
                            </div>
                            <?php
                        }

                        //  For each of the sales in the order 
                        while ($saleRecord = mysqli_fetch_assoc($salesSelectResult)) {

                            // Set corresponding sale variables
                            $orderID = $saleRecord["OrderID"];
                            $productID = $saleRecord["ProductID"];
                            $quantity = $saleRecord["Quantity"];
                            $subtotal = $saleRecord["Subtotal"];

                            // Get corresponding product record from table
                            $sqlProductsSelect = "SELECT * FROM products WHERE productID = '$productID'";
                            $productsSelectResult = mysqli_query($conn, $sqlProductsSelect);
                            $productRecord = mysqli_fetch_assoc($productsSelectResult);

                            // Get corresponding product details 
                            $productTitle = $productRecord["productTitle"];
                            $productImageLink = $productRecord["productImageLink"];
                            $description = $productRecord["description"];
                            $productCost = $productRecord["productCost"];
                            $stock = $productRecord["stock"];

                            ?>

                            <hr>

                            <?php

                            // TEMPORARY - FORMAT LATER
                    
                            // echo details
                            echo ("Quantity: " . $quantity . "<br>"); // Add a 'CHANGE QUANTITY' selector and a 'REMOVE ITEM FROM BASKET' button
                            echo ("Subtotal: " . $subtotal . "<br>");
                            echo ("Title: " . $productTitle . "<br>");
                            ?>

                            <img src="<?php echo ($productImageLink); ?>" class="basket-image" />
                            <br>

                            <?php
                            echo ("Description: " . $description . "<br>");
                            echo ("Cost: " . $productCost . "<br>");
                            echo ("In stock: " . $stock . "<br>");
                            ?>

                            <hr>

                            <?php
                        }
                        ?>
                        <hr>
                        <?php if (!(mysqli_num_rows($salesSelectResult)) == 0) { ?>
                            <div class="row">
                                <form action="./includes/shop-includes/checkout-basket.php" method="POST">
                                    <input type="hidden" name="id-Checkout" value="<?php echo ($orderID) ?>">
                                    <!-- use url to send verification data? -->
                                    <input type="submit" value="checkout basket" class="padded-button checkout-button">
                                </form>
                                <form action="./includes/shop-includes/empty-basket.php" method="POST">
                                    <input type="hidden" name="orderID" value="<?php echo ($orderID) ?>">
                                    <input type="submit" value="empty basket" class="padded-button empty-basket-button">
                                    <!-- use a popup like delete account for empty basket confirmation -->
                                </form>
                            </div>
                        <?php }
                    }
                    //  If user is not logged in
                    else { ?>
                        <hr>
                        <div class="basket-empty center-div grow column">
                            <div class="center-div">
                                <h3>You are not logged in</h3>
                            </div>
                            <div class="center-div">
                                <p> Have a look around and log in to buy items! </p>
                            </div>
                        </div>
                        <hr>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- BASKET POPUP END -->

    </div>

    <!-- TITLE ROW END -->

    <!-- SHOP FUNCTION START -->

    <div class=" horizontal-section-container">
        <div class="horizontal-section">
            <div class="column grow">
                <div class="horizontal-section-container">
                    <h1>Search item titles</h1>
                </div>
                <form class="center-div" method="POST">
                    <input type=text class=search-bar placeholder="Enter an item to search for" name='search-term'
                        value="<?php if (isset($_POST['search-term'])) {
                            echo $_POST['search-term'];
                        } ?>" />
                    <input type=submit class=submit-search value="Search" />
                </form>
                <!-- Search (SQL LIKE... )just needs an entry text box and a search button -->
                <!--    
                    center this
                    <img src="./assets/magnifying-glass.svg" width="25px" height="25px">
                -->

            </div>
        </div>
        <div class="horizontal-section">
            <div class="column grow">
                <!-- Sort (SQL ORDER BY) needs -->
                <div class="horizontal-section-container">
                    <h1>Sort By</h1>

                    <?php if (isset($_POST["sort-term"]))
                        $_SESSION["shop-sort-term"] = $_POST["sort-term"]; ?>
                </div>
                <!-- price, date, colour, type -->
                <form class="center-div" method="POST">
                    <select name='sort-term' class=sort-drop>

                        <!-- option session recall -->
                        <?php
                        if ($_SESSION['shop-sort-term'] == "PricAsc")
                            $opt1 = TRUE;
                        else
                            $opt1 = False;
                        if ($_SESSION['shop-sort-term'] == "PricDesc")
                            $opt2 = TRUE;
                        else
                            $opt2 = False;
                        if ($_SESSION['shop-sort-term'] == "DateAsc")
                            $opt3 = TRUE;
                        else
                            $opt3 = False;
                        if ($_SESSION['shop-sort-term'] == "DateDesc")
                            $opt4 = TRUE;
                        else
                            $opt4 = False;
                        if ($_SESSION['shop-sort-term'] == "TitlAsc")
                            $opt5 = TRUE;
                        else
                            $opt5 = False;
                        if ($_SESSION['shop-sort-term'] == "TitlDesc")
                            $opt6 = TRUE;
                        else
                            $opt6 = False;
                        if ($_SESSION['shop-sort-term'] == "StocAsc")
                            $opt7 = TRUE;
                        else
                            $opt7 = False;
                        if ($_SESSION['shop-sort-term'] == "StocDesc")
                            $opt8 = TRUE;
                        else
                            $opt8 = False;
                        ?>
                        <!-- options -->
                        <option value="PricAsc" <?php if ($opt1)
                            echo "selected"; ?>>Price Ascending</option>
                        <option value="PricDesc" <?php if ($opt2)
                            echo "selected"; ?>>Price Descending</option>
                        <option value="DateAsc" <?php if ($opt3)
                            echo "selected"; ?>>Date Ascending</option>
                        <option value="DateDesc" <?php if ($opt4)
                            echo "selected"; ?>>Date Descending</option>
                        <option value="TitlAsc" <?php if ($opt5)
                            echo "selected"; ?>>Title Alphabetical</option>
                        <option value="TitlDesc" <?php if ($opt6)
                            echo "selected"; ?>>Title Reverse Alphabetical
                        </option>
                        <option value="StocAsc" <?php if ($opt7)
                            echo "selected"; ?>>Stock Ascending</option>
                        <option value="StocDesc" <?php if ($opt8)
                            echo "selected"; ?>>Stock Descending</option>
                    </select>
                    <input type=submit class=submit-sort value="Sort" />
                </form>
            </div>

        </div>
        <div class="horizontal-section">
            <div class="column grow">
                <!--    Filter (SQL WHERE ... ) needs a number of categories, a.g. price, date, colour, and type (impossible shape, optical illusion etc.).  
                        users can select any number of the categories
                        selected categories need a range e.g. <£10 or a number of colour selects e.g. blue, red, grayscale etc. -->

                <div class="horizontal-section-container">
                    <h1>Filter results by</h1>
                </div>
                <div class="horizontal-section-container grow">


                    <!-- Filter price button -->
                    <div class="column">
                        <a href="#popup-price">
                            <button class="filter-button center-div <?php if ($_SESSION["filter-by-price"]) {
                                echo 'filter-selected';
                            }  //INTENDED TO CHANGE COLOUR AND ADD "REMOVE FILTER BUTTON
                            ?>" for="price">Price</button>
                        </a>
                        <!-- <input type="text" class="filter-input" /> -->
                    </div>
                    <!-- Filter Price popup-->
                    <div id="popup-price" class="overlay">
                        <div class="filter-popup">
                            <h2 class="center-div">Add a price filter</h2>
                            <a class="close" href="#">&times;</a>
                            <div class="content">
                                <form method="POST">

                                    <input type="hidden" value=TRUE name="filter-by-price">
                                    <!-- informing the retrieving end what Type of filter we are adding through the post-->

                                    <div class="row">
                                        <select class="padded-button filter-input" name="price-filter-tail">

                                            <!-- more than / less than option selection-->
                                            <option class="filter-input" value="More Than">More Than</option>
                                            <option class="filter-input" value="Less Than">Less Than</option>
                                        </select>

                                        <!-- value entry selection -->
                                        <input class="padded-button filter-input" name="price-filter-value"
                                            type="number" min="0" max="1000" step="10" value="50" />
                                    </div>
                                    <div class="center-div">

                                        <!-- confirm / "add filter" button-->
                                        <input type=submit class=submit-filter value="Add filter" />

                                    </div>
                                </form>
                                <div class="row grow">
                                    <?php if ($_SESSION["filter-by-price"]) { ?>
                                        <form method="POST" class="grow">
                                            <input type="hidden" value=TRUE name="remove-price-filter" />
                                            <input type="submit" class="remove-filter grow center-div"
                                                value="Remove filter" />
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="popup-footer">
                        </div>
                    </div>


                    <!-- Filter colour button -->
                    <div class="column">
                        <a href="#popup-colour">
                            <button class="filter-button center-div" for="colour">Colour</button>
                        </a>
                        <!-- <input type="text" class="filter-input" /> -->
                    </div>
                    <!-- Filter colour popup-->
                    <div id="popup-colour" class="overlay">
                        <div class="filter-popup">
                            <h2>Colour</h2>
                            <a class="close" href="#">&times;</a>
                            <div class="content">
                                <form method="POST">
                                    <div class="row">
                                        <input name="filter-colour-red" type="checkbox" id="colour1" value="Red">
                                        <label for="colour1"> RED </label>
                                        <input type="number" min="0" max="1000" step="10" value="50" />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="popup-footer">
                        </div>
                    </div>


                    <!-- Filter type button -->
                    <div class="column">
                        <a href="#popup-type">
                            <button class="filter-button center-div" for="type">Type</button>
                        </a>
                        <!-- <input type="text" class="filter-input" /> -->
                    </div>
                    <!-- Filter type popup-->
                    <div id="popup-type" class="overlay">
                        <div class="filter-popup">
                            <h2>Type</h2>
                            <a class="close" href="#">&times;</a>
                            <div class="content">
                            </div>
                        </div>
                        <div class="popup-footer">
                        </div>
                    </div>


                    <!-- Filter Stock Button-->
                    <div class="column">
                        <a href="#popup-stock">
                            <button class="filter-button center-div" for="stock">Stock</button>
                        </a>
                        <!-- <input type="text" class="filter-input" /> -->
                    </div>
                    <!-- Filter Stock Popup-->
                    <div id="popup-stock" class="overlay">
                        <div class="filter-popup">
                            <h2>Stock</h2>
                            <a class="close" href="#">&times;</a>
                            <div class="content">
                            </div>
                        </div>
                        <div class="popup-footer">
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <!-- SHOP FUNCTION END -->

    <!-- ITEM SECTION START -->

    <div class="horizontal-section-container">
        <div class="horizontal-section">
            <div class="column grow">
                <div class="item-wrap">
                    <?php


                    // MAIN PRODUCT QUERY
                    
                    $sqlSelectProducts = ("SELECT * FROM products " . $sqlSearchAppend . $sqlFilterAppend . $sqlSortAppend);

                    // TESTING: 
                    echo $sqlSelectProducts;

                    $result = mysqli_query($conn, $sqlSelectProducts);
                    if (mysqli_num_rows($result) == 0) {
                        echo ("No items found<br>");
                        echo (mysqli_error($conn));
                        echo ("<br>" . $sqlSelectProducts);
                    } else {
                        while ($productRecord = mysqli_fetch_assoc($result)) {
                            $id = $productRecord["productID"];
                            $title = $productRecord["productTitle"];
                            $description = $productRecord["description"];
                            $image = $productRecord["productImageLink"];
                            $cost = $productRecord["productCost"];
                            $stock = $productRecord["stock"];

                            ?>
                            <!-- ITEM START -->
                            <a class="item raise column mono" href="#popup<?php echo ($id) ?>"
                                id="popup<?php echo ($id) ?>-link">
                                <div class="column grow">
                                    <div class="item-title center-div">
                                        <?php echo ($title) ?>
                                    </div>

                                    <div class="image">
                                        <img src="<?php echo ($image) ?>" class="product-image" />
                                    </div>
                                    <div class=itemDescription>
                                        <h2>Description</h2>
                                        <?php echo ($description) ?>
                                    </div>

                                    <div class="row">

                                        <div class="item-main-text">
                                            <p>
                                                <b>Cost:</b>
                                            </p>
                                        </div>
                                        <div class="item-detail-text">
                                            <p>
                                                <?php echo "£";
                                                echo (number_format($cost, 2));   // formats the cost to 2 dp e.g. 20.5 --> £20.50 
                                                ?>
                                            </p>
                                        </div>
                                        <div class="item-main-text">
                                            <p>
                                                <b>In stock:</b>
                                            </p>
                                        </div>
                                        <div class="item-detail-text">
                                            <p>
                                                <?php echo $stock; ?>
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </a>
                            <!-- ITEM END -->

                            <!-- POPUP START -->
                            <div id="popup<?php echo ($id) ?>" class="overlay">
                                <div class="popup">
                                    <h2>
                                        <?php echo ($title) ?>
                                    </h2>
                                    <a class="close" href="#">&times;</a>
                                    <div class="content">
                                        <div class="image">
                                            <img src="<?php echo ($image) ?>" class="popup-image" />
                                        </div>
                                        <div class="popup-description">
                                            <h4 class="mono"> more information about this product </h4>
                                        </div>
                                    </div>
                                    <div class="buttons">
                                        <div class="button-row grow">
                                            <form action="./includes/shop-includes/add-to-basket.php" method=POST>
                                                <input type="hidden" name="id-Add" value="<?php echo ($id) ?>">
                                                <input type="hidden" name="cost-Add" value="<?php echo ($cost) ?>">

                                                <input type="submit" class="add-to-basket raise" value="Add To Basket">
                                                <!--
                                            <img class="button-icon" src="./assets/Basket.png" width="30px" height="30px" />
                                            
                                            <input type="number" min="0" max="10" step="1" value="6" size="6">-->
                                            </form>

                                            <form action="./includes/shop-includes/buy-now.php" method=POST>
                                                <input type="hidden" name="id-Buy" value="<?php echo ($id) ?>">
                                                <input type="hidden" name="cost-Buy" value="<?php echo ($cost) ?>">

                                                <input type="submit" class="buy-now raise" value="Buy Now">
                                                <!--
                                            <img class="button-icon" src="./assets/Clicker.png" width="30px"
                                                height="30px" />
                                            
                                            <input type="number" min="0" max="10" step="1" value="6" size="6">
                                            -->
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="popup-footer">

                                </div>
                            </div>
                            <!-- POPUP END -->

                        <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- ITEM SECTION END -->


</body>

</html>