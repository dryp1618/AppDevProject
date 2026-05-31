<?php
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
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="components/main.css">
    <link rel="stylesheet" href="registration.css">
    <script defer src="../scripts/service.js"></script>
</head>
<body>
    <?php include_once("components/navbarLogin.html");?>
    <div class="body-contain">
        <div class="main-container">
            <div class="main-border-box">
                <h1>REGISTER HERE</h1>
                <br>
                <div class="input-area">
                    <div class="name-group">
                        <div class="entry-area">
                            <input type="text" id="txtfName" oninput="allowOnlyLetters(this)" minlength="2" maxlength="51" required>
                            <label for="txtfName" class="label-line">First Name</label>
                            <span class="req-error" id="err-fname"></span>
                        </div>
                        <div class="entry-area">
                            <input type="text" id="txtlName" oninput="allowOnlyLetters(this)" minlength="2" maxlength="51" required>
                            <label for="txtlName" class="label-line">Last Name</label>
                            <span class="req-error" id="err-lname"></span>
                        </div>
                    </div>
                        <div class="entry-area">
                            <input type="text" id="regID" oninput="allowOnlyNumbers(this)" minlength="10" maxlength="11" required>
                            <label for="regID" class="label-line">ID Number</label>
                            <span class="req-error" id="err-id"></span>
                        </div>
                        <div class="entry-area">
                            <input type="email" id="email" required>
                            <label for="email" class="label-line">Email</label>
                            <span class="req-error" id="err-email"></span>
                        </div>
                        <div class="entry-area">
                            <input type="tel" id="phone" oninput="allowOnlyNumbers(this)" required>
                            <label for="phone" class="label-line">Phone Number</label>
                            <span class="req-error" id="err-phone"></span>
                        </div>
                        <div class="entry-area">
                            <input type="password" id="userPassword" required>
                            <label for="userPassword" class="label-line">Password</label>
                            <span class="req-error" id="err-password"></span>
                        </div>
                        <div class="entry-area">
                            <input type="password" id="confPassword" required>
                            <label for="confPassword" class="label-line">Confirm Password</label>
                            <span class="req-error" id="err-confirm"></span>
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