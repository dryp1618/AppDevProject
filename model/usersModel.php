<?php
    class usersTable{
        private $conn;
        public function __construct($db){
            $this->conn = $db;
        }
        
        public function createUserModel($userID, $fName, $lName, $phone_num, $email, $password){
            $query = 
            "INSERT INTO tbl_users
            VALUES (:userID, :roleID, :firstName, :lastName, :password, :email, :phone_number, :updatedAt, :createdAt)";

            $response = $this->conn->prepare($query);
            
            $roleIDdefault = 2; // default user
            date_default_timezone_set('Asia/Manila');
            $datenow = date('Y-m-d H:i:s');

            // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);
            
            $response->bindParam(":userID", $userID);
            $response->bindParam(":roleID", $roleIDdefault);
            $response->bindParam(":firstName", $fName);
            $response->bindParam(":lastName", $lName);
            $response->bindParam(":password", $hashedPassword);
            $response->bindParam(":email", $email);
            $response->bindParam(":phone_number", $phone_num);
            $response->bindParam(":updatedAt", $datenow);
            $response->bindParam(":createdAt", $datenow);
            
            $response->execute();
            
            return $response;
        }
        public function readUsers(){
            $query = "SELECT tbl_users.*, tbl_userroles.role_name FROM tbl_users INNER JOIN tbl_userroles ON tbl_users.roleID = tbl_userroles.roleID";
            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        } 

        public function updateUserModel($userID, $role, $fName, $lName){
            $query="UPDATE tbl_users SET roleID = :roleID, firstName = : firstName, lastName = :lastName, updatedAt = :updatedAt WHERE userID = :userID";
            $response = $this->conn->prepare($query);

            date_default_timezone_set('Asia/Manila');
            $datenow = date('Y-m-d H:i:s');
            $response->bindParam(":firstName", $fName);
            $response->bindParam(":lastName", $lName);
            $response->bindParam(":IdNumber", $userID);
            $response->bindParam(":roleID", $role);
            $response->bindParam(":updatedAt", $datenow);

            $response->execute();
            return $response;
        }

        public function deleteUserModel($deleteUserID){
            $query = "DELETE FROM tbl_users WHERE userID = :userID";
            $response = $this->conn->prepare($query);

            $response->bindParam(":userID", $deleteUserID);

            $response->execute();

            return $response;
        }

        public function loginUserModel($userID, $userPassword){
            $query = "SELECT * FROM tbl_users WHERE userID = :userID";
            $response = $this->conn->prepare($query);

            $response->bindParam(":userID", $userID);
            $response->execute();

            $passCheck = $response->fetch(PDO::FETCH_ASSOC);

            if(!isset($passCheck['password'])){
                return false;
            }

            if($userPassword == $passCheck['password']){
                return true;
            }

            return password_verify($userPassword, $passCheck['password']);
            exit;
        }
    }
?>