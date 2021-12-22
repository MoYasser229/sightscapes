<form action ='view1.php' method='post'>

<h1> <b> Welcome</b></h1>
Name: <input type='text'name='name'>
Address: <input type='text'name='address'>
<br>
Mobile: <input type='text'name='mobile'>

<?php
$courses=array('web','oop','math');
?>

Choose Course:
<select name='course'>
<?php
for($i=0;$i<count($courses);$i++)
	echo "<option>".$courses[$i]."</option>";
?>
</select>
<br>
<input type='submit'>
</form>
