<?php
include_once "./includes/connAct.php";
include_once "./includes/nav.php";

?>
<html lang="en">
<!--head-->

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a viewing</title>

    <link rel="stylesheet" href="./styles/all.css">
    <link rel="stylesheet" href="./styles/admin.css">

</head>

<!--body-->

<body>


    <!-- PHP -->
    <?php

    if((!isset($_SESSION["loggedIn"]))){
        
        //header("Location:index.php");
        
        if(!($_SESSION["isAdmin"]==1)){

        //header("Location:index.php");

        }
    }


    

    $getTableNamesQuery = "SELECT table_name
        FROM information_schema.tables
        WHERE table_schema = 'mathartdb'
        AND table_type = 'BASE TABLE';";
    $tableNames = mysqli_query($conn, $getTableNamesQuery);

    //set the tab which opens by default:
    $defaultTab = "useraccounts";

    ?>

    <!-- Tab links -->

    <div class="tab">
        <?php foreach ($tableNames as $tableTitle) {        // Loops for each of the base tables in the database  
            $tableTitle = $tableTitle["table_name"]; ?>     <!-- Creates a navigation button tab for each table --> 
            <button class="tablinks" onclick="openTab(event, '<?php echo ($tableTitle) ?>')" <?php if ($tableTitle == $defaultTab) { ?> id="defaultOpen" <?php } ?>>
                <?php echo ($tableTitle); ?>
            </button>
        <?php } ?>

    </div>


    <!-- Each Tab content -->

    <?php foreach ($tableNames as $tableTitle) {            // Loops for each of the base tables in the database  
        $tableTitle = $tableTitle["table_name"]; ?>
        <div id="<?php echo ($tableTitle) ?>" class="tabcontent">
            <h3>
                <?php echo ($tableTitle) ?>
            </h3>

            <table>
                <tr>
                <?php 
                // Gets column names
                $getColumnNamesQuery = "SELECT column_name FROM information_schema.columns WHERE table_schema = 'mathartdb' AND table_name = '$tableTitle';";
                $columnNames = mysqli_query($conn, $getColumnNamesQuery);

                //  Makes table header from each column title
                foreach ($columnNames as $columnTitle) {
                $columnTitle = $columnTitle["column_name"]; 
                
                
                ?>
                    <th> 
                        <?php echo ($columnTitle); ?> 
                    </th>
                <?php } ?>
                </tr>

                <?php

                //  Gets data from corresponding table
                $dataQuery = "SELECT * FROM $tableTitle";
                $result = mysqli_query($conn, $dataQuery);
                if (($result->num_rows) > 0) { //   If there is some data, displays that
                    while ($recordArr = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <?php
                            foreach ($columnNames as $columnTitle) { 
                            $columnTitle = $columnTitle["column_name"]; ?>
                                <td>
                                    <?php echo ($recordArr[$columnTitle]); ?>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php }
                } else {    //  If not, informs the user that there are 0 results
                    ?> 
                    <tr> 
                        <?php echo "0 results"; ?> 
                    </tr> 
                    <?php
                }
                ?>
            </table>
        </div>
    <?php } ?>

    <!-- End of content for Each Tab-->


</body>

<script>

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();

    function openTab(evt, TabName) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(TabName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>

</html>