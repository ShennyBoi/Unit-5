<link rel="stylesheet" href="../styles/nav.css">
<div class="total-nav-wrapper">
    <div class="column">
        <div class="login-text">
            <?php
            if (isset($_SESSION["firstName"])) {
                echo ("You are signed in as: ");
                echo ($_SESSION["firstName"]);
                echo (" ");
                echo ($_SESSION["lastName"]);
                echo (" (");
                if ($_SESSION["isAdmin"]) {
                    echo ("admin)");
                } else {
                    echo ("customer)");
                }
                if ($_SESSION["isAdmin"]) { ?>
                    <a href="/admin.php"><button>admin dashboard</button></a>
                <?php }
            } elseif (!isset($_SESSION["firstName"])) {
                echo ("You are not signed in. ");
                echo ("(Guest User)");
            }

            ?>
        </div>
        <div class="horizontal-section-container">
            <div class="left-div">
                <div class="logo-div">
                    <a href="/index.php">
                        <img src="./assets/nav-assets/MathArt.png" width="128px" height="128px" class="logo"
                            alt="logo" />
                    </a>
                </div>
            </div>
            <div class="nav-body-div">
                <div class="column grow">
                    <nav class="nav">
                        <div class="fifth"> <!-- each nav link takes 25% width -->
                            <a class="normal" href="/gallery.php"> <!-- TOTAL FIFTH LINK -->
                                <div class="column center-div nav-group"> <!-- column with on-hover -->
                                    <div class="center-div"> <!-- image center div -->
                                        <img class="nav-icon" src="../assets/nav-assets/image-gallery.svg" width="50px"
                                            height="50px" />
                                    </div>
                                    <div class="nav-text"><!-- text div to animate -->
                                        <div class="navigation-button">Gallery</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="divider">|</div>
                        <div class="fifth">
                            <a class="normal" href="/shop.php">
                                <div class="column center-div nav-group">
                                    <div class="center-div">
                                        <img class="nav-icon" src="../assets/nav-assets/shopping-cart.svg" width="50px"
                                            height="50px" />
                                    </div>
                                    <div class="nav-text">
                                        <div class="navigation-button">Shop</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="divider">|</div>
                        <div class="fifth">
                            <a class="normal" href="/index.php">
                                <div class="column center-div nav-group">
                                    <div class="center-div">
                                        <img class="nav-icon" src="../assets/nav-assets/home-icon.svg" width="50px"
                                            height="50px" />
                                    </div>
                                    <div class="nav-text">
                                        <div class="navigation-button">Home</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="divider">|</div>
                        <div class="fifth">
                            <a class="normal" href="/booking.php">
                                <div class="column center-div nav-group">
                                    <div class="center-div">
                                        <img class="nav-icon" src="../assets/nav-assets/calendar.svg" width="50px"
                                            height="50px" />
                                    </div>
                                    <div class="nav-text">
                                        <div class="navigation-button">Bookings</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="divider">|</div>
                        <div class="fifth">
                            <a class="normal" href="/profile.php">
                                <div class="column center-div nav-group">
                                    <div class="center-div">
                                        <img class="nav-icon" src="../assets/nav-assets/profile-icon.svg" width="50px"
                                            height="50px" />
                                    </div>
                                    <div class="nav-text">
                                        <div class="navigation-button">Profile</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div>
        <hr>
    </div>
</div>