<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="floorplan.css">
    <title>Floorplan</title>
</head>
<body>
    <div id="size-definer">
        <div id="fixed-ratio">
            <div id="grid-wrapper">
                <div id="floor-s-grid">
                    <div id="rs30" class="room">S.30</div>
                    <div id="rs31" class="room">S.31</div>
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
                    <div id="r101" class="room">1.01</div>
                    <div id="r108" class="room">1.08</div>
                    <div id="wc11" class="unavailable">WC and stairs</div>
                    <div id="r112" class="room">1.12</div>
                    <div id="wc12" class="unavailable">WC and elevator</div>
                    <div id="r116" class="room">1.16</div>
                    <div id="r117" class="room">1.17</div>
                    <div id="r118" class="room">1.18</div>
                    <div id="r119" class="room">1.19</div>
                    <div id="r124" class="room">1.24</div>
                    <div id="wc13" class="unavailable">WC and stairs</div>
                    <div id="r127" class="room">1.27</div>
                    <div id="printer1" class="unavailable">Printer</div>
                    <div id="r128" class="room">1.28</div>
                    <div id="r132" class="room">1.32</div>
                    <div id="wc14" class="unavailable">WC and stairs</div>
                    <div id="r138" class="room">1.38</div>
                    <div id="r139" class="room">1.39</div>
                    <div id="r140" class="room">1.40</div>
                    <div id="r142" class="room">1.42</div>
                    <div id="r143" class="room">1.43</div>
                    <div id="r144" class="room">1.44</div>
                    <div id="hole1"></div>
                </div>
                <div id="floor-2-grid">
                    <div id="r201" class="room">2.01</div>
                    <div id="wc21" class="unavailable">WC and stairs</div>
                    <div id="r207" class="room">2.07</div>
                    <div id="r209" class="room">2.09</div>
                    <div id="service-desk" class="unavailable">Sevice Desk</div>
                    <div id="r211" class="room">2.11</div>
                    <div id="wc22" class="unavailable">WC and elevator</div>
                    <div id="r216" class="room">2.16</div>
                    <div id="r217" class="room">2.17</div>
                    <div id="r218" class="room">2.18</div>
                    <div id="r220" class="room">2.20</div>
                    <div id="r221" class="room">2.21</div>
                    <div id="r222" class="room">2.22</div>
                    <div id="wc23" class="unavailable">WC and stairs</div>
                    <div id="r225" class="room">2.25</div>
                    <div id="r226" class="room">2.26</div>
                    <div id="r231" class="room">2.31</div>
                    <div id="wc24" class="unavailable">WC and stairs</div>
                    <div id="r237" class="room">2.37</div>
                    <div id="r238" class="room">2.38</div>
                    <div id="r241" class="room">2.41</div>
                    <div id="hole2"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="switch-floor">
        <!-- calls the switchFloor function and specifies what floor -->
        <p id="ground-floor-btn" class="floor-btns" onclick="switchFloor(0)">Ground Floor</p>
        <p id="first-floor-btn" class="floor-btns" onclick="switchFloor(1)">First Floor</p>
        <p id="second-floor-btn" class="floor-btns" onclick="switchFloor(2)">Second Floor</p>
    </div>

    <script src="floorplan.js"></script>
</body>
</html>