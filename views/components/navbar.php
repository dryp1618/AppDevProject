<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $loggedIn = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true;
    $userRole = $_SESSION['userRole'] ?? 2;
?>
<nav>
    <div class="links-container">
        <ul>
            <?php if ($loggedIn): ?>
                <li><a href="/views/home.php">Home</a></li>
                <!-- <li><a href="/views/user/profile.php">User</a></li> -->
                <li><a href="#">User</a></li>
            
                <?php if ($userRole === 1): ?>
                    <li><a href="/views/admin/dashboard.php">Dashboard</a></li>
                <?php endif; ?>
                
                <li><a href="/views/components/logout.php">Logout</a></li>

            <?php else: ?>
                <li><a href="/views/login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>