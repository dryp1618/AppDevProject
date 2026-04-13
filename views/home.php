<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Tracker | Homepage</title>
    <link rel="stylesheet" href="components/main.css">
    <link rel="stylesheet" href="home.css">
    <script defer type="text/javascript" src="../scripts/script.js"></script>
</head>
<body>
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
        <aside class="main-border-box asidebar-content" id="sidebar">
            <div id="sidebar-view"></div>
        </aside>
    </div>

</body>
</html>