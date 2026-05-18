<?php
    session_start();
    require_once('../bl/scheduleManage.php');
    require_once('../helper/sendEmail.php');

    $schedManage = new scheduleManage();

        if (isset($_POST['newSchedType'], $_POST['newSchedSect'], $_POST['newSchedRoom'], $_POST['newSchedDay'], $_POST['newSchedTimeIn'], $_POST['newSchedTimeOut'])) {
            $schedManage -> registerNewSchedule($_POST['newSchedType'], $_POST['newSchedSect'], $_POST['newSchedRoom'], $_POST['newSchedDay'], $_POST['newSchedTimeIn'], $_POST['newSchedTimeOut']);

            if($_POST['newSchedType'] == 2){

                $days = ['Sunday', 'Monday', 'Tuesday', 'Wedesday', 'Thursday', 'Friday', 'Saturday'];

                $day = htmlspecialchars($days[$_POST['newSchedDay']]);
                $room = htmlspecialchars($_POST['newSchedRoom']);
                $timeStart = htmlspecialchars(date_format(date_create($_POST['newSchedTimeIn']),"g:iA"));
                $timeEnd = htmlspecialchars(date_format(date_create($_POST['newSchedTimeOut']),"g:iA"));
                $section = htmlspecialchars($_POST['newSchedSect']);
                $datenow = htmlspecialchars(date('Y-m-d H:i:s'));

                $email = filter_var("renrichfernandez1020@gmail.com", FILTER_VALIDATE_EMAIL);
                
                if(!$email){
                    die('Invalid email!');
                }

                $body = file_get_contents(__DIR__ . '/emailFormat.html');

                $body = str_replace('{{section}}', $section, $body);
                $body = str_replace('{{room}}', $room, $body);
                $body = str_replace('{{day}}', $day, $body);
                $body = str_replace('{{start}}', $timeStart, $body);
                $body = str_replace('{{end}}', $timeEnd, $body);
                $body = str_replace('{{date}}', $datenow, $body);
                    
                //receiver, name of receiver, subject, body
                $result = sendEmail(
                    'renrichfernandez1020@gmail.com',
                    'Admin',
                    'Room Reservation',
                    $body
                    );
                        
                if($result === true){
                    echo "Email sent successfully.";
                } else {
                    echo "Email failed to send." . $result;
                }
            }
            exit;
        } else if(isset($_POST['updSchedID'], $_POST['updSchedType'], $_POST['updSchedRoom'], $_POST['updSchedSect'], $_POST['updSchedDay'], $_POST['updSchedTimeIn'], $_POST['updSchedTimeOut'])){
            $schedManage -> changeScheduleInfo($_POST['updSchedID'], $_POST['updSchedType'], $_POST['updSchedRoom'], $_POST['updSchedSect'], $_POST['updSchedDay'], $_POST['updSchedTimeIn'], $_POST['updSchedTimeOut']);
        } else if(isset($_POST['delSchedID'])){
            $schedManage -> removeScheduleEntry($_POST['delSchedID']);
            exit;
        } else if(isset($_POST['reqRoomDetail'])){
            $schedules = $schedManage->getNextScheds($_POST['reqRoomDetail']);

            $response = [
                "id"    => $_POST['reqRoomDetail'],
                "name"  => $_POST['reqRoomDetail'],
                "slots" => $schedules
            ];

            echo json_encode($response);
            exit;
        }
?>