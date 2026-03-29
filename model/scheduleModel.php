<?php
    class scheduleTable{
        private $conn;
        public function __construct($db){
            $this->conn = $db;
        }

        public function createScheduleModel($room, $section, $day, $time_start, $time_end){
            $query = 
            "INSERT INTO tbl_schedules
            VALUES (:room_number, :schedTypeID, :day, :time_start, :time_end, :updatedAt, :createdAt)"; 

            $response = $this->conn->prepare($query);
            
            $days = [
                1 => "sunday",
                2 => "monday",
                3 => "tuesday",
                4 => "wednesday",
                5 => "thursday",
                6 => "friday",
                7 => "saturday"
            ];

            $defaultSchedType = 1;
            $datenow = date('Y-m-d H:i:s');
            
            $response->bindParam(":room_number", $room);
            $response->bindParam(":schedTypeID", $defaultSchedType);
            $response->bindParam(":day", $days[$day]);
            $response->bindParam(":time_start", $time_start);
            $response->bindParam(":time_end", $time_end);
            $response->bindParam(":updatedAt", $datenow);
            $response->bindParam(":createdAt", $datenow);
            
            $response->execute();
            
            return $response;
        }
        
        public function readSchedulesModel(){
            // $query = "SELECT tbl_users.*, tbl_userroles.role_name FROM tbl_users INNER JOIN tbl_userroles ON tbl_users.roleID = tbl_userroles.roleID";

            $query = "SELECT tbl_schedules.*, tbl_schedtype.* FROM tbl_schedules INNER JOIN tbl_schedtype ON tbl_schedules.schedTypeID = tbl_schedtype.schedTypeID";

            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        } 
    }



?>