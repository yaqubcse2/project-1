<?php
session_start();
error_reporting();
include_once('dbconnect/dbconnection.php');	
if(isset($_POST['email'])){  
    $email=$_POST['email'];  
   $query=mysql_query("SELECT * FROM registration WHERE email = '$email'");	
   
   $row=mysql_fetch_assoc($query);
   if($row['email']){
	   echo "Email Already Exist"; 
   } else {
	   
   }
  
  
  
}
?>