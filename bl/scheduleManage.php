<?php
    require_once("../model/database.php");
    require_once("../model/scheduleModel.php");

    class scheduleManage{
        private $schedModel;

        public function __construct()
        {
            $database = new Database();
            $db = $database->connect();

            $this->schedModel = new scheduleTable($db);
        }

        public function getSchedules(){
            $response = $this->schedModel->readSchedulesModel();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }
    }


?>