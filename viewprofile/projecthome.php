<?php
session_start();
?>
<html>
    <body>
        <?php
        echo "<a href='project1.php'> personal Info</a >";
        echo "<br>";
        echo "<a href= 'project1pt2.php'> security </a>";
        echo '<br>';
        if($_SESSION['userRole'] === 'admin')
            echo "<a href = 'warningPage.php'>WARNINGS</a>";
        ?>
    </body>
</html>


