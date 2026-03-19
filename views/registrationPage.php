<!DOCTYPE html>
<html lang="en">
<head>
    <title>Room Tracker | Login Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <nav>
        <?php include_once("components/navbarLogin.html");?>
    </nav>
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
                            <input type="text" id="fName" required>
                            <label for="fName" class="label-line">First Name</label>
                        </div>
                        <div class="entry-area">                              
                            <input type="text" id="lName" required>
                            <label for="lName" class="label-line">Last Name</label>
                        </div>
                    </div>
                    <div class="entry-area">
                        <input type="text" id="regID" required>
                        <label for="regID" class="label-line">ID Number</label>
                    </div>
                    <div class="entry-area">
                        <input type="text" id="email" required>
                        <label for="email" class="label-line">Email</label>
                    </div>
                    <div class="entry-area">
                        <input type="text" id="userPassword" required>
                        <label for="userPassword" class="label-line">Password</label>
                    </div>
                    <button type="submit" name="action" class="btn-enter">
                        <span>Register</span>
                    </button>
                    <button class="btn-reset">Reset</button>
                </div>
                <p>Want to Register? <a href="loginPage.php">Click here</a></p>
            </div>
        </div>
    </div>
        
</body>
</html>