<?php

include_once("classes/mySQL.php");

$database = new MySQL(true);
$action = $_REQUEST["action"];

// If the requested information is present, set them to variables
if ($action == "checkAvail" && isset($_REQUEST["date"]) && isset($_REQUEST["start-time-input"]) && isset($_REQUEST["end-time-input"])){
    $date = $_REQUEST["date"];
    $startTime = $_REQUEST["start-time-input"];
    $endTime = $_REQUEST["end-time-input"];

    // Select every room that is unavailable on the given date and time
    $unavailableQuery = "
        SELECT room_id
        FROM examProject_bookings
        WHERE (
            ('".$date."' = booking_day AND start_time <= '".$startTime."') 
            AND ('".$date."' = booking_day AND end_time >= '".$endTime."')
        )
        ;
    ";

    // Select everything that is partially available on the given date and time - where there's overlap, but not through the WHOLE period
    $partlyAvailableQuery = "
        SELECT room_id
        FROM examProject_bookings
        WHERE NOT (
            ('".$date."' = booking_day AND start_time <= '".$startTime."') 
            AND ('".$date."' = booking_day AND end_time >= '".$endTime."')
        )
        AND (
            ('".$date."' = booking_day AND start_time BETWEEN '".$startTime."' AND '".$endTime."') 
            OR ('".$date."' = booking_day AND end_time BETWEEN '".$startTime."' AND '".$endTime."')
        )
        ;
    ";
    
    // Create two empty arrays
    $unavailableList = [];
    $partlyAvailableList = [];
    
    // Insert the query results into their respective array
    $unavailableResult = $database->Query($unavailableQuery);
    $partlyAvailableResult = $database->Query($partlyAvailableQuery);

    // While there are unavailable rooms, set their id into the array of unavailable rooms
    while ($row = $unavailableResult->fetch_object()){
        $booking = [];

        $booking['id'] = $row->room_id;

        $unavailableList[] = $booking;
    }

    // While there are partially available rooms, set their id into the array of partially available rooms
    while ($row = $partlyAvailableResult->fetch_object()){
        $booking = [];

        $booking['id'] = $row->room_id;

        $partlyAvailableList[] = $booking;
    }


    //encode the arrays as JSON
    $json = [];
    $json["unavailableList"] = $unavailableList;
    $json["partlyAvailableList"] = $partlyAvailableList;

    header("content-type: application/json");
    echo json_encode($json);
    
}
// If the requested information is not fully present, but room_id and date is, set these to variables
else if ($action == "selectRoom" && isset($_REQUEST["roomid"]) && isset($_REQUEST["date"])){
    $roomid = $_REQUEST["roomid"];
    $date = $_REQUEST["date"];

    // Select the room's information based on the room's id
    $getRoomInfoQuery = "
        SELECT roomNumber, floorVariable, screen, capacity, smartBoard
        FROM examProject_rooms
        WHERE ".$roomid." = id;
    ";

    // Select the booking's information based on the room's id and the date
    $getRoomBookingsQuery = "
        SELECT start_time, end_time, booking_description 
        FROM examProject_bookings
        WHERE room_id = ".$roomid."
        AND booking_day = '".$date."';
    ";

    // Create 2 empty arrays
    $roomInfo = [];
    $roomBookingsInfo = [];

    // Insert the query results into their respective array
    $roomInfoResult = $database->Query($getRoomInfoQuery);
    $roomBookingsInfoResult = $database->Query($getRoomBookingsQuery);

    // While there's more rows of information to display about the room, set them into the info array and set the content of
    //the info array into the roomInfo array.
    while ($row = $roomInfoResult->fetch_object()){
        $info = [];

        $info['roomNumber'] = $row->roomNumber;
        $info['floorVariable'] = $row->floorVariable;
        $info['screen'] = $row->screen;
        $info['capacity'] = $row->capacity;
        $info['smartBoard'] = $row->smartBoard;

        $roomInfo[] = $info;
    }

    // While there's more rows of information to display about the booking, set them into the booking array and set the content of
    //the info booking into the roomBookingsInfo array.
    while ($row = $roomBookingsInfoResult->fetch_object()){
        $booking = [];

        $booking['start_time'] = $row->start_time;
        $booking['end_time'] = $row->end_time;
        $booking['booking_description'] = $row->booking_description;

        $roomBookingsInfo[] = $booking;
    }

    //encode the arrays as JSON
    $json = [];
    $json["roomInfo"] = $roomInfo;
    $json["roomBookingsInfo"] = $roomBookingsInfo;

    header("content-type: application/json");
    echo json_encode($json);
}

if($action == "checkUpdateConflict" && isset($_REQUEST["room_id"]) && isset($_REQUEST["date"]) && isset($_REQUEST["start_time"]) && isset($_REQUEST["end_time"])){
    $room_id = $_REQUEST["room_id"];
    $booking_date = $_REQUEST["date"];
    $start_time = $_REQUEST["start_time"];
    $end_time = $_REQUEST["end_time"];

    $conflicting_bookings = "
        SELECT *
        FROM examProject_bookings
        WHERE room_id = $room_id
        AND(
            (
                ('$booking_date' = booking_day AND start_time <= '$start_time') 
                AND ('$booking_date' = booking_day AND end_time >= '$end_time')
            )
            OR (
                ('$booking_date' = booking_day AND start_time BETWEEN '$start_time' AND '$end_time') 
                OR ('$booking_date' = booking_day AND end_time BETWEEN '$start_time' AND '$end_time')
            )
        );
    ";
    
    $occupied = $database->Query($conflicting_bookings)->fetch_object();

    header("content-type: application/json");
    echo json_encode($occupied);
}
?>