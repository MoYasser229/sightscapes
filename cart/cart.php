<?php
    session_start();
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="../../project/styles/cartStyle.css" type="text/css">
        <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        <title>My Cart</title>

    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
<body>
    <?php
    function checkLogin(){
        if(!isset($_SESSION['ID']) && !isset($_SESSION['userRole'])){
        ?>
        <nav class="navbar navbar-expand-md fixed-top navbar-dark background">
                    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                        <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="../home.php"><h6>HOME</h6></a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="../viewGroups/grouphikers.php"><h6>GROUP</h6></a>
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
                                <a class="nav-link" href="../users/Login.php"><h6>LOGIN</h6></a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="../users/Signup.php"><h6>SIGN UP</h6></a>
                                </li>
                        </ul>
                    </div>
                    </nav>
                            <?php
                            }
                            else if ($_SESSION['userRole'] === "admin"){
                                ?>
                                        <nav class="navbar navbar-expand-md fixed-top navbar-dark background">
                                    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                                        <ul class="navbar-nav mr-auto">
                                            <li class="nav-item">
                                            <a class="nav-link active" aria-current="page" href="../home.php"><h6>HOME</h6></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../admincontrol/admin.php"><h6>DATA MANAGEMENT</h6></a>
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
                            else if($_SESSION['userRole'] === 'hiker'){
                                ?>
                                <nav class="navbar navbar-expand-md fixed-top navbar-dark background">
                                    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                                        <ul class="navbar-nav mr-auto">
                                            <li class="nav-item">
                                            <a class="nav-link active" aria-current="page" href="../home.php"><h6>HOME</h6></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../viewgroups/grouphikers.php"><h6>GROUPS</h6></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../cart/cart.php"><h6>CART</h6></a>
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
                                        <a class="nav-link" href="../chat/chatMenu.php"><h6>CHAT</h6></a>
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
                            else if($_SESSION['userRole'] === "auditor"){
                                ?>
                                <nav class="navbar navbar-expand-md fixed-top navbar-dark background">
                                    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                                        <ul class="navbar-nav mr-auto">
                                            <li class="nav-item">
                                            <a class="nav-link active" aria-current="page" href="../home.php"><h6>HOME</h6></a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" href="../chat/newChat.php"><h6>CHAT</h6></a>
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
                            else if($_SESSION['userRole'] == 'hr'){
                                ?>
                                <nav class="navbar navbar-expand-md fixed-top navbar-dark background">
                                    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                                        <ul class="navbar-nav mr-auto">
                                            <li class="nav-item">
                                            <a class="nav-link active" aria-current="page" href="../home.php"><h6>HOME</h6></a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" href=""><h6>CHAT REPORTS</h6></a>
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