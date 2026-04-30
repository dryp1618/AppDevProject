<?php
    session_start();
    require_once('../bl/scheduleManage.php');
    require_once('../helper/sendEmail.php');

    $schedManage = new scheduleManage();

        if (isset($_POST['newSchedType'], $_POST['newSchedSect'], $_POST['newSchedRoom'], $_POST['newSchedDay'], $_POST['newSchedTimeIn'], $_POST['newSchedTimeOut'])) {
            $schedManage -> registerNewSchedule($_POST['newSchedType'], $_POST['newSchedSect'], $_POST['newSchedRoom'], $_POST['newSchedDay'], $_POST['newSchedTimeIn'], $_POST['newSchedTimeOut']);

            if($_POST['newSchedType'] == 2){

                $days = ['Sunday', 'Monday', 'Tuesday', 'Wedesday', 'Thursday', 'Friday', 'Saturday'];

                $dateOfRes = htmlspecialchars($days[$_POST['newSchedDay']]);
                $room = htmlspecialchars($_POST['newSchedRoom']);
                $timeSpan = htmlspecialchars($_POST['newSchedTimeIn'] . '-' . $_POST['newSchedTimeOut']);
                $section = htmlspecialchars($_POST['newSchedSect']);
                $datenow = htmlspecialchars(date('Y-m-d H:i:s'));

                $email = filter_var("renrichfernandez1020@gmail.com", FILTER_VALIDATE_EMAIL);
                
                if(!$email){
                    die('Invalid email!');
                }
                    
                $body = "
                <h3>Room Reservation created</h3>
                <p><strong>Day:</strong> $dateOfRes</p>
                <p><strong>Time:</strong> $timeSpan</p>
                <p><strong>Room:</strong><br> $room</p>
                <p><strong>Section:</strong><br> $section</p>
                <p><strong>Date of creation:</strong><br> $datenow</p>
                ";
                    
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
        }
?>