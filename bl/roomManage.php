<?php
    require_once __DIR__ . '/../model/database.php';
    require_once __DIR__ . '/../model/roomsModel.php';

    class roomManage{
        private $roomModel;

        public function __construct()
        {
            $database = new Database();
            $db = $database->connect();

            $this->roomModel = new roomsTable($db);
        }

        public function toggleDisable($room){
            try {
                $this->roomModel->disableRoom($room);
            } catch (InvalidArgumentException $ex) {
                http_response_code(500);
                echo $ex->getMessage();
                exit;
            }
        }

        public function getRooms(){
            $response = $this->roomModel->readRoomsModel();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }

        public function updateStatus(){
            try {
                $this->roomModel->updateStatusModel();
            } catch (InvalidArgumentException $ex) {
                http_response_code(500);
                echo $ex->getMessage();
                exit;
            }
        }

        public function getTotalCount(){
            $response = $this->roomModel->countRoomsModel();
            return $response->fetch(PDO::FETCH_ASSOC);
        }

        public function getBusiestCount(){
            $response = $this->roomModel->countBusiestRoomModel();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getTotalAvailableDailyHour(){
            $response = $this->roomModel->countDayVacancy();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getRoomStat(){
            $response = $this->roomModel->readRoomStatus();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }

    }


?>