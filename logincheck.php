<?php
session_start();
$email = $_POST['email'];
$passwd = $_POST['passwd'];
$passwd = md5($passwd);

require_once('connect.php');
$q="select * from staff where status='active'
and email='".$mysqli->real_escape_string($email)."' and
spassword='".$mysqli->real_escape_string($passwd)."'" ;
$result = $mysqli->query($q);
if (!$result) {
die('Error: '.$q." ". $mysqli->error);
}
$count = $result->num_rows;
$row=$result->fetch_array();
// If result matches, there must be one row returned
if($count==1){
$_SESSION['request_id']="0";
$_SESSION['edit']="0";
$_SESSION['check']="0";
$_SESSION['staff_id']=$row['staff_id'];
$_SESSION['department']=$row['department'];
$_SESSION['position']=$row['position'];
$_SESSION['email']=$email;
$_SESSION['passwd']=$passwd;

$q="select staff_id from staff where position='Head'
and department='Maintenance'" ;
$result = $mysqli->query($q);
if (!$result) {
die('Error: '.$q." ". $mysqli->error);
}
$count = $result->num_rows;
$row=$result->fetch_array();

if($count==1){
	$_SESSION['maintenance_id']=$row['staff_id'];
}

header("location: http://localhost/P/Staff/homescreen.php");
} else {
header("location: http://localhost/P/Staff/login.php?error=1");
}
?>