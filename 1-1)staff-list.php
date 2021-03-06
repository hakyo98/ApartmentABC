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
		echo '<a href="1-1)staff-list.php"  class="button selected"> STAFF-LIST</a>';
		echo '<a href="2-1)add-staff.php" class="button"><i class="fa fa-plus"></i> ADD-STAFF</a>';
	}
	if($_SESSION['department']=="Admin"){
		echo '<a href="3.1)book_map.php" class="button"> <i class="fas fa-home"></i>  BOOKING</a>';
		echo '<a href="4)pricing.php" class="button"><i class="fa fa-usd"></i> PRICING</a>';
		echo '<a href="3.5)lease_input.php" class="button"><i class="fa fa-th"></i> LEASE</a>';
		echo '<a href="4.5)billing_input.php" class="button"><i class="fas fa-receipt"></i> BILLING</a>';
		echo '<a href="5)staff-maintenance_request.php" class="button"><i class="fas fa-wrench"></i> MAINTENANCE</a>';
		echo '<a href="6)staff-parcel_input.php" class="button"><i class="fas fa-shipping-fast"></i> PARCEL</a>';
	}
	elseif($_SESSION['department']=="Office"){
		echo '<a href="3.1)book_map.php" class="button"> <i class="fas fa-home"></i> BOOKING</a>';
		echo '<a href="4)pricing.php" class="button"><i class="fa fa-usd"></i> PRICING</a>';
		echo '<a href="3.5)lease_input.php" class="button"><i class="fa fa-th"></i> LEASE</a>';
	}
	elseif($_SESSION['department']=="Maintenance"){
		echo '<a href="4.5)billing_input.php" class="button"><i class="fas fa-receipt"></i>  BILLING</a>';
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
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ??</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">MEMBERS</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">ADD-MEMBERS</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">BOOK NOW</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">WORK</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">PRICING</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">CONTACT US</a>
  <a href="" onclick="w3_close()" class="w3-bar-item w3-button">SIGN OUT</a>
</nav>

<!-- Header with full-height image -->
<header class="w3-display-container" id="home">
<div>

	<!--%%%%% Main block %%%%-->
	<?php
		if(isset($_POST['submit'])) {
			// insert data from add_user.php
			$position=$_POST['position'];
			$department=$_POST['department'];
			$salary=$_POST['salary'];
			$title=$_POST['title'];
			$sfname=$_POST['sfname'];
			$smname=$_POST['smname'];
			$slname=$_POST['slname'];
			$idpassport=$_POST['idpassport'];
			$email=$_POST['email'];
			$telephone=$_POST['telephone'];
			$enroll_date=$_POST['enroll_date'];
			$sDOB=$_POST['sDOB'];
			$address=$_POST['address'];
			$civil_status=$_POST['civil_status'];
			$language_ability=$_POST['language_ability'];
			$passwd=$_POST['passwd'];
			$passwd=md5($passwd);
			
			$q="INSERT INTO staff (staff_id,position,department,salary,title,sfname,smname,slname,national_id,email,telephone,enroll_date,sDOB,address,civil_status,language_ability,spassword)
			VALUES ('','$position','$department','$salary','$title','$sfname','$smname','$slname','$idpassport','$email','$telephone','$enroll_date','$sDOB','$address','$civil_status','$language_ability','$passwd')";
			$result=$mysqli->query($q);
			if(!$result){
				echo $mysqli->connect_errno.": ".$mysqli->connect_error;
			}
		}
	?>
	<h2 style="padding-left: 40px; padding:15px; margin: 0; background-color: #F9F9F9;">Staff list</h2>
<div style="padding:5px;  padding-bottom: 30px; background-color: #F9F9F9;">
	<table style="text-align:center; margin: auto; padding: 0px 0px 10px;">
        <tr>
			<th>ID</th> 
            <th>Position</th> 
            <th>Department</th>
			<th>Name</th>
            <th>ID/Passport</th>
            <th>Email</th>
            <th>Telephone</th>
        </tr>
		<?php 
			$i=1;
		 	$q="select * from staff";
			$result=$mysqli->query($q);
			if(!$result){
				echo 'Query error: '.$mysqli->error;
			}
		 while($row=$result->fetch_array()){ ?>
		 <?php 
			if($i==1)
			{
				$color="#F9F9F9";
				$i=-1;
			}
			else
			{
				$color="#D5D5D5";
				$i=1;
			}
		?>
         <tr style="padding:5px; background-color: <?php echo $color;?>;">
            <td><?php echo $row['staff_id'];?></td> 
            <td><?php echo $row['position'];?></td> 
            <td><?php echo $row['department'];?></td> 
            <td><?php echo $row['title'];?> <?php echo $row['sfname'];?> <?php echo $row['smname'];?> <?php echo $row['slname'];?></td>
            <td><?php echo $row['national_id'];?></td>
            <td><?php echo $row['email'];?></td>
            <td><?php echo "(0)"; echo $row['telephone'];?></td>
            <td><a href='1-2)staff-list-more.php?userid=<?php echo $row['staff_id']?>'> Moreinfo </a></td>
        </tr>                               
		<?php }?>

		<tr>
			<td colspan="18" style="text-align: end;">
			<?php 
			// count the no. of entries
			$q="select staff_id from staff";
			if($result=$mysqli->query($q)){
				$count=$result->num_rows;
				echo "Total $count records";
				$result->free();
			}else{
				echo "Query failed: ".$mysqli->error;
			}
			?>
			</td>
		</tr>
	</table>
</div>
</header>

</body>
</html>