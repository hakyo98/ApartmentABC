<?php
$username='root';
$password='';
$database='golf_view';
$mysqli = new mysqli('localhost',$username,$password,$database);
   if($mysqli->connect_errno){
      echo $mysqli->connect_errno.": ".$mysqli->connect_error;
   }
 ?>
