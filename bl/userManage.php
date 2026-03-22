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

        public function createUser($fName, $lName, $role, $userID){

        }

        public function getUser(){
            $response = $this->regModel->readUsers();
            return $response->fetchAll(PDO::FETCH_ASSOC);

            //replace the role ID with actual string using array_map form summoning userReadRoles()
        }
    }


?>