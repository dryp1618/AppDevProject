<?php
    require_once("../model/database.php");
    require_once("../model/usersModel.php");

    class userManage{
        private $regModel;

        public function __construct()
        {
            $database = new Database();
            $db = $database->connect();

            $this->regModel = new usersTable($db);
        }

        public function getUser(){
            $response = $this->regModel->readRegistration();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }
    }


?>