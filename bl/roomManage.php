<?php
    require_once("../model/database.php");
    require_once("../model/roomsModel.php");

    class roomManage{
        private $roomModel;

        public function __construct()
        {
            $database = new Database();
            $db = $database->connect();

            $this->roomModel = new roomsTable($db);
        }

        // public function toggleDisable($room){
        //     try {
        //         $this->roomModel->changeStatusModel($room, $newStat);
        //     } catch (InvalidArgumentException $ex) {
        //         http_response_code(500);
        //         echo $ex->getMessage();
        //         exit;
        //     }
        // }

        public function getRooms(){
            $response = $this->roomModel->readRoomsModel();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }
        

        public function updateStatus(){
            try {
                if($this->roomModel->updateStatusModel()){
                    // echo "Updating each room status...";
                }else{
                    echo "Error encountered while updating status.";
                }
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

        public function getRoomStat(){
            $response = $this->roomModel->readRoomStatus();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }
    }


?>