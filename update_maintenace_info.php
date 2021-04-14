<?php
session_start();
require_once('connect.php');

$maintenance_no=$_POST['maintenance_no'];
if(isset($_POST['update'])){
$dateom=$_POST['dateom'];
$timeom=$_POST['timeom'];
$mic=1;
$oic=1;
if(isset($_POST['oic'])){$oic=$_POST['oic'];}
if(isset($_POST['mic'])){$mic=$_POST['mic'];}

$q="UPDATE maintenance SET dateom='$dateom', timeom='$timeom', oic='$oic', mic='$mic'
WHERE maintenance_no=$maintenance_no";
$result=$mysqli->query($q);
if(!$result){
	echo $mysqli->connect_errno.": ".$mysqli->connect_error;
}
}
elseif(isset($_POST['delete'])){
$q="DELETE FROM maintenance WHERE maintenance_no=$maintenance_no";
if(!$mysqli->query($q)){
echo "DELETE failed. Error: ".$mysqli->error ;}
}
elseif(isset($_POST['mark_as_done'])){
$q="UPDATE maintenance SET status='Done' WHERE maintenance_no=$maintenance_no";
if(!$mysqli->query($q)){
echo "DELETE failed. Error: ".$mysqli->error ;}
}

//redirect
if(isset($_POST['page'])){header("Location: 5.2)staff-maintenance_input.php");}
header("Location: 5.1)staff-maintenance_search.php");

?>