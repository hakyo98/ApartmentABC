<?php
session_start();
if(!isset($_SESSION['staff_id'])){
header("location: http://localhost/P/Staff/login.php");
}
?>
<?php
require_once('connect.php');

$title=$_POST['title'];
$email=$_POST['email'];
$telephone=$_POST['telephone'];
$address=$_POST['address'];
$civil_status=$_POST['civil_status'];
$language_ability=$_POST['language_ability'];
$id=$_POST['staff_id'];

$q="UPDATE staff SET title='$title', email='$email', telephone='$telephone', address='$address', civil_status='$civil_status', language_ability='$language_ability'
WHERE staff_id=$id";
$result=$mysqli->query($q);
if(!$result){
	echo $mysqli->connect_errno.": ".$mysqli->connect_error;
}

$mysqli->close();
//redirect
header("Location: 7)staff-profile.php");
?>