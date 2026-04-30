<?php
    class sectionsTable{
        private $conn;
        public function __construct($db){
            $this->conn = $db;
        }
        
        public function readSectionsModel(){
            // $query = "SELECT tbl_users.*, tbl_userroles.role_name FROM tbl_users INNER JOIN tbl_userroles ON tbl_users.roleID = tbl_userroles.roleID";

            $query = "SELECT tbl_sections.*, tbl_departments.dept_code, tbl_departments.dept_name FROM tbl_sections INNER JOIN tbl_departments ON tbl_sections.departmentID = tbl_departments.departmentID";
            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        } 
    }



?>