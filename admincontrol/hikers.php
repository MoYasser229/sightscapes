<?php
    session_start();
    include_once '../errorHandler/errorHandlers.php';
    set_error_handler('customError',E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
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
    <?php
    include_once "../users/checkLogin.php"; 
    checkLogin();
    ?>
    <div class='mainAdmin'>
    <div class="topTextAdmin">
            <h1>Hikers</h1>
            <p>Right here, you can view all admins.</p>
            <hr>
        </div>
    <?php
    
    if($_SESSION['userRole'] === 'admin'){
        
        $conn=new mysqli("localhost","root","","project");
        ?>
            <form method='post' action=''>
            <select name = 'sortArrange'>
            <option value='DESC' selected>descending</option>
            <option value='ASC' >ascending</option>
            </select>
            <select name = 'sort'>
            <option value='userID' selected>ID</option>
            <option value='fname' >First Name</option>
            <option value='lname' >Last Name</option>
            <option value='email' >Email</option>
            </select>
            Search <select name='searchlist' id='searchlist'>
            <option value='all' selected>All</option>
            <option value='userID' >Admin ID</option>
            <option value='fname' >First Name</option>
            <option value='lname' >Last Name</option>
            <option value='email' >Email</option>
            </select>
            <input name = 'search' id='search'>
            <input type='submit' name='submit'>
            </form>
            <br>
        <?php

        $orderby = "userID";
        $sort = "ASC";
        $narrowedsearch='';
        $txtsr='';

        if(isset($_POST['submit'])){
            if(isset($_POST['sortArrange']))
            if($_POST['sortArrange'] === "DESC")
            $sort = "DESC";
            if(isset($_POST['sort']))
            if($_POST['sort'] === 'fname' || $_POST['sort'] === 'lname' || $_POST['sort'] === 'email')
            $orderby = $_POST['sort'];
            if(isset($_POST['search'])){
                if($_POST['searchlist']!='all'){
                    $narrowedsearch=$_POST['searchlist'];
                }
                $txtsr=$_POST['search'];
            }
        }
        if($txtsr=="")
        $sql="SELECT * FROM users WHERE userRole = 'hiker' ORDER BY $orderby $sort";
        else if($txtsr!=""&&($_POST['searchlist']=='all'))
        $sql = "SELECT * FROM users WHERE concat(userID,fname,lname,email,pswrd) LIKE '%$txtsr%' AND userRole = 'hiker'
        ORDER BY $orderby $sort;";
        else if($txtsr!=""&&$narrowedsearch!="")
        $sql = "SELECT * FROM users WHERE $narrowedsearch='$txtsr' AND userRole = 'hiker'
        ORDER BY $orderby $sort;";

        $result=$conn->query($sql) or die($conn->error);
        if($txtsr!=""&&(mysqli_num_rows($result)) == 0)
            echo "There are no results <br> Try searching again";
        else{
            echo "<table class = 'tableClass' ><tr><th>Hiker ID</th><th>FirstName</th><th>LastName</th><th>Email</th></tr>";
            while($row=$result->fetch_assoc()){
            echo "<tr><td>" .$row['userID']. "</td><td>" .$row['fname']. "</td><td>" .$row['lname'] . "</td><td>" .$row['email'] . "</td></tr>";
            }
        }
        echo "</table>";
    }
    else{
        header('Location:../home/home.php');
    }
    ?>
    </div>
</body>
</html>


<?php 
    if(isset($_POST['action'])){
        $conn=new mysqli("localhost","root","","project");
        if($_POST['action']=="Admins")
            {
            echo "<script>window.location.replace('otheradmin.php')</script>";
        }

        if($_POST['action']=="Hikers")
        {
            echo "<script>window.location.replace('hikers.php')</script>";
        }
        
        if($_POST['action']=="Groups"){
            echo "<script>window.location.replace('/project/controlgroups/groupadminview.php')</script>";
        }
        if($_POST['action']=="Orders"){
            echo "<script>window.location.replace('/project/orders/orders.php')</script>";
        }
    }
?>  