<?php
    class userRolesTable{
        private $conn;
        public function __construct($db){
            $this->conn = $db;
        }
        
        public function readUserRoles(){
            $query = "SELECT * FROM tbl_userroles";
            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        } 
    }



?>