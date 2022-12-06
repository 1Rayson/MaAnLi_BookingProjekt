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
        <section class="login--box">
            <form action="backend.php?action=login" method="post" id="login-form">
                <?php 
                    if($fail)echo "<p id='log-in-fail-text'>Your password or username is wrong</p>";
                ?>
                <label>
                    <p>Username</p>
                    <input type="text" name="userNameLogin" id="login-username">
                </label>
                <label>
                    <p>Password</p>    
                    <input type="password" name="passwordLogin" id="login-password">
                </label>
                <input type="submit" value="Log In">
            </form>
        </section>
    </body>
</html>