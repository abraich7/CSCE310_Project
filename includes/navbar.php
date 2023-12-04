<nav>
    <ul>
        <?php        
        // Check user type and set the home link accordingly
        if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "admin") {
            echo '<li><a href="../login/admin_links.php">Home</a></li>';
        } else {
            echo '<li><a href="../login/student_links.php">Home</a></li>';
        }
        ?>
        <li><a href="../login/logout.php">Logout</a></li>
    </ul>
</nav>
