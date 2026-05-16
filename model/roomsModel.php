<?php
    class roomsTable{
        private $conn;
        public function __construct($db){
            $this->conn = $db;
        }

        public function disableRoom($room){
            $query="UPDATE tbl_rooms
                    SET statusID = 
                            CASE 
                            WHEN statusID = 4 THEN 1
                            ELSE 4
                    END,
                    updatedAt = :updatedAt
                    WHERE room_number = :room_number;";
            $response = $this->conn->prepare($query);

            date_default_timezone_set('Asia/Manila');
            $datenow = date('Y-m-d H:i:s');
            
            $response->bindParam(":room_number", $room);
            $response->bindParam(":updatedAt", $datenow);
            
            $response->execute();
            return $response;
            }
            
            public function updateStatusModel(){
                $query="UPDATE tbl_rooms
                    LEFT JOIN tbl_schedules 
                        ON tbl_rooms.room_number = tbl_schedules.room_number 
                        AND tbl_schedules.day_id = DAYOFWEEK(CURRENT_DATE() + INTERVAL 1 DAY) - 1
                        AND CURRENT_TIME() BETWEEN tbl_schedules.time_start AND tbl_schedules.time_end
                    SET 
                        tbl_rooms.statusID = CASE 
                            WHEN tbl_schedules.schedTypeID = 2 THEN 3
                            WHEN tbl_schedules.room_number IS NOT NULL THEN 1
                            ELSE 2
                        END,
                        tbl_rooms.updatedAt = :updatedAt
                    WHERE tbl_rooms.statusID NOT IN (3, 4);";
            $response = $this->conn->prepare($query);

            date_default_timezone_set('Asia/Manila');
            $datenow = date('Y-m-d H:i:s');

            $response->bindParam(":updatedAt", $datenow);

            $response->execute();
            return $response;
        }

        public function readRoomStatus(){
            $query = "SELECT 
                            SUM(IF(statusID = 1, 1, 0)) AS occupied,
                            SUM(IF(statusID = 2, 1, 0)) AS vacant,
                            SUM(IF(statusID = 3, 1, 0)) AS reserved,
                            SUM(IF(statusID = 4, 1, 0)) AS closed
                        FROM tbl_rooms;";
            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        }
        
        public function readRoomsModel(){
            $query = "SELECT * FROM tbl_rooms";
            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        }

        public function countBusiestRoomModel(){
            $query = "SELECT room_number, 
                        ROUND(SUM(TIME_TO_SEC(TIMEDIFF(time_end, time_start))) / 3600, 2) AS total_hours
                    FROM tbl_schedules
                    WHERE day_id = DATE_FORMAT(CURDATE(), '%w')
                    GROUP BY room_number
                    ORDER BY total_hours DESC
                    LIMIT 10;";
            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        }

        public function countDayVacancy(){
            $query = "SELECT tbl_days.day_name,
                        840 - ROUND(SUM(TIME_TO_SEC(TIMEDIFF(LEAST(tbl_schedules.time_end, '21:00:00'), GREATEST(tbl_schedules.time_start, '07:00:00'))) / 3600), 2) AS vacant_hours
                    FROM tbl_schedules
                    JOIN tbl_days ON tbl_schedules.day_id = tbl_days.day_id
                    WHERE tbl_schedules.time_start < '21:00:00' AND tbl_schedules.time_end > '07:00:00'
                    GROUP BY tbl_days.day_id, tbl_days.day_name
                    ORDER BY tbl_days.day_id;";
            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        }

        public function countRoomsModel(){
            $query = "SELECT COUNT(room_number) AS room_count FROM tbl_rooms";
            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        }
    }
?>