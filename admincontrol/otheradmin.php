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
<?php
include_once "../users/checkLogin.php"; 
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
        <input class = 'inputSide' type = "submit" name= "action" value = "Orders">
        <br><br>
        </form>
    </div>
    <div class='mainAdmin'>
    <div class="topTextAdmin">
            <h1>Admins</h1>
            <p>Right here, you can view all admins or add a new one.</p>
            <hr>
            <script>
                    function openForm() {
                    document.getElementById("myForm").style.display = "block";
                    }

                    function closeForm() {
                    document.getElementById("myForm").style.display = "none";
                    }
                    </script>
            <button class = 'createButton' type="submit" name = 'addTable' onclick="openForm()"> Add an Admin</button>
            <!-- </form> -->
            <div class="form-popup" id="myForm">
                     <h5>Create a Group</h5>
                     <form action='' method='post' class = 'form-container'>
                        <p>First Name:
                        <input type='text' name='fname' placeholder = 'First Name'></p><br> 
                        <p>Last Name:
                        <input type='text' name='lname' placeholder = 'Last Name'></p><br>
                        <p>Email:
                        <input type='text' name='Email' placeholder = 'ex: email@email.com'></p> <br>
                        <p>Password:
                        <input type='Password' name='Password' placeholder='Password'></p><br><br>
                        <button type="submit" class="btn" name = 'Addsub' >SUBMIT</button>
                        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                    </form>
                    </div>
            
            <p>Add a new admin to operate with you.</p>
            <hr>
        </div>
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
        echo "<table class = 'tableClass'><tr>
        <th>Admin ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th></th>
        </tr>";
        while($row=$result->fetch_assoc()){
            $id=$row['userID'];
            if($id != $_SESSION['ID']){
                echo "<tr>
                <td>{$id}</td>
                <td>{$row['fname']}</td>
                <td>{$row['lname']}</td>
                <td>{$row['email']}</td>
                <td><button class = 'deleteButton' type = 'submit' name = 'delete' value = '$id' >DELETE</button></td>
                </tr>";
            }
        }
    }
    echo "</table></form>";
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
            echo "<script>window.location.replace('otheradmin.php')</script>";
        }

        if($_POST['action']=="Hikers")
        {
            echo "<script>window.location.replace('hikers.php')</script>";
        }
        
        if($_POST['action']=="Groups"){
            echo "<script>window.location.replace('../controlgroups/groupadminview.php')</script>";
        }
        if($_POST['action']=="Orders"){
            echo "<script>window.location.replace('../orders/orders.php')</script>";
        }
    }
?>  