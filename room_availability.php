<?php
    session_start();
    include 'classes/calendar.php';
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
    <title>Book Lokale</title>
</head>
<body>
    <wrapper class="site-wrapper">
        <section id="header">
            <h1>Studierum booking</h1>
            <hr>
        </section>
        <section id="nav-content">
            <nav id="booking-nav-desktop">
                <div class="nav-item active">
                    <div><h3>|</h3></div>
                    <a><h3>Book Lokale</h3></a>
                </div>
                <div class="nav-item">
                    <div><h3>|</h3></div>
                    <a href="mine_tider.php"><h3>Mine Tider</h3></a>
                </div>
                <h2 id="breadcrumb-nav-mobile">Book Lokale</h2>
            </nav>

            <article class="content">
                <section id="chosen-date-map">
                    <article>
                        <h2>24. november 2022</h2> <!-- Dato -->
                        <input type="submit" id="update-time-submit" value="Ændr tid"></input>
                    </article>
                    <h3>Torsdag, kl. 13:00 - 14:00</h3>
                    <div id="availability-map">KORT</div>
                </section>
                <section id="room-info">
                    <h2>Lokale</h2>
                    <p>(Vælg lokale)</p>
                    <h2>Faciliteter</h2>
                    <p>(Vælg lokale)</p>
                    <article id="book-btn">
                        <input type="submit" id="book-selected-room" value="Book"></input>
                    </article>

                </section>
                <section id="availability-calendar-section">
                    <table>
                        <thead class="availability-calendar-head">
                            <tr id="availability-head">
                                <th colspan="2">Ledighed</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="availability-time">8:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">9:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">10:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">11:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">12:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">13:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">14:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">15:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">16:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">17:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">18:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">19:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">20:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">21:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">22:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">23:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">24:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">1:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">2:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">3:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">4:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">5:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">6:00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="availability-time">7:00</td>
                                <td></td>
                            </tr>
                        </tbody>

                    </table>
                </section>
            </article>
        </section>
    </wrapper>
</body>
</html>