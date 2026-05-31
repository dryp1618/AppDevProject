<?php
    if (session_status() === PHP_SESSION_NONE) {
            session_start();
    }
    require_once('../bl/roomManage.php');

    $roomManage = new roomManage();

    if(!($loggedIn = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true && ($_SESSION['userRole'] === 1))){
            exit;
    }

    if (isset($_POST['disableRoom'])) {
        $roomManage -> toggleDisable($_POST['disableRoom']);
        exit;
    }
?>