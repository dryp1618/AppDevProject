<?php
    require_once('../bl/roomManage.php');

    $roomManage = new roomManage();

        if (isset($_POST['disableRoom'])) {
            $roomManage -> toggleDisable($_POST['disableRoom']);
            exit;
        } else if(isset($_POST['reqDetail'])){
            
            // echo json_encode();
            exit;
        }
?>