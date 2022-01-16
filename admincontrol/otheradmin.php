<?php
    session_start();
    include_once '../errorHandler/errorHandlers.php';
    // set_error_handler('customError',E_ALL);
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
<script>
    var errorInEmail = false
    var used = false
    var errorInPassword = false
    var errorInFname = false
    var errorInLname = false
</script>
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
    <div class='mainAdmin'>
    <?php
    
    if($_SESSION['userRole'] === 'admin'){
    $error=false;
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
    $sql="SELECT * FROM users WHERE userRole = 'admin' ORDER BY $orderby $sort";
    else if($txtsr!=""&&($_POST['searchlist']=='all'))
    $sql = "SELECT * FROM users WHERE concat(userID,fname,lname,email,pswrd) LIKE '%$txtsr%' AND userRole = 'admin'
    ORDER BY $orderby $sort;";
    else if($txtsr!=""&&$narrowedsearch!="")
    $sql = "SELECT * FROM users WHERE $narrowedsearch='$txtsr' AND userRole = 'admin'
    ORDER BY $orderby $sort;";
    $result=$conn->query($sql) or die($conn->error);
    echo "<form method = 'post' action = '' >";
    if($txtsr!=""&&(mysqli_num_rows($result)) == 0)
        echo "There are no results <br> Try searching again<br>";
    else{
        echo "<table class = 'tableClass' border = '1'><tr>
        <th>Admin ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Delete</th>
        </tr>";
        while($row=$result->fetch_assoc()){
            $id=$row['userID'];
            echo "<tr>
            <td>{$id}</td>
            <td>{$row['fname']}</td>
            <td>{$row['lname']}</td>
            <td>{$row['email']}</td>
            <td><button type = 'submit' name = 'delete' value = '$id' >DELETE</button></td>
            </tr>";
        }
    }
    echo "</table><input type = 'submit' name = 'add' value = 'add' ></form>";
    if(isset($_POST['add'])){
        echo "<form action='' method='post'>
        First Name:<br>
        <input type='text' name='fname'><br> 
        Last Name:<br>
        <input type='text' name='lname'><br>
        Email:<br>
        <input type='text' name='Email'> <br>
        Password:<br>
        <input type='Password' name='Password'><br><br>
        <button type = 'submit' value='add' name='Addsub'>Submit</button>
        <input type='reset'>
        </form>";
    }
    if(isset($_POST['delete'])){
        $id=$_POST['delete'];
        $sql="DELETE FROM users WHERE userID='$id'";
        $queryResult=mysqli_query($conn,$sql);
        echo "<script>window.location.replace('otheradmin.php')</script>";
    }
    if(isset($_POST['Addsub'])){
        if(empty($_POST['fname']))
            {echo "<script>errorInFname = true</script>"; $error = true;}
        else
            $fname=$_POST['fname'];

        if(empty($_POST['lname']))
            {echo "<script>errorInLname = true</script>"; $error = true;}
        else
            $lname = $_POST['lname']; 

        if(empty($_POST['Email']) || !filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL))
            {echo "<script>errorInEmail = true</script>"; $error = true;}
        else
            $email=$_POST['Email'];

        if(empty($_POST['Password']))
            {echo "<script>errorInPassword = true</script>"; $error = true;}
        else
            $password=$_POST['Password'];
        if($error==false){
            $password=mysqli_real_escape_string($conn,$_POST['Password']);
            $password = md5($password);
            $sql="INSERT INTO users (fname,lname,email,pswrd,userRole,pic) VALUES('$fname','$lname','$email','$password','admin','default.png')";
            $queryResult=mysqli_query($conn,$sql) or die($conn->error);
            echo "<script>window.location.replace('otheradmin.php')</script>";
        }
    }
?>
<script>
    let form = ""
    if(errorInEmail === true)
        form += "Error: Email is mistyped or not given\n"
    if(errorInPassword === true)
        form += "Error: Password is not given\n"
    if(errorInFname === true)
        form += "Error: First Name is not given\n"
    if(errorInLname === true)
        form += "Error: Last Name is not given\n"
    if(used === true)
        form += "Error: Email is already used\n"
        if(form != "")
            alert(form)
</script>
<?php
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