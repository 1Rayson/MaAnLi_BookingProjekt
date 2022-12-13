<?php
    session_start();
    
    if(isset($_SESSION['userToken'])) header("location: book_lokale.php");

    $fail = false;
    $response = isset($_GET['login']) ? $_GET['login'] : "";

    if($response == "fail") $fail = true;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-anders.css">
    <title>login</title>
</head>
    <body>
        <wrapper id="flexbox">
            <section class="login--box">
                <form action="backend.php?action=login" method="post" id="login-form">
                    <?php 
                        if ($fail) echo "<p id='log-in-fail-text'>Your password or username is wrong</p>";
                    ?>
                    <label>
                        <p>Email</p>
                        <input type="text" name="emailLogin" id="login-email">
                    </label>
                    <label>
                        <p>Password</p>    
                        <input type="password" name="passwordLogin" id="login-password">
                    </label>
                    <input type="submit" id="login-submit" value="Log In">
                </form>
            </section>
        </wrapper>
    </body>
</html>