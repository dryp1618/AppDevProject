<?php
    session_start();
    require_once('../bl/userManage.php');
    require_once('../bl/roleManage.php');

    $usermanagement = new userManage();
    $rolemanagement = new roleManage();
    $users = $usermanagement -> getUser();
    $roles = $rolemanagement -> getRoles();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Tracker | Admin Homepage</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="components/main.css">
    <link rel="stylesheet" href="admin.css">
    <nav>   
        <?php include_once("components/navbarAdmin.html");?>
    </nav>
    <script defer type="text/javascript" src="../scripts/service.js"></script>
    <script defer type="text/javascript" src="../scripts/dataTable.js"></script>
</head>
<body>
    <script async>
        $(document).ready(function () {
        $("#myTable").DataTable();
        });

    </script>
    <?php include_once("components/adminSideNavbar.html");?>
    <main class="main-border-box main-top">
        <div class="row">
            <div class="row">
                <div class="row input-field col s12 m12 l4">
                    <div class="input-field col s12 m12 l6">
                        <input id="txtFirstName" type="text" class="validate">
                        <label for="txtFirstName">First Name</label>
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <input id="txtLastName" type="text" class="validate">
                        <label for="txtLastName">Last Name</label>
                    </div>
                    <div class="input-field col s12 m12 l12">
                        <input id="txtUserID" type="text" class="validate">
                        <label for="txtUserID">ID Number</label>
                    </div>
                </div>

                <div class="col s12 m12 l4 select">
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var elems = document.querySelectorAll('select');
                            var options = document.querySelectorAll('option');
                            var instances = M.FormSelect.init(elems, options);
                        });
                    </script>
                    <select id="roleSelect">
                        <option value="" disabled selected>Choose a role</option>
                        <?php foreach ($roles as $role) : ?>
                            <option value="<?=  $role['roleID'] ?>">
                                <?= ucfirst($role['roleName'])?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <label>Select User role</label>
                </div>
                <div class="col s12 m12 l4">
                    <br><br>
                    <a class="waves-effect waves-light btn deep-purple lighten-2" style="width: 90%;" onclick="addUserFunc()"><i class="material-icons right">add_circle_outline</i>Add User</a>
                    <br><br>
                    <a class="waves-effect waves-light btn" style="width: 90%; background: #8b8b8b;" onclick="clearUserFormsFunc();"><i class="material-icons right">backspace</i>Clear</a>
                </div>
            </div>
        </div>
    </main>
    <main class="main-border-box main-bottom">
        <table class="centered higlight striped" id="myTable">
            <thead>
                <tr>
                    <th> User ID </th>
                    <th> First Name </th>
                    <th> Last Name </th>
                    <th> Role </th>
                    <th> Action </th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($users)) :  ?>
                <?php foreach($users as $user) : ?>
                <tr>
                        <td><?= $user["idNumber"] ?></td>
                        <td><?= $user["firstName"] ?></td>
                        <td><?= $user["lastName"] ?></td>
                        <td><?= ucfirst($user["roleName"]) ?></td>
                    <td class="">
                        <a class="btn-floating btn-large waves-effect waves-light" style="background: #4296ba;" onclick="updateUserFunc(<?= $user['idNumber'] ?>)" title="Update user info"><i class="material-icons">update</i></a>
                        <a class="btn-floating btn-large waves-effect waves-light" style="background: #e02b2e;" onclick="deleteUserFunc(<?= $user['idNumber'] ?>)" title="Delete user"><i class="material-icons">remove_circle</i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td>No Data Found</td>
                </tr>
                <?php endif ?>
            </tbody>
        </table>
    </main>

</body>
</html>