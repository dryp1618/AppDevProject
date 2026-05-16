<?php
    require_once __DIR__ . '/../model/database.php';
    require_once __DIR__ . '/../model/sectionModel.php';

    class sectionManage{
        private $secModel;

        public function __construct()
        {
            $database = new Database();
            $db = $database->connect();

            $this->secModel = new sectionsTable($db);
        }

        public function getSections(){
            $response = $this->secModel->readSectionsModel();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }
    }


?>