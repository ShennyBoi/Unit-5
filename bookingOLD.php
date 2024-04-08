<?php
include_once "./includes/connAct.php";
include_once "./includes/nav.php";
require_once "./includes/calendar.php";

//if(!isset($_SESSION["Calendar"])){
//create new instance of calendar class under $calendar, using paramaters whic are new instances of CurrentDate() and DisplayDate
$calendar = new Calendar(new CurrentDate(), new DisplayDate());

//set whether sunday comes first
$calendar->setSundayFirst(false);

//set the month the calendar shows (default current)
$calendar->setMonth(1);

//calls create function to create calendar 
$calendar->create();
//}
?>

<html lang="en">
<!--head-->

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a viewing</title>

    <link rel="stylesheet" href="./styles/all.css">
    <link rel="stylesheet" href="./styles/booking.css">

</head>

<!--body-->

<body>
    <div class="center-div">
        <h1>Book a viewing</h1>
    </div>

    <div class="horizontal-section-container">
        <div class="horizontal-section">
            <h1> Upcoming Events </h1>
        </div>
        <div class="horizontal-section">
            <div class="column grow">
                <div class="center-div">
                    <h1>Calendar</h1>
                </div>
                <div class="center-div">
                    <div class="month-div">
                        <?php
                        echo $calendar->getCalendarMonth();
                        echo (" ");
                        echo $calendar->getCalendarYear(); ?>
                    </div>
                </div>
                <div class="center-div">
                    <div class="horizontal-section-no-format grow">
                        <form method="post">
                            <input id="btn" type="submit" name="button-1-dec" value="<" class="btnL shift-left" />
                        </form>
                        <table class="calendar-table">
                            <thead>
                                <?php foreach ($calendar->getDayLabels() as $dayLabel): ?>
                                    <th class="calendar-heading">
                                        <div class="grow center-div">
                                            <?php echo $dayLabel; ?>
                                        </div>
                                    </th>
                                <?php endforeach; ?>
                            </thead>
                            <tbody>
                                <?php foreach ($calendar->getWeeks() as $week): ?>
                                    <tr>
                                        <?php foreach ($week as $day): ?>
                                            <td class="day-button"> <!-- onclick= post day then retrieve day  -->
                                                <div class="grow center-div <?php if ($calendar->isCurrentDate($day['dayNumber'])) {
                                                    echo ('text-focus');
                                                } ?>">
                                                    <span class="<?php if (!$day['currentMonth']) {
                                                        echo ('text-grey');
                                                    } ?>">
                                                        <?php echo $day['dayNumber']; ?>
                                                    </span>
                                                </div>
                                            </td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <form method="post">
                            <input id="btn" type="submit" name="button-2-inc" value=">" class="btnR shift-right" />
                        </form>
                    </div>
                </div>
                <div class="debug">
                    <?php
                    // Instantiate CurrentDate and DisplayDate objects
                    //$currentDate = new CurrentDate();
                    //$displayDate = new DisplayDate();
                    // Variable Watch
                    ?>
                    <?php
                        if (array_key_exists('button-1-dec', $_POST)) {
                            $_SESSION["Calendar"]=True;
                            echo("Button1 pressed, decrement month triggered");
                            if ($calendar->getCalendarMonth()==1){
                                $calendar->setMonth(12);
                                echo("month set to dec/12");
                            } else {
                                $calendar->setMonth($calendar->getCalendarMonth()-1);
                                echo("month subtracted 1");
                            }
                            //$calendar = new Calendar(new CurrentDate(), new DisplayDate());
                            //$calendar->create();  

                        } elseif (array_key_exists('button-2-inc', $_POST)) {
                            $_SESSION["Calendar"]=True;
                            echo("Button2 pressed increment month triggered");
                            if ($calendar->getCalendarMonth()==12){
                                $calendar->setMonth(1);
                                echo("month set to jan/1");
                            } else {
                                $calendar->setMonth($calendar->getCalendarMonth()+1);
                                echo("month set added 1");
                            }
                            //$calendar = new Calendar(new CurrentDate(), new DisplayDate());
                            //$calendar->create();
                        }
                        ?>
                    <div style="border: 1px solid #ccc; padding: 10px; margin-top: 10px;">
                        <h3>Variable Watch</h3>
                        <ul>
                            <li><strong>Display Date:</strong>
                                <ul>
                                    <li>Number of Days in Month: <?php echo $calendar->$displayDate->getMonthNumberDays(); ?></li>
                                    <li>Current Day Number: <?php echo $calendar->$displayDate->getCurrentDayNumber(); ?></li>
                                    <li>Month Number: <?php echo $calendar->$displayDate->getMonthNumber(); ?></li>
                                    <li>Month Name: <?php echo $calendar->$displayDate->getMonthName(); ?></li>
                                    <li>Year: <?php echo $calendar->$displayDate->getYear(); ?></li>
                                    <li>Start Day of Week: <?php echo $calendar->$displayDate->getMonthStartDayOfWeek(); ?></li>
                                </ul>
                            </li>
                            <li><strong>Current Date:</strong>
                                <ul>
                                    <li>Number of Days in Month: <?php echo($calendar->$currentDate->getMonthNumberDays()); ?></li>
                                    <li>Current Day Number: <?php echo($calendar->$currentDate->getCurrentDayNumber()); ?></li>
                                    <li>Month Number: <?php echo($calendar->$currentDate->getMonthNumber()); ?></li>
                                    <li>Month Name: <?php echo($calendar->$currentDate->getMonthName()); ?></li>
                                    <li>Year: <?php echo($calendar->$currentDate->getYear()); ?></li>
                                </ul>
                            </li>
                            <li><strong>Calendar Class</strong>
                                <ul>
                                    <li>Day Labels: <?php var_dump($calendar->getDayLabels()); ?></li>
                                    <li>Month Labels: <?php var_dump($calendar->getMonthLabels()); ?></li>
                                    <li>Calendar Month: <?php var_dump($calendar->getCalendarMonth()); ?></li>
                                    <li>Weeks: <?php var_dump($calendar->getWeeks()); ?></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="horizontal-section">
            <h1> Available Slots </h1>
        </div>
    </div>

</body>

</html>