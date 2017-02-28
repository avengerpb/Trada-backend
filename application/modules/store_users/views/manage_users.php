<h1>Manage Users</h1>
<?php 
	if (isset($flash)) {
		echo $flash;
	}

	$create_user_url = base_url().'index.php/store_users/create_users'; 
?>

<p style="margin-top: 30px">
	<a href="<?= $create_user_url ?>"><button type="button" class="btn btn-primary">Add New User</button></a>
</p>

<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white briefcase"></i><span class="break"></span>Customers Users</h2>
						<div class="box-icon">

							<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>

							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>User ID</th>
								  <th>Full Name</th>
								  <th>User Name</th>
								  <th>Email</th>
								  <th>Fb Link</th>
								  <!-- <th>Password</th> -->
								  <th>Level</th>
								  <th>Admin</th>
								  <th>DoB</th>
								  <th>Location</th>
								  <th>User Image Url</th>
							  </tr>
						  </thead>   
						  <tbody>

						  <?php 
						  	foreach ($query->result() as $row) {
<<<<<<< HEAD
						  		$edit_user_image_url = base_url().'index.php/store_users/create_users/'.$row->user_id;
=======
						  		$delete_user_url = base_url().'index.php/store_users/delete_user/'.$row->user_id;
						  		$view_user_url = base_url().'index.php/store_users/view_user/'.$row->user_id;
>>>>>>> item
						  ?>

							<tr>
								<td><?= $row->user_id ?></td>
								<td class="center"><?= $row->full_name ?></td>
								<td class="center"><?= $row->user_name ?></td>
								<td class="center"><?= $row->email ?></td>
								<td class="center"><?= $row->fb_link ?></td>
								<!-- <td class="center"><?= $row->password ?></td> -->
								<td class="center"><?= $row->level ?></td>
								<td class="center"><?= $row->admin ?></td>
								<td class="center"><?= $row->dob ?></td>
								<td class="center"><?= $row->location ?></td>
								<td class="center"><?= $row->user_image_url ?></td>
								
<<<<<<< HEAD
								<!-- <td class="center">
									<a class="btn btn-success" href="#">
										<i class="halflings-icon white zoom-in"></i>  
									</a>
									<a class="btn btn-info" href="<?= $edit_User_image_url ?>">
										<i class="halflings-icon white edit"></i>  
									</a>
									
								</td> -->
=======
								<td class="center">
									<!-- <a class="btn btn-success" href="#">
										<i class="halflings-icon white zoom-in"></i>  
									</a> -->
									<a class="btn btn-info" href="<?= $delete_user_url ?>">
										<i class="halflings-icon white trash"></i>  
									</a>
									
								</td>
>>>>>>> item
							</tr>

							<?php } ?>

						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->