<?php
    session_start();
    include_once '../errorHandler/errorHandlers.php';
    //set_error_handler('customError',E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <title>Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="../styles/adminStyle.css" type="text/css">
        <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        <title>Sightscape</title>

        <!-- Bootstrap CSS -->
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
        </form>
    </div>
    <?php
        function checkLogin(){
            if ($_SESSION['userRole'] === "admin"){
                ?>
                        <nav class="navbar navbar-expand-md fixed-top navbar-dark background">
                    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="../home.php"><h6>HOME</h6></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../admincontrol/admin.php"><h6>DATA MANAGEMENT</h6></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="orders/orders.php"><h6>ORDERS</h6></a>
                        </li>
                        </ul>
                    </div>
                    <div class="mx-auto order-0">
                    <a class="navbar-brand" href="../home.php"><img src="../bckgrnd/logo.png" width="100px" height="100px"></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                        <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                        <a class="nav-link" href="../chat/newChat.php"><h6>CHAT</h6></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../users/signOut.php"><h6>SIGN OUT</h6></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../viewprofile/projecthome.php"><h6>PROFILE</h6></a>
                    </li>
                        </ul>
                    </div>
                </nav>
                <?php
            }
        }
        checkLogin();
    ?>
    <div class='mainAdmin'>
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
            </select><br><br>
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
            echo "<table class = 'tableClass' border = '1'><tr><th>Hiker ID</th><th>FirstName</th><th>LastName</th><th>Email</th></tr>";
            while($row=$result->fetch_assoc()){
            echo "<tr><td>" .$row['userID']. "</td><td>" .$row['fname']. "</td><td>" .$row['lname'] . "</td><td>" .$row['email'] . "</td></tr>";
            }
        }
        echo "</table>";
    }
    else{
        header('Location:../home.php');
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
            $_GET['add']=false;
            $_GET['delete']=false;
            echo "<script>window.location.replace('otheradmin.php')</script>";
        }

        if($_POST['action']=="Hikers")
        {
            $_GET['add']=false;
            $_GET['delete']=false;
            echo "<script>window.location.replace('hikers.php')</script>";
        }
        
        if($_POST['action']=="Groups"){
            $_GET['add']=false;
            $_GET['delete']=false;
            echo "<script>window.location.replace('/project/controlgroups/groupadminview.php')</script>";
        }
    }
?>  