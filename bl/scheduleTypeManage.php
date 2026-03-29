<?php
    require_once("../model/database.php");
    require_once("../model/schedTypeModel.php");

    class schedTypeManage{
        private $sTypeModel;

        public function __construct()
        {
            $database = new Database();
            $db = $database->connect();

            $this->sTypeModel = new schedTypeTable($db);
        }

        public function getScheduleTypes(){
            $response = $this->sTypeModel->readSchedTypeModel();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }
    }


?>