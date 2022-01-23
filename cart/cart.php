<?php
    session_start();
    include_once '../errorHandler/errorHandlers.php';
    set_error_handler('customError',E_ALL);
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="../styles/cartStyle.css" type="text/css">
        <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        <title>My Cart</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
<body>
    <?php
    include_once"../users/checkLogin.php";
    checkLogin();
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


function delete($group_id){
    $myCartData = stripslashes($_COOKIE['GroupsCart']);
    $myCart = json_decode($myCartData, true);
 
    for($i = 0;$i<count($myCart);$i++){
        if(isset($myCart[$i])){
                $row = $myCart[$i];
                if($row['ID'] == $group_id){
                    array_splice($myCart,$i,1);
                    break;
                }
        }
    }
    $jsonString = json_encode($myCart);
    setcookie('GroupsCart', $jsonString ,time() + 86400, '/');
    header('Location:cart.php');
}
    if(isset($_GET['del'])){
        delete($_GET['GID']);
    }
   
?>
    <div class = "Top">
        <h1 class = "Top-Header">My Cart</h1>
        <p class = "Top-Text">Your cart. Feel free to rename!</p>
        <?php
         if(isset($_COOKIE['GroupsCart'])){
            $conn = new mysqli("localhost" , "root" , "" , "project");
            $sql = "SELECT * FROM orders where userID = '{$_SESSION['ID']}'";
            $result = $conn->query($sql);
            $myCartData = stripslashes($_COOKIE['GroupsCart']);
            $myCart = json_decode($myCartData, true);
            $counter = 0;
            while ($row = $result->fetch_assoc()){
                if(isset($myCart[$counter])){
                    $cartItem = $myCart[$counter];
                    if($row['GID'] == $cartItem['ID']){
                        delete($row['GID']);
                    }
                    
                    $counter++;
                }
         }}
        select2();
        ?>
    </div>
</body>
</html>