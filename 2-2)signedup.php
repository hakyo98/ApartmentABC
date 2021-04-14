<?php require_once('connect.php');  ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles11.css">
<title>signedup</title>
</head>

<body>

<div >
	<!--%%%%% Main block %%%%-->
	<?php
		if(isset($_POST['submit'])) {
			// insert data from add_user.php
			$fname=$_POST['fname'];
			$lname=$_POST['lname'];
			$dob=$_POST['dob'];
			$idpassport=$_POST['idpassport'];
			$address=$_POST['address'];
			$email=$_POST['email'];
			$lineid=$_POST['lineid'];
			$passwd=$_POST['passwd'];
			$passwd=md5($passwd);
			
			$q="INSERT INTO USER (USER_ID,FNAME,LNAME,BIRTHDATE,PASSPORTID,ADDRESS,EMAIL,LINEID,PASSWORD)
			VALUES ('','$fname','$lname','$dob','$idpassport','$address','$email','$lineid','$passwd')";
			$result=$mysqli->query($q);
			if(!$result){
				echo "error";
			}
		}
	?>
	<h2>User Profile</h2>
	<table>
        <col width="2%">
        <col width="10%">
        <col width="8%">
        <col width="10%">
        <col width="30%">
        <col width="10%">
        <col width="10%">
        <col width="10%">

        <tr>
            <th>ID</th> 
            <th>Name</th>
            <th>Birthdate</th>
            <th>National/ Passport ID</th>
            <th>Address</th>
            <th>Email</th>
            <th>Line ID</th>
            <th>Password</th>
        </tr>
		<?php 
		 	$q="select * from USER";
			$result=$mysqli->query($q);
			if(!$result){
				echo 'Query error: '.$mysqli->error;
			}
			
		 while($row=$result->fetch_array()){ ?>
         <tr>
            <td><?php echo $row['user_id'];?></td> 
            <td><?php echo $row['fname'];?> <?php echo $row['lname'];?></td>
            <td><?php echo $row['birthdate'];?></td>
            <td><?php echo $row['passportid'];?></td>
            <td><?php echo $row['address'];?></td>
            <td><?php echo $row['email'];?></td>
            <td><?php echo $row['lineid'];?></td>
            <td><?php echo $row['password'];?></td>
            <td><a href='editinfo.php?userid=<?php echo $row['user_ID']?>'> Edit </a></td>
            <td><a href='delinfo.php?userid=<?php echo $row['user_ID']?>'> Delete </a></td>
        </tr>                               
		<?php } ?>

		<tr>
			<td colspan="8" style="text-align: end;">
			<?php 
			// count the no. of entries
			$q="select user_ID from user";
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
</body>
</html>
