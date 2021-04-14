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
<form action="update_maintenace_info.php" class="form-container" method="POST">
	<h1>Update</h1>
    <b>Request No. </b><?php echo " ".$row['maintenance_no'];?>
    <b>Room </b><?php echo " ".$row['roomno'];?>
    <b>Request date</b><?php echo " ".$row['request_date'];?>
	<b>Description</b><?php echo " ".$row['description'];?>
	<?php
	$orgDate = $row['dateom'];
    $newDate = date("Y-m-d", strtotime($orgDate)); 
	?>
    <b>Maintenance date</b><input Class="main" type="date" name="dateom" value="<?php echo $newDate;?>" required>
	<b>time</b><input Class="main" type="time" name="timeom" value="<?php echo $row['timeom'];?>" min="09:00" max="17:30" required>
    <b>Telephone</b><?php echo " ".$row['telephone'];?>
	<b>Record staff</b><input Class="main" type="text" value="<?php echo $row['oic'];?>" name="oic" size="10">
	<b>Maintainer</b><input Class="main" type="text" value="<?php echo $row['mic'];?>" name="mic" size="13">
	<input type="hidden" name="maintenance_no" value="<?php echo $row['maintenance_no']?>">
	<div>
	<input style="background: green;" class="btn" type="submit" name="update" value="Update">
		<input style="background: green; margin-left: 10vmax;" class="btn" type="submit" name="mark_as_done" value="Mark as done">
	<input style="margin-left: 10vmax;" class="btn" type="submit" name="delete" value="Delete" onclick="myFunction()">
	</div>
  </form>
</div>

<!-- Header with full-height image -->
<header class="w3-display-container" id="home">
<hr style="margin:-1px; padding:0px;  border-top: 2px solid #838383;">
<div class="types">
<?php
echo '<a href="5)staff-maintenance_request.php" class="button">Requests</a>';
echo '<a href="5.1)staff-maintenance_search.php" class="button selected">Search</a>';
echo '<a href="5.2)staff-maintenance_input.php" class="button">Input</a>';
?>
</div>

<!--%%%%% Form for Request %%%%-->
<div style="text-align:center; background-color: #F9F9F9; margin: auto;">
<h2 style="padding: 25px 0px 25px; margin:0px;">Search maintenance requests</h2>
  <form action="5.1)staff-maintenance_search.php" method="POST">
      <input Class="main" type="text" placeholder="Request No." name="maintenance_no" size="6" >
      <input Class="main" type="text" placeholder="Room No" name="roomno" size="7" >
      <b>Request date</b><input Class="main"  type="date" name="request_date" >
      <input Class="main" type="text" placeholder="Description" name="description" size="100" ><br>
      <b>Maintenance date</b><input Class="main"  type="date" value="<?php echo date('Y-m-d');?>" name="dateom" >
	  <b>time</b><input Class="main" type="time" name="timeom" min="09:00" max="17:30" >
      <input Class="main" type="text" placeholder="Telephone" name="telephone" size="15" >
	  <input Class="main" type="text" placeholder="Record staff" name="oic" size="10" >
	  <input Class="main" type="text" placeholder="maintenance staff" name="mic" size="13" >
        <select name="status" style="width: fit-content;">
			<option value="">Status</option>
			<option value="bag">Not done</option>
			<option value="box">Done</option>
		</select>
	  <input class="btn" type="submit" name="search" value="Search"><br>
  </form>
</div>

<div
<?php 
if(isset($_POST['edit'])){echo "style='display: block;'";}
?>
class="form-popup-background" onclick="closeForm();" id="myFormbackground">
</div>

<div style=" padding: 0px 0px 10px; background-color: #F9F9F9;">
<?php 
$i=1;
	$q="select * from maintenance where NOT oic='1' and NOT mic='1'";
if(isset($_POST['search'])) {
	$maintenance_no=$_POST['maintenance_no'];
	$roomno=$_POST['roomno'];
	$request_date=$_POST['request_date'];
	$description=$_POST['description'];
	$dateom=$_POST['dateom'];
	$timeom=$_POST['timeom'];
	$telephone=$_POST['telephone'];
	$oic=$_POST['oic'];
	$mic=$_POST['mic'];
	$status=$_POST['status'];

	$q="select * from maintenance where maintenance_no like '%$maintenance_no%'
	and roomno like '%$roomno%' and request_date like '%$request_date%' and description like '%$description%' 
	and dateom like '%$dateom%' and timeom like '%$timeom%' 
	and telephone like '%$telephone%' and oic like '%$oic%' and mic like '%$mic%' and status like '%$status%'
	and (NOT oic='1' and NOT mic='1')";
}
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
			<th>Status</th>
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
            <td><?php echo $row['dateom']." / ".$row['timeom'];?></td>
            <td><?php echo $row['telephone'];?></td>
            <td><?php echo $row['oic'];?></td>
            <td><?php echo $row['mic'];?></td>
			<?php
			if($row['status']=="Not done"){$status="#FF0000";}
			else{$status="#02D619";}
			?>
            <td style="color: <?php echo $status;?>;"><?php echo $row['status'];?></td>
			
			<form action="5.1)staff-maintenance_search.php" method="post">
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
