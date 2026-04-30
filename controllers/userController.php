<?php
    session_start();
    require_once('../bl/userManage.php');
 
    
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
            $confirmLogin = $usermanagement->loginUser($_POST['loginID'], $_POST['loginPass']);

            if($confirmLogin){
                echo json_encode(['success' => true, 'message' => 'Login authorized.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Wrong credentials.']);
            }
        }
?>