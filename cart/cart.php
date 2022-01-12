<?php
    session_start();
?>
<html>
<head>
    <title>My Cart</title>
    <link rel="stylesheet" href="../../project/styles/cartStyle.css" type="text/css">
</head>
<body>
    <?php
    $totalPrice = 0;
    function select2(){
        if(isset($_COOKIE['UserCartID']) && isset($_COOKIE['GroupsCart']) && $_COOKIE['UserCartID'] === $_SESSION['ID'])
            {
                $myCartData = stripslashes($_COOKIE['GroupsCart']);
                $myCart = json_decode($myCartData, true);
                $table = "<table class = 'Top-Table'>";
                
                foreach($myCart as $cartItem){
                    if($cartItem['userID'] == $_SESSION['ID']){
                    $table .= "<tr>
                    <td>
                        <p><strong style = 'font-size: 25px;'>ID &nbsp &nbsp &nbsp</strong><span class = 'Top-Text-Table'>".strtoupper($cartItem['ID'])."</span></p>
                        </td>
                    <td>
                        <p><strong style = 'font-size: 25px;'>LOCATION &nbsp &nbsp &nbsp</strong><span class = 'Top-Text-Table'>".strtoupper($cartItem['location'])."</span></p>
                    </td>
                    <td>
                        <p><strong style = 'font-size: 25px;'>PRICE &nbsp &nbsp &nbsp</strong><span class = 'Top-Text-Table'>".strtoupper($cartItem['price'])."</span></p>
                    </td>
                    <td>
                        <a href = 'cart.php?del=true&GID=".$cartItem['ID']."' class = button-delete>REMOVE</a>
                    </td>
                   </tr>";
                   $GLOBALS['totalPrice'] += $cartItem['price'];}
                }
                $table .= "</table>";
                echo $table;
                if($GLOBALS['totalPrice'] != 0){
                    echo "<h1>Total Price: {$GLOBALS['totalPrice']}</h1>";
                    echo "<form method='post' action='insertOrder.php'>
                        <input type='submit' value='Buy now' name = 'submit'>
                     </form>";
                }
            }
        else
            echo "NOT FOUND";
    }


function edit($group_id){
    // $sql = "DELETE from cart where hikerid = '$hiker_id' AND GID = '$group_id'";
    // $GLOBALS['conn']->query($sql) or die($GLOBALS['conn']->error);
    $myCartData = stripslashes($_COOKIE['GroupsCart']);
    $myCart = json_decode($myCartData, true);
 
    for($i = 0;$i<count($myCart);$i++){
        if(isset($myCart[$i])){
                $row = $myCart[$i];
                echo "<script>alert({$row['ID']})</script>";
                if($row['ID'] == $group_id && $row['userID'] == $_SESSION['ID']){
                    //unset($myCart[$i]);
                    array_splice($myCart,$i,1);
                    break;
                }
        }
    }
    $jsonString = json_encode($myCart);
    setcookie('GroupsCart', $jsonString ,time() + 86400, '/');
    header('Location:cart.php');
    //echo "<scipt>$.ajax({method: post,url:''})</script>";
}

//Test id
//select(101);
//insert(101, 100, 900,'aswan','10/11/2021','15/11/2021','900 EGP');
//insert(101, 103, 905,'Dahab','20/11/2021','25/11/2021','1700 EGP');
//edit(101,103);
    if(isset($_GET['del'])){
        edit($_GET['GID']);
    }
?>
    <div class = "Top">
        <h1 class = "Top-Header">My Cart</h1>
        <p class = "Top-Text">Your cart. Feel free to edit!</p>
        <?php
        //insert(2,1);
        
        select2();
            ?>
    </div>
</body>
</html>