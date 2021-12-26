<?php session_start();?>

<?php
    $_SESSION['username']=123;
    /////////

    $conn=new mysqli("localhost","root","","project");
    if($conn->connect_error)
    die ("cannot connect to the database");

    $rs=array();
    $message= isset($_POST['message'])?$_POST['message']:null;
    $usrn= $_SESSION['username'];

    if(!empty($message)){
        $query="INSERT INTO `chat`(chatText,ID)
            VALUES( '$message', (SELECT ID FROM person WHERE ID ='$usrn'));";
            $rs['status']=$conn->query($query);
            if(!$rs)
            die("Error: ".$conn->error);
    }
    
    $sql="SELECT DISTINCT `chat`.`chatID`,`chat`.`ID`,`person`.`ID`,`chat`.`chatText`,
    `chat`.`chatTime`,`person`.`fname` FROM `chat`, `person`
    WHERE  `chat`.`ID`=`person`.`ID` ORDER BY `chat`.`chatID` ASC;";
    $items = $conn->query($sql);
    while(($row=$items->fetch_assoc())){
        $result['items'][]=$row;
    }
    
    $conn->close();

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    if(isset($result))
    echo json_encode($result);
    ?>