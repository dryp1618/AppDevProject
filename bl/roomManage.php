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

        public function getRooms(){
            $response = $this->roomModel->readUserRolesModel();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }
    }


?>