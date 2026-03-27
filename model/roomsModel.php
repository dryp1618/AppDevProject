<?php
    class roomsTable{
        private $conn;
        public function __construct($db){
            $this->conn = $db;
        }
        
        public function readUserRolesModel(){
            $query = "SELECT * FROM tbl_rooms";
            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        } 
    }



?>