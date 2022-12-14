<?php

include_once("classes/mySQL.php");

$database = new MySQL(true);

if (isset($_REQUEST["date"]) && isset($_REQUEST["start-time-input"]) && isset($_REQUEST["end-time-input"])){
    $date = $_REQUEST["date"];
    $startTime = $_REQUEST["start-time-input"];
    $endTime = $_REQUEST["end-time-input"];

    $unavailableQuery = "
        SELECT room_id
        FROM examProject_bookings
        WHERE (
            ('".$date."' = booking_day AND start_time <= '".$startTime."') 
            AND ('".$date."' = booking_day AND end_time >= '".$endTime."')
        )
        ;
    ";

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

    $unavailableList = [];
    $partlyAvailableList = [];

    $unavailableResult = $database->Query($unavailableQuery);
    $partlyAvailableResult = $database->Query($partlyAvailableQuery);

    while ($row = $unavailableResult->fetch_object()){
        $booking = [];

        $booking['id'] = $row->room_id;

        $unavailableList[] = $booking;
    }

    while ($row = $partlyAvailableResult->fetch_object()){
        $booking = [];

        $booking['id'] = $row->room_id;

        $partlyAvailableList[] = $booking;
    }

    $json = [];
    $json["unavailableList"] = $unavailableList;
    $json["partlyAvailableList"] = $partlyAvailableList;

    header("content-type: application/json");
    echo json_encode($json);
}
else if (isset($_REQUEST["roomid"]) && isset($_REQUEST["date"])){
    $roomid = $_REQUEST["roomid"];
    $date = $_REQUEST["date"];

    $getRoomInfoQuery = "
        SELECT roomNumber, floorVariable, screen, capacity, smartBoard
        FROM examProject_rooms
        WHERE ".$roomid." = id;
    ";

    $getRoomBookingsQuery = "
        SELECT start_time, end_time, booking_description 
        FROM examProject_bookings
        WHERE room_id = ".$roomid."
        AND booking_day = '".$date."';
    ";

    $roomInfo = [];
    $roomBookingsInfo = [];

    $roomInfoResult = $database->Query($getRoomInfoQuery);
    $roomBookingsInfoResult = $database->Query($getRoomBookingsQuery);

    while ($row = $roomInfoResult->fetch_object()){
        $info = [];

        $info['roomNumber'] = $row->roomNumber;
        $info['floorVariable'] = $row->floorVariable;
        $info['screen'] = $row->screen;
        $info['capacity'] = $row->capacity;
        $info['smartBoard'] = $row->smartBoard;

        $roomInfo[] = $info;
    }

    // if(!$roomBookingsInfoResult){}
    while ($row = $roomBookingsInfoResult->fetch_object()){
        $booking = [];

        $booking['start_time'] = $row->start_time;
        $booking['end_time'] = $row->end_time;
        $booking['booking_description'] = $row->booking_description;

        $roomBookingsInfo[] = $booking;
    }

    $json = [];
    $json["roomInfo"] = $roomInfo;
    $json["roomBookingsInfo"] = $roomBookingsInfo;

    header("content-type: application/json");
    echo json_encode($json);
}

?>