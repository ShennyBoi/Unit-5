    /*public function decrementCalendarMonth()
    {
        $currentMonth = $this->displayDate->getMonthNumber();
        if ($currentMonth == 1) {
            $this->displayDate->setDate($this->displayDate->getYear() - 1, 12, 1);
        } else {
            $this->displayDate->setDate($this->displayDate->getYear(), $currentMonth - 1, 1);
        }
    }

    public function incrementCalendarMonth()
    {
        $currentMonth = $this->displayDate->getMonthNumber();
        if ($currentMonth == 12) {
            $this->displayDate->setDate($this->displayDate->getYear() + 1, 1, 1);
        } else {
            $this->displayDate->setDate($this->displayDate->getYear(), $currentMonth + 1, 1);
        }
    }*/


    <div class="debug">
    <?php
    // Instantiate CurrentDate and DisplayDate objects
    $currentDate = new CurrentDate();
    $displayDate = new DisplayDate();
    // Variable Watch
    ?>
    <?php
        if (array_key_exists('button-1-dec', $_POST)) {
            echo("Button1 pressed, decrement month triggered");
            if ($calendar->getCalendarMonth()==1){
                $calendar->setMonth(12);
                echo("month set do dec/12");
            } else {
                $calendar->setMonth($calendar->getCalendarMonth()-1);
                echo("month subtracted 1");
            }
            $calendar = new Calendar(new CurrentDate(), new DisplayDate());
            $calendar->create();

        } else if (array_key_exists('button-2-inc', $_POST)) {
            echo("Button2 pressed increment month triggered");
            if ($calendar->getCalendarMonth()==12){
                $calendar->setMonth(1);
                echo("month set to jan/1");
            } else {
                $calendar->setMonth($calendar->getCalendarMonth()+1);
                echo("month set added 1");
            }
            $calendar = new Calendar(new CurrentDate(), new DisplayDate());
            $calendar->create();
        }
        ?>
    <div style="border: 1px solid #ccc; padding: 10px; margin-top: 10px;">
        <h3>Variable Watch</h3>
        <ul>
            <li><strong>Display Date:</strong>
                <ul>
                    <li>Number of Days in Month: <?php echo $displayDate->getMonthNumberDays(); ?></li>
                    <li>Current Day Number: <?php echo $displayDate->getCurrentDayNumber(); ?></li>
                    <li>Month Number: <?php echo $displayDate->getMonthNumber(); ?></li>
                    <li>Month Name: <?php echo $displayDate->getMonthName(); ?></li>
                    <li>Year: <?php echo $displayDate->getYear(); ?></li>
                    <li>Start Day of Week: <?php echo $displayDate->getMonthStartDayOfWeek(); ?></li>
                </ul>
            </li>
            <li><strong>Current Date:</strong>
                <ul>
                    <li>Number of Days in Month: <?php echo($currentDate->getMonthNumberDays()); ?></li>
                    <li>Current Day Number: <?php echo($currentDate->getCurrentDayNumber()); ?></li>
                    <li>Month Number: <?php echo($currentDate->getMonthNumber()); ?></li>
                    <li>Month Name: <?php echo($currentDate->getMonthName()); ?></li>
                    <li>Year: <?php echo($currentDate->getYear()); ?></li>
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

<!-- < ?php if (!$day['currentMonth']){echo('unclickable');}?> -->

                                        <!--
                                            <td < ?php if (!$day['currentMonth']): ?> class="text-grey" < ?php endif; ?>>
                                                <span < ?php if ($calendar->isCurrentDate($day['dayNumber'])): ?>
                                                        class="text-focus" < ?php endif; ?>>
                                        -->
                                        <!--
                                                <div class="full-width">
                                                    <button class="day-button grow">
                                                        <div class="button-text">
                                                        </div>
                                                    </button>
                                                </div>
                                        -->


        NAV ADMIN CHECK DEBUG
                 elseif($_SESSION["isAdmin"]==1) {
                    echo ("admin, by int)");
                } else{
                    echo ("normal user)");
                    echo ("admin value:");
                    var_dump($_SESSION["isAdmin"]);
                }

        PASSWORD VERIFICATION FROM HASH


    password_verify($userentry,$storedpassword)

        #$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    #or die($conn->error)



    //WHERE username = '$username' AND password = '$hashword' ";

/\* class="hover-underline-animation"
.hover-underline-animation {
display: inline-block;
position: relative;
color: #0087ca;
}

.hover-underline-animation:after {
content: '';
position: absolute;
width: 100%;
transform: scaleX(0);
height: 2px;
bottom: 0;
left: 0;
background-color: #0087ca;
transform-origin: bottom right;
transition: transform 0.25s ease-out;
}

.hover-underline-animation:hover:after {
transform: scaleX(1);
transform-origin: bottom left;
}
class="hover-underline-animation" \*/

                    <!--
                <div class="top-nav">
                    <div class="left-div">
                        <div class="back-icon" onclick="history.back()">
                            <img src="./assets/nav-assets/back-circle.svg" width="50px" height="50px">
                        </div>
                    </div>
                    <div class="right-div">
                        <div class="profile-icon">
                            <a href="/profile.php">
                                <img src="../assets/nav-assets/profile-icon.svg" width="50px" height="50px" />
                            </a>
                        </div>
                    </div>
                </div>-->

/_
.navigation-button:hover:before,
.navigation-button:hover:after
{
-webkit-backface-visibility: hidden;
backface-visibility: hidden;
border-color: #000000;
transition: width 350ms ease-in-out;
width: 70%;
}
.navigation-button:hover:before {
bottom: auto;
top: 0;
width: 70%;
}
.navigation-button:hover {
text-decoration: underline;
}
_/
/\*.navigation-button:hover,
.navigation-button:active {

    letter-spacing: 5px;

}
.navigation-button:before,\*/

    <script>
        function isPresent() {

            const formData = new FormData(document.getElementById("loginForm"))

            const user = formData.get("user")
            const pass = formData.get("pass")
            if ((user.length === 0) && (pass.length === 0)) {
                alert("Username and Password fields are empty.");
                return false
            }
            else {
                if (user.length === 0) {
                    alert("Username field is empty");
                    return false
                }
                if (pass.length === 0) {
                    alert("Password field is empty");
                    return false
                }
            }
        }
    </script>

<?php
    /*
    if (empty($_POST["FirstName"])) {
       die("first name is required");
    }

    if (!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) {
       die("Valid email is required");
    }

    if (strlen($_POST['Password']) < 8) {
       die("Password must be at least 8 characters");
    }

    if (!preg_match("/[a-z]/i", $_POST["Password"])) {
       die("Password must contain at least one letter");
    }

    if (!preg_match("/[0-9]/i", $_POST["Password"])) {
       die("Password must contain at least one number");
    }
    */
    ?>

<script>
        function isPresent() {
            const formData = new FormData(document.getElementById("loginForm"))

            const user = formData.get("user")
            const pass = formData.get("pass")
            if ((user.length === 0) && (pass.length === 0)) {
                //alert("Username and Password fields are empty.");
                return false
            }
            else {
                if (user.length === 0) {
                    //alert("Username field is empty");
                    return false
                }
                if (pass.length === 0) {
                    //alert("Password field is empty");
                    return false
                }
            }
        }
    </script>

/\* _/
/_ _/
/_ COPY PASTE _/
/_ _/
/_ \* /
body {
font-family: Arial, sans-serif;
background: url(http://www.shukatsu-note.com/wp-content/uploads/2014/12/computer-564136_1280.jpg) no-repeat;
background-size: cover;
height: 100vh;
}

h1 {
text-align: center;
font-family: Tahoma, Arial, sans-serif;
color: #06D85F;
margin: 80px 0;
}

.box {
width: 40%;
margin: 0 auto;
background: rgba(255,255,255,0.2);
padding: 35px;
border: 2px solid #fff;
border-radius: 20px/50px;
background-clip: padding-box;
text-align: center;
}

.button {
font-size: 1em;
padding: 10px;
color: #fff;
border: 2px solid #06D85F;
border-radius: 20px/50px;
text-decoration: none;
cursor: pointer;
transition: all 0.3s ease-out;
}
.button:hover {
background: #06D85F;
}

        <!--
        <button class="tablinks" onclick="openTab(event, 'UserAccounts')" id="defaultOpen">UserAccounts</button>
        <button class="tablinks" onclick="openTab(event, 'Bookings')">Bookings</button>
        <button class="tablinks" onclick="openTab(event, 'Products')">Products</button>
        <button class="tablinks" onclick="openTab(event, 'Sales')">Sales</button>
        <button class="tablinks" onclick="openTab(event, 'Orders')">Orders</button>
        -->


            foreach ($tableNames as $tableTitle) {
        $tableTitle = $tableTitle["table_name"]; ?>
        <?php echo ($tableTitle); ?>

        <br>
        <?php $getColumnNamesQuery = "SELECT column_name
                FROM information_schema.columns
                WHERE table_schema = 'mathartdb'
                AND table_name = '$tableTitle';";
        $columnNames = mysqli_query($conn, $getColumnNamesQuery);
        foreach ($columnNames as $columnTitle) {
            $columnTitle = $columnTitle["column_name"]; ?>
            <?php echo ("...."); ?>
            <?php echo ($columnTitle); ?>
            <br>
            <?php
        }
        ?>
    <?php }





        <!-- Old tab content -->

    <div id="UserAccounts" class="tabcontent">
        <h3>User Accounts</h3>
        <!-- user accounts table -->
        <table>
            <tr>
                <?php
                $fieldArray = array("userID", "username", "email", "firstName", "lastName", "isAdmin");

                foreach ($fieldArray as $fieldHead) { ?>
                    <th>
                        <?php echo ($fieldHead); ?>
                    </th>

                <?php } ?>
            </tr>
            <?php

            $sqlSelect = "SELECT * FROM userAccounts";
            $result = mysqli_query($conn, $sqlSelect);
            if ($result->num_rows > 0) {
                while ($recordArr = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <?php
                        foreach ($fieldArray as $fieldData) { ?>
                            <td>
                                <?php echo ($recordArr[$fieldData]); ?>
                            </td>
                        <?php } ?>
                    </tr>
                <?php }
            } else {
                echo "0 results";
            }
            ?>
        </table>
    </div>

    <!-- Tab 2 content -->
    <div id="Bookings" class="tabcontent">
        <h3>Bookings</h3>
        <p>Bookings table.</p>
        <?php
        $sqlSelect = "SELECT * FROM bookings";
        $result = mysqli_query($conn, $sqlSelect);
        while ($recordArr = mysqli_fetch_assoc($result)) {
            ?>
            <div class="">
                <div class="">
                    <?php
                    //echo($recordArr[""])
                    var_dump($recordArr); ?>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Tab 3 content -->
    <div id="Products" class="tabcontent">
        <h3>Products</h3>
        <p>Products table.</p>
        <?php
        $sqlSelect = "SELECT * FROM products";
        $result = mysqli_query($conn, $sqlSelect);
        while ($recordArr = mysqli_fetch_assoc($result)) {
            ?>
            <div class="">
                <div class="">
                    <?php
                    //echo($recordArr[""])
                    var_dump($recordArr); ?>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Tab 4 content -->
    <div id="Sales" class="tabcontent">
        <h3>Sales</h3>
        <p>Sales table.</p>
        <?php
        $sqlSelect = "SELECT * FROM sales";
        $result = mysqli_query($conn, $sqlSelect);
        while ($recordArr = mysqli_fetch_assoc($result)) {
            ?>
            <div class="">
                <div class="">
                    <?php
                    //echo($recordArr[""])
                    var_dump($recordArr); ?>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Tab 5 content -->
    <div id="Orders" class="tabcontent">
        <h3>Orders</h3>
        <p>Orders table.</p>
    </div>
    <?php
    $sqlSelect = "SELECT * FROM orders";
    $result = mysqli_query($conn, $sqlSelect);
    while ($recordArr = mysqli_fetch_assoc($result)) {
        ?>
        <div class="">
            <div class="">
                <?php
                //echo($recordArr[""])
                var_dump($recordArr); ?>
            </div>
        </div>
    <?php } ?>



    /*else {

$password = input_data($\_POST["pass"]);
if (!preg*match("/^[a-zA-Z]*$/", $password)) {
$passwordErr = "Only letters and spaces permitted";
}
// if there are no errors, redirect to
}\_/

/_else {
$username = input_data($\_POST["user"]);
if (!preg_match("/^[a-zA-Z]_$/", $username)) {
$usernameErr = "Only letters and spaces permitted";
}
}\*/

<!--

OLD INPUT FIELDS

                    <div class="row margin" for="fName">
                        <label for="fName" class="mono">First Name:</label>
                        <input class="input" type="text" id="fName" name="fName" placeholder="first name">
                    </div>

                    <div class="row margin" for="lName">
                        <label for="lName" class="mono">Last Name:</label>
                        <input class="input" type="text" id="lName" name="lName" placeholder="last name">
                    </div>
                    <div class="row margin" for="email">
                        <label for="email" class="mono">Email:</label>
                        <input class="input" type="text" id="email" name="email" placeholder="example@mathart.uk">
                    </div>
                    <div class="row margin" for="username">
                        <label for="username" class="mono">Username:</label>
                        <input class="input" type="text" id="user" name="user" placeholder="username">
                    </div>
                    <div class="row margin" for="password1">
                        <label for="password1" class="mono">Password:</label>
                        <input class="input" type="password" id="pass1" name="pass1" placeholder="password">
                    </div>
                    <div class="row margin" for="password2">
                        <label for="password2" class="mono">Confirm Password:</label>
                        <input class="input" type="password" id="pass2" name="pass2" placeholder="confirm password">
                    </div>


-->

/\*
.material-bubble {
background-color: transparent;
color: #1b1b20;
border: none;
overflow: hidden;
box-shadow: none;
}
.material-bubble:hover {
color: #e6e6e6;
}
.material-bubble::before {
content: "";
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
border: 3px solid #1b1b20;
transition: opacity 0.3s, border 0.3s;
}
.material-bubble:hover::before {
opacity: 0;
}
.material-bubble::after {
content: "";
position: absolute;
top: 0;
left: 0;
width: 200px;
height: 200px;
background-color: #494958;
border-color: transparent;
border-radius: 50%;
transform: translate(-10px, -70px) scale(0.1);
opacity: 0;
z-index: -1;
transition: transform 0.3s, opacity 0.3s, background-color 0.3s;
}
.material-bubble:hover::after {
opacity: 1;
transform-origin: 100px 100px;
transform: scale(1) translate(-10px, -70px);
}

  <?php
include("connAct.php");

if ( (isset($_POST["user"]) and (isset($_POST["pass"])) ) ) {
    $username = $_POST["user"];
    $password = $_POST["pass"];

    $hashword = password_hash($password, PASSWORD_DEFAULT);

    $sqlSelect = "SELECT * FROM useraccounts ";
    $result = mysqli_query($conn, $sqlSelect);

    $_SESSION["loggedIn"] = False;

    while ($row = mysqli_fetch_assoc($result)) {
        if ((($row["username"]) == $username) and (password_verify($password, $row["password"]))) {
            $_SESSION["loggedIn"] = True;

            $_SESSION["userID"] = $row['userID'];
            $_SESSION["username"] = $row["username"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["isAdmin"] = $row["isAdmin"];
            $_SESSION["firstName"] = $row["firstName"];
            $_SESSION["lastName"] = $row["lastName"];

            break;
        }
    }
    if ($_SESSION["loggedIn"] == True) {
        echo '<script> alert("Login Success!") </script>';
        header("Location:../profile.php");
    } else {
        echo '<script> alert("Nope") </script>';
        header("Location:../login.php");
    }
    /* improve response on login sucess/fail AND REGISTER */
} else {echo("error with session");}




<script>

    /**Define validation and verification checks here. In javascript.*/
                
                //  OLD PRESENCE VALIDATION 

                function isPresent() {

                    const formData = new FormData(document.getElementById("registerForm"))

                    const fName = formData.get("fName")
                    const lName = formData.get("lName")
                    const email = formData.get("email")
                    const user = formData.get("user")
                    const pass1 = formData.get("pass1")
                    const pass2 = formData.get("pass2")

                    if (fName.length === 0) {
                        alert("First name field is empty!");
                        return false
                    }
                    if (lName.length === 0) {
                        alert("Last name field is empty!");
                        return false
                    }
                    if (email.length === 0) {
                        alert("Email field is empty!");
                        return false
                    }
                    if (user.length === 0) {
                        alert("Username name field is empty!");
                        return false
                    }
                    if (pass1.length === 0 || pass2.length === 0) {
                        alert("A password field is empty!");
                        return false
                    }

                // END OF PRESENCE VALIDATION 
                

                // LENGTH VALIDATION 
                }
                function lengthCheck() {

                    const formData = new FormData(document.getElementById("registerForm"))

                    const fName = formData.get("fName")
                    const lName = formData.get("lName")
                    const email = formData.get("email")
                    const user = formData.get("user")
                    const pass1 = formData.get("pass1")
                    const pass2 = formData.get("pass2")

                    /** only really need to check pass1 if we are double keying later*/
                    /** but do both for runtime efficiency over code conciseness */

                    if (((fName.length) > 100) || ((lName).length > 100)) {
                        alert("First/Last name must be under 100 characters long.");
                        return false
                    }
                    if ((email).length > 256) {
                        alert("Email must be under 256 characters long.");
                        return false
                    }
                    if ((user).length > 256) {
                        alert("Username cannot be over 256 characters.");
                        return false
                    }
                    if (((pass1).length < 7) || ((pass2).length < 7)) {
                        alert("passwords must be more than 7 characters long");
                        return false
                    }
                    if (((pass1).length > 100) || ((pass2).length > 100)) {
                        alert("passwords must be less than 100 characters long");
                        return false
                    }
                }



                /** DOUBLE KEY verification */
                function doubleKey() {

                    const formData = new FormData(document.getElementById("registerForm"))

                    const pass1 = formData.get("pass1")
                    const pass2 = formData.get("pass2")

                    if (pass1 != pass2) {
                        alert("Passwords do not match!");
                        return false
                    }
                }
                function isValid() {
                    if ((isPresent() === false) || (lengthCheck() === false) || (doubleKey() === false)) {
                        return false
                    }
                    else {
                        return true
                    }
                }
                                                                                                    console.log(lName)
                                                                                                    console.log(email)
                                                                                                    console.log(user)
                                                                                                    console.log(pass1)
                                                                                                    console.log(pass2)*/

            </script>

-----------------GENERAL POPUP FORMAT-----------------

<a href="#POPUP-ID"></a>
<div id="POPUP ID" class="overlay">
    <div class="popup">
        <h2>title</h2>
        <a class="close" href="#">&times;</a>
        <div class="content">
        </div>
    </div>
    <div class="popup-footer">
    </div>
</div>


CODE FOR CHECK ALL CHECKBOX

<script language="JavaScript">
function toggle(source) {
  checkboxes = document.getElementsByName('foo');
  for(var checkbox in checkboxes)
    checkbox.checked = source.checked;
}
</script>

<input type="checkbox" onClick="toggle(this)" /> Toggle All<br/>

<input type="checkbox" name="foo" value="bar1"> Bar 1<br/>
<input type="checkbox" name="foo" value="bar2"> Bar 2<br/>
<input type="checkbox" name="foo" value="bar3"> Bar 3<br/>
<input type="checkbox" name="foo" value="bar4"> Bar 4<br/>

                    //  Shop filter  Brainstorming
                    //  if .$sqlSearch.$sqlSort.$sqlFilter not set, 
                    //      if method is post and post functions are set
                    //          get .$sqlSearch.$sqlSort.$sqlFilter from $_POST
                    //      else if $_SESSION variables are set
                    //          get .$sqlSearch.$sqlSort.$sqlFilter from $_SESSION
                    //  else if they are set, 
                    //      if $_SESSION variables are not set, set them as session variables
                    //


    <script>
        function isPresent() {
  
            const formData = new FormData(document.getElementById("loginForm"))
  
            const user = formData.get("user")
            const pass = formData.get("pass")
            if ((user.length === 0) && (pass.length === 0)) {
                alert("Username and Password fields are empty.");
                return false
            }
            else {
                if (user.length === 0) {
                    alert("Username field is empty");
                    return false
                }
                if (pass.length === 0) {
                    alert("Password field is empty");
                    return false
                }
            }
        }
    </script>
