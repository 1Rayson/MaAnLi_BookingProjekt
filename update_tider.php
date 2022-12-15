<?php
    session_start();
    if(!isset($_SESSION['userToken'])) header("location: index.php");
    
    include_once('classes/mySQL.php');
    include 'classes/calendar.php';

    $mySQL = new MySQL(true);

    $booking_id = $_REQUEST['booking_id'];
    $bookingDataQuery = "
        SELECT 
            examProject_bookings.room_id, 
            examProject_bookings.start_time, 
            examProject_bookings.end_time, 
            examProject_bookings.booking_day, 
            examProject_bookings.booking_description,
            examProject_rooms.* 
        FROM `examProject_bookings`
        INNER JOIN `examProject_rooms` ON examProject_rooms.id = examProject_bookings.room_id
        WHERE examProject_bookings.id = $booking_id;
    ";
    
    $bookingData = $mySQL->Query($bookingDataQuery)->fetch_object();
    
    list($startHour, $startMinute) = explode(':', $bookingData->start_time);
    list($endHour, $endMinute) = explode(':', $bookingData->end_time);
    
    $compareData = "
        SELECT
            booking_day,
            start_time,
            end_time,
            booking_description
        FROM `examProject_bookings`
        WHERE room_id = $bookingData->room_id
        AND booking_day = '$bookingData->booking_day'
        AND NOT id = $booking_id;
    ";
    
    $roomAvailability = $mySQL->Query($compareData);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="style.css">
    <link href="classes/calendar.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="floorplan.css">
    <title>Opdatér booking</title>
</head>
<body>
    <wrapper class="site-wrapper">

        <section id="pop-up-confirmation">
            <div id="centerPopUp">
                <div id="pop-up-header">
                    <img id="back-button" src="img/arrow-left-circle.svg" alt="Tilbage" onclick="popDown()">
                    <h1 id="pop-up-titel">Bekræft booking</h1>
                </div>
                <div id="pop-up-main-content"></div>
            </div>
        </section>

        <section id="header">
            <h1>Studierum booking</h1>
            <hr>
        </section>
        <section id="nav-content">
            <nav id="booking-nav-desktop">
                <a href="/mine_tider.php"><img src="img/arrow-left-circle.svg" alt=""></a>
            </nav>

            <article class="content">
                <section id="chosen-date-map">
                    <article>
                        <div onchange="updatePopUp()">
                            <h2><input id="date" type="date" value="<?php echo $bookingData->booking_day;?>"></h2> <!-- Dato -->
                            <form method="post">
                            <div class="time-picker-flex">
                                <label for="start_hour">Fra:</label>
                                <select id="start_hour" name="start_hour">
                                    <option value="01">1</option>
                                    <option value="02">2</option>
                                    <option value="03">3</option>
                                    <option value="04">4</option>
                                    <option value="05">5</option>
                                    <option value="06">6</option>
                                    <option value="07">7</option>
                                    <option selected="selected" value="08">8</option>
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
                            </div>
                            <div class="time-picker-flex">
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
                                    <option selected="selected" value="14">14</option>
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
                            </div>
                            </form>
                        </div>
                        <button id="update-time-submit" class="button-deactivated">Opdatér tid</button>
                    </article>
                    
                </section>
                <div id="room-info-availability">
                    <section id="room-info">
                        <h2>Lokale</h2>
                        <p><?php echo $bookingData->floorVariable. "." .$bookingData->roomNumber;  ?></p>
                        <h2>Faciliteter</h2>
                        <p id="capacity">Antal siddepladser:<?php echo $bookingData->capacity; ?> </p>
                        <p id="screen">Antal skærme:<?php echo $bookingData->screen; ?></p>
                        <p id="smartboard">Antal smartboard:<?php echo $bookingData->smartBoard; ?></p>
                    </section>
                    <section>
                        <h2>Reservationer på dagen</h2>
                        <div id="bookingsOnTheDay">
                            <?php
                                foreach($roomAvailability as $booking){
                                
                                    echo "
                                        <article class='booking-details'>
                                            <section class='date-time-location'>
                                                <p class='time-interval'>".$booking["start_time"]." - ".$booking["end_time"]."</p>
                                            </section>
                                            <section class='organizer'>
                                                <p id='description'>".$booking["booking_description"]."</p>
                                            </section>
                                        </article>
                                        <section class='divider'>
                                                <hr>
                                        </section>
                                    ";
                                }; 
                            ?>
                        </div>
                    </section>
                </div>
            </article>
        </section>
    </wrapper>
    <script>
        document.getElementById("start_hour").value ="<?php echo $startHour;?>";
        document.getElementById("start_minute").value ="<?php echo $startMinute;?>";
        document.getElementById("end_hour").value = "<?php echo $endHour;?>";
        document.getElementById("end_minute").value ="<?php echo $endMinute;?>";
    
        async function updatePopUp() {

            let updateTimeButton = document.getElementById('update-time-submit');
            let date = document.getElementById('date').value;
            let startHour = document.getElementById('start_hour').value;
            let startMinute = document.getElementById('start_minute').value;
            let endHour = document.getElementById('end_hour').value;
            let endMinute = document.getElementById('end_minute').value;

            let popUpHtml = `
                <form action="backend.php?action=update&booking_id=<?php echo $booking_id?>&room_id=<?php echo $bookingData->room_id?>" method="post">
                    <h2>Lokale</h2>
                    <div>
                        <input type="text" name="room_var" id="pop-up-room-var" value="<?php echo $bookingData->floorVariable?>" readonly>
                        .
                        <input type="number" name="room_number" id="pop-up-room-number" value="<?php echo $bookingData->roomNumber?>" readonly>
                    </div>
                    <h2>Dato</h2>
                    <input type="date" name="booking_date" value="${date}" readonly>
                    <h2>Tidsrum</h2>
                    <div id="timeIntervalFlex">
                        <input type="time" name="start_time" value="${startHour}:${startMinute}" readonly>
                        <p> - </p>
                        <input type="time" name="end_time" value="${endHour}:${endMinute}" readonly>
                    </div>
                    <h2>Booking beskrivelse</h2>
                    <input type="text" name="booking-description" id="booking-description-input" minlength="1" maxlength="50" value="<?php echo $bookingData->booking_description?>">
                    <br>
                    <input type="submit" id="pop-up-submit" value="Bekræft">
                </form>
            `;

            let fetchUrl = `/backend_floorplan.php?action=checkUpdateConflict&room_id=<?php echo $bookingData->room_id ?>&booking_id=<?php echo $booking_id?>&date=${date}&start_time=${startHour}:${startMinute}&end_time=${endHour}:${endMinute}`;
            
            fetch(fetchUrl)
                .then(res => res.json())
                .then(data => {

                    if(!data){
                        updateTimeButton.classList.remove("button-deactivated");
                        updateTimeButton.classList.add("button-activated");

                        updateTimeButton.addEventListener("click", function(){popUp()});
                    } else {
                        updateTimeButton.classList.remove("button-activated");
                        updateTimeButton.classList.add("button-deactivated");

                        updateTimeButton.removeEventListener("click", function(){popUp()});
                    }
                });
            
            document.getElementById("pop-up-main-content").innerHTML = popUpHtml;
        }
           
        // Gives display:block to pop-up-confirmation, making it visible and interactable
        function popUp(){
            document.getElementById("pop-up-confirmation").style.display = "flex";
        }

        // Gives display:none to pop-up-confirmation, making it invisible and uninteractable
        function popDown(){
            document.getElementById("pop-up-confirmation").style.display = "none";
        }
    </script>
</body>
</html>