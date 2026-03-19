<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Tracker | Homepage</title>
    <link rel="stylesheet" href="components/main.css">
    <link rel="stylesheet" href="home.css">
    <nav>   
        <button onclick="toggleSidebar()" class="mobile-only">Button</button>
        <?php include_once("components/navbarPublic.html");?>
    </nav>
    <script defer type="text/javascript" src="../scripts/script.js"></script>
</head>
<body>
    <template id="room-template">
        <div class="room-card">
            <h3 class="room-name"></h3>
            <span class="room-status"></span>
        </div>
    </template>
    <main class="main-border-box">
        <div id="room-grid-container"></div>
    </main>
    <aside class="main-border-box" id="sidebar">
        <h1>NO ROOM SELECTED</h1>
    </aside>

</body>
</html>