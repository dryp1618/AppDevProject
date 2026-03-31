<?php
// e
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Tracker | Admin Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.min.css">
    
    <link rel="stylesheet" href="components/main.css">
    <link rel="stylesheet" href="admin1.css">
    <link rel="stylesheet" href="adminDashboard.css">
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
        <div class="card-area">
            <div class="card-item card-red">
                Rooms Occupied for the week: 75% <br>
                34/45
            </div>
            <div class="card-item card-green">
                Rooms Vacant for the week: 20% <br>
                9/45
            </div>
            <div class="card-item card-blue">
                Rooms Reserved for the week: 4% <br>
                2/45
            </div>
            <div class="card-item card-blank">
                I don't know what to display<br>
                beep boop bap
            </div>
        </div>
        <div class="graph-area">
            <div class="graph-box">Bar Graph for <br> Most used room per day (Top 5)</div>
            <div class="graph-box">Pie Graph for <br> Daily percentage of statuses</div>
        </div>
        <div class="table-area">
            <table class="display compact" id="myTable">
                <thead>
                    <tr>
                        <th> Work </th>
                        <th> In </th>
                        <th> Progress </th>
                        <th> Standby </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($stats)) :  ?>
                        <?php foreach($stats as $stat) : ?>
                            <tr>
                                <td>N/A</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                                <tr>
                                    <td colspan="4">No Data Found</td>
                                </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </main>
    
</body>
</html>