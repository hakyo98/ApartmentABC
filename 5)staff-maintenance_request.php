<?php require_once('connect.php');
session_start();
if(!isset($_SESSION['staff_id'])){
header("location: http://localhost/P/Staff/login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Homepage</title>
<link href="homestyle.css" rel="stylesheet">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<!-- Navbar (sit on top) -->
<div class="top">
  <div class="bar" id="myNavbar">
	<?php if($_SESSION['position']=="Head"){
		echo '<a href="homescreen.php" class="logo">'.$_SESSION["position"].' of '.$_SESSION["department"].'</a>';
	}
	elseif($_SESSION['position']=="Admin"){
		echo '<a href="homescreen.php" class="logo">'.$_SESSION["department"].'</a>';
	}
	else{
		echo '<a href="homescreen.php" class="logo"> '.$_SESSION["department"].' '.$_SESSION["position"].'</a>';  
	}
	?>
	<!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small" >
	<?php
	if($_SESSION['position']=="Head" || $_SESSION['department']=="Admin"){
		echo '<a href="1-1)staff-list.php"  class="button"> STAFF-LIST</a>';
		echo '<a href="2-1)add-staff.php" class="button"><i class="fa fa-plus"></i> ADD-STAFF</a>';
	}
	if($_SESSION['department']=="Admin"){
		echo '<a href="3.1)book_map.php" class="button"> <i class="fas fa-home"></i>  BOOKING</a>';
		echo '<a href="4)pricing.php" class="button"><i class="fa fa-usd"></i> PRICING</a>';
		echo '<a href="3.5)lease_input.php" class="button"><i class="fa fa-th"></i> LEASE</a>';
		echo '<a href="4.5)billing_input.php" class="button"><i class="fas fa-receipt"></i> BILLING</a>';
		echo '<a href="5)staff-maintenance_request.php" class="button selected"><i class="fas fa-wrench"></i> MAINTENANCE</a>';
		echo '<a href="6)staff-parcel_input.php" class="button"><i class="fas fa-shipping-fast"></i> PARCEL</a>';
	}
	elseif($_SESSION['department']=="Office"){
		echo '<a href="3.1)book_map.php" class="button"> <i class="fas fa-home"></i> BOOKING</a>';
		echo '<a href="4)pricing.php" class="button"><i class="fa fa-usd"></i> PRICING</a>';
		echo '<a href="3.5)lease_input.php" class="button"><i class="fa fa-th"></i> LEASE</a>';
	}
	elseif($_SESSION['department']=="Maintenance"){
		echo '<a href="4.5)billing_input.php" class="button"><i class="fas fa-receipt"></i>  BILLING</a>';
		echo '<a href="5)staff-maintenance_request.php" class="button selected"><i class="fas fa-wrench"></i> MAINTENANCE</a>';
	}
	elseif($_SESSION['department']=="Package"){
		echo '<a href="6)staff-parcel_input.php" class="button"><i class="fas fa-shipping-fast"></i> PARCEL</a>';
	}
	?>
      <a href="7)staff-profile.php"     class="button"><i class="fa fa-user-circle"></i></a>
	  <a href="login.php?logout=1" 		class="button"><i class="fas fa-sign-out-alt"></i></a>
    </div>
    <!-- Hide right-floated links on small screens and replace them with a menu icon -->
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">MEMBERS</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">ADD-MEMBERS</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">BOOK NOW</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">WORK</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">PRICING</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">CONTACT US</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">SIGN OUT</a>
</nav>

<?php
if(isset($_POST['edit'])){
$maintenance_no=$_POST['maintenance_no'];
$q="select * from maintenance where maintenance_no=$maintenance_no";
if($result=$mysqli->query($q)){
	$row=$result->fetch_array();
}else{
	echo "Query failed: ".$mysqli->error;
}
}
?>
<div
<?php
if(isset($_POST['edit'])){echo "style='display: block; margin-left: 240px; margin-top: 160px;'";}
?>
class="form-popup" id="myForm">

<form action="5)staff-maintenance_request.php" class="form-container" method="POST">
	<h1>Update</h1>
    <b>Request No. </b><?php echo " ".$row['maintenance_no'];?>
    <b>Room </b><?php echo " ".$row['roomno'];?>
    <b>Request date</b><?php echo " ".$row['request_date'];?>
	<b>Description</b><?php echo " ".$row['description'];?>
	<?php
	$orgDate = $row['dateom'];
    $newDate = date("Y-m-d", strtotime($orgDate)); 
	?>
    <b>Maintenance date</b><input Class="main" type="date" name="dateom" value="<?php echo $newDate;?>">
	<b>time</b><input Class="main" type="time" name="timeom" value="<?php echo $row['timeom'];?>">
    <b>Telephone</b><?php echo " ".$row['telephone'];?>
	<input Class="main" type="text" placeholder="Record staff" name="oic" size="10">
	<input Class="main" type="text" placeholder="maintainer" name="mic" size="13">
	<input type="hidden" name="maintenance_no" value="<?php echo $row['maintenance_no']?>">
	<div>
	<input style="background: green;" class="btn" type="submit" name="update" value="Update">
	<input style="margin-left: 10vmax;" class="btn" type="submit" name="delete" value="Delete" onclick="myFunction()">
	</div>
  </form>
</div>

<!-- Header with full-height image -->
<header class="w3-display-container" id="home">
<hr style="margin:-1px; padding:0px;  border-top: 2px solid #838383;">
<div class="types">
<?php
echo '<a href="5)staff-maintenance_request.php" class="button selected">Requests</a>';
echo '<a href="5.1)staff-maintenance_search.php" class="button">Search</a>';
echo '<a href="5.2)staff-maintenance_input.php" class="button">Input</a>';
?>
</div>

<!-- Background for popup -->
<div
<?php 
if(isset($_POST['edit'])){echo "style='display: block;'";}
?>
class="form-popup-background" onclick="closeForm();" id="myFormbackground">
</div>

<!--%%%%% Main block %%%%-->
<?php 
if(isset($_POST['update'])) {
	// update data in maintenance request
	$maintenance_no=$_POST['maintenance_no'];
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
	$maintenance_no=$_POST['maintenance_no'];
	$q="DELETE FROM maintenance WHERE maintenance_no=$maintenance_no";
	if(!$mysqli->query($q)){
	echo "DELETE failed. Error: ".$mysqli->error ;}
}
?>

<div style=" padding: 0px 0px 10px; background-color: #F9F9F9;">
<?php 
$i=1;
$q="select * from maintenance where oic='1' and mic='1'";

if($result=$mysqli->query($q)){
	$count=$result->num_rows;
	if($count==0){$color1="#FF0000";}
	else{$color1="#02D619";}
?>

<div style="padding: 0px 0px 15px; text-align: center; color: <?php echo $color1;?>;">
<?php
	echo "Total $count records";
	echo '</div>';
}else{
	echo "Query failed: ".$mysqli->error;
}
?>
<div style="text-align: center;  padding-bottom: 30px;">
	<table class="detail">
        <tr>
			<th>No.</th> 
            <th>Room</th> 
            <th>Request date</th>
			<th>Description</th>
            <th>Maintenance date / time</th>
			<th>Telephone</th>
			<th>Staff</th>
			<th>maintainer</th>
        </tr>
		<?php
		while($row=$result->fetch_array()){ 
			if($i==1){
				$color="#F9F9F9";
				$i=-1;}
			else{
				$color="#D5D5D5";
				$i=1;}
		?>
        <tr style="padding:5px; background-color: <?php echo $color;?>;">
            <td><?php echo $row['maintenance_no'];?></td> 
            <td><?php echo $row['roomno'];?></td> 
            <td><?php echo $row['request_date'];?></td> 
            <td><?php echo $row['description'];?></td> 
            <?php
			if($row['dateom']=='0000-00-00'){
				$dateom='-';
			}else{
				$dateom=$row['dateom'];
			}
			if($row['timeom']=='00:00:00'){
				$timeom='-';
			}else{
				$timeom=$row['timeom'];
			}
			?>
			<td><?php echo $dateom." / ".$timeom;?></td>
            <td><?php echo $row['telephone'];?></td>
            <td>-</td>
            <td>-</td>
			
			<form action="5)staff-maintenance_request.php" method="post">
			<input type="hidden" name="maintenance_no" value="<?php echo $row['maintenance_no'];?>">
			<td><button class="open-button" name="edit" value="edit">Edit</button></td>
			</form>
			</tr>	
			<?php
			 }
			?>
	</table>
	</div>
</div>
</header>
<script>
$(window).scroll(function() {
  $("#myForm").css({"margin-top": ($(window).scrollTop()+160) + "px", "margin-left":($(window).scrollLeft()+240) + "px"});

  sessionStorage.scrollTop = $(this).scrollTop();
});

$(document).ready(function() {
  if (sessionStorage.scrollTop != "undefined") {
    $(window).scrollTop(sessionStorage.scrollTop);
  }
});

function myFunction() {
	$("form").submit();
  if(!confirm("Are you sure?")){
	  event.preventDefault();
  }
}

function openForm() {
  document.getElementById("myForm").style.display = "block";
  document.getElementById("myFormbackground").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
  document.getElementById("myFormbackground").style.display = "none";
}
</script>
</body>
</html>
