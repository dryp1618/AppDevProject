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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
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
                            <input type="text" id="loginID" oninput="allowOnlyNumbers(this)" required>
                            <label for="loginID" class="label-line">ID Number</label>
                        </div>
                        <div class="entry-area">
                            <input type="password" id="userPassword" required>
                            <label for="userPassword" class="label-line">Password</label>
                        </div>
                        <button type="submit" name="action" onclick="loginFunc()">
                            <span>Enter</span>
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </button>
                </div>
                <p> Want to Register? <a href="registration.php">Click here</a></p>
            </div>
        </div>
    </div>
        
</body>
</html>