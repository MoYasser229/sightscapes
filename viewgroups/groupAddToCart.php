<?php
	session_start();
	include_once "../cart/insertCart.php";
			if(isset($_SESSION['ID'])){
					$groups = $_GET['groups'];
					$conn = new mysqli("localhost","root","","project");
					$sql = "SELECT * FROM groups WHERE GID = '$groups'";
					$result = $conn->query($sql);
					$found = false;
					if($row = $result->fetch_assoc()) {
						if(isset($_COOKIE['GroupsCart'])){
							$cartItems = stripslashes($_COOKIE['GroupsCart']);
							$cart = json_decode($cartItems, true);
							foreach($cart as $cartItem){
								if($cartItem['ID'] == $groups && $cartItem['userID'] == $_SESSION['ID']){
									$found = true;
									break;
								}
							}
						}
						else{
							$cart = array();
						}
						if($found === false){
							$location = $row['loc'];
							$price = $row['price'];
							$item = array(
								'ID' => $groups,
								'userID' => $_SESSION['ID'],
								'location' => $location,
								'price' => $price,
							);
							$cart[] = $item;
							$jsonString = json_encode($cart);
							
							insert($_SESSION['ID'],$jsonString);
                            header("Location: grouphikers.php?success=1");
						}
						else{
                            header("Location: grouphikers.php?errorCart=1");
						}
					}
			}
			else{
                header("Location: grouphikers.php?errorRegister=1");
				
			}
?>