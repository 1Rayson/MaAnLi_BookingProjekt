<?php
    session_start();
    if(!isset($_SESSION['userToken'])) header("location: index.php");
    if(!isset($_REQUEST['date'])
        &&!isset($_REQUEST['start-hour'])
        &&!isset($_REQUEST['start-minute'])
        &&!isset($_REQUEST['end-hour'])
        &&!isset($_REQUEST['end-minute'])
    ) header("location: book_lokale.php");

    include 'classes/calendar.php';

    //Request the selected values to get a date, plus a start- and end time
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
    <link rel="stylesheet" href="style.css">
    <link href="classes/calendar.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="floorplan.css">
    <title>Book Lokale</title>
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
                        <div onchange="activateButton()" id="time-div-on-change">
                            <h2><input id="date" type="date" value="<?php echo $date; ?>"></h2> <!-- Dato -->
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
                    <div id="switch-floor">
                        <p id="ground-floor-btn" class="floor-btns" onclick="switchFloor(0)">Ground Floor</p>
                        <p id="first-floor-btn" class="floor-btns" onclick="switchFloor(1)">First Floor</p>
                        <p id="second-floor-btn" class="floor-btns" onclick="switchFloor(2)">Second Floor</p>
                    </div>
                    <div id="size-definer">
                        <div id="fixed-ratio">
                            <div id="grid-wrapper">
                                <div id="floor-s-grid">
                                    <div id="30" class="room rs30">S.30</div>
                                    <div id="31" class="room rs31">S.31</div>
                                    <div id="wcs1" class="unavailable">WC and stairs</div>
                                    <div id="wcs2" class="unavailable">WC and elevator</div>
                                    <div id="wcs4" class="unavailable">WC and stairs</div>
                                    <div id="administration-area-1" class="unavailable"></div>
                                    <div id="administration-area-2" class="unavailable"></div>
                                    <div id="administration-area-3" class="unavailable"></div>
                                    <div id="administration-area-4" class="unavailable"></div>
                                    <div id="administration-area-5" class="unavailable"></div>
                                    <div id="printerS" class="unavailable">Printer</div>
                                    <div id="holeS"></div>
                                </div>
                                <div id="floor-1-grid">
                                    <div id="101" class="room r101">1.01</div>
                                    <div id="108" class="room r108">1.08</div>
                                    <div id="wc11" class="unavailable">WC and stairs</div>
                                    <div id="112" class="room r112">1.12</div>
                                    <div id="wc12" class="unavailable">WC and elevator</div>
                                    <div id="116" class="room r116">1.16</div>
                                    <div id="117" class="room r117">1.17</div>
                                    <div id="118" class="room r118">1.18</div>
                                    <div id="119" class="room r119">1.19</div>
                                    <div id="124" class="room r124">1.24</div>
                                    <div id="wc13" class="unavailable">WC and stairs</div>
                                    <div id="127" class="room r127">1.27</div>
                                    <div id="printer1" class="unavailable">Printer</div>
                                    <div id="128" class="room r128">1.28</div>
                                    <div id="132" class="room r132">1.32</div>
                                    <div id="wc14" class="unavailable">WC and stairs</div>
                                    <div id="138" class="room r138">1.38</div>
                                    <div id="139" class="room r139">1.39</div>
                                    <div id="140" class="room r140">1.40</div>
                                    <div id="142" class="room r142">1.42</div>
                                    <div id="143" class="room r143">1.43</div>
                                    <div id="144" class="room r144">1.44</div>
                                    <div id="hole1"></div>
                                </div>
                                <div id="floor-2-grid">
                                    <div id="201" class="room r201">2.01</div>
                                    <div id="wc21" class="unavailable">WC and stairs</div>
                                    <div id="207" class="room r207">2.07</div>
                                    <div id="209" class="room r209">2.09</div>
                                    <div id="service-desk" class="unavailable">Sevice Desk</div>
                                    <div id="211" class="room r211">2.11</div>
                                    <div id="wc22" class="unavailable">WC and elevator</div>
                                    <div id="216" class="room r216">2.16</div>
                                    <div id="217" class="room r217">2.17</div>
                                    <div id="218" class="room r218">2.18</div>
                                    <div id="220" class="room r220">2.20</div>
                                    <div id="221" class="room r221">2.21</div>
                                    <div id="222" class="room r222">2.22</div>
                                    <div id="wc23" class="unavailable">WC and stairs</div>
                                    <div id="225" class="room r225">2.25</div>
                                    <div id="226" class="room r226">2.26</div>
                                    <div id="231" class="room r231">2.31</div>
                                    <div id="wc24" class="unavailable">WC and stairs</div>
                                    <div id="237" class="room r237">2.37</div>
                                    <div id="238" class="room r238">2.38</div>
                                    <div id="241" class="room r241">2.41</div>
                                    <div id="hole2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <button id="book-selected-room" class="button-deactivated">Book</button>
                </div>
            </article>
        </section>
    </wrapper>
    <script src="floorplan.js"></script>
    <script>
        let opdateButton = document.getElementById('update-time-submit');

        function activateButton (){
            opdateButton.classList.remove("button-deactivated");
            opdateButton.classList.add("button-activated");

            opdateButton.addEventListener("click", function(){opdateTime()});
        }

        function opdateTime (){
            checkAvailability()
            
            opdateButton.classList.remove("button-activated");
            opdateButton.classList.add("button-deactivated");

            opdateButton.removeEventListener("click", function(){opdateTime()});
        }
    </script>
</body>
</html>