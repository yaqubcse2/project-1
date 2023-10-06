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
										<th>Signature</th>
											<th>Name</th>
											<th>Contact</th>
											<th>Amount</th>
											<th>Paid</th>
											<th>By</th>
											<th>DD/Check No</th>
											<th>Pending</th>
											<th>Date</th>
											
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>Image</th>
										<th>Signature</th>
											<th>Name</th>
											<th>Contact</th>
											<th>Amount</th>
											<th>Paid</th>
											<th>By</th>
											<th>DD/Check No</th>
											<th>Pending</th>
											<th>Date</th>
											<th>Action</th>
										</tr>
									</tfoot>
									<tbody>
									<?php $sql="select * from account_supplier order by id desc";$result=mysql_query($sql);
									while($rs=mysql_fetch_array($result)){?>
										<tr>
										<td width="13%">
									<?php 
									if($rs['image']!=""){ ?>
									<img id="myImg" src="image_projects/midthumb/<?php echo $rs['image']; ?>" class="img img-responsive">
									<?php } else { ?>
									<img id="myImg" src="image_projects/midthumb/images.jpg" class="img img-responsive">
									<?php } ?>	
							</td>
							<td width="13%">
									<?php 
									if($rs['images']!=""){ ?>
									<img id="myImg" src="image_projects/midthumb/<?php echo $rs['images']; ?>" class="img img-responsive">
									<?php } else { ?>
									<img id="myImg" src="image_projects/midthumb/signature.png" class="img img-responsive">
									<?php } ?>	
							</td>
											<td><?php echo$rs['name'];?></td>
											<td><?php echo$rs['contact'];?></td>
											<td><?php echo$rs['amount'];?></td>
											<td><?php echo$rs['paid'];?></td>
											<td><?php echo$rs['by_check_cash'];?></td>
											<td><?php echo$rs['dd_check_num'];?></td>
											<td><?php echo$rs['pending'];?></td>
											<td><?php echo date('d-M-Y',strtotime($rs['date']));?></td>
											<td><a href="edit_account_sup.php?id=<?php echo$rs['id'];?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
											<a href="manage_acc_sup.php?id=<?php echo$rs['id'];?>" title="Delete" onclick="return confirm('Do You want to delete !');"><span class="glyphicon glyphicon-trash"></span></a>
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


