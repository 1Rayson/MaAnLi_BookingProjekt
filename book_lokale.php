<?php
    session_start();
    if(!isset($_SESSION['userToken'])) header("location: login.php");

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
    <link href="calendar.css" type="text/css" rel="stylesheet" />
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

            <article class="content" onchange="activateButton()">
                <section id="calendar-container">
                    <h2>Vælg dag</h2>
                    <?php
                        // Insert calendar
                        $calendar = new Calendar();
                    
                        echo $calendar->show();
                    ?>
                </section>
                <section id="time-container">
                    <h2>Vælg tidsrum</h2>
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
                    <button id="submit-button">Tjek ledighed</button>
                </section>


                <!--<section id="my-bookings">
                    <article id="booking-headers">
                        <h2>Vælg dag</h2>
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
                                <input type="submit" id="update-submit" value="Opdatér">

                                <form action="backend-testing.php?action=insertTestPerson" method="post">

                                <input type="submit" value="Submit">

                                </form>
                                 $2y$10$WuWzwiMlbsWpg2vcqVio..IaWB30xoDbm4f944eR0Rb/8YLQf59I6
                                <a href="backend-testing.php" id="delete-submit">Slet</a>
                                <input type="submit" id="delete-submit" value="Slet">
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
                </section>-->
            </article>
        </section>
    </wrapper>
    <script src="calendar.js"></script>
    <script>

        /**
         * Set the date-variable to be the element with the class activeDate,
         * and set the starting time and ending time based on the elements with the corresponding id's
         * */
        let seeAvailButton = document.getElementById('submit-button');
        let date = document.getElementsByClassName('activeDate');
        let startHour = document.getElementById('start_hour').value;
        let startMinute = document.getElementById('start_minute').value;
        let endHour = document.getElementById('end_hour').value;
        let endMinute = document.getElementById('end_minute').value;

        seeAvailButton.classList.add("button-deactivated");
        
        /**
         * Then set location to be the date's id(the date), the start hour, start minute,
         * end hour and end minute to pass it along in the url for later use
         */
        function collectInfo(){
            console.log("collecting info");       
            window.location.href='room_availability.php?date='+ date[0].id
                +'&start-hour='+ startHour
                +'&start-minute='+ startMinute
                +'&end-hour='+ endHour
                +'&end-minute='+ endMinute
            ;
        }

        function activateButton (){
            let date = document.getElementsByClassName('activeDate');
            let startHour = document.getElementById('start_hour').value;
            let startMinute = document.getElementById('start_minute').value;
            let endHour = document.getElementById('end_hour').value;
            let endMinute = document.getElementById('end_minute').value;

            if(date[0]!=null && startHour!="" && startMinute!="" && endHour!="" && endMinute!=""){
                seeAvailButton.classList.remove("button-deactivated");
                seeAvailButton.classList.add("button-activated");

                seeAvailButton.addEventListener("click", function(){collectInfo()});
            } else {
                seeAvailButton.classList.remove("button-activated");
                seeAvailButton.classList.add("button-deactivated");

                seeAvailButton.removeEventListener("click", function(){collectInfo()});
            }
        }

    </script>
</body>
</html>