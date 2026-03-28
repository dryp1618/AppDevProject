<?php

    require_once('../bl/userManage.php');
    $usermanage = new UserManage();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Room Tracker | Login Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <nav>
        <?php include_once("components/navbarLogin.html");?>
    </nav>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link rel="stylesheet" href="components/main.css">
    <link rel="stylesheet" href="login.css">
    <script defer src="../scripts/service.js"></script>
</head>
<body>
    <div class="body-contain">
        <div class="main-container">
            <div class="main-border-box">
                <h1>LOGIN</h1>
                <br>
                <div class="input-area">
                        <div class="entry-area">
                            <input type="text" id="loginID" required>
                            <label for="loginID" class="label-line">ID Number</label>
                        </div>
                        <div class="entry-area">
                            <input type="text" id="userPassword" required>
                            <label for="userPassword" class="label-line">Password</label>
                        </div>
                        <button type="submit" name="action" onclick="loginFunc()">
                            <span>Enter</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m560-240-56-58 142-142H160v-80h486L504-662l56-58 240 240-240 240Z"/></svg>
                        </button>
                </div>
                <p> Want to Register? <a href="registrationPage.php">Click here</a></p>
            </div>
        </div>
    </div>
        
</body>
</html>