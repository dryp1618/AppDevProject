<?php
    session_start();
    require_once dirname(__DIR__, 2) . '/bl/roomManage.php';
    require_once dirname(__DIR__, 2) . '/bl/scheduleManage.php';
    require_once dirname(__DIR__, 2) . '/bl/dayManage.php';

    $roommanagement = new roomManage();
    $roommanagement->updateStatus();
    $rmStat = $roommanagement->getRoomStat();
    $rmTotal = $roommanagement->getTotalCount();
    $busyRms = $roommanagement->getBusiestCount();
    $availDays = $roommanagement->getTotalAvailableDailyHour();

    $statusLabel = array_column($rmStat, 'status_name');
    $statusData = array_column($rmStat, 'status_count');

    $busyLabel = array_column($busyRms, 'room_number');
    $busyData = array_column($busyRms, 'total_hours');

    $availDailyLabel = array_column($availDays, 'day_name');
    $availDailyData = array_column($availDays, 'vacant_hours');

    $statusConfig = [
    'occupied' => [
        'class' => 'card-red',
        'label' => 'Occupied',
        'desc'  => 'Current Occupied Room count within 30 minute interval'
    ],
    'vacant' => [
        'class' => 'card-green',
        'label' => 'Vacant',
        'desc'  => 'Current Available Room count within 30 minute interval'
    ],
    'reserved' => [
        'class' => 'card-blue',
        'label' => 'Reserved',
        'desc'  => 'Current Reserved Room count within 30 minute interval'
    ],
    'closed' => [
        'class' => 'card-blank',
        'label' => 'Closed',
        'desc'  => 'Current Closed Room count within 30 minute interval'
    ]
];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Tracker | Admin Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.min.css">
    
    
    <link rel="stylesheet" href="../components/main.css">
    <link rel="stylesheet" href="admin1.css">
    <link rel="stylesheet" href="adminDashboard.css">
    <nav>
        <?php require_once dirname(__DIR__, 2) . '/views/components/navbar.php';?>
    </nav>
    
    <script defer type="text/javascript" src="../../scripts/dataTable.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer type="text/javascript" src="../../scripts/service.js"></script>
    <script defer type="text/javascript" src="../../scripts/charts.js"></script>
</head>
<body>
    <script>
        window.PieData = {
            labels: <?= json_encode($statusLabel); ?>,
            data: <?= json_encode($statusData); ?>
        }
    
        window.BarData = {
            labels: <?= json_encode($busyLabel); ?>,
            data: <?= json_encode($busyData); ?>
        }
        
        window.LineData = {
            labels: <?= json_encode($availDailyLabel); ?>,
            data: <?= json_encode($availDailyData); ?>
        }
        
        $(document).ready(function () {
            $("#myTable").DataTable();
        }); 
    </script>
    <?php include_once("adminSideNavbar.html");?>
    <main class="main-border-box">
        <div class="card-area">
            <?php foreach ($rmStat as $stat): 
                $statusKey = strtolower($stat['status_name']); 
                if (!isset($statusConfig[$statusKey])) continue; 
                $config = $statusConfig[$statusKey];
            ?>
                <div class="card-item <?= $config['class'] ?> tooltip">
                    <span class="room-count">
                        <?= $stat['status_count'] ?> / <?= $rmTotal['room_count'] ?>
                    </span> <br>
                    <span class="tooltiptext"><?= $config['desc'] ?></span>
                    <?= $config['label'] ?>
                </div>
            <?php endforeach; ?>
            
        </div>
        <div class="graph-area">
            <div class="graph-box">
                <canvas id="pieChart"></canvas>
            </div>
            <div class="graph-box">
                <canvas id="barChart"></canvas>
            </div>
            <div class="graph-box">
                <canvas id="lineChart"></canvas>
            </div>
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