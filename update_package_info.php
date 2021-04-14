<?php
session_start();
?>
<?php
require_once('connect.php');
if(isset($_POST['update'])){
$gvpackageno=$_POST['gvpackageno'];
$delivery_partner=$_POST['delivery_partner'];
$doa=$_POST['doa'];
$dor=$_POST['dor'];
$type_of_package=$_POST['type_of_package'];
$owner_name=$_POST['name'];
$citizen_id=$_POST['citizen_id'];
$poic=$_POST['poic'];

$q="UPDATE packages SET delivery_partner='$delivery_partner', doa='$doa', dor='$dor', type_of_package='$type_of_package',
owner_name='$owner_name', citizen_id='$citizen_id', poic='$poic'
WHERE gvpackageno=$gvpackageno";
$result=$mysqli->query($q);
if(!$result){
	echo $mysqli->connect_errno.": ".$mysqli->connect_error;
}
}
elseif(isset($_POST['delete'])){
	$gvpackageno=$_POST['gvpackageno'];
	$q="DELETE FROM packages WHERE gvpackageno=$gvpackageno";
	if(!$mysqli->query($q)){
	echo "DELETE failed. Error: ".$mysqli->error ;}
}

//redirect
if(isset($_POST['page'])){header("Location: 6.2)staff-parcel_search.php");}
header("Location: 6)staff-parcel_input.php");

?>