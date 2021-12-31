<form method="post" action="">
    sort:<br>
    descending: <input type="radio" value = "DESC" name = "sortArrange"><br>
    ascending: <input type="radio" value = "ASC" name = "sortArrange"><br>
    by:<br>
    id <input type="checkbox" value = "GID" name = "sort"><br>
    Price <input type="checkbox" value = "price" name = "sort"><br>
    location <input type="checkbox" value = "loc" name = "sort"><br>
    departure time <input type="checkbox" value = "departureTime" name = "sort"><br>
    arrival time <input type="checkbox" value = "arrivalTime" name = "sort"><br>
    rating <input type="checkbox" value = "rating" name = "sort"><br>
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
</form>
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
    $query = "SELECT * from Groups WHERE concat(GID,price,avgrating,Loc,departureTime,arrivalTime,descrip)
    LIKE '%$txtsr%' ORDER BY $orderby $sort;";
else if($txtsr!=""&&$narrowedsearch!="")
    $query = "SELECT * from Groups WHERE $narrowedsearch='$txtsr'
    ORDER BY $orderby $sort;";

$result=$conn->query($query); 
if(!$result) die ("fatal error in executing code");
if($txtsr!=""&&(mysqli_num_rows($result)) == 0)
    echo "There are no results <br> Try searching again";
else{
    echo "<table border =1><tr><th> Group ID </th><th> Price </th><th> Rating 
    </th><th> Location </th><th> Departure Date </th><th> Arrival Date 
    </th><th> Description </th><th> Picture </th></tr>";
    while($row= $result->fetch_array(MYSQLI_ASSOC)){
        echo "<td> ".$row['GID']."</td>";
        echo "<td> ".$row['price']."</td>";
        if(!isset($row['avgrating']))
            echo "<td>No customer reviews</td>";
        else
            echo "<td> ".$row['avgrating']."</td>";
        echo "<td> ".$row['Loc']."</td>";
        echo "<td> ".$row['departureTime']."</td>";
        echo "<td> ".$row['arrivalTime']."</td>";
        echo "<td> ".$row['descrip']."</td>";
        echo "<td> ".$row['pic']."</td>";
        echo "</tr>";
    }
}
?>
</table>
<form action ='groupadmin.php' method ='post'>
<?php
$query="SELECT * from Groups"; 
$result=$conn->query($query); 
if(!$result) die ("fatal error in executing code");
while($row= $result->fetch_array(MYSQLI_ASSOC))
{
?>
<input type="radio" name="groups" value='<?php echo $row['GID']?>'><?php echo $row['GID'];}?>
<input type="submit" value="Submit" name="Submit">
</form>
<form action ='addgroup.php' method ='post'>
<button type="submit"> Add Table</button>
</form>

