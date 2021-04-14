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
		echo '<a href="4.5)billing_input.php" class="button selected"><i class="fas fa-receipt"></i> BILLING</a>';
		echo '<a href="5)staff-maintenance_request.php" class="button"><i class="fas fa-wrench"></i> MAINTENANCE</a>';
		echo '<a href="6)staff-parcel_input.php" class="button"><i class="fas fa-shipping-fast"></i> PARCEL</a>';
	}
	elseif($_SESSION['department']=="Office"){
		echo '<a href="3.1)book_map.php" class="button"> <i class="fas fa-home"></i> BOOKING</a>';
		echo '<a href="4)pricing.php" class="button"><i class="fa fa-usd"></i> PRICING</a>';
		echo '<a href="3.5)lease_input.php" class="button"><i class="fa fa-th"></i> LEASE</a>';
	}
	elseif($_SESSION['department']=="Maintenance"){
		echo '<a href="4.5)billing_input.php" class="button selected"><i class="fas fa-receipt"></i>  BILLING</a>';
		echo '<a href="5)staff-maintenance_request.php" class="button"><i class="fas fa-wrench"></i> MAINTENANCE</a>';
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

<!-- Pop up edit -->
<?php
if(isset($_POST['edit'])){
$bill_id=$_POST['bill_id'];
$q="select * from utility where bill_id=$bill_id";
if($result=$mysqli->query($q)){
	$row=$result->fetch_array();
}else{
	echo "Query failed: ".$mysqli->error;
}
}
?>
<div
<?php
if(isset($_POST['edit'])){echo "style='display: block; margin-left: 230px; margin-top: 140px;'";}
?>
class="form-popup" id="myForm">

	<form action="update_billing.php" class="form-container" method="POST">
	<h1>Update</h1>
    <b>Bill No.  <?php echo $bill_id;?></b>
    <input Class="main" type="text" value="<?php echo $row['roomno'];?>" name="roomno" size="7" required>
    <input Class="main" type="text" value="<?php echo $row['Electricity_bill'];?>" name="Electricity_bill" size="7" required>
    <input Class="main" type="text" value="<?php echo $row['Water_bill'];?>" name="Water_bill" size="7" required>
    <b>Wifi</b><input Class="main" type="checkbox" name="Wificable_fee" <?php if($row['Wificable_fee']==200){echo 'checked';}?>>
    <input Class="main" type="text" value="<?php echo $row['maintenance_fee'];?>" name="maintenance_fee" size="10" required>
	<?php
	$orgDate = $row['due_date'];
    $newDate = date("Y-m-d", strtotime($orgDate)); 
	?>
	<b>Due date</b><input Class="main"  type="date" value="<?php echo $newDate;?>" name="due_date" required>
	<input type="hidden" name="bill_id" value="<?php echo $row['bill_id']?>">
	<input type="hidden" name="Total_room_fee" value="<?php echo $row['Total_room_fee']?>">
	<input type="hidden" name="page" value="page">
	<input style="background: green;" class="btn" type="submit" name="update" value="Update"><br>
	<input style="margin-left: 10vmax;" class="btn" type="submit" name="delete" value="Delete" onclick="myFunction()"><br>
  </form>
</div>

<!-- Pop up receipt -->
<div
<?php
if(isset($_POST['upload'])){echo "style='display: block; width: 550px; height: 550px; margin-left: 500px; margin-top: -80px;'";}
?>
class="form-popup" id="myForm2">

<form action="update_billing.php" class="form-container" method="POST">
	<h3>Receipt</h3>
	<b>Payment date</b><input Class="main"  type="date" value="<?php echo date('Y-m-d'); ?>" name="payment_date" required>
	<input style="background: green; text-align: center; width:35%;" class="btn" type="submit" name="confirm_payment" value="Confirm payment" onclick="myFunction()">
	<?php 
	$bill_id=$_POST['bill_id'];
	$resul = $mysqli->query("SELECT image FROM utility_payment_images WHERE bill_id='$bill_id'"); 
	if($resul->num_rows > 0){ ?> 
    <?php while($ro = $resul->fetch_assoc()){ 
        echo '<img style="width:100%" src="data:image/jpg;charset=utf8;base64,'.base64_encode($ro['image']).'"/>';
	}} ?>
	<div>
	<br>
	<input type="hidden" name="bill_id" value="<?php echo $bill_id;?>">
	<input type="hidden" name="page" value="page">
	</div>
  </form>
</div>


<!-- Header with full-height image -->
<header class=" w3-display-container" id="home">
<hr style="margin:-1px; padding:0px;  border-top: 2px solid #838383;">
<div class="types">
<?php
echo '<a href="4.5)billing_input.php" class="button">Input</a>';
echo '<a href="4.6)billing_search.php" class="button selected">Search</a>';
?>
</div>

<?php
$q="SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'golf_view' AND TABLE_NAME = 'utility'";
$result=$mysqli->query($q);
if(!$result){
echo $mysqli->connect_errno.": ".$mysqli->connect_error;
}
$row=$result->fetch_array();
$bill_id=$row['AUTO_INCREMENT'];
if(isset($_POST['submit'])) {
$bill_id=$bill_id+1;}

?>
<!--%%%%% Form for Request %%%%-->
<div style="text-align:center; background-color: #F9F9F9; margin: auto;">
<h2 style="padding: 10px 0px 10px; margin:0px;"></h2>
  <form action="4.6)billing_search.php" method="POST">
      <input Class="main" type="text" placeholder="Bill No." name="bill_id" size="7">
      <input Class="main" type="text" placeholder="Member ID" name="member_id" size="7">
      <input Class="main" type="text" placeholder="Room No." name="roomno" size="7">
      <input Class="main" type="text" placeholder="Name" name="name" size="7">
      <b>Wifi</b><input Class="main" type="checkbox" name="Wificable_fee">
      <b>Late fee</b><input Class="main" type="checkbox" name="late_fee">
	  <b>Due date</b><input Class="main"  type="date" name="due_date">
	  <b>Payment date</b><input Class="main"  type="date" name="payment_date">
	    <select name="status" style="width: fit-content;">
			<option value="">Status</option>
			<option value="Not paid">Not paid</option>
			<option value="Paid">Paid</option>
		</select>
	  <input class="btn" type="submit" name="search" value="Search"><br>
  </form>
</div>

<!-- Popup background-->
<div
<?php 
if(isset($_POST['edit']) || isset($_POST['upload'])){echo "style='display: block;'";}
?>
class="form-popup-background" onclick="closeForm();" id="myFormbackground">
</div>

<div style=" background-color: #F9F9F9;">
<!--%%%%% Main block %%%%-->
<?php 
$q="SELECT
	utility.bill_id,
    utility.roomno,
    utility.Electricity_bill,
    utility.Water_bill,
    utility.Wificable_fee,
    utility.maintenance_fee,
    utility.Total_room_fee,
    utility.payment_date,
    utility.due_date,
    utility.status,
    utility.Lease_id,
    lease.roomno,
    room_info.member_id,
    member.user_id,
    user.fname,
    user.lname,
    user.telephone
FROM
    utility
INNER JOIN lease ON utility.Lease_id=lease.Lease_id
INNER JOIN room_info ON lease.roomno=room_info.roomno
INNER JOIN member ON room_info.member_id=member.member_id
INNER JOIN user ON member.user_id=user.user_id
ORDER BY utility.bill_id DESC
    ";

if(isset($_POST['search'])) {
	// search data in untility
	$bill_id=$_POST['bill_id'];
	$member_id=$_POST['member_id'];
	$roomno=$_POST['roomno'];
	$name = explode(" ", $_POST['name']);
	$fname = $name[0];
	if(isset($name[1])){$lname = $name[1];}else{$lname = "";}
	if(isset($_POST['Wificable_fee'])){$Wificable_fee = $_POST['Wificable_fee'];}else{$Wificable_fee = "";}
	if(isset($_POST['late_fee'])){$late_fee = $_POST['late_fee'];}else{$late_fee = "";}
	$due_date=$_POST['due_date'];
	$payment_date=$_POST['payment_date'];
	$status=$_POST['status'];
	
$q="SELECT
	utility.bill_id,
    utility.roomno,
    utility.Electricity_bill,
    utility.Water_bill,
    utility.Wificable_fee,
    utility.maintenance_fee,
    utility.Total_room_fee,
    utility.payment_date,
    utility.due_date,
    utility.status,
    utility.Lease_id,
    lease.roomno,
    room_info.member_id,
    member.user_id,
    user.fname,
    user.lname,
    user.telephone
FROM
    utility
INNER JOIN lease ON utility.Lease_id=lease.Lease_id
INNER JOIN room_info ON lease.roomno=room_info.roomno
INNER JOIN member ON room_info.member_id=member.member_id
INNER JOIN user ON member.user_id=user.user_id
WHERE utility.bill_id like '%$bill_id%' and utility.roomno like '%$roomno%' and utility.Wificable_fee like '%$Wificable_fee%'
	and utility.due_date like '%$due_date%' and utility.payment_date like '%$payment_date%' and utility.status like '$status%'
	and room_info.member_id like '%$member_id%' 
	and ((user.fname like '%$fname%' and user.lname like '%$lname%') or (user.fname like '%$lname%' and user.lname like '%$fname%'))
ORDER BY utility.bill_id DESC
    ";
}

if($result=$mysqli->query($q)){
	$count=$result->num_rows;
	if($count==0){$color1="#FF0000";}
	else{$color1="#02D619";}
?>
<div style="padding: 0px 0px 10px; text-align: center; color: <?php echo $color1;?>;">
<?php
	echo "Total $count records";
	echo '</div>';
}else{
	echo "Query failed: ".$mysqli->error;
}
?>
<div style="text-align: center; padding-bottom: 30px;">
	<table class="detail">
        <tr>
			<th>ID</th> 
            <th>Member ID</th> 
            <th>Room</th>
			<th>Name</th>
            <th>Telephone</th>
			<th>Due Date<br>(yyyy-mm-dd)</th>
			<th>Total<br>(Baht)</th>
			<th>Late fee<br>(Baht)</th>
			<th>Payment date<br>(yyyy-mm-dd)</th>
			<th>Status</th>
			<th>Receipt</th>
        </tr> 
		
		<?php
		$i=1;
		while($row=$result->fetch_array()){ 
			if($i==1){
				$color="#F9F9F9";
				$i=-1;}
			else{
				$color="#D5D5D5";
				$i=1;}
		?>

         <tr style="padding:5px; background-color: <?php echo $color;?>;">
            <td><?php echo $row['bill_id'];?></td> 
            <td><?php echo $row['member_id'];?></td> 
            <td><?php echo $row['roomno'];?></td> 
            <td><?php echo $row['fname']." ".$row['lname'];?></td> 
            <td><?php echo "(0)".$row['telephone'];?></td> 
            <td><?php echo $row['due_date'];?></td> 
			
			<!-- Calculating late fee -->
			<?php
			if($row['status']=="Not paid"){
				$origin = new DateTime($row['due_date']);
				$target = new DateTime(date('Y-m-d'));
				$interval = $origin->diff($target);
				if($interval->format('%R%a')>0){
					$daysremain=$interval->format('%a')." days late";
					$late_fee=$interval->format('%a')*200;
					$fee_color="#FF0000";
				}
				elseif($interval->format('%R%a')==0){
					$daysremain="Today is the due date";
					$late_fee=0;
					$fee_color="#FF0000";
				}
				else{
					$daysremain=$interval->format('%a')." days remaining";
					$late_fee=0;
					$fee_color="#02D619";
				}
			}
			else{
				$origin = new DateTime($row['due_date']);
				$target = new DateTime($row['payment_date']);
				$interval = $origin->diff($target);
				$daysremain="";
				if($interval->format('%R%a')>0){
					$daysremain=$interval->format('%a')." days late";
					$late_fee=$interval->format('%a')*200;
					$fee_color="#FF0000";
				}
				elseif($interval->format('%R%a')==0){
					$daysremain="Today is the due date";
					$late_fee=0;
					$fee_color="#02D619";
				}
				else{
					$daysremain=$interval->format('%a')." days remaining";
					$late_fee=0;
					$fee_color="#02D619";
				}
			}
			?>
			
            <td><?php echo $row['Total_room_fee']+$late_fee;?></td>
			<?php
			if($row['status']=="Not paid"){
				$status="#FF0000";
				
			}
			else{
				$status="#02D619";
			}
			?>
            <td style="color: <?php echo $fee_color;?>;"><?php echo $late_fee;?></td>
            <?php
			if($row['payment_date']==""){$payment_date="-";}
			else{$payment_date=$row['payment_date'];}
			?>
			<td><?php echo $payment_date;?></td>
            <td style="color: <?php echo $status;?>;"><?php echo $row['status'];?></td>
			
			<?php
			$bill_id=$row['bill_id'];
			$resul = $mysqli->query("SELECT image FROM utility_payment_images WHERE bill_id='$bill_id'"); 
			if($resul->num_rows > 0){
				$disable="";
				$upload="Uploaded";
				$upload_color="#02D619";
			}
			else{
				$upload="None";
				$upload_color="#FF0000";
				$disable="Disabled";
			}
			?>
			<form action="4.6)billing_search.php" method="post">
			<input type="hidden" name="bill_id" value="<?php echo $row['bill_id'];?>">
			<td><button style="background-color: <?php echo $upload_color;?>;" class="open-button" name="upload" <?php echo $disable;?> value="upload"><?php echo $upload;?></button></td>
			</form>
			
			<form action="4.6)billing_search.php" method="post">
			<input type="hidden" name="bill_id" value="<?php echo $row['bill_id'];?>">
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
  $("#myForm").css({"margin-top": ($(window).scrollTop()+140) + "px", "margin-left":($(window).scrollLeft()+230) + "px"});
  $("#myForm2").css({"margin-top": ($(window).scrollTop()-80) + "px", "margin-left":($(window).scrollLeft()+500) + "px"});
  sessionStorage.scrollTop = $(this).scrollTop();
});

$(document).ready(function() {
  if (sessionStorage.scrollTop != "undefined") {
    $(window).scrollTop(sessionStorage.scrollTop);
  }
});

function myFunction() {
	$("form").submit();
  if(!confirm("Press a button!")){
	  event.preventDefault();
  }
}

function openForm() {
  document.getElementById("myForm").style.display = "block";
  document.getElementById("myFormbackground").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
  document.getElementById("myForm2").style.display = "none";
  document.getElementById("myFormbackground").style.display = "none";
}
</script>
</body>
</html>
