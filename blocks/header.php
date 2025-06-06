<header>
    <nav class="navbar navbar-expand-lg navbar-dark px-4">
        <a class="navbar-brand" href="#">🍽 Recipe Wall</a>
        <div class="ms-auto d-flex align-items-center gap-3">
            <a href="/" class="nav-link text-white">Home</a>
            <a href="about.php" class="nav-link text-white">About us</a>
            <?php
            session_start();
            if (isset($_SESSION["username"])) {
                echo '<a href="cabine.php" class="btn btn-outline-light">Personal account</a>';
                echo '<a href="logout.php" class="btn btn-danger">Exit</a>';
            } else {
                echo '<a href="login.php" class="btn btn-outline-light">Login</a>';
                echo '<a href="register.php" class="btn btn-primary">Registration</a>';
            }
            ?>
        </div>
    </nav>
</header>