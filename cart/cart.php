<?php
    session_start();
    setcookie('UserCart', $_SESSION['ID'] ,time() + 86400, '/');
?>
<html>
<head>
    <title>My Cart</title>
    <link rel="stylesheet" href="/project/styles/cartStyle.css" type="text/css">
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "project";
    $conn = mysqli_connect($servername, $username, $password, $db);
    function allItems($id){
        $sql = "SELECT * from `cart` where hikerid = ".$id;
        return $GLOBALS['conn']->query($sql) or die($GLOBALS['conn']->error);
    }
function select($id){
    $sql = "SELECT * from groups where gid IN (SELECT gid from cart where hikerid = '$id')";
    $result = $GLOBALS['conn']->query($sql);
    $table = "<table class = 'Top-Table'>";
    while($row = $result->fetch_assoc()){
        $table .= "<tr>
                    <td>
                        <h2 class = 'Table-Header'>DEPARTURE DATE</h2>
                        <p class = 'Top-Text-Table'>{$row['departureTime']}</p> 
                    </td>
                    <td>
                        <p><strong style = 'font-size: 25px;'>LOCATION &nbsp &nbsp &nbsp</strong><span class = 'Top-Text-Table'>".strtoupper($row['Loc'])."</span></p>
                    </td>
                    <td>
                        <p><strong style = 'font-size: 25px;'>PRICE &nbsp &nbsp &nbsp</strong><span class = 'Top-Text-Table'>".strtoupper($row['price'])."</span></p>
                    </td>
                     <td>
                        <h2 class = 'Table-Header'>ARRIVAL DATE</h2>
                        <p class = 'Top-Text-Table'>{$row['arrivalTime']}</p> 
                    </td>
                    <td>
                        <a href = 'cart.php?del=true&GID=".$row['GID']."' class = button-delete>REMOVE</a>
                    </td>
                   </tr>";
    }
    $table .= "</table>";
    echo $table;
}

function edit($hiker_id,$group_id){
    $sql = "DELETE from cart where hikerid = '$hiker_id' AND GID = '$group_id'";
    $GLOBALS['conn']->query($sql) or die($GLOBALS['conn']->error);
}
//Test id
//select(101);
//insert(101, 100, 900,'aswan','10/11/2021','15/11/2021','900 EGP');
//insert(101, 103, 905,'Dahab','20/11/2021','25/11/2021','1700 EGP');
//edit(101,103);
    if(isset($_GET['del'])){
        edit($_SESSION['ID'],$_GET['GID']);
    }
?>
    <div class = "Top">
        <h1 class = "Top-Header">My Cart</h1>
        <p class = "Top-Text">Your cart. Feel free to edit!</p>
        <?php
        //insert(2,1);
        select($_SESSION['ID']);
        $GLOBALS['conn']->close();
        //select(101);
        //insert(101, 100, 900,'aswan','10/11/2021','15/11/2021','900 EGP');
        //insert(101, 103, 905,'Dahab','20/11/2021','25/11/2021','1700 EGP');
        //insert(101, 105, 910,'Mount Everest','20/12/2021','25/12/2021','17000 EGP');
        //insert(101, 110, 880,'Denali','30/1/2022','2/2/2022','17000 EGP');

        ?>
    </div>
</body>
</html>
