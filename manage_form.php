<?php 
session_start();
error_reporting(0);
include_once('dbconnect/dbconnection.php');
date_default_timezone_set('Asia/calcutta');

if(isset($_GET['id'])){
	$id=$_GET['id'];
	
	$sql = "DELETE FROM `registration` WHERE `id`='$id'";
	 mysql_query($sql);
	 
	 $message='Student Successfully deleted';
   
 }
?>

		
    <div class="ts-main-content">
     
		<div class="content-wrapper">
			<div class="container-fluid">
              <div class="row">
				<div class="col-md-12">
                     <?php  if(isset($_SESSION['message'])){?>
						<div class="alert alert-dismissible alert-success">
							<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
							<strong><?php echo $_SESSION['message'];?></strong>
							</div>
						<?php }?>
						<h2 class="page-title">Student Account</h2>
						
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">
							<div class="btn-group">
							<a href="registration_form.php" class="btb btn-success btn-sm">
							<span class="fa fa-plus-circle"> Add </span></a>
							
							
							</div>
							</div>
							<div class="panel-body">
							<div class="table-responsive">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>Image</th>
									    <th>User Name</th>
										<th>Mobile</th>
											
											<th>Date Of Birth</th>
											
											<th>Action</th>
										</tr>
									</thead>
									
									<tbody>
									<?php $sql="select * from registration order by id desc";$result=mysql_query($sql);
									while($rs=mysql_fetch_array($result)){?>
										<tr>
										<td>
									<?php 
									if($rs['image']!=""){ ?>
									<img id="myImg" src="image_projects/midthumb/<?php echo $rs['image']; ?>" class="img img-responsive">
									<?php } else { ?>
									<img id="myImg" src="image_projects/midthumb/images.jpg" class="img img-responsive">
									<?php } ?>	
							</td>
							
											<td><?php echo$rs['name'];?></td>
											<td><?php echo$rs['mobile'];?></td>
											<td><?php echo date('d-M-Y',strtotime($rs['dateOfBirth']));?></td>
											<td><a href="edit_registration_form.php?id=<?php echo $rs['id'];?>" title="Edit">Edit</a>
											<a href="manage_form.php?id=<?php echo$rs['id'];?>" title="Delete" onclick="return confirm('Do You want to delete !');">Delete</a>
											</td>
										</tr>
									<?php }?>	
									</tbody>
								</table></div>
								</div></div>

					</div>
  </div>

			</div>
		</div>
	</div>


