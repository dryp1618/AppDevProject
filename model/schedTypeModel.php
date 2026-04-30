<?php
    class schedTypeTable{
        private $conn;
        public function __construct($db){
            $this->conn = $db;
        }
        
        public function readSchedTypeModel(){
            $query = "SELECT * FROM tbl_schedType";

            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        } 
    }



?>