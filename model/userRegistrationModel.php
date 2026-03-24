<?php
    class registrationTable{
        private $conn;
        public function __construct($db){
            $this->conn = $db;
        }
        
        public function createRegistration($userID, $roleID, $fName, $lName, $password){
            $query = 
              "INSERT INTO tbl_registrations
            VALUES (:idNumber, :roleID, :firstName, :lastName, :usr_password, :updatedAt, :createdAt)";

            $response = $this->conn->prepare($query);
            
            $datenow = date('Y-m-d H:i:s');
            
            $response->bindParam(":idNumber", $userID);
            $response->bindParam(":roleID", $roleID);
            $response->bindParam(":firstName", $fName);
            $response->bindParam(":lastName", $lName);
            $response->bindParam(":usr_password", $password);
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

        public function deleteUser($deleteUserID){
            $query = "DELETE FROM tbl_users WHERE idNumber = :idNumber";
            $response = $this->conn->prepare($query);

            $response->bindParam(":idNumber", $deleteUserID);

            $response->execute();

            return $response;

        }
    }



?>