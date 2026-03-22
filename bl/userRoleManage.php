<?php
    require_once("../model/database.php");
    require_once("../model/userRoleModel.php");

    class userManage{
        private $roleModel;

        public function __construct()
        {
            $database = new Database();
            $db = $database->connect();

            $this->roleModel = new userRolesTable($db);
        }

        public function getRoles(){
            $response = $this->roleModel->readUserRoles();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }
    }


?>