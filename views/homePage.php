<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Tracker | Homepage</title>
    <link rel="stylesheet" href="components/main.css">
    <link rel="stylesheet" href="home.css">
    <script defer type="text/javascript" src="../scripts/script.js"></script>
    <nav>
        <button onclick="toggleSidebar()" class="mobile-only">Button</button>
        <?php include_once("components/navbarPublic.html");?>
    </nav>
</head>
<body>
    <main class="main-border-box">
        <h1>Hello World</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita quia quibusdam ducimus quis suscipit, beatae maxime vitae molestias et doloribus harum ex laboriosam nisi quas. Porro voluptates doloremque quo expedita.</p>
    </main>
    <aside class="main-border-box" id="sidebar">
        <h1>NO ROOM SELECTED</h1>
    </aside>
</body>
</html>