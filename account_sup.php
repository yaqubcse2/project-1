<?php
session_start();
error_reporting(0);
include_once('dbconnect/dbconnection.php');
date_default_timezone_set('Asia/calcutta');
include_once('SimpleImage.php');
if($_SESSION['id']=='')
{
	header("Location:index.php");
	exit;
}

if (isset($_POST['add'])) {	
 $customer_name = mysql_real_escape_string($_POST['customer_name']);
 $contact= mysql_real_escape_string($_POST['contact']);
 $amount= mysql_real_escape_string($_POST['amount']);
 $paid= mysql_real_escape_string($_POST['paid']);
 $by= mysql_real_escape_string($_POST['by']);
 $dd_check_num = mysql_real_escape_string($_POST['dd_check_num']);    
 $pending= mysql_real_escape_string($_POST['pending']);
 
 $pending_date = date('Y-m-d',strtotime($_POST['date']));
 
 $thumb = new SimpleImage();
	if(!empty($_FILES['image']['name'])) {
	    $orgName = $_FILES['image']['name']; 
		 
		 $imgName = time().$orgName;
		
		 
		if(file_exists("image_projects/".$orgName)) {
			unlink("image_projects/".$orgName);
			unlink("image_projects/bigthumb/".$orgName);
			unlink("image_projects/midthumb/".$orgName);
			unlink("image_projects/thumb/".$orgName);
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
	if(!empty($_FILES['image1']['name'])) {
	    $orgName1 = $_FILES['image1']['name']; 
	    $imgName1 = $customer_name.$orgName1;
		move_uploaded_file($_FILES['image1']['tmp_name'], 'image_projects/'.$imgName1);
		$thumb->load('image_projects/'.$imgName1);
		$thumb->resize(140, 125);
		$thumb->save('image_projects/midthumb/'.$imgName1);	
	} else {
		
	}
 
 
      if($contact=="")
	  {
		$message1 = "Please Enter Contact Number";  
	  }
	  else if (!preg_match("/^\d{10}$/",$contact))
	  {
		$message1 = "Phone number invalid !";  
	  }
    
     else if($customer_name=="")
	  {
		  $message1 = "Please Enter Customer Name";
	  }	 
	  
	  else if($amount=="" || $pending=="")
	 {
		 $message1 = "Plese Fill Required Form Field!";
     }
	 
      else
      {		
	    $sql="insert into account_supplier set name='$customer_name', image='$imgName', images='$imgName1', contact='$contact', amount='$amount', paid='$paid', by_check_cash='$by', dd_check_num='$dd_check_num', pending='$pending', date='$pending_date'";
		$query_run=mysql_query($sql) or die(mysql_error());
		  
		if($query_run){
			  $message='Supplier Successfully Added';
		  }
	  }
	  
	}

?>
<?php include("header.php");?>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<?php include("topmenu.php");?>
    <div class="ts-main-content">
     <?php include("leftmenu.php");?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

                     <?php  if($message){?>
						<div class="alert alert-dismissible alert-success">
							<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
							<strong><?php echo$message;?></strong>
							</div>
						<?php }?>
						
						<?php  if($message1){?>
						<div class="alert alert-dismissible alert-danger">
							<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
							<strong><?php echo$message1;?></strong>
							</div>
						<?php }?>
					<!--Start table-->
					<h2 class="page-title">Supplier Account</h2>
					<div class="panel panel-default panels">
					<div class="panel-heading">
							<div class="btn-group">
							<a href="manage_acc_sup.php" class="btb btn-success btn-sm">
							<span class="fa fa-arrow-left"> Back </span></a>
							</div>
							</div>
					
					 <form name="addbilling"  method="post" action="" enctype="multipart/form-data">					
										<div class="panel-body">
									<!--Start First Row-->
									
									<div class="table-responsive panelss" >
									<table class="table table-bordered table-striped">
											<thead>
												<tr>
													
													<th>Supplier Name</th>
													<th>Contact</th>
													<th>Amount</th>
													<th>Paid</th>
												</tr>
											</thead>
											<tbody>
								<tr>
								<td><input type="text"  class="form-control" name="customer_name"></td>
								<td>
								<input type="text"  class="form-control" name="contact">
								
											</td>
								<td>
								
								<input type="text"  class="form-control" name="amount">
								
								</td>
								<td><input type="text" class="form-control" name="paid"></td>
								</tr>
												
											</tbody>
										</table></div>
										<!--End first Row-->
										
									<!--Start Second Row-->
									<div class="table-responsive panelss" >
									<table class="table table-bordered table-striped">
											<thead>
												<tr>
													
													<th>By</th>
													<th>DD/Check No</th>
													<th>Pending</th>
													<th>Date</th>
													<th>Image</th>
													<th>Signature</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													
								<td>
								<select class="form-control" name="by">
													<option value="">-----SELECT-----</option>
													<option value="Cash">Cash</option>
													<option value="Check">Check</option>
													<option value="D.D">D.D</option>
									
											</select>
								
								</td>
								
								<td><input type="text"  class="form-control" name="dd_check_num"></td>
								<td><input type="text"  class="form-control" name="pending"></td>
								<td><input type="date"  class="form-control" name="date"></td>
								<td><input type="file" name="image" id="file"/></td>
								<td><input type="file" name="image1" id="file1"/></td>
								<td> <input type="submit" name="add" value="Add" id="add" class="btn" style="background:rgb(74, 179, 198); color:white;"></td>					
							      		
													</tr>
												
											</tbody>
										</table></div>
										<!--End Second Row-->	
									</div>
									</form>
								</div>
								<!--End-->
				 </div>
                </div>
		</div>
	</div>	
 <?php include("footer.php");?>	

