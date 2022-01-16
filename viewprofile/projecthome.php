<?php 
session_start();
include_once '../errorHandler/errorHandlers.php';
set_error_handler('loginError',E_ALL);
?>
<html>
    <body>
        <?php
        echo "<a href='project1.php'> personal Info</a >";
        echo "<br>";
        echo "<a href= 'Editinfopt2.php'> security </a>";
        echo '<br>';
        if($_SESSION['userRole'] === 'admin')
            echo "<a href = 'warningPage.php'>WARNINGS</a>";
        ?>
    </body>
</html>


