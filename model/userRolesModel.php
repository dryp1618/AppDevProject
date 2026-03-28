<?php
    class rolesTable{
        private $conn;
        public function __construct($db){
            $this->conn = $db;
        }
        
        public function readUserRolesModel(){
            $query = "SELECT tbl_users.*, tbl_userroles.role_name FROM tbl_users INNER JOIN tbl_userroles ON tbl_users.roleID = tbl_userroles.roleID";

            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        } 
    }



?>