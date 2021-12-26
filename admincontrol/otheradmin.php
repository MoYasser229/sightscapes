<script>
    var errorInEmail = false
    var used = false
    var errorInPassword = false
    var errorInFname = false
    var errorInLname = false
</script>
<?php
$error=false;
$conn=new mysqli("localhost","root","","project");
echo "<form method='post' action=''>
sort:<br>
descending: <input type='checkbox' value = 'DESC' name = 'sortArrange'><br>
ascending: <input type='checkbox' value = 'ASC' name = 'sortArrange'><br>
by:<br>
ID <input type='checkbox' value = 'adminID' name = sort><br>
First Name <input type='checkbox' value = 'fname' name = sort><br>
Last Name <input type='checkbox' value = 'lname' name = 'sort'><br>
Email <input type='checkbox' value = 'email' name = 'sort'><br>
<input type='submit' name='submit'>
</form>";
$orderby = "adminID";
$sort = "ASC";
if(isset($_POST['submit']))
if(isset($_POST['sortArrange']))
if($_POST['sortArrange'] === "DESC")
$sort = "DESC";
if(isset($_POST['sort']))
if($_POST['sort'] === 'fname' || $_POST['sort'] === 'lname' || $_POST['sort'] === 'email')
$orderby = $_POST['sort'];
$sql="SELECT * FROM Admins ORDER BY $orderby $sort";
            $result=$conn->query($sql) or die($conn->error);
            echo "<form method = 'post' action = '' >";
            echo "<table border = '1'><tr>
            <th>Admin ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Password</th><th>Delete</th>
            </tr>";
            while($row=$result->fetch_assoc()){
                $id=$row['adminID'];
                echo "<tr>
                <td>{$id}</td>
                <td>{$row['fname']}</td>
                <td>{$row['lname']}</td>
                <td>{$row['email']}</td>
                <td>{$row['pswrd']}</td>
                <td><input type = 'submit' name = 'delete' value = '$id' ></td>
                </tr>";
            }
            echo "</table><input type = 'submit' name = 'add' value = 'add' ></form>";
    if(isset($_POST['add'])){
        echo "<form action='' method='post'>
        First Name:<br>
        <input type='text' name='fname'><br> 
        Last Name:<br>
        <input type='text' name='lname'><br>
        Email:<br>
        <input type='text' name='Email'> <br>
        Password:<br>
        <input type='Password' name='Password'><br><br>
        <button type = 'submit' value='add' name='Addsub'>sub</button>
        <input type='reset'>
        </form>";
        
    }
    if(isset($_POST['delete'])){
        $id=$_POST['delete'];
        $sql="DELETE FROM Admins WHERE adminID='$id'";
        $queryResult=mysqli_query($conn,$sql);
        header("Location: otheradmin.php");
    }
    if(isset($_POST['Addsub'])){
        if(empty($_POST['fname']))
            {echo "<script>errorInFname = true</script>"; $error = true;}
        else
            $fname=$_POST['fname'];

        if(empty($_POST['lname']))
            {echo "<script>errorInLname = true</script>"; $error = true;}
        else
            $lname = $_POST['lname']; 

        if(empty($_POST['Email']) || !filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL))
            {echo "<script>errorInEmail = true</script>"; $error = true;}
        else
            $email=$_POST['Email'];

        if(empty($_POST['Password']))
            {echo "<script>errorInPassword = true</script>"; $error = true;}
        else
            $password=$_POST['Password'];
        if($error==false){
            $sql="INSERT INTO Admins (fname,lname,email,pswrd) VALUES('$fname','$lname','$email','$password')";
            $queryResult=mysqli_query($conn,$sql) or die($conn->error);
            header("Location: otheradmin.php");
        }
    }
?>
    <script>
    let form = ""
    if(errorInEmail === true)
        form += "Error: Email is mistyped or not given\n"
    if(errorInPassword === true)
        form += "Error: Password is not given\n"
    if(errorInFname === true)
        form += "Error: First Name is not given\n"
    if(errorInLname === true)
        form += "Error: Last Name is not given\n"
        if(used === true)
        form += "Error: Email is already used\n"
        if(form != "")
            alert(form)
    </script>

