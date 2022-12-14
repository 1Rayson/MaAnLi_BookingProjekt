<?php
    session_start();
    if(!isset($_SESSION['userToken'])) header("location: login.php");
    
    include 'classes/calendar.php';

    $date = $_REQUEST['date'];
    $startHour = $_REQUEST['start-hour'];
    $startMinute = $_REQUEST['start-minute'];
    $endHour = $_REQUEST['end-hour'];
    $endMinute = $_REQUEST['end-minute'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="style-anders.css">
    <link href="calendar.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="floorplan.css">
    <title>Opdatér booking</title>
</head>
<body>
    <wrapper class="site-wrapper">
        <section id="pop-up-confirmation">
            <div id="pop-up-header">
                <img id="back-button" src="img/arrow-left-circle.svg" alt="Tilbage" onclick="popDown()">
                <h1 id="pop-up-titel">Bekræft booking</h1>
            </div>
            <div id="pop-up-main-content"></div>
        </section>
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
                        <div>
                            <h2><input id="date" type="date" value="<?php echo $date; ?>"></h2> <!-- Dato -->
                            <h3>
                                <form method="post">
                                    <label for="start_hour">Fra:</label>
                                    <select id="start_hour" name="start_hour">
                                    <option value="01">1</option>
                                    <option value="02">2</option>
                                    <option value="03">3</option>
                                    <option value="04">4</option>
                                    <option value="05">5</option>
                                    <option value="06">6</option>
                                    <option value="07">7</option>
                                    <option value="08">8</option>
                                    <option value="09">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    </select>
                                    <p>:</p>
                                    <select id="start_minute" name="start_minute">
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                    </select>
                                    <label for="end_time">Til:</label>
                                    <select id="end_hour" name="end_hour">
                                    <option value="01">1</option>
                                    <option value="02">2</option>
                                    <option value="03">3</option>
                                    <option value="04">4</option>
                                    <option value="05">5</option>
                                    <option value="06">6</option>
                                    <option value="08">8</option>
                                    <option value="09">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    </select>
                                    <p>:</p>
                                    <select id="end_minute" name="end_minute">
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                    </select>
                                </form>
                            </h3>
                        </div>
                        <button id="update-time-submit" onclick="checkAvailability()">Opdatér tid</button>
                    </article>
                    
                </section>
                <div id="room-info-availability">
                    <section id="room-info">
                        <h2>Lokale</h2>
                        <p>(Vælg lokale)</p>
                        <h2>Faciliteter</h2>
                        <p>(Vælg lokale)</p>
                    </section>
                    <section id="bookingsOnTheDay">
                        
                    </section>
                    <button id="book-selected-room" onclick="popUp()">Book</button>
                </div>
            </article>
        </section>
    </wrapper>
    <script src="floorplan.js"></script>
</body>
</html>