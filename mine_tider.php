<?php
    session_start();
    if(!isset($_SESSION['userToken'])) header("location: login.php");
    
    include 'classes/calendar.php';
    include_once('classes/MySQL.php');
    
    if($_SESSION['userToken'] === 0 || NULL) header("location: login.php");

    $mySQL = new MySQL(true);
    $user_id = $_SESSION['userToken'];

    
    // 
    // Read own bookings
    // 
    $bookings = "SELECT * FROM examProject_bookings
                WHERE organizer_login_id = $user_id;";

    $bookings_result = $mySQL->Query($bookings);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="style-anders.css">
    <link href="classes/calendar.css" type="text/css" rel="stylesheet" />
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
                // Insert Calendar
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
                        // While there's rows in the select query, fetch the object and insert its data into the template below - then echo to the user
                        while($row = $bookings_result->fetch_object()) {
                            echo '<form class="booking" action="backend.php?action=delete" method="post" name="book_id' . $row->id . '">
                            <article class="booking-details">
                                <section class="date-time-location">
                                    <input type="text" class="booking_date" name="booking_date" value="' . $row->booking_day . '" readonly>
                                    <article class="time-flex">
                                        <input type="text" class="start_time" name="start_time" value="' . $row->start_time . '" readonly>
                                        -
                                        <input type="text" class="end_time" name="end_time" value="' . $row->end_time . '" readonly>
                                    </article>
                                    <article class="room-flex" >
                                        <input type="text" class="room_var" readonly>ID</input>
                                        .
                                        <input type="text" class="room_number" name="room_number" value="' . $row->room_id . '" readonly>
                                    </article>
                                </section>
                                <section class="organizer">
                                    <input type="text" class="booking_description" name="booking_description" value="' . $row->booking_description . '" readonly>
                                    <input type="text" class="booking_id" name="booking_id" value="' . $row->id . '" readonly>
                                </section>
                            </article>
                            <article class="update-delete-booking">
                                <input type="submit" class="update-submit" formaction="update_tider.php?booking_id='. $row->id . '" value="Opdatér">
                                <input type="submit" class="delete-submit" value="Slet">
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