<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="calendar-temp.css" type="text/css" rel="stylesheet" />
    <title>Document</title>
</head>
<body>
    <?php
include 'classes/calendar.php';
 
$calendar = new Calendar();
 
echo $calendar->show();
?>
</body>
</html>