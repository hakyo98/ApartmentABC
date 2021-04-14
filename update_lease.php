<?php
session_start();
?>
<?php
require_once('connect.php');
$lease_id=$_POST['lease_id'];
$member_id=$_POST['member_id'];
$roomno=$_POST['roomno'];

if(isset($_POST['update'])){
$start_date=$_POST['start_date'];
$period=$_POST['period'];
if(isset($_POST['termination_date'])){$termination_date=", termination_date='".$_POST['termination_date']."'";}

$q="UPDATE lease SET roomno='$roomno', start_date='$start_date',
period='$period'".$termination_date." WHERE Lease_id=$lease_id";
$result=$mysqli->query($q);
if(!$result){
	echo $mysqli->connect_errno.": ".$mysqli->connect_error;
}
}

elseif(isset($_POST['deactivate'])){
$date=date('Y-m-d');
$q="UPDATE lease SET status='Inactive', termination_date='$date' WHERE Lease_id=$lease_id";
if(!$mysqli->query($q)){
echo "UPDATE failed. Error: ".$mysqli->error ;}

$q="UPDATE room_info SET status='Available', member_id='0' WHERE roomno='$roomno'";
if(!$mysqli->query($q)){
echo "UPDATE failed. Error: ".$mysqli->error ;}

$q="UPDATE member SET status='Inactive', roomno='0'
	WHERE member_id=$member_id";
if(!$mysqli->query($q)){
echo "UPDATE failed. Error: ".$mysqli->error ;}

}
$mysqli->close();

//redirect
if(isset($_POST['page'])){header("Location: 3.6)lease_search.php");}
else{header("Location: 3.5)lease_input.php");}
?>