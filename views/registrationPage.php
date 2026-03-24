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
                            <input type="text" id="txtfName" required>
                            <label for="fName" class="label-line">First Name</label>
                        </div>
                    <div class="entry-area">                              
                        <input type="text" id="txtlName" required>
                        <label for="lName" class="label-line">Last Name</label>
                    </div>
                </div>
                <div class="entry-area">
                    <script async>
                        document.addEventListener('DOMContentLoaded', function() {
                            var elems = document.querySelectorAll('select');
                            var options = document.querySelectorAll('option');
                            var instances = M.FormSelect.init(elems, options);
                        });
                    </script>
                    <select id="roleSelectReg">
                        <label for="roleSelectReg">Select User role</label>
                        <option value="" disabled selected>Choose a role</option>
                        <?php foreach ($roles as $role) : ?>
                            <option value="<?=  $role['roleID'] ?>">
                                <?= ucfirst($role['roleName'])?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="entry-area">
                    <input type="text" id="regID" required>
                    <label for="regID" class="label-line">ID Number</label>
                </div>
                    <div class="entry-area">
                        <input type="text" id="userPassword" required>
                        <label for="userPassword" class="label-line">Password</label>
                    </div>
                    <button type="submit" name="action" class="btn-enter" onclick="newUserRegisterFunc()">
                        <span>Register</span>
                    </button>
                </div>
                <p>Want to Login? <a href="loginPage.php">Click here</a></p>
            </div>
        </div>
    </div>
        
</body>
</html>