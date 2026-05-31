<?php
    require_once __DIR__ . '/../model/database.php';
    require_once __DIR__ . '/../model/scheduleModel.php';

    class scheduleManage{
        private $schedModel;

        public function __construct()
        {
            $database = new Database();
            $db = $database->connect();

            $this->schedModel = new scheduleTable($db);
        }

        public function registerNewSchedule($type, $section, $room, $day, $time_start, $time_end){
            try {
                if($this-> schedModel-> createScheduleModel($type, $room, $section, $day, $time_start, $time_end)){
                    echo "Making a schedule...";
                }else{
                    echo "Error encountered while making a schedule.";
                }
            } catch (InvalidArgumentException $ex) {
                http_response_code(500);
                echo $ex->getMessage();
                exit;
            }
        }

        public function getSchedules(){
            $response = $this->schedModel->readSchedulesModel();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getSchedCount(){
            $response = $this->schedModel->readSchedulesModel();
            return (int) $response;
        }

        public function changeScheduleInfo($id, $type, $room, $section, $day, $time_start, $time_end){
            try {
                if($this-> schedModel-> updateScheduleModel($id, $type, $room, $section, $day, $time_start, $time_end)){
                    echo "Changing schedule...";
                }else{
                    echo "Error encountered while changing a schedule.";
                }
            } catch (InvalidArgumentException $ex) {
                http_response_code(500);
                echo $ex->getMessage();
                exit;
            }
        }

        public function removeScheduleEntry($id){
            try {
                if($this-> schedModel-> deleteScheduleModel($id)){
                    echo "Deleting schedule...";
                }else{
                    echo "Error encountered while deleting schedule.";
                }
            } catch (InvalidArgumentException $ex) {
                http_response_code(500);
                echo $ex->getMessage();
                exit;
            }
        }

                public function getNextScheds($room_number){
                    $rows = $this->schedModel->getSideScheds($room_number)->fetchAll(PDO::FETCH_ASSOC);

                    date_default_timezone_set('Asia/Manila');
                    $currTime = date('H:i:s');
                    $status = "vacant";

                    $slots = [];
                    foreach($rows as $row){
                        // Check if current time falls within this slot
                        if($currTime >= $row['time_start'] && $currTime <= $row['time_end']){
                            $status = "occupied";
                        }

                        $slots[] = [
                            "type"  => "occupied",
                            "label" => $row["section_code"],
                            "time" => substr($row["time_start"], 0, 5) . " - " . substr($row["time_end"], 0, 5)
                        ];
                    }

                    return [
                        "name"   => $room_number,
                        "status" => $status,
                        "slots"  => $slots
                    ];
                }
    }


?>