<?php
    session_start();
    include 'calendar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="style-anders.css">
    <link href="calendar-temp.css" type="text/css" rel="stylesheet" />
    <title>Mine Tider</title>
</head>
<body>
    <wrapper class="site-wrapper">
        <section id="header">
            <h1>Studierum booking</h1>
            <hr>
        </section>
        <section id="nav-content">
            <nav id="booking-nav-desktop">
                <div class="nav-item">
                    <div><h3>|</h3></div>
                    <a href="book_lokale.php"><h3>Book Lokale</h3></a>
                </div>
                <div class="nav-item active">
                    <div><h3>|</h3></div>
                    <a><h3>Mine Tider</h3></a>
                </div>
                <h2 id="breadcrumb-nav-mobile">Mine Tider</h2>
            </nav>

            <article class="content row-reverse">
                <?php
                $calendar = new Calendar();
                
                echo $calendar->show();
                ?>
                <section id="my-bookings">
                    <form action="backend-testing.php?action=insertTestPerson" method="post">
                                    <label for="email">
                                        Email
                                        <input type="text" name="email" placeholder="Email">
                                    </label>
                                    <label for="password">
                                        Password
                                        <input type="text" name="password" placeholder="Password">
                                    </label>
                                    <label for="fullName">
                                        Full Name
                                        <input type="text" name="fullName" placeholder="Full Name">
                                    </label>
                                    <label for="schoolInitials">
                                        School Initials
                                        <input type="text" name="schoolInitials" placeholder="School Initials">
                                    </label>
                                <input type="submit" value="Submit">
                                </form>
                    <article id="booking-headers">
                        <h3>Dato</h3>
                        <h3>Tidsrum</h3>
                        <h3>Lokale</h3>
                    </article>
                    <hr>
                    <article id="bookings">
                        <section class="booking">
                            <article class="booking-details">
                                <section class="date-time-location">
                                    <p>24/11-22</p>
                                    <p>08:30-12:30</p>
                                    <p>1.16</p>
                                </section>
                                <section class="organizer">
                                    <p>Maanli -  Tværfagligt projekt - gruppe arbejde</p>
                                </section>
                            </article>
                            <article class="update-delete-booking">
                                <a href="backend-testing.php" id="update-submit">Opdatér</a>
                                <!--<input type="submit" id="update-submit" value="Opdatér">-->

                                <!-- $2y$10$WuWzwiMlbsWpg2vcqVio..IaWB30xoDbm4f944eR0Rb/8YLQf59I6 -->
                                <a href="backend-testing.php" id="delete-submit">Slet</a>
                                <!--<input type="submit" id="delete-submit" value="Slet">-->
                            </article>
                        </section>
                        <section class="divider">
                            <hr>
                        </section>
                        <section class="booking">
                            <article class="booking-details">
                                <section class="date-time-location">
                                    <p>25/11-22</p>
                                    <p>09:30-14:00</p>
                                    <p>1.40</p>
                                </section>
                                <section class="organizer">
                                    <p>Maanli -  Tværfagligt projekt - gruppe arbejde</p>
                                </section>
                            </article>
                            <article class="update-delete-booking">
                                <input type="submit" id="update-submit" value="Opdatér">
                                <input type="submit" id="delete-submit" value="Slet">
                            </article>
                        </section>
                    </article>
                    <hr>
                </section>
            </article>
        </section>
    </wrapper>
</body>
</html>