<?php
    session_start();
    require_once('../bl/userManage.php');
    require_once('../helper/sendEmail.php');
    
    $usermanagement = new userManage();

        if (isset($_POST['regFName'], $_POST['regLName'], $_POST['regUserID'], $_POST['regEmail'], $_POST['regPhone'], $_POST['regPass'])) {
            $usermanagement -> registerNewUser($_POST['regUserID'], $_POST['regFName'], $_POST['regLName'], $_POST['regPhone'], $_POST['regEmail'], $_POST['regPass']);
            exit;




        }else if(isset($_POST['uFName'], $_POST['uLName'],$_POST['uUserID'], $_POST['uroleID'])){
            $usermanagement -> changeUserInfo($_POST['uUserID'], $_POST['uroleID'], $_POST['uFName'], $_POST['uLName']);
            exit;
        } else if(isset($_POST['delID'])){
            $usermanagement -> removeUser($_POST['delID']);
            exit;
        } else if(isset($_POST['loginID'], $_POST['loginPass'])){
            // $confirmLogin = $usermanagement->loginUser($_POST['loginID'], $_POST['loginPass']);

            // if($confirmLogin){
            //     echo json_encode(['success' => true, 'message' => 'Login authorized.']);
            // } else {
            //     echo json_encode(['success' => false, 'message' => 'Wrong credentials.']);
            // }

            $name = htmlspecialchars("Renrich Fernandez");
            $email = filter_var("renrichfernandez1020@gmail.com", FILTER_VALIDATE_EMAIL);
            $message = htmlspecialchars('User logged on');

            if(!$email){
                die('Invalid email!');
            }

            $body = "
                <h3>New Message</h3>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Message:</strong><br> $message</p>
            ";

            //receiver, name of receiver, subject, body
            $result = sendEmail(
                'renrichfernandez1020@gmail.com',
                'Admin',
                'Logged in detected',
                $body
            );

            if($result == true){
                echo "Email sent successfully.";
            } else {
                echo "Email failed to send.";
            }
        }
?>