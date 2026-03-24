<?php
    require_once("../model/database.php");
    require_once("../model/userRegistrationModel.php");

    class registrationManage{
        private $registerModel;

        public function __construct()
        {
            $database = new Database();
            $db = $database->connect();

            $this->registerModel = new registrationTable($db);
        }

        public function addNewRegistration($userID, $role, $fName, $lName, $password){
            try {
                if($this->registerModel->createRegistration($userID, $role, $fName, $lName, $password)){
                    echo "Registration sent for apprival.";
                } else{
                    echo "Error encountered while registering.";
                }
            } catch (InvalidArgumentException $ex) {
                http_response_code(500);
                echo $ex->getMessage();
                exit;
            }
        }

        public function readRegistrationList(){
            $response = $this->registerModel->readUsers();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }

        public function denyRegistration($deleteID){
            try {
                if($this->registerModel->deleteUser($deleteID)){
                    echo "User deleted successfully.";
                }else{
                    echo "Error encountered while deleting user.";
                }
            } catch (InvalidArgumentException $ex) {
                http_response_code(500);
                echo $ex->getMessage();
                exit;
            }
        }
    }


?>