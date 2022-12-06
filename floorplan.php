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
                    <div id="rS30">S.30</div>
                    <div id="rS31">S.31</div>
                    <div id="wcS1" class="unavailable">WC and stairs</div>
                    <div id="wcS2" class="unavailable">WC and elevator</div>
                    <div id="wcS4" class="unavailable">WC and stairs</div>
                    <div id="administration-area-1" class="unavailable"></div>
                    <div id="administration-area-2" class="unavailable"></div>
                    <div id="administration-area-3" class="unavailable"></div>
                    <div id="administration-area-4" class="unavailable"></div>
                    <div id="administration-area-5" class="unavailable"></div>
                    <div id="printerS" class="unavailable">Printer</div>
                    <div id="holeS"></div>
                </div>
                <div id="floor-1-grid">
                    <div id="r101" class="partly-available">1.01</div>
                    <div id="r108" class="unavailable">1.08</div>
                    <div id="wc11" class="unavailable">WC and stairs</div>
                    <div id="r112" class="unavailable">1.12</div>
                    <div id="wc12" class="unavailable">WC and elevator</div>
                    <div id="r116" class="available">1.16</div>
                    <div id="r117" class="partly-available">1.17</div>
                    <div id="r118" class="partly-available">1.18</div>
                    <div id="r119">1.19</div>
                    <div id="r124">1.24</div>
                    <div id="wc13" class="unavailable">WC and stairs</div>
                    <div id="r127">1.27</div>
                    <div id="printer1" class="unavailable">Printer</div>
                    <div id="r128">1.28</div>
                    <div id="r132">1.32</div>
                    <div id="wc14" class="unavailable">WC and stairs</div>
                    <div id="r138">1.38</div>
                    <div id="r139">1.39</div>
                    <div id="r140">1.40</div>
                    <div id="r142">1.42</div>
                    <div id="r143">1.43</div>
                    <div id="r144">1.44</div>
                    <div id="hole1"></div>
                </div>
                <div id="floor-2-grid">
                    <div id="r201">2.01</div>
                    <div id="wc21" class="unavailable">WC and stairs</div>
                    <div id="r207">2.07</div>
                    <div id="r209">2.09</div>
                    <div id="service-desk" class="unavailable">Sevice Desk</div>
                    <div id="r211">2.11</div>
                    <div id="wc22" class="unavailable">WC and elevator</div>
                    <div id="r216">2.16</div>
                    <div id="r217">2.17</div>
                    <div id="r218">2.18</div>
                    <div id="r220">2.20</div>
                    <div id="r221">2.21</div>
                    <div id="r222">2.22</div>
                    <div id="wc23" class="unavailable">WC and stairs</div>
                    <div id="r225">2.25</div>
                    <div id="r226">2.26</div>
                    <div id="r231">2.31</div>
                    <div id="wc24" class="unavailable">WC and stairs</div>
                    <div id="r237">2.37</div>
                    <div id="r238">2.38</div>
                    <div id="r241">2.41</div>
                    <div id="hole2"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="switch-floor">
        <p id="ground-floor-btn" class="floor-btns" onclick="switchFloor(0)">Ground Floor</p>
        <p id="first-floor-btn" class="floor-btns" onclick="switchFloor(1)">First Floor</p>
        <p id="second-floor-btn" class="floor-btns" onclick="switchFloor(2)">Second Floor</p>
    </div>

    <script src="floorplan.js"></script> 
</body>
</html>