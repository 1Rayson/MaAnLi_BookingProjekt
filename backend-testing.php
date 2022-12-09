<?php
    session_start();
    include("mySQL.php");
// 
// Variables
// 
    $database = new MySQL(true);    
    $action = $_REQUEST['action'];

    
    $fullName = (isset($_REQUEST['fullName'])) ? $_REQUEST['fullName']: "";
    $schoolInitials = (isset($_REQUEST['schoolInitials'])) ? $_REQUEST['schoolInitials']: "";
    $email = (isset($_REQUEST['email'])) ? $_REQUEST['email']: "";
    $password = (isset($_REQUEST['password'])) ? $_REQUEST['password']: "";

    if($action == 'insertTestPerson') {
        if($schoolInitials !="" && $fullName !="" && $email !="" && $password !="" ){
            try {
                $passEncrypt = password_hash($password, PASSWORD_DEFAULT);
                
                $userSQLLogin = "INSERT INTO examProject_login(userEmail, userPassword) VALUES ('$email', '$passEncrypt');";
                $userSQLUser = "INSERT INTO examProject_user(fullName, schoolInitials) VALUES ('$fullName', '$schoolInitials');";
        
                $database->Query($userSQLLogin);
                $database->Query($userSQLUser);
            } catch (Exception $ex){
                echo "Error ID10T";
            }
        }
    }
?>