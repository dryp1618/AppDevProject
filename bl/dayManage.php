<?php
    // require_once("../model/database.php");
    require_once __DIR__ . '/../model/database.php';
    
    // require_once("../model/daysModel.php");
    require_once __DIR__ . '/../model/daysModel.php';

    class dayManage{
        private $dayModel;

        public function __construct()
        {
            $database = new Database();
            $db = $database->connect();

            $this->dayModel = new daysTable($db);
        }

        public function getDays(){
            $response = $this->dayModel->readUserRolesModel();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }
    }


?>