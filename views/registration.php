<?php
    session_start();
    require_once('../bl/roleManage.php');

    $rolemanagement = new roleManage();
    $roles = $rolemanagement -> getRoles();

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
    <link rel="stylesheet" href="registration.css">
    <script defer src="../scripts/service.js"></script>
</head>
<body>
    <div class="body-contain">
        <div class="main-container">
            <div class="main-border-box">
                <h1>REGISTER HERE</h1>
                <br>
                <div class="input-area">
                    <div class="name-group">
                        <div class="entry-area">                              
                            <input type="text" id="txtfName" minlength="2" maxlength="51" required validate>
                            <label for="txtfName" class="label-line">First Name</label>
                            <!-- <span class="req-error" id="err-first-name"></span> -->
                        </div>
                        <div class="entry-area">                              
                            <input type="text" id="txtlName" minlength="2" maxlength="51" required validate>
                            <label for="txtlName" class="label-line">Last Name</label>
                            <!-- <span class="req-error" id="err-last-name"></span> -->
                        </div>
                    </div>
                    <div class="entry-area">
                        <input type="text" id="regID" minlength="10" maxlength="11" required validate>
                        <label for="regID" class="label-line">ID Number</label>
                        <!-- <span class="req-error" id="err-id-number"></span> -->
                    </div>
                    <div class="entry-area">
                        <input type="email" id="email" required validate >
                        <label for="email" class="label-line">Email</label>
                        <span class="req-error" id="err-email"></span>
                    </div>
                    <div class="entry-area">
                        <input type="tel" id="phone" pattern="^0(9\d{9}|[2-8]\d{7,8})$" required pattern validate minlength="5" maxlength="11">
                        <label for="phone" class="label-line">Phone Number</label>
                        <!-- <span class="req-error" id="err-phone-number"></span> -->
                    </div>
                    <div class="entry-area">
                        <input type="text" id="userPassword" required validate>
                        <label for="userPassword" class="label-line">Password</label>
                        <!-- <span class="req-error" id="err-password"></span> -->
                    </div>
                    <button type="submit" name="action" class="btn-enter" onclick="newUserRegisterFunc()">
                        <span>Register</span>
                    </button>
                </div>
                <p>Want to Login? <a href="login.php">Click here</a></p>
            </div>
        </div>
    </div>
        
</body>
</html>