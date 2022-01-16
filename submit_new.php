<?php
if(isset($_POST['submit_password']) && $_POST['key'] && $_POST['reset'])
{
  $email=$_POST['email'];
  $pass=$_POST['pswrd'];
  mysql_connect('localhost','root','');
  mysql_select_db('project');
  $select=mysql_query("update Users set pswrd='$pass' where email='$email'");
}
?>
