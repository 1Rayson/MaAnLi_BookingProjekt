<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>temporary time select</title>
</head>
<body>
    <form action="/floorplan.php" method="get">
        <h2>Vælg tidsrum</h2>
        <label id="date">
            <p>Dato</p>
            <input type="date" id="date-input" name="date">
        </label>
        <label id="start-time" style="display: flex; align-items: center;">
            <p style="margin-right: 5px;">Fra</p>
            <input type="time" id="start-time-input" name="start-time-input" step="900" style="height: 1em;">
        </label>
        <label id="end-time" style="display: flex; align-items: center;">
            <p style="margin-right: 5px;">Til</p>
            <input type="time" id="end-time-input" name="end-time-input" step="900" style="height: 1em;">
        </label>
        <br><br>
        <input type="submit" value="Se ledighed >">
    </form>
</body>
</html>