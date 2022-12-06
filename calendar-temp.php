<?php

$date = date("2020-02-06");


$monthOffset = 0;

$time = date("H:i:s");

echo $time . "<br>"; 

$year = date("Y");
$month = date("m");
$day = date("d");

$daysInMonth = date("t", strtotime($date));

$firstDayOfMonth = date("N", strtotime($year . "-" . $month . "-1"));


for($i = 1; $i <= $daysInMonth; $i++) {
    echo "<a href='backend.php?action=bookdate&date=$year$month$i'>" . $i . "</a> ";
}


?>