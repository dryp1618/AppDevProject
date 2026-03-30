<?php
    class scheduleTable{
        private $conn;
        public function __construct($db){
            $this->conn = $db;
        }

        public function createScheduleModel($type, $room, $section, $day, $time_start, $time_end){
            $query = 
            "INSERT INTO tbl_schedules
            (room_number, schedTypeID, day_id, time_start, time_end, section_code, updatedAt, createdAt)
            VALUES (:room_number, :schedTypeID, :day_id, :time_start, :time_end, :section_code, :updatedAt, :createdAt)";

            $response = $this->conn->prepare($query);
            
            $datenow = date('Y-m-d H:i:s');
            
            $response->bindParam(":room_number", $room);
            $response->bindParam(":schedTypeID", $type);
            $response->bindParam(":day_id", $day);
            $response->bindParam(":section_code", $section);
            $response->bindParam(":time_start", date_format(date_create($time_start), "H:i:s"));
            $response->bindParam(":time_end", date_format(date_create($time_end), "H:i:s"));
            $response->bindParam(":updatedAt", $datenow);
            $response->bindParam(":createdAt", $datenow);
            
            $response->execute();
            
            return $response;
        }
        
        public function readSchedulesModel(){
            // $query = "SELECT tbl_users.*, tbl_userroles.role_name FROM tbl_users INNER JOIN tbl_userroles ON tbl_users.roleID = tbl_userroles.roleID";

            $query = "SELECT tbl_schedules.*, tbl_schedtype.*, tbl_days.day_name FROM tbl_schedules INNER JOIN tbl_schedtype ON tbl_schedules.schedTypeID = tbl_schedtype.schedTypeID INNER JOIN tbl_days ON tbl_schedules.day_id = tbl_days.day_id";

            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        } 

        public function updateScheduleModel($id, $type, $room, $section, $day, $time_start, $time_end){
            $query="UPDATE tbl_schedules SET  room_number = :room_number, schedTypeID = :schedTypeID, day_id = :day_id, time_start = :time_start, time_end = :time_end, section_code = :section_code, updatedAt = :updatedAt WHERE sched_id = :sched_id";
            $response = $this->conn->prepare($query);

            $datenow = date('Y-m-d H:i:s');

            $response->bindParam(":sched_id", $id);
            $response->bindParam(":room_number", $room);
            $response->bindParam(":schedTypeID", $type);
            $response->bindParam(":day_id", $day);
            $response->bindParam(":section_code", $section);
            $response->bindParam(":time_start", date_format(date_create($time_start), "H:i:s"));
            $response->bindParam(":time_end", date_format(date_create($time_end), "H:i:s"));
            $response->bindParam(":updatedAt", $datenow);


            $response->execute();
            return $response;
        }

        public function deleteScheduleModel($id){
            $query = "DELETE FROM tbl_schedules WHERE sched_id = :sched_id";
            $response = $this->conn->prepare($query);

            $response->bindParam(":sched_id", $id);

            $response->execute();

            return $response;
        }
    }
?>