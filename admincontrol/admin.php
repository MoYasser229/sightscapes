<?php
session_start();
include_once '../errorHandler/errorHandlers.php';
set_error_handler("customError",E_ALL);
if($_SESSION['userRole'] === 'admin'){
?>
<!doctype html>
<html>
    <head>
        <title>Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="../styles/adminStyle.css" type="text/css">
        <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        <title>Sightscapes</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
<body>
    <?php
    include_once "../users/checkLogin.php"; 
    checkLogin();
    ?>
    <div class="sidenav">
        <form method = "post" action="">
        <input class = 'inputSide' type = "submit" name= "action" value ="Groups">
        <br><br>
        <input class = 'inputSide' type = "submit" name= "action" value = "Admins">
        <br><br>
        <input class = 'inputSide' type = "submit" name= "action" value = "Hikers">
        <br><br>
        <input class = 'inputSide' type = "submit" name= "action" value = "Orders">
            <br><br>
        </form>
    </div>
    <div class='main'>
        <h1>Welcome, <?php echo $_SESSION['FName'] ?></h1>
    </div>
<?php 
    if(isset($_POST['action'])){
        $conn=new mysqli("localhost","root","","project");
        if($_POST['action']=="Admins")
            {
            header("Location: otheradmin.php");
        }

        if($_POST['action']=="Hikers")
        {
            header("Location: hikers.php");
        }
        
        if($_POST['action']=="Groups"){
            header("Location: /project/controlgroups/groupadminview.php");
        }
        if($_POST['action']=="Orders"){
            echo "<script>window.location.replace('/project/orders/orders.php')</script>";
        }
    }
?>  
</body>
</html>
<?php
}
else{
    header("Location:../home/home.php");
}
?>