<?php
    session_start();
    require_once('../bl/scheduleManage.php');

    $schedManage = new scheduleManage();

        if (isset($_POST['newSchedType'], $_POST['newSchedSect'], $_POST['newSchedRoom'], $_POST['newSchedDay'], $_POST['newSchedTimeIn'], $_POST['newSchedTimeOut'])) {
            $schedManage -> registerNewSchedule($_POST['newSchedType'], $_POST['newSchedRoom'], $_POST['newSchedSect'], $_POST['newSchedDay'], $_POST['newSchedTimeIn'], $_POST['newSchedTimeOut']);
            exit;
        } else if(isset($_POST['updSchedID'], $_POST['updSchedType'], $_POST['updSchedRoom'], $_POST['updSchedSect'], $_POST['updSchedDay'], $_POST['updSchedTimeIn'], $_POST['updSchedTimeOut'])){
            $schedManage -> changeScheduleInfo($_POST['updSchedID'], $_POST['updSchedType'], $_POST['updSchedRoom'], $_POST['updSchedSect'], $_POST['updSchedDay'], $_POST['updSchedTimeIn'], $_POST['updSchedTimeOut']);
        } else if(isset($_POST['delSchedID'])){
            $schedManage -> removeScheduleEntry($_POST['delSchedID']);
            exit;
        }
?>