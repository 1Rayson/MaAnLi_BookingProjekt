<?php

include_once("classes/mySQL.php");

$database = new MySQL(true);

/* Disse variabler skal tilpasses jeres kalender */
$date = $_REQUEST["date"];
$startTime = $_REQUEST["start-time-input"];
$endTime = $_REQUEST["end-time-input"];

/* De her to query er ikke testet i vores projekt database.
Der skal sandsynligvis laves lidt om på dem.
Det er muligt jeres løsning vil fungere og er nemmere at overskue. */
$unavailableQuery = "
    SELECT examProject_rooms.floorVariable, examProject_rooms.roomNumber
    FROM examProject_rooms
    INNER JOIN examProject_bookings ON examProject_rooms.id = examProject_bookings.room_id
    WHERE examProject_bookings.start_time < '".$date." ".$startTime."' AND examProject_bookings.end_time > '".$date." ".$endTime."'
    ;
";

$partlyAvailableQuery = "
    SELECT examProject_rooms.floorVariable, examProject_rooms.roomNumber
    FROM examProject_rooms
    INNER JOIN examProject_bookings ON examProject_rooms.id = examProject_bookings.room_id
    WHERE NOT (examProject_bookings.start_time < '".$date." ".$startTime."' AND examProject_bookings.end_time > '".$date." ".$endTime."')
    AND (examProject_bookings.start_time BETWEEN '".$date." ".$startTime."' AND '".$date." ".$endTime."') 
        OR (examProject_bookings.end_time BETWEEN '".$date." ".$startTime."' AND '".$date." ".$endTime."')
    ;
";

$unavailableList = [];
$partlyAvailableList = [];

$unavailableResult = $database->Query($unavailableQuery);
$partlyAvailableResult = $database->Query($partlyAvailableQuery);

while ($row = $unavailableResult->fetch_object()){
    $booking = [];

    $booking['roomNumber'] = $row->roomNumber;
    $booking['floorVariable'] = $row->floorVariable;

    $unavailableList[] = $booking;
}

while ($row = $partlyAvailableResult->fetch_object()){
    $booking = [];

    $booking['roomNumber'] = $row->roomNumber;
    $booking['floorVariable'] = $row->floorVariable;

    $partlyAvailableList[] = $booking;
}

$json = [];
$json["unavailableList"] = $unavailableList;
$json["partlyAvailableList"] = $partlyAvailableList;

header("content-type: application/json");
echo json_encode($json);

?>