<?php
    session_start();
    require_once('../bl/userManage.php');

    $usermanagement = new userManage();
    $users = $usermanagement -> getUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Tracker | Admin Homepage</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.min.css">
    
    <link rel="stylesheet" href="components/main.css">
    <link rel="stylesheet" href="admin1.css">
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
    <main class="main-border-box">
        <table class="display compact" id="myTable">
            <thead>
                <tr>
                    <th> User ID </th>
                    <th> First Name </th>
                    <th> Last Name </th>
                    <th> Role </th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($users)) :  ?>
                <?php foreach($users as $user) : ?>
                <tr>
                        <td><?= $user["userID"] ?></td>
                        <td><?= $user["firstName"] ?></td>
                        <td><?= $user["lastName"] ?></td>
                        <td><?= ucfirst($user["role_name"]) ?></td>
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