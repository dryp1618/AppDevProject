<?php
    class roomsTable{
        private $conn;
        public function __construct($db){
            $this->conn = $db;
        }

        public function changeStatusModel($room, $newStat){
            $query="UPDATE tbl_rooms SET statusID = :statusID, updatedAt = :updatedAt WHERE room_number = :room_number";
            $response = $this->conn->prepare($query);

            date_default_timezone_set('Asia/Manila');
            $datenow = date('Y-m-d H:i:s');

            $response->bindParam(":statusID", $newStat);
            $response->bindParam(":room_number", $room);
            $response->bindParam(":updatedAt", $datenow);

            $response->execute();
            return $response;
        }

        public function updateStatusModel(){
            $query="UPDATE tbl_rooms
                    LEFT JOIN tbl_schedules ON tbl_rooms.room_number = tbl_schedules.room_number 
                        AND tbl_schedules.day_id = WEEKDAY(CURRENT_DATE() + INTERVAL 1 DAY) % 7
                        AND CURRENT_TIME() BETWEEN tbl_schedules.time_start AND tbl_schedules.time_end
                    SET 
                        -- Logic for statusID
                        tbl_rooms.statusID = CASE 
                            WHEN tbl_schedules.schedTypeID = 2 THEN 3
                            WHEN tbl_schedules.room_number IS NOT NULL THEN 1
                            ELSE 2
                        END,
                        -- Logic for updatedAt: Only change if statusID is different from the new target
                        tbl_rooms.updatedAt = IF(
                            tbl_rooms.statusID <> CASE 
                                WHEN tbl_schedules.schedTypeID = 2 THEN 3
                                WHEN tbl_schedules.room_number IS NOT NULL THEN 1
                                ELSE 2
                            END, 
                            CURRENT_TIMESTAMP, 
                            tbl_rooms.updatedAt
                        )
                    WHERE tbl_rooms.statusID <> 4;";
            $response = $this->conn->prepare($query);

            date_default_timezone_set('Asia/Manila');
            // $datenow = date('Y-m-d H:i:s');

            // $response->bindParam(":updatedAt", $datenow);

            $response->execute();
            return $response;
        }

        public function readRoomStatus(){
            $query = "SELECT 
                        SUM(CASE WHEN statusID = 1 THEN 1 ELSE 0 END) AS occupied,
                        SUM(CASE WHEN statusID = 2 THEN 1 ELSE 0 END) AS vacant,
                        SUM(CASE WHEN statusID = 3 THEN 1 ELSE 0 END) AS reserved,
                        SUM(CASE WHEN statusID = 4 THEN 1 ELSE 0 END) AS closed
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

        public function countRoomsModel(){
            $query = "SELECT COUNT(room_number) AS room_count FROM tbl_rooms";
            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        }
    }



?>