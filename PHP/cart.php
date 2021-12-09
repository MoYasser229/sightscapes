<?php
    session_start();
    setcookie('UserCart', '301',time() + 86400, '/');
?>
<html>
<head>
    <title>My Cart</title>
    <link rel="stylesheet" href="styles/cartStyle.css" type="text/css">
</head>
<body>
    <?php
//[TODO] the item attribute will be changed to specific data of a product
//[TODO] the table design will change when creating the frontend
function select($id){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "cart";

    $conn = mysqli_connect($servername, $username, $password, $db);

    $sql = "SELECT * from `cart` where hiker_id = ".$id;
    $result = $conn->query($sql) or die("$conn->error");
    $table = "<table class = 'Top-Table'>";
    while($row = $result->fetch_assoc())
        $table .= "<tr>
                    <td>
                        <h2 class = 'Table-Header'>DEPARTURE DATE</h2>
                        <p class = 'Top-Text-Table'>{$row['departure_date']}</p> 
                    </td>
                    <td>
                        <p><strong style = 'font-size: 25px;'>LOCATION &nbsp &nbsp &nbsp</strong><span class = 'Top-Text-Table'>".strtoupper($row['location'])."</span></p>
                    </td>
                    <td>
                        <p><strong style = 'font-size: 25px;'>PRICE &nbsp &nbsp &nbsp</strong><span class = 'Top-Text-Table'>".strtoupper($row['price'])."</span></p>
                    </td>
                     <td>
                        <h2 class = 'Table-Header'>ARRIVAL DATE</h2>
                        <p class = 'Top-Text-Table'>{$row['arrival_date']}</p> 
                    </td>
                    <td>
                        <a href = 'cart.php?cbdet=true&itid=".$row['item_id']."' class = button-delete>REMOVE</a>
                    </td>
                   </tr>";
    $table .= "</table>";
    echo $table;
    $conn ->close();
}
function insert($hiker_id, $item_id, $group_id,$location, $departure_date, $arrival_Date, $price){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "cart";

    $conn = mysqli_connect($servername, $username, $password, $db);
    $sql = "insert into cart(hiker_id, item_id,group_id,location,departure_Date, arrival_Date,price) values ('".$hiker_id." ', '".$item_id."', '".$group_id."','".$location."','".$departure_date."','".$arrival_Date."','".$price."')";
    if($conn->query($sql)){
        $_COOKIE['id'] = $_SESSION['id'];
        $_COOKIE['item_id'] = $_SESSION["$item_id"];
        $_COOKIE['group_id'] = $_SESSION["$group_id"];
        $_COOKIE['location'] = $_SESSION["$location"];
        $_COOKIE['departure_date'] = $_SESSION["$departure_date"];
        $_COOKIE['arrival_Date'] = $_SESSION["$arrival_Date"];
        $_COOKIE['price'] = $_SESSION["$price"];
    }
    $conn->close();
}
function edit($hiker_id,$item_id){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "cart";

    $conn = mysqli_connect($servername, $username, $password, $db);
    $sql = "delete from cart where hiker_id = '".$hiker_id."' AND item_id = '".$item_id."'";
    $conn->query($sql) or die($conn->error);
    $conn->close();
}
//Test id
//select(101);
//insert(101, 100, 900,'aswan','10/11/2021','15/11/2021','900 EGP');
//insert(101, 103, 905,'Dahab','20/11/2021','25/11/2021','1700 EGP');
//edit(101,103);
    if(isset($_GET['cbdet']))
        edit(101,$_GET['itid']);
?>
    <div class = "Top">
        <h1 class = "Top-Header">My Cart</h1>
        <p class = "Top-Text">Your cart. Feel free to edit!</p>
        <?php
        select(101);
        //insert(101, 100, 900,'aswan','10/11/2021','15/11/2021','900 EGP');
        //insert(101, 103, 905,'Dahab','20/11/2021','25/11/2021','1700 EGP');
        //insert(101, 105, 910,'Mount Everest','20/12/2021','25/12/2021','17000 EGP');
        //insert(101, 110, 880,'Denali','30/1/2022','2/2/2022','17000 EGP');

        ?>
    </div>
</body>
</html>
