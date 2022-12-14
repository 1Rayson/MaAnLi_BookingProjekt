<?php
session_start();
include("classes/mySQL.php");
// 
// Variables
// 
$database = new MySQL(true);
$action = $_GET['action'] ;


// 
// Login Backend
// 
if($action == 'login') {
    //if a session is NOT set, set userToken to be null.
    if(!isset($_SESSION['userToken'])) $_SESSION['userToken'] = NULL;

    //Request email and password
    $emailLoginVar = $_REQUEST['emailLogin'];
    $passwordLoginVar = $_REQUEST['passwordLogin'];

    //Select the id and password where the email matches the provided email
    $loginQuery = "
        SELECT id, userPassword
        FROM examProject_login
        WHERE userEmail = '$emailLoginVar'
    ";

    $result = $database->Query($loginQuery)->fetch_object();

    //Verify that the provided password matches the stored password
    $passVerify = password_verify($passwordLoginVar, $result->userPassword);
    
    //If the passwords match, set userToken to the id matching the login attempt
    //Return user to book_lokale.php
    if($passVerify){
        $_SESSION['userToken'] = $result->id;
        header("location: book_lokale.php");
        exit;
    } else {
        //If the above fails, return to login.php and note it was a failure
        header("location: login.php?login=fail");
        exit;
    }
}


// 
// Create booking Backend
// 
if($action == 'create'){
    //Request all fields w. required data - if there's nothing in it, set it to an empty string
    $user_id = $_SESSION['userToken'];
    $room_id = (isset($_REQUEST['roomid'])) ? $_REQUEST['roomid']: "";
    $start_time = (isset($_REQUEST['start_time'])) ? $_REQUEST['start_time']: "";
    $end_time = (isset($_REQUEST['end_time'])) ? $_REQUEST['end_time']: "";
    $booking_date = (isset($_REQUEST['booking_date'])) ? $_REQUEST['booking_date']: "";
    $booking_description = (isset($_REQUEST['booking-description'])) ? $_REQUEST['booking-description']: "";
    
    //Select every booking with the required room_id
    //which is also on the same date, and within the timeframe we're trying to book.
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

    // If none of the above variables are empty strings, and the occupied variable is set, proceed to run an INSERT query with the provided information
    if(!isset($occupied) && $room_id !="" && $start_time !="" && $end_time !="" && $booking_date !="" && $booking_description !="" ){

        $userSQL = "
            INSERT INTO examProject_bookings (
                organizer_login_id,
                room_id,
                start_time,
                end_time,
                booking_day,
                booking_description
            )
            VALUES (
                $user_id, 
                $room_id, 
                '$start_time', 
                '$end_time', 
                '$booking_date', 
                '$booking_description'
            );
        ";    

        $database->Query($userSQL);

        //Return to mine_tider.php
        header("location: mine_tider.php");
    } else {
        //If the above fails, return to book_lokale.php and note it was a failure
        header("location: book_lokale.php?create=fail");
    }
}


// 
// Update booking Backend
// 
if($action == 'update') {
        //Request all fields w. required data - if there's nothing in it, set it to an empty string
        $user_id = $_SESSION['userToken'];
        $booking_id = (isset($_REQUEST['booking_id'])) ? $_REQUEST['booking_id']: "";
        $room_id = (isset($_REQUEST['room_number'])) ? $_REQUEST['room_number']: "";
        $start_time = (isset($_REQUEST['start_time'])) ? $_REQUEST['start_time']: "";
        $end_time = (isset($_REQUEST['end_time'])) ? $_REQUEST['end_time']: "";
        $booking_date = (isset($_REQUEST['booking_date'])) ? $_REQUEST['booking_date']: "";
        $booking_description = (isset($_REQUEST['booking-description'])) ? $_REQUEST['booking-description']: "";

        // If none of the above variables are empty strings, proceed to run an UPDATE query with the provided information
        if($booking_id !="" && $room_id !="" && $start_time !="" && $end_time !="" && $booking_date !="" && $booking_description !="" ){
            
            $userSQL = "UPDATE examProject_bookings
                        SET room_id = '$room_id', start_time = '$start_time', end_time = '$end_time', booking_day = '$booking_date', booking_description = '$booking_description'
                        WHERE id = '$booking_id';";
            $database->Query($userSQL);
    
        //Return to mine_tider.php
        header("location: mine_tider.php");
    } else {
        //If the above fails, return to update.php and note it was a failure
        header("location: update.php?update=fail");
    }
}


// 
// Delete booking Backend
// 
    if($action == 'delete') {
        //Request booking_id - if there's nothing in it, set it to an empty string
        $booking_id = (isset($_REQUEST['booking_id'])) ? $_REQUEST['booking_id']: "";

         // If booking_id is not an empty string, proceed to run a DELETE query with it
        if($booking_id !=""){
        

            $userSQL = "DELETE FROM examProject_bookings
                        WHERE id = '$booking_id';";
            $database->Query($userSQL);
        
            //Return to mine_tider.php
            header("location: mine_tider.php");
        } else {
            //If the above fails, return to mine_tider.php and note it was a failure
            header("location: mine_tider.php?delete=fail");
    }
}








// 
// Read booking Backend
// 
//IKKE I BRUG(?)
if($action == 'showOwnBookings') {
    $user_id = $_SESSION['userToken'];

    $userSQL = "SELECT * FROM examProject_bookings
                WHERE organizer_login_id = '$user_id';";
                
    $database->Query($userSQL);

    $result = $database->Query($userSQL)->fetch_object();
    var_dump($result);
    exit;
    while($row = mysql_fetch_array($result)) {
        ?>
            <section class="booking">
                <article class="booking-details">
                    <section class="date-time-location">
                        <p><?php echo $row['booking_day'] ?></p>
                        <p>Kl. <?php echo $row['start_time']?>-<?php echo $row['end_time']?></p>
                        <p>Lokale <?php echo $row['room_id']?></p>
                    </section>
                    <section class="organizer">
                        <p><?php echo $row['booking_description']?></p>
                    </section>
                </article>
                <article class="update-delete-booking">
                    <a href="backend-testing.php?action=update" id="update-submit">Opdatér</a>
                    <a href="backend-testing.php?action=delete" id="delete-submit">Slet</a>
                    
                </article>
            </section>
            <section class="divider">
                <hr>
            </section>
        <?php
    }
}

// 
// Read room details Backend (+lokalets bookinger for dagen)
// 
//IKKE I BRUG(?)
if($action == 'selectRoom') {
    //$room_id = ;
    //$booking_date = ;
    //$start_time = ;
    //$end_time = ;

    if($room_id !="" && $start_time !="" && $end_time !="") {
        $userSQL = "SELECT * FROM examProject_bookings
                    WHERE room_id = '$room_id'
                    AND WHERE booking_date = '$booking_date';";
        $database->Query($userSQL);

        $result = $database->Query($userSQL);
    }
    while($row = mysql_fetch_array($result)) {
        ?>
            <section class="booking">
                <article class="booking-details">
                    <section class="date-time-location">
                        <p><?php echo $row['booking_day'] ?></p>
                        <p>Kl. <?php echo $row['start_time']?>-<?php echo $row['end_time']?></p>
                        <p>Lokale <?php echo $row['room_id']?></p>
                    </section>
                    <section class="organizer">
                        <p><?php echo $row['booking_description']?></p>
                    </section>
                </article>
                <article class="update-delete-booking">
                    <a href="backend-testing.php?action=update" id="update-submit">Opdatér</a>
                    <a href="backend-testing.php?action=delete" id="delete-submit">Slet</a>
                    
                </article>
            </section>
            <section class="divider">
                <hr>
            </section>
        <?php
    }
}


?>