<?php
session_start();
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
        <div class="mainAdmin">
        <form method="post" action="">
        <select name = 'sortArrange'>
            <option value='DESC' selected>descending</option>
            <option value='ASC' >ascending</option>
            </select>
            <select name = 'sort'>
            <option value="GID" selected>ID</option>
                <option value="price" >Price</option>
                <option value="avgrating" >Rating</option>
                <option value="Loc" >Location</option>
                <option value="departureTime" >Departure Date</option>
                <option value="arrivalTime" >Arrival Date</option>
            </select><br><br>
            Search <select name="searchlist" id="searchlist">
                <option value="all" selected>All</option>
                <option value="GID" >Group ID</option>
                <option value="price" >Price</option>
                <option value="avgrating" >Rating</option>
                <option value="Loc" >Location</option>
                <option value="departureTime" >Departure Date</option>
                <option value="arrivalTime" >Arrival Date</option>
                <option value="descrip" >Description</option>
            </select>
            
            <input name = "search" id="search">
            <input type="submit" name="submit">
        </form><br>


        <script>
            var select=document.getElementById('searchlist');
            var type=document.getElementById('search')
            select.addEventListener('change', () => {
            if((event.target.value=='departureTime')||(event.target.value=='arrivalTime'))
            document.getElementById("search").type='date';
            else
            document.getElementById("search").type='text';
            })
        </script>
        <?php
            $orderby = "GID";
            $sort = "ASC";
            $narrowedsearch='';
            $txtsr='';
            if(isset($_POST['submit'])){
                if(isset($_POST['sortArrange']))
                    if($_POST['sortArrange'] === "DESC")
                        $sort = "DESC";
                if(isset($_POST['sort']))
                    if($_POST['sort'] === 'loc' || $_POST['sort'] === 'departureTime' || $_POST['sort'] === 'arrivalTime' || $_POST['sort'] === 'price' || $_POST['sort'] === 'rating')
                        $orderby = $_POST['sort'];
                if(isset($_POST['search'])){
                    if($_POST['searchlist']!='all'){
                        $narrowedsearch=$_POST['searchlist'];
                    }
                    $txtsr=$_POST['search'];
                }
            }

        $hn='localhost';
        $db='project';
        $un='root';
        $pw='';

        $conn=new mysqli("localhost","$un","$pw","$db") or die("ERROR");

        if($txtsr=="")
            $query="SELECT * from Groups ORDER BY $orderby $sort"; 
        else if($txtsr!=""&&($_POST['searchlist']=='all'))
            $query = "SELECT * from Groups WHERE concat(GID,price,avgrating,loc,departureTime,arrivalTime,descrip)
            LIKE '%$txtsr%' ORDER BY $orderby $sort;";
        else if($txtsr!=""&&$narrowedsearch!="")
            $query = "SELECT * from Groups WHERE $narrowedsearch='$txtsr'
            ORDER BY $orderby $sort;";

        $result=$conn->query($query); 
        if(!$result) die ("fatal error in executing code");
        if($txtsr!=""&&(mysqli_num_rows($result)) == 0)
            echo "There are no results <br> Try searching again";
        else{
            echo "<table class = 'tableClass' border =1><tr><th> Group ID </th><th> Price </th><th> Rating 
            </th><th> Location </th><th> Departure Date </th><th> Arrival Date 
            </th><th> Description </th><th> Picture </th><th>Difficulty Level</th><th>Distance</th><th>Edit</th><th>Delete</th></tr>";
            while($row= $result->fetch_array(MYSQLI_ASSOC)){
                echo "<td> ".$row['GID']."</td>";
                echo "<td> ".$row['price']."</td>";
                if(!isset($row['avgrating']))
                    echo "<td>No customer reviews</td>";
                else
                    echo "<td> ".$row['avgrating']."</td>";
                echo "<td> ".$row['loc']."</td>";
                echo "<td> ".$row['departureTime']."</td>";
                echo "<td> ".$row['arrivalTime']."</td>";
                echo "<td> ".$row['descrip']."</td>";
                echo "<td> ".$row['pic']."</td>";
                echo "<td> ".$row['diffLevel']."</td>";
                echo "<td> ".$row['distance']."</td>";
                echo "<td> <a href='groupadminview.php?editId={$row['GID']}'> Edit</a></td>
                <td> <a href='groupadminview.php?deleteId={$row['GID']}' >Delete</a></td>";
                echo "</tr>";
            }
        }
        ?>
        </table>
        <form action ='' method ='post'>
        <button type="submit" name = 'addTable'> Add Table</button>
        </form>
        <script>
            var errorInPrice = false
            var errorInLocation = false
            var errorInDeparture = false
            var errorInArrival = false
            var errorInDescription = false
            var errorInPicture = false
        </script>
        <?php
            if(isset($_POST['addTable'])){
                ?>
                <h1>Add</h1>
                <form action="" method="post" enctype="multipart/form-data">
                Price:<br>
                <input type="text" name="price"><br> 
                Location:<br>
                <input type="text" name="Loc"><br> 
                Departure Time:<br>
                <input type="DATE" name="departureTime"><br>
                Arrival Time:<br>
                <input type="DATE" name="arrivalTime"><br>
                Description:<br>
                <input type="text" name="descrip"><br>
                Distance:<br>
                <input type="text" name="distance" placeholder="Distance In Miles"><br>
                Difficulty Level:<br>
                <input type= 'range' min="1" max="5" name='diffLevel' value = "1" id="myRange"><br>
                <p>Level: <span id="diffValue"></span></p>
                Picture:<br>
                <input type="file" name="picture"><br><br>
                <input type="submit" value="Submit" name="addSubmit">
                <input type="reset">
                </form>
                
                <?php
            }
            else if(isset($_GET['editId'])){
                ?>
                <h1>Edit</h1>
                <form method = "post" action="" enctype="multipart/form-data">
                <?php
                    $conn = new mysqli("localhost" , "root" , "" , "project");
                    if($conn-> connect_error) die("fatal error - cannot connect to the DB");
                    $id=$_GET["editId"];
                    $query = "SELECT * FROM Groups WHERE GID='$id'";
                    $results = $conn-> query($query);
                    if(!$results) die($conn->error);

                    while($row = $results->fetch_array(MYSQLI_ASSOC)) {
                        echo 'Price:<br>';
                        echo "<input type = text name=price value = ".$row["price"] . "><br>";
                        echo 'Location:<br>';
                        echo "<input type = text name=Loc value = ".$row["loc"] . "><br>";
                        echo 'Departure Time:<br>';
                        echo "<input type = DATE name=departureTime value = ".$row["departureTime"] . "><br>";
                        echo 'Arrival Time:<br>';
                        echo "<input type = DATE name=arrivalTime value = ".$row["arrivalTime"] . "><br>";
                        echo 'Description:<br>';
                        echo "<input type = text name=descrip value = ".$row["descrip"] . "><br>";
                        echo "Difficulty Level: <br><input type = range min= 1 max = 5 name=diffLevel id='myRange' value = ".$row["diffLevel"] . "><br>";
                        echo "<p>Level: <span id='diffValue'></span></p>";
                        echo "Distance<br><input type = text name=distance value = ".$row["distance"] . "><br>";
                        echo "Picture:<br>
                        <input type='file' name='picture' value = ".$row["pic"]."><br><br>";
                    }
                ?>
                <input type="submit" name="editSubmit">
                <?php
            }
            else if(isset($_GET['deleteId'])){
                $id=$_GET["deleteId"];
                ?>
                <h2> Are you sure that you want to delete? </h2>
                <form method = "post" action="">
                <button type="submit" name="deleteSubmit">Delete</button>
                <?php
                
            }
        ?>
        </div>
        <script>
                    var slider = document.getElementById("myRange");
                    var output = document.getElementById("diffValue");
                    output.innerHTML = slider.value;

                    slider.oninput = function() {
                        output.innerHTML = this.value;
                    }
        </script>
    </body>
</html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$error = false;
if(isset($_POST['addSubmit'])){ //check if form was submitted
    $price=$_POST['price'];
    $Loc=$_POST['Loc'];
    $departureTime=$_POST['departureTime'];
    $arrivalTime=$_POST['arrivalTime'];
    $descrip=$_POST['descrip'];
    $distance = $_POST['distance'];
    $diffLevel = $_POST['diffLevel'];


    if(empty($price)){
    echo "<script>errorInPrice = true</script>";
    $error = true;
    }
    if(empty($Loc)){
    echo "<script>errorInLocation = true</script>";
    $error = true;
    }
    if(empty($departureTime)){
    echo "<script>errorInDeparture = true</script>";
    $error = true;
    }
    if(empty($arrivalTime)){
    echo "<script>errorInArrival = true</script>";
    $error = true;
    }
    if(empty($descrip)){
    echo "<script>errorInDescription = true</script>";
    $error = true;
    }
    //|| $arrivalTime > $departureTime
    if($departureTime < date("Y-m-d")){
    $error = true;
    // echo "<script>alert('Departure Date is Invalid ".date("Y-m-d")."')</script>";
    echo "<script>alert('Departure Date is Invalid $departureTime')</script>";
    }
    if($arrivalTime < date("Y-m-d") || $arrivalTime < $departureTime){
    $error = true;
    echo "<script>alert('Arrival Date is Invalid')</script>";
    }
    $pic = "";
    $dir = "images/";
    if(!empty($_FILES['picture']['name'])){
        $pic = $_FILES['picture']['name'];
        move_uploaded_file($_FILES['picture']['tmp_name'], $dir.$pic);
    }
    else{
    echo "<script>errorInPicture = true;</script>";
    $error = true;
    }
    
    if($error === false){
    $sql="INSERT INTO groups(price,Loc,departureTime,arrivalTime,descrip,pic,distance, diffLevel)
    VALUES ('$price','$Loc','$departureTime','$arrivalTime','$descrip','$pic','$distance','$diffLevel')";
    $result=mysqli_query($conn,$sql) or die($conn->error);
    echo "<script>window.location.replace('/project/controlgroups/groupadminview.php')</script>";
}
}
if(isset($_POST["editSubmit"])){
    $pic = "";
    $dir = "images/";
    if(!empty($_FILES['picture']['name'])){
        $pic = $_FILES['picture']['name'];
        move_uploaded_file($_FILES['picture']['tmp_name'], $dir.$pic);
    }
    $query = '';
    if(empty($pic)){
        $query="UPDATE Groups set
        price='{$_POST["price"]}',
        arrivalTime='{$_POST["arrivalTime"]}',
        departureTime='{$_POST["departureTime"]}',
        descrip='{$_POST["descrip"]}',
        diffLevel='{$_POST['diffLevel']}',
        distance='{$_POST['distance']}'
        WHERE GID='$id'";
    }
    else{
        $query="UPDATE Groups set
        price='{$_POST["price"]}',
        arrivalTime='{$_POST["arrivalTime"]}',
        departureTime='{$_POST["departureTime"]}',
        pic='$pic',
        descrip='{$_POST["descrip"]}',
        diffLevel='{$_POST['diffLevel']}',
        distance='{$_POST['distance']}'
        WHERE GID='$id'";
    }
    $results = $conn-> query($query) or die ($conn->error);
    echo "<script>window.location.replace('/project/controlgroups/groupadminview.php')</script>";
}
if(isset($_POST["deleteSubmit"])){
    $query = "DELETE from Groups where GID ='$id'";
    $results = $conn-> query($query);
    if($results) echo "<script>window.location.replace('/project/controlgroups/groupadminview.php')</script>";
}
if(isset($_POST['action'])){
    $conn=new mysqli("localhost","root","","project");
    if($_POST['action']=="Admins")
        {
        $_GET['add']=false;
        $_GET['delete']=false;
        echo "<script>window.location.replace('/project/admincontrol/otheradmin.php')</script>";
    }

    if($_POST['action']=="Hikers")
    {
        $_GET['add']=false;
        $_GET['delete']=false;
        echo "<script>window.location.replace('/project/admincontrol/hikers.php')</script>";
    }
    
    if($_POST['action']=="Groups"){
        $_GET['add']=false;
        $_GET['delete']=false;
        echo "<script>window.location.replace('/project/controlgroups/groupadminview.php')</script>";
    }
}
?>
<script>
                error = ""
                if(errorInLocation === true)
                error += "Error: Location is not given"
                if(errorInDeparture === true)
                error += "Error: Departure Time is not given"
                if(errorInArrival === true)
                error += "Error: Arrival Time is not given"
                if(errorInDescription === true)
                error += "Error: Description is not given"
                if(errorInPicture === true)
                error+= "Error: Picture is not given"
                if(errorInPrice === true)
                error+= "Error: Price is not given"
                if(error != "")
                alert(error)
                </script>

