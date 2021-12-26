<!doctype html>
<html>
<head>
<title>Admin</title>
</head>
<!-- file -->


<body>

    <form method = "post" action="">
    <input type = "submit" name= "action" value ="Groups">
    <br><br>
    <input type = "submit" name= "action" value = "Admins">
    <br><br>
    <input type = "submit" name= "action" value = "Hikers">
    <br><br>

    </form>
    
    <?php 
    

    if(isset($_POST['action'])){
        $conn=new mysqli("localhost","root","","project");
        if($_POST['action']=="Admins")
            {
            
            $_GET['add']=false;
            $_GET['delete']=false;
            header("Location: otheradmin.php");
        }

        if($_POST['action']=="Hikers")
        {
            $_GET['add']=false;
            $_GET['delete']=false;
            header("Location: hikers.php");
        }
        
        if($_POST['action']=="Groups"){
            $_GET['add']=false;
            $_GET['delete']=false;
            header("Location: /project/controlgroups/groupadminview.php");
        }

    }
?>
    
</body>
</html>