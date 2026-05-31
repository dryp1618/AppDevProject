<?php
    if (session_status() === PHP_SESSION_NONE) {
            session_start();
    }
    require_once('../bl/roomManage.php');

    $roomManage = new roomManage();

    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
        http_response_code(0);
        exit;
    }

    if ($_SESSION['userRole'] !== 1) {
        http_response_code(0);
        exit;
    }

    if (isset($_POST['disableRoom'])) {
        $roomManage -> toggleDisable($_POST['disableRoom']);
        exit;
    }
?>