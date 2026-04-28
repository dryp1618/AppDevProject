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
                            <input type="text" id="txtfName" required validate>
                            <label for="txtfName" class="label-line req-error" minlength="2" maxlength="50" placeholder="John">First Name</label>
                            <!-- <span class="req-error">Name must be more than 2 characters</span>
                            <span class="req-error">Name must be less than 50 characters</span>
                            <span class="req-error">Name must not have special characters</span> -->
                        </div>
                        <div class="entry-area">                              
                            <input type="text" id="txtlName" required validate>
                            <label for="txtlName" class="label-line" minlength="2" maxlength="50" placeholder="Smith">Last Name</label>
                            <!-- <span class="req-error">Name must be more than 2 characters</span>
                            <span class="req-error">Name must be less than 50 characters</span>
                            <span class="req-error">Name must not have special characters</span> -->
                        </div>
                    </div>
                    <div class="entry-area">
                        <input type="text" id="regID" required validate>
                        <label for="regID" class="label-line" placeholder="1111222233">ID Number</label>
                        <!-- <span class="req-error">Only numbers are allowed</span>
                        <span class="req-error">ID must be 10 digits</span> -->
                    </div>
                    <div class="entry-area">
                        <input type="text" id="email" required validate >
                        <label for="email" class="label-line" placeholder="you@example.com">Email</label>
                        <!-- <span class="req-error">Enter a valid email address</span> -->
                    </div>
                    <div class="entry-area">
                        <input type="tel" id="phone" pattern="[0-9]{11}" required pattern validate maxlength="10">
                        <label for="phone" class="label-line">Phone Number</label>
                    </div>
                    <div class="entry-area">
                        <input type="text" id="userPassword" required validate>
                        <label for="userPassword" class="label-line">Password</label>
                        <!-- <span class="req-error"></span> -->
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