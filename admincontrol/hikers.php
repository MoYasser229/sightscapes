<?php
    $conn=new mysqli("localhost","root","","project");
    echo "<form method='post' action=''>
        sort:<br>
        descending: <input type='radio' value = 'DESC' name = 'sortArrange'><br>
        ascending: <input type='radio' value = 'ASC' name = 'sortArrange'><br>
        by:<br>
        ID <input type='checkbox' value = 'hikerID' name = sort><br>
        First Name <input type='checkbox' value = 'fname' name = sort><br>
        Last Name <input type='checkbox' value = 'lname' name = 'sort'><br>
        Email <input type='checkbox' value = 'email' name = 'sort'><br>
        Search <select name='searchlist' id='searchlist'>
        <option value='all' selected>All</option>
        <option value='userID' >Hiker ID</option>
        <option value='fname' >First Name</option>
        <option value='lname' >Last Name</option>
        <option value='email' >Email</option>
        <option value='pswrd' >Password</option>
        </select>
        <input name = 'search' id='search'>
        <input type='submit' name='submit'>
        </form>";

    $orderby = "userID";
    $sort = "ASC";
    $narrowedsearch='';
    $txtsr='';

    if(isset($_POST['submit'])){
        if(isset($_POST['sortArrange']))
        if($_POST['sortArrange'] === "DESC")
        $sort = "DESC";
        if(isset($_POST['sort']))
        if($_POST['sort'] === 'fname' || $_POST['sort'] === 'lname' || $_POST['sort'] === 'email')
        $orderby = $_POST['sort'];
        if(isset($_POST['search'])){
            if($_POST['searchlist']!='all'){
                $narrowedsearch=$_POST['searchlist'];
            }
            $txtsr=$_POST['search'];
        }
    }
    if($txtsr=="")
    $sql="SELECT * FROM users WHERE userRole = 'hiker' ORDER BY $orderby $sort";
    else if($txtsr!=""&&($_POST['searchlist']=='all'))
    $sql = "SELECT * FROM users WHERE concat(userID,fname,lname,email,pswrd) LIKE '%$txtsr%' AND userRole = 'hiker'
    ORDER BY $orderby $sort;";
    else if($txtsr!=""&&$narrowedsearch!="")
    $sql = "SELECT * FROM users WHERE $narrowedsearch='$txtsr' AND userRole = 'hiker'
    ORDER BY $orderby $sort;";

    $result=$conn->query($sql) or die($conn->error);
    if($txtsr!=""&&(mysqli_num_rows($result)) == 0)
        echo "There are no results <br> Try searching again";
    else{
        echo "<table border = '1'><tr><th>Hiker ID</th><th>FirstName</th><th>LastName</th><th>Email</th><th>Password</th></tr>";
        while($row=$result->fetch_assoc()){
        echo "<tr><td>" .$row['userID']. "</td><td>" .$row['fname']. "</td><td>" .$row['lname'] . "</td><td>" .$row['email'] . "</td><td>" .$row['pswrd'] . "</td></tr>";
        }
    }
    echo "</table>";
?>