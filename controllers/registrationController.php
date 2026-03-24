<?php
    session_start();
    require_once('../bl/registrationManage.php');

    $regmanagement = new registrationManage();

        if (isset($_POST['regFName'],$_POST['regLName'], $_POST['regUserID'], $_POST['regRole'], $_POST['regPass'])) {  //queueing a user for registration
            $regmanagement -> addNewRegistration($_POST['regUserID'], $_POST['regRole'], $_POST['regFName'],$_POST['regLName'], $_POST['regPass']);
            exit;
        }
        
        // else if(isset($_POST['uFName'], $_POST['uLName'],$_POST['uUserID'], $_POST['uroleID'])){
        //     $usermanagement -> changeUserInfo($_POST['uUserID'], $_POST['uroleID'], $_POST['uFName'], $_POST['uLName']);
        //     exit;
        // } else if(isset($_POST['delID'])){
        //     $usermanagement -> removeUser($_POST['delID']);
        //     exit;
        // }

?>