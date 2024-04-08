<?php

//sets local timezone so that errors--
/* Fatal error: Uncaught exception 'Exception' with message 'DateTimeImmutable::__construct(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected the timezone 'UTC' for now, but please set date.timezone to select your timezone.' in E:\Unit 5 Project\UwAmp\www\includes\calendar.php on line 40
( ! ) Exception: DateTimeImmutable::__construct(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected the timezone 'UTC' for now, but please set date.timezone to select your timezone. in E:\Unit 5 Project\UwAmp\www\includes\calendar.php on line 40 */
//do not occur
date_default_timezone_set('Europe/London');

trait DateHelpers
{   //getters
    public function getMonthNumberDays()
    {
        return (int) $this->format('t');
    }

    public function getCurrentDayNumber()
    {
        return (int) $this->format('j');
    }

    public function getMonthNumber()
    {
        return (int) $this->format('n');
    }

    public function getMonthName()
    {
        return $this->format('M');
    }

    public function getYear()
    {
        return $this->format('Y');
    }
}

class CurrentDate extends DateTimeImmutable
{   // using getters

    use DateHelpers;

    public function __construct() // on creation, construct repalaces setter function 
    // - here it is doing something different,
    // constructing to the parent function
    {
        parent::__construct();
    }
}

class DisplayDate extends DateTime
{   // using getters

    use DateHelpers;

    public function __construct()
    {
        parent::__construct();
        $this->modify('first day of this month');
    }

    public function getMonthStartDayOfWeek()
    {
        return (int) $this->format('N');
    }
}

class Calendar
{
    public $currentDate;
    public $displayDate;

    /* 
    protected $shortDayLabels = [
        //'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
        'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'
    ];
    */
    protected $dayLabels = [
        //'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
        'Sun',
        'Mon',
        'Tue',
        'Wed',
        'Thu',
        'Fri',
        'Sat'
    ];
    protected $monthLabels = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    ];

    // Sunday shown as first day of week boolean
    protected $sundayFirst = true;
    protected $weeks = [];


    public function __construct(CurrentDate $currentDate, DisplayDate $displayDate)
    {
        $this->currentDate = $currentDate;
        $this->displayDate = clone $displayDate;
        $this->displayDate->modify('first day of this month');
    }

    public function getDayLabels()
    {
        return $this->dayLabels;
    }

    public function getMonthLabels()
    {
        return $this->monthLabels;
    }

    public function setSundayFirst($bool)
    {
        $this->sundayFirst = $bool;

        if (!$this->sundayFirst) {
            array_push($this->dayLabels, array_shift($this->dayLabels));
        }
    }

    //function to set the viewing month
    public function setMonth($monthNumber)
    {
        $this->displayDate->setDate($this->displayDate->getYear(), $monthNumber, 1);
    }

    public function getCalendarMonth()
    {
        return $this->displayDate->getMonthName();
    }
    public function getCalendarYear()
    {
        return $this->displayDate->getYear();
    }

    // function to get day of week month started on

    protected function getMonthFirstDay()
    {
        $day = $this->displayDate->getMonthStartDayOfWeek();

        if ($this->sundayFirst) {
            if ($day === 7) {
                return 1;
            }

            if ($day < 7) {
                return ($day + 1);
            }
        }

        return $day;
    }

    //current date boolean result for colouring today in calendar
    public function isCurrentDate($dayNumber)
    {
        if (
            $this->displayDate->getYear() === $this->currentDate->getYear() &&
            $this->displayDate->getMonthNumber() === $this->currentDate->getMonthNumber() &&
            $this->currentDate->getCurrentDayNumber() === $dayNumber
        ) {
            return true;
        }

        return false;
    }

    public function getWeeks()
    {
        return $this->weeks;
    }

    // this function creates the calendar
    public function create()
    {
        // sets the days array 
        $days = array_fill(0, ($this->getMonthFirstDay() - 1), ['currentMonth' => false, 'dayNumber' => '']); /* -1 because arrays are 0 based*/

        //current days
        for ($x = 1; $x <= $this->displayDate->getMonthNumberDays(); $x++) {
            $days[] = ['currentMonth' => true, 'dayNumber' => $x];
        }

        //this splits the array into multiple arrays (7, 1 for each day of the week)
        $this->weeks = array_chunk($days, 7);

        //arrays for each week in the calendar
        // last month
        $firstWeek = $this->weeks[0];
        $prevMonth = clone $this->displayDate;
        $prevMonth->modify('-1 month');
        $prevMonthNumDays = $prevMonth->getMonthNumberDays();

        for ($x = 6; $x >= 0; $x--) {
            if (!$firstWeek[$x]['dayNumber']) {
                $firstWeek[$x]['dayNumber'] = $prevMonthNumDays;
                $prevMonthNumDays -= 1;
            }
        }

        $this->weeks[0] = $firstWeek;

        //Next month
        $lastWeek = $this->weeks[count($this->weeks) - 1];
        $nextMonth = clone $this->displayDate;
        $nextMonth->modify('+1 month');

        $c = 1;
        for ($x = 0; $x < 7; $x++) {
            if (!isset($lastWeek[$x])) {
                $lastWeek[$x]['currentMonth'] = false;
                $lastWeek[$x]['dayNumber'] = $c;
                $c++;
            }
        }

        $this->weeks[count($this->weeks) - 1] = $lastWeek;
    }
    //end of create function
}
//Note there is a SET MONTH function in the calendar class!