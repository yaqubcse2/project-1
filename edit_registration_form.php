<?php
session_start();
error_reporting(0);
include_once('dbconnect/dbconnection.php');
date_default_timezone_set('Asia/calcutta');
include_once('SimpleImage.php');

if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$sql="select * from registration where id='$id'";
	$result=mysql_query($sql);
	$rs=mysql_fetch_array($result);
	
}

if (isset($_POST['submit'])) {	
 $name = mysql_real_escape_string($_POST['name']);
 $email= mysql_real_escape_string($_POST['email']);
 $password = mysql_real_escape_string($_POST['password']); 
 $address= mysql_real_escape_string($_POST['address']);
 $mobileNum= mysql_real_escape_string($_POST['mobile']);
 $gender= mysql_real_escape_string($_POST['gender']);
 $hobbies= mysql_real_escape_string($_POST['hobb']);
 
 $dateOfBirth = date('Y-m-d',strtotime($_POST['dateOfBirth']));
 
 $thumb = new SimpleImage();
	if(!empty($_FILES['image']['name'])) {
	    $proPick = $_FILES['image']['name']; 
		 
		 $imgName = time().$proPick;
		
		 
		if(file_exists("image_projects/".$proPick)) {
			unlink("image_projects/".$proPick);
			unlink("image_projects/bigthumb/".$proPick);
			unlink("image_projects/midthumb/".$proPick);
			unlink("image_projects/thumb/".$proPick);
		}
		move_uploaded_file($_FILES['image']['tmp_name'], 'image_projects/'.$imgName);
		$thumb->load('image_projects/'.$imgName);
		//$thumb->resize(1000, 644);
		//$thumb->save('image_projects/bigthumb/'.$imgName);
		$thumb->resize(140, 125);
		$thumb->save('image_projects/midthumb/'.$imgName);
		//$thumb->resize(60, 60);
		//$thumb->save('image_projects/thumb/'.$imgName);
	} else {
	}
      if($name=="")
	  {
		$message1 = "Please Enter your Number";  
	  }else if($email=="")
	  {
		$message1 = "Please Enter Email";  
	  }
	  else if($mobileNum=="")
	  {
		$message1 = "Please Enter Mobile Number";  
	  }
	  else if (!preg_match("/^\d{10}$/",$mobileNum))
	  {
		$message1 = "Phone number invalid !";  
	  }
	 
      else
      {		
	    $sql="insert into registration set name='$name',email='$email',password='$password',address='$address',mobile='$mobileNum',gender='$gender',hobbies='$hobbies',dateOfBirth='$dateOfBirth', image='$imgName'";
		$query_run=mysql_query($sql) or die(mysql_error());
		  
		if($query_run){
			 $_SESSION['message']='Supplier Successfully Updated';
			 header('Location: manage_form.php');  
		  }
	  }
	  
	}



?>
<! Doctype html>  
<html lang="en">  
<head>  
  <meta charset="utf-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  
  <title> PHP Registration Form </title>  
<style>  
input[type=radio] { width:20px; }  
input[type=checkbox]{ width:20px; }  
* {  
    padding: 0;  
    margin: 0;  
    box-sizing: border-box;  
}  
body {  
    margin: 50px auto;  
    text-align: center;  
    width: 800px;  
}  
input[type=reset] {  
  border: 3px solid;    
  border-radius: 2px;    
  color: ;    
  display: block;    
  font-size: 1em;    
  font-weight: bold;    
  margin: 1em auto;    
  padding: 1em 4em;    
 position: relative;    
  text-transform: uppercase;    
}    
input[type=reset]::before   
{    
  background: #fff;    
  content: '';    
  position: absolute;    
  z-index: -1;    
}    
input[type=reset]]:hover {    
  color: #1A33FF;    
}    
input {  
    border: 2px solid #ccc;  
    font-size: 1rem;  
    font-weight: 100;  
    font-family: 'Lato';  
    padding: 10px;  
}  
form {  
    margin: 20px auto;  
    padding: 20px;  
    border: 5px solid #ccc;  
    background: #8bb2eafa;  
}  
h1 {  
    font-family: sans-serif;  
  display: block;  
  font-size: 2rem;  
  font-weight: bold;  
  text-align: center;  
  letter-spacing: 3px;  
  color: hotpink;  
    text-transform: uppercase;  
}  
    input[type=submit] {    
  border: 3px solid;    
  border-radius: 2px;    
  color: ;    
  display: block;    
  font-size: 1em;    
  font-weight: bold;    
  margin: 1em auto;    
  padding: 1em 4em;    
 position: relative;    
  text-transform: uppercase;    
}    
input[type=submit]::before   
{    
  background: #fff;    
  content: '';    
  position: absolute;    
  z-index: -1;    
}    
input[type=submit]:hover {    
  color: #1A33FF;    
}    
</style> 
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script> 
<script>

$(document).ready(function(){
	
  $('#email').blur(function(){
	  var email = $(this).val();
	  //alert(email);
	//exist;
    $.ajax({
        method:"POST",
        url: "emailAjax.php",
        data:{email:email},
        success: function(data){
			console.log(data);
          $('#emailStatus').html(data);
        }
      });
  });
});

</script>




</head>  
<body>  
<h1> Registration Form </h1>  
<form name="add"  method="post" action="" enctype="multipart/form-data"> 
<table>  
 <tr>  
    <td colspan="2"></td>
                       <?php  if($message1){?>
						<div class="alert alert-dismissible alert-danger">
							<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
							<strong><?php echo $message1;?></strong>
							</div>
						<?php }?>
						<?php if($message){ ?>
						<div class="alert alert-dismissible alert-danger">
							
							<strong style="color:red;"><?php echo $message;?></strong>
							</div>
						<?php }?>
 </tr>  
  <tr>  
    <td width="159"> <b> Enter your Name </b> </td>  
    <td width="218">  
    <input type="text" placeholder="Enter name" name = "name" value="<?php echo $rs['name'];?>" id="name" pattern="[a-z A-Z]*" required /> </td>  
  </tr>  
  <tr>  
    <td> <b> Enter your Email </b> </td>  
    <td> <input type="email" name="email" value="<?php echo $rs['email'];?>" id="email"> <span style="color:red;" id="emailStatus"></span></td>  
  </tr>  
  <tr>  
    <td> <b> Enter your Password </b> </td>  
    <td> <input type="password" name="password" id="password"> </td>  
  </tr>  
  <tr>  
    <td> <b> Enter your Address </b> </td>  
    <td> <textarea name="address" id="address"></textarea> </td>  
  </tr>  
  <tr>  
    <td> <b> Enter your Mobile Number </b> </td>  
    <td> <input type="text" pattern="[0-9]*" name="mobile" id="mobile" placeholder=" Enter number" > </td>  
  </tr>  
  <tr>  
    <td height="23"> <b> Select your Gender </b> </td>  
    <td>  
    Male <input type="radio" name="gender" value="male"/>  
    Female <input type="radio" name="gender" value="female"/>  
    </td>  
  </tr>  
  <tr>  
    <td> <b> Choose your Hobbies </b> </td>  
    <td>  
        Cricket <input type="checkbox" value="cricket" name="hobb[]"/>  
        Singing <input type="checkbox" value="singing" name="hobb[]"/>  
        Dancing <input type="checkbox" value="dancing" name="hobb[]"/>  
    </td>  
  </tr>  
  <tr>  
    <td> <b> Select your Profile Pic </b> </td>  
	<td><input type="file" name="image" id="file"/></td>
  </tr>  
  <tr>  
    <td> <b> Select your Date of Birth </b> </td>  
	<td><input type="date"  class="form-control" name="dateOfBirth"/></td>
    
  </tr>  
  <tr>  
    <td colspan="8" align="center">  
    <input type ="submit" name="submit" value="Register"/>  
	<input type="reset" value="Reset"/>  
    
    </td>  
  </tr>  
</table>  
</form>  
</body>  
</html>  


<!--<select class="form-control" name="by">
							<option value="">-----SELECT-----</option>
						   <option value="Cash"<?php //if($rs['by_check_cash']=='Cash'){echo 'selected';}?>>Cash</option>
							<option value="Check"<?php //if($rs['by_check_cash']=='Check'){echo 'selected';}?>>Check</option>
							<option value="D.D"<?php //if($rs['by_check_cash']=='D.D'){echo 'selected';}?>>D.D</option>
			
			
</select>-->
