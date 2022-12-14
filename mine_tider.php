<?php
    session_start();
    include 'classes/calendar.php';
    include_once('classes/MySQL.php');
    // if(!isset($_SESSION['userToken'])) header("location: login.php");
    if($_SESSION['userToken'] === 0 || NULL) header("location: login.php");

    $mySQL = new MySQL(true);
    $user_id = $_SESSION['userToken'];

    $bookings = "SELECT * FROM examProject_bookings
                WHERE organizer_login_id = $user_id;";

    $bookings_result = $mySQL->Query($bookings);
    $formId = uniqid();
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
                    <article id="booking-headers">
                        <h3>Dato</h3>
                        <h3>Tidsrum</h3>
                        <h3>Lokale</h3>
                    </article>
                    <hr>
                    <article id="bookings">
                        <?php

                         while($row = $bookings_result->fetch_object()) {
                            echo '<form class="booking" action="backend.php?action=update" id="' . $row->booking_id . '">
                            <article class="booking-details">
                                <section class="date-time-location">
                                    <textarea class="booking_date" readonly>' . $row->booking_day . '</textarea>
                                    <article class="time-flex">
                                        <textarea class="start_time" readonly>' . $row->start_time . '</textarea>
                                        -
                                        <textarea class="end_time" readonly>' . $row->end_time . '</textarea>
                                    </article>
                                    <article class="room-flex">
                                        <textarea class="room_var">ID</textarea>
                                        .
                                        <textarea class="room_number">' . $row->room_id . '</textarea>
                                    </article>
                                </section>
                                <section class="organizer">
                                    <textarea class="booking_description">' . $row->booking_description . '</textarea>
                                </section>
                            </article>
                            <article class="update-delete-booking">
                                <input type="submit" class="update-submit" value="Opdatér">
                                <input type="submit" class="delete-submit" formaction="backend.php?action=delete" value="Slet">
                            </article>
                        </form>
                        <section class="divider">
                            <hr>
                        </section>';
                        }
                        ?>

                    </article>
                    <hr>
                </section>
            </article>
        </section>
    </wrapper>
</body>
</html>