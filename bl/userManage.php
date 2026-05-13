<?php
    // require_once("../model/database.php");
    require_once __DIR__ . '/../model/database.php';
    
    // require_once("../model/usersModel.php");
    require_once __DIR__ . '/../model/usersModel.php';

    class userManage{
        private $userModel;

        public function __construct()
        {
            $database = new Database();
            $db = $database->connect();

            $this->userModel = new usersTable($db);
        }

        public function registerNewUser($userID, $fName, $lName, $phone_num, $email, $password){
            try {
                if($this->userModel->createUserModel($userID, $fName, $lName, $phone_num, $email, $password)){
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

        public function changeUserInfo($userID, $roleID, $fName, $lName){
            try {
                if($this->userModel->updateUserModel($userID, $roleID, $fName, $lName)){
                    echo "User info updated successfully.";
                }else{
                    echo "Error encountered while updating user credentials.";
                }
            } catch (InvalidArgumentException $ex) {
                http_response_code(500);
                echo $ex->getMessage();
                exit;
            }
        }

        public function removeUser($deleteID){
            try {
                if($this->userModel->deleteUserModel($deleteID)){
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

        public function loginUser($inputID, $inputPass){
            try {
                if($this->userModel->loginUserModel($inputID, $inputPass)){
                    return true;
                }else{
                    return false;
                }
            } catch (InvalidArgumentException $ex) {
                http_response_code(500);
                echo $ex->getMessage();
                exit;
            }
        }
    }


?>