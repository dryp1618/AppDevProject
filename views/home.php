<?php
    require_once("../bl/roomManage.php");

    $roommanagement = new roomManage();
    $roommanagement->updateStatus();
    $rooms = $roommanagement -> getRooms();

    $room = array_map(function($room) {    //rename stuff for easier recognition
        return [
            "id" => $room["room_number"],
            "name" => $room["room_number"],
            "status" => $room["statusID"]
        ];
    }, $rooms);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Tracker | Homepage</title>
    <link rel="stylesheet" href="components/main.css">
    <link rel="stylesheet" href="home.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


</head>
<body>
    <script defer>
        const rooms = <?= json_encode($room) ?>;
    </script>
    <template id="room-template">
        <div class="room-wrapper">
            <input type="radio" name="room-selection" class="room-input" id="">
            <label class="room-card">
                <h3 class="room-name"></h3>
                <span class="room-status"></span>
            </label>
        </div>
    </template>
    <nav>   
        <button onclick="toggleSidebar()" class="mobile-only">Button</button>
        <?php include_once("components/navbarAdmin.html");?>
    </nav>
    <div class="main-content">
        <main class="main-border-box">
            <div id="grid-room-container"></div>
        </main>
        <aside class="main-border-box invis" id="sidebar">
            <div id="sidebar-view"></div>
        </aside>
    </div>
    <?php require_once("components/footer.html");?>
    <script defer type="text/javascript" src="../scripts/script.js"></script>
</body>
</html>