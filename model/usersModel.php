<?php
    class usersTable{
        private $conn;
        public function __construct($db){
            $this->conn = $db;
        }
        
        public function createUserModel($fName, $lName, $userID, $roleID ){
            $query = 
            "INSERT INTO tbl_users
            VALUES (:idNumber, :roleID, :firstName, :lastName, :updatedAt, :createdAt)"; 

            $response = $this->conn->prepare($query);
            
            $datenow = date('Y-m-d H:i:s');
            
            $response->bindParam(":idNumber", $userID);
            $response->bindParam(":roleID", $roleID);
            $response->bindParam(":firstName", $fName);
            $response->bindParam(":lastName", $lName);
            $response->bindParam(":updatedAt", $datenow);
            $response->bindParam(":createdAt", $datenow);
            
            $response->execute();
            
            return $response;
        }
        public function readUsers(){
            $query = "SELECT tbl_users.*, tbl_userroles.roleName FROM tbl_users INNER JOIN tbl_userroles ON tbl_users.roleID = tbl_userroles.roleID";
            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        } 

            
        public function updateUser($fName, $lName, $regID){
            $query="UPDATE tbl_registrations SET firstName = : firstName, lastName = :lastName, updatedAt = :updatedAt WHERE regsitartionID == :registrationID";
            $response = $this->conn->prepare($query);

            $datenow = date('Y-m-d H:i:s');
            $response->bindParam(":firstName", $fName);
            $response->bindParam(":lastName", $lName);
            $response->bindParam(":registrationID", $regID);
            $response->bindParam(":updatedAt", $datenow);

            $response->execute();
            return $response;
        }   

        public function deleteUser($regID){
            $query = "DELETE FROM tbl_registations WHERE registartionID = :registartionID";
            $response = $this->conn->prepare($query);
            $response->execute();

            return $response;

        }
    }



?>