<?php
include_once '../errorHandler/errorHandlers.php';
set_error_handler("customError",E_ALL);
?>
<?php
session_start();
if($_SESSION['userRole'] === 'admin'){
?>
<html>
    <head>
        <title>Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="../styles/adminStyle.css" type="text/css">
        <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        <title>Sightscapes</title>

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
        <input class = 'inputSide' type = "submit" name= "action" value = "Orders">
            <br><br>
        </form>
    </div>
        <?php
        include_once "../users/checkLogin.php"; 
        checkLogin();
        ?>
        <div class="mainAdmin">
        <div class="topTextAdmin">
            <h1>Orders</h1>
            <p>Right here, you can view all orders and some statistics.</p>
            <hr>
            <h3>Statistics</h3>
            <div class="stat">
                <?php
                    $conn = new mysqli("localhost" , "root" , "" , "project");
                    $sql = "SELECT * FROM orders";
                    $result = $conn->query($sql);
                    $totalItems = 0;
                    $totalRevenue = 0;
                    while($row = $result->fetch_assoc()) {
                        $totalRevenue += $row['totalPrice'];
                        $totalItems++;
                    }
                    echo "<h2><span class = 'smallText'>Total Items</span>$totalItems<span class = 'smallText'>ITEMS</span>  <span class = 'rightInfo'><span class = 'smallText'>Total Revenue</span>$totalRevenue<span class = 'smallText'>EGP</span></span></h2>";
                    
                ?>
            </div>
            <hr>
            
        </div>
            <form method="post" action="">
            <select name="sortArrange">
                <option value="DESC" selected>descending</option>
                <option value="ASC" >ascending</option>
            </select>
            <select name="sort">
                <option value="fname" >Hiker name</option>
                <option value="loc" >Group Location</option>
                <option value="totalPrice" >price</option>
            </select>
            Search <select name="searchlist" id="searchlist">
                <option value="all" selected>All</option>
                <option value="fname" >Hiker name</option>
                <option value="loc" >Group Location</option>
                <option value="totalPrice" >price</option>
            </select>
            <input name = "search" id="search">
            <input type="submit" name="submit">
        </form>
        <script>
            var select=document.getElementById('searchlist');
            var type=document.getElementById('search')
            select.addEventListener('change', () => {
                document.getElementById("search").type='text';
            })
        </script>
        <?php
            $orderby = "users.userID";
            $sort = "ASC";
            $narrowedsearch='';
            $tb='';
            $txtsr='';

            if(isset($_POST['submit'])){
                if(isset($_POST['sortArrange']))
                    if($_POST['sortArrange'] === "DESC")
                        $sort = "DESC";
                if(isset($_POST['sort']))
                    if($_POST['sort'] === 'loc' )
                        $orderby = 'groups.'.$_POST['sort'];
                    else if($_POST['sort'] === 'totalPrice')
                        $orderby = "orders.{$_POST['sort']}";
                if(isset($_POST['search'])){
                    if($_POST['searchlist']!='all'){
                        ($_POST['searchlist'] =='fname')?($tb='users.'):($tb='groups.');
                        if($_POST['searchlist'] === 'totalPrice')
                            $tb = 'orders.';
                        $narrowedsearch=$tb.$_POST['searchlist'];
                    }
                    $txtsr=$_POST['search'];
                }
            }

            $host = 'localhost';
            $db = 'project';
            $username = 'root';
            $password = "";
            $conn = mysqli_connect($host, $username, $password,$db);

            if($txtsr=="")
                $sql = "SELECT groups.GID,users.fname,orders.totalPrice,groups.loc
                FROM `orders`,`groups`,`users` WHERE orders.GID = groups.GID AND orders.userID = users.userID ORDER BY $orderby $sort;";
            else if($txtsr!=""&&($_POST['searchlist']=='all'))
                $sql = "SELECT groups.GID,users.fname,orders.totalPrice,groups.loc
                FROM `orders`,`groups`,`users` WHERE orders.GID = groups.GID AND orders.userID = users.userID AND concat(users.userID,groups.loc
                ) LIKE '%$txtsr%'
                ORDER BY $orderby $sort;";
            else if($txtsr!=""&&$narrowedsearch!="")
                $sql = "SELECT groups.GID,groups.loc,users.fname,orders.totalPrice
                FROM `orders`,`groups`,`users` WHERE orders.GID = groups.GID AND orders.userID = users.userID AND $narrowedsearch='$txtsr'
                ORDER BY $orderby $sort;";
            
            $result = $conn->query($sql) or die($conn->error);
            if($txtsr!=""&&(mysqli_num_rows($result)) == 0)
                echo "There are no results <br> Try searching again";
            else{
                echo "<table class = 'tableClass'>
                <tr><th>Hiker Name</th><th>Group ID</th><th>Location</th><th>Group Price</th></tr>";
                while($row2 = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>".$row2['fname']."</td>
                    <td>".$row2['GID']."</td>
                    <td>".$row2['loc']."</td>
                    <td>".$row2['totalPrice']."</td>
                    </tr>";
                }
            }
        ?>
        </table>
        </div>
        
        
        
    </body>
</html>
<?php
if(isset($_POST['action'])){
    $conn=new mysqli("localhost","root","","project");
    if($_POST['action']=="Admins")
        {
        echo "<script>window.location.replace('../admincontrol/otheradmin.php')</script>";
    }

    if($_POST['action']=="Hikers")
    {
        echo "<script>window.location.replace('../admincontrol/hikers.php')</script>";
    }
    
    if($_POST['action']=="Groups"){
        echo "<script>window.location.replace('../controlgroups/groupadminview.php')</script>";
    }
    if($_POST['action']=="Orders"){
        echo "<script>window.location.replace('orders.php')</script>";
    }
}
}
else{
    header("Location:../home/home.php");
}
?>