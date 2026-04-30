<?php
    require_once("../model/database.php");
    require_once("../model/userRolesModel.php");

    class roleManage{
        private $roleModel;

        public function __construct()
        {
            $database = new Database();
            $db = $database->connect();

            $this->roleModel = new rolesTable($db);
        }

        public function getRoles(){
            $response = $this->roleModel->readUserRolesModel();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }
    }


?>