<html>
    <head>
    </head>
    <body>
        <form method="post" action="">
            SORT:<br>
            descending: <input type="radio" value = "DESC" name = "sortArrange"><br>
            ascending: <input type="radio" value = "ASC" name = "sortArrange"><br>
            by:<br>
            hiker name <input type="checkbox" value = "fname" name = "sort"><br>
            location <input type="checkbox" value = "Loc" name = "sort"><br>
            price <input type="checkbox" value = "ItemPrice" name = "sort"><br>
            Search <select name="searchlist" id="searchlist">
                <option value="all" selected>All</option>
                <option value="fname" >Hiker name</option>
                <option value="Loc" >Group Location</option>
                <option value="ItemPrice" >price</option>
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
            $orderby = "hikers.hikerID";
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
                        $orderby = 'orders.'.$_POST['sort'];
                if(isset($_POST['search'])){
                    if($_POST['searchlist']!='all'){
                        ($_POST['searchlist'] =='fname')?($tb='hikers.'):($tb='orders.');
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
                $sql = "SELECT groups.GID,orders.loc,hikers.fname,orders.ItemPrice
                FROM `orders`,`groups`,`hikers` WHERE orders.GID = groups.GID AND orders.hikerid = hikers.hikerid ORDER BY $orderby $sort;";
            else if($txtsr!=""&&($_POST['searchlist']=='all'))
                $sql = "SELECT groups.GID,orders.loc,hikers.fname,orders.ItemPrice
                FROM `orders`,`groups`,`hikers` WHERE orders.GID = groups.GID AND orders.hikerid = hikers.hikerid AND concat(hikers.hikerID,groups.loc
                ) LIKE '%$txtsr%'
                ORDER BY $orderby $sort;";
            else if($txtsr!=""&&$narrowedsearch!="")
                $sql = "SELECT groups.GID,orders.loc,hikers.fname,orders.ItemPrice
                FROM `orders`,`groups`,`hikers` WHERE orders.GID = groups.GID AND orders.hikerid = hikers.hikerid AND $narrowedsearch='$txtsr'
                ORDER BY $orderby $sort;";
            
            $result = $conn->query($sql) or die($conn->error);
            if($txtsr!=""&&(mysqli_num_rows($result)) == 0)
                echo "There are no results <br> Try searching again";
            else{
                echo "<table border = 1>
                <tr><th>Hiker Name</th><th>Group ID</th><th>Location</th><th>Group Price</th></tr>";
                while($row2 = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>".$row2['fname']."</td>
                    <td>".$row2['GID']."</td>
                    <td>".$row2['loc']."</td>
                    <td>".$row2['ItemPrice']."</td>
                    </tr>";
                }
            }
        ?>
        </table>
        
    </body>
</html>