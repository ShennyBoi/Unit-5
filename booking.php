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

    <link rel="stylesheet" href="./styles/all.css" type="text/css">
    <link rel="stylesheet" href="./styles/booking.css" type="text/css">

</head>

<!--body-->

<body>
    <div class="center-div">
        <h1>Book a viewing</h1>
    </div>

    <div class="horizontal-section-container">
        <div class="horizontal-section">
            <div class=column>
            <h1 > Upcoming Events </h1> <!-- Section title -->
            <br>
            <h2 class=mono> Calendar Key </h2> <!-- Key title -->
            <ul>
                <li class="today mono key-text">Todays date</li>
                <li class="event mono key-text">Upcoming events</li>
            </ul>
            </div>
        </div>

        <div class="horizontal-section">
            <div class="column grow">
                <div class="heading center-div">
                    <h1>Calendar</h1>
                </div>
                <div class="grow center-div">
                    <div class="calendar">
                        <?php
                        include './includes/calendar.php';  //  Includes calendar code

                        $calendar = new Calendar();     //  Sets calendar variable

                        echo $calendar->show();     //  Calls function to display calendar
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="horizontal-section">
            <div class=column>
                <h1> Available Slots </h1>  <!-- Section title -->
                <p> Coming soon! </p>
            </div>
        </div>
    </div>
</body>

</html>