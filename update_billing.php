<?php
session_start();
?>
<?php
require_once('connect.php');
$bill_id=$_POST['bill_id'];
if(isset($_POST['update'])){
$roomno=$_POST['roomno'];
$Electricity_bill=$_POST['Electricity_bill'];
$Water_bill=$_POST['Water_bill'];
$maintenance_fee=$_POST['maintenance_fee'];
$due_date=$_POST['due_date'];
if(isset($_POST['Wificable_fee']) && $_POST['Wificable_fee']=='on'){
	$Wificable_fee=200;
	}
else{
	$Wificable_fee=0;
}
$Standard = array(
"A1","A2","A3","A4","A5","A6","A7",
"B1","B2","B3","B4","B5","B6","B7",
"C1",          "C4","C5","C6","C7");
$Premium = array(
"M1","M2");
$Paradise = array(
"P1");
if(in_array(substr($_POST['roomno'],0,2),$Standard)){
	$roomrent=2950;
	if(substr($_POST['roomno'],2,1)>1){
		$roomrent=3050;
	}
}
elseif(in_array(substr($_POST['roomno'],0,2),$Premium)){
	$roomrent=3850;
	if(substr($_POST['roomno'],2,1)>1){
		$roomrent=4050;
	}
}
elseif(in_array(substr($_POST['roomno'],0,2),$Paradise)){
	$roomrent=6350;
	if(substr($_POST['roomno'],2,1)>1){
		$roomrent=6550;
	}
}

$Total_room_fee=$Electricity_bill+$Water_bill+$maintenance_fee+$Wificable_fee+$roomrent;

$q="UPDATE utility SET roomno='$roomno', Electricity_bill='$Electricity_bill',
Water_bill='$Water_bill', Wificable_fee='$Wificable_fee', maintenance_fee='$maintenance_fee',
due_date='$due_date', Total_room_fee='$Total_room_fee' WHERE bill_id=$bill_id";
$result=$mysqli->query($q);
if(!$result){
	echo $mysqli->connect_errno.": ".$mysqli->connect_error;
}
}
elseif(isset($_POST['delete'])){
$q="DELETE FROM utility WHERE bill_id=$bill_id";
if(!$mysqli->query($q)){
echo "DELETE failed. Error: ".$mysqli->error ;}
}
elseif(isset($_POST['confirm_payment'])){
$payment_date=$_POST['payment_date'];
$due_date=$_POST['due_date'];
/*-------------- Check if the payment is late ----------------*/
$origin = new DateTime($due_date);
$target = new DateTime($payment_date);
$interval = $origin->diff($target);
if($interval->format('%R%a')>0){
	$late_fee=$interval->format('%a')*200;
}
else{
	$late_fee=0;
}

$q="UPDATE utility SET status='Paid', late_fee='$late_fee', payment_date='$payment_date' WHERE bill_id=$bill_id";
if(!$mysqli->query($q)){
echo "Confirm payment failed. Error: ".$mysqli->error ;
}
}
$mysqli->close();

//redirect
if(isset($_POST['page'])){header("Location: 4.6)billing_search.php");}
else{header("Location: 4.5)billing_input.php");}
?>