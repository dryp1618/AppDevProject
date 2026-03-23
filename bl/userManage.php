<?php
    require_once("../model/database.php");
    require_once("../model/usersModel.php");

    class userManage{
        private $userModel;

        public function __construct()
        {
            $database = new Database();
            $db = $database->connect();

            $this->userModel = new usersTable($db);
        }

        public function addNewUser($fName, $lName, $userID, $role){
            try {
                if($this->userModel->createUserModel($fName, $lName, $userID, $role)){
                    echo "User added successfuly!";
                } else{
                    echo "Error encountered while adding user.";
                }
            } catch (InvalidArgumentException $ex) {
                http_response_code(500);
                echo $ex->getMessage();
                exit;
            }
        }

        public function getUser(){
            $response = $this->userModel->readUsers();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }

        public function processDataFunc($fNameParam, $lNameParam) {
            try {
                echo $fNameParam . ' ' . $lNameParam . ' from, PHP';
                exit;
            } catch (InvalidArgumentException $ex) {
                http_response_code(501);
                echo $ex -> getMessage();
                exit;
            }
        }
    }


?>