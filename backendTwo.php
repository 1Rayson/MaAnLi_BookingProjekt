<?php
session_start();
include("classes/mySQL.php");

// 
// Login Backend
// 
if($action == 'login') {
    if(!isset($_SESSION['userToken'])) $_SESSION['userToken'] = 0;

    $userNameLoginVar = $_REQUEST['userNameLogin'];
    $passwordLoginVar = $_REQUEST['passwordLogin'];

    $loginQuery = "
        SELECT id, userPassword
        FROM examProject_login
        WHERE userEmail = '$emailLoginVar'
    ";

    $result = $database->Query($loginQuery)->fetch_object();

    $passVerify = password_verify($passwordLoginVar, $result->userPassword);

    if($passVerify){
        $_SESSION['userToken'] = $result->id;
        header("location: book_lokale.php");
        exit;
    } else {
        header("location: login.php?login=fail");
        exit;
    }
}

// 
// Create booking Backend
// 

if($action == 'create'){
    $user_id = $_SESSION['userToken'];
    $room_var = (isset($_REQUEST['room_var'])) ? $_REQUEST['room_var']: "";
    $room_number = (isset($_REQUEST['room_number'])) ? $_REQUEST['room_number']: "";
    $start_time = (isset($_REQUEST['start_time'])) ? $_REQUEST['start_time']: "";
    $end_time = (isset($_REQUEST['end_time'])) ? $_REQUEST['end_time']: "";
    $booking_date = (isset($_REQUEST['booking_date'])) ? $_REQUEST['booking_date']: "";
    $name_of_booking = (isset($_REQUEST['name_of_booking'])) ? $_REQUEST['name_of_booking']: "";

    $conflicting_bookings = "SELECT * FROM examProject_bookings
                            WHERE start_time OR end_time
                            BETWEEN startTimeVar AND endTimeVar
                            AND WHERE booking_date = '$booking_date';";

    if(empty($conflicting_bookings) && $room_var !="" && $room_number !="" && $start_time !="" && $end_time !="" && $booking_date !="" && $name_of_booking !="" ){
        if ($room_var == 's') {
            $room_var = '';
        }
        if ($room_number > 10) {
            $room_number = '0' . $room_number;
        }

        $room_id = $room_var . $room_number;

        $userSQL = "INSERT INTO examProject_bookings
                    SET organizer_login_id = '$user_id', room_id = '$room_id', start_time = '$start_time', end_time = '$end_time', booking_day = '$booking_date', booking_description = '$name_of_booking';";    

        $database->Query($userSQL);

        header("location: mine_tider.php");
    } else {
        header("location: book_lokale.php?create=fail");
    }
}

// 
// Read booking Backend
// 





// 
// Read room details Backend (+lokalets bookinger for dagen)
// 
if($action == 'selectRoom') {
    $room_id = ;
    $booking_date = ;
    $start_time = ;
    $end_time = ;

    if($room_id !="" && $start_time !="" && $end_time !="") {
        $userSQL = "SELECT * FROM examProject_bookings
                    WHERE id = '$room_id'
                    AND WHERE booking_date = '$booking_date';";

                    



                    //SET room_id = '$room_id', start_time = '$start_time', end_time = '$end_time', booking_day = '$booking_date', booking_description = '$name_of_booking'
                    //WHERE id = '$booking_id';"
        $database->Query($userSQL);
    }
}




// 
// Update booking Backend (Ikke færdig - ikke sikker på HVORDAN vi skal opdatere tiden ud fra designet)
// 
if($action == 'update') {
        $user_id = $_SESSION['userToken'];
        $booking_id = (isset($_REQUEST['booking_id'])) ? $_REQUEST['booking_id']: "";
        $room_var = (isset($_REQUEST['room_var'])) ? $_REQUEST['room_var']: "";
        $room_number = (isset($_REQUEST['room_number'])) ? $_REQUEST['room_number']: "";
        $start_time = (isset($_REQUEST['start_time'])) ? $_REQUEST['start_time']: "";
        $end_time = (isset($_REQUEST['end_time'])) ? $_REQUEST['end_time']: "";
        $booking_date = (isset($_REQUEST['booking_date'])) ? $_REQUEST['booking_date']: "";
        $name_of_booking = (isset($_REQUEST['name_of_booking'])) ? $_REQUEST['name_of_booking']: "";

        if($booking_id !="" && $room_var !="" && $room_number !="" && $start_time !="" && $end_time !="" && $booking_date !="" && $name_of_booking !="" ){
            if ($room_var == 's') {
                $room_var = '';
            }
            if ($room_number > 10) {
                $room_number = '0' . $room_number;
            }

            $room_id = "$room_var" . "$room_number";

            $userSQL = "UPDATE examProject_bookings
                        SET room_id = '$room_id', start_time = '$start_time', end_time = '$end_time', booking_day = '$booking_date', booking_description = '$name_of_booking'
                        WHERE id = '$booking_id';";
            $database->Query($userSQL);
    

        header("location: mine_tider.php");
    } else {
        header("location: update.php?update=fail");
    }
}

// 
// Delete booking Backend
// 
    if($action == 'update') {
        $booking_id = (isset($_REQUEST['booking_id'])) ? $_REQUEST['booking_id']: "";

        if($booking_id !=""){
            

            $userSQL = "DELETE FROM examProject_bookings
                        WHERE id = '$booking_id';";
            $database->Query($userSQL);
        

            header("location: mine_tider.php");
        } else {
            header("location: mine_tider.php?delete=fail");
    }
}

?>