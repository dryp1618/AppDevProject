<?php
    session_start();
    require_once('../bl/userManage.php');

    $usermanagement = new userManage();

        if (isset($_POST['fName'], $_POST['lName'], $_POST['userID'], $_POST['roleID'])) {
            $usermanagement -> addNewUser( $_POST['fName'], $_POST['lName'], $_POST['userID'], $_POST['roleID']);
            exit;
        }else if(isset($_POST['uFName'], $_POST['uLName'],$_POST['uUserID'], $_POST['uroleID'])){
            $usermanagement -> changeUserInfo($_POST['uUserID'], $_POST['uroleID'], $_POST['uFName'], $_POST['uLName']);
            exit;
        } else if(isset($_POST['delID'])){
            $usermanagement -> removeUser($_POST['delID']);
            exit;
        }
            
        // else if(isset($_POST['lFName']) && isset($_POST['lLName'])){
        //     $usermanagement -> loginUserFunc($_POST['lFName'], $_POST['lLName']);
        // }

?>