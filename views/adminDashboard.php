<?php
    require_once('../bl/roomManage.php');
    require_once('../bl/scheduleManage.php');
    require_once('../bl/dayManage.php');

    $roommanagement = new roomManage();
    $roommanagement->updateStatus();
    $rmStat = $roommanagement->getRoomStat();
    $rmTotal = $roommanagement->getTotalCount();

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
            <div class="card-item card-red tooltip">
                <span class="room-count"><?=  $rmStat[0]['occupied'] ?> / <?=  $rmTotal['room_count'] ?></span> <br>
                <span class="tooltiptext">Current Occupied Room count within 30 minute interval</span>
                Occupied
                <!-- current count of rooms within this 30 minute timeframe -->
            </div>
            <div class="card-item card-green tooltip">
                <span class="room-count"><?=  $rmStat[0]['vacant'] ?> / <?=  $rmTotal['room_count'] ?></span> <br>
                <span class="tooltiptext">Current Available Room count within 30 minute interval</span>
                Vacant
            </div>
            <div class="card-item card-blue tooltip">
                <span class="room-count"><?=  $rmStat[0]['reserved'] ?> / <?=  $rmTotal['room_count'] ?></span> <br>
                <span class="tooltiptext">Current Reserved Room count within 30 minute interval</span>
                Reserved
            </div>
            <div class="card-item card-blank tooltip">
                <span class="room-count"><?=  $rmStat[0]['closed'] ?> / <?=  $rmTotal['room_count'] ?></span> <br>
                <span class="tooltiptext">Current Closed Room count within 30 minute interval</span>
                Closed
            </div>
        </div>
        <div class="graph-area">
            <div class="graph-box">Bar Graph for <br> Most used room per day (Top 5)</div>
            <div class="graph-box">Pie Graph for <br> Daily percentage of statuses</div>
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