<h1>Content Management System</h1>
<?php 
	if (isset($flash)) {
		echo $flash;
	}

	$create_page_url = base_url().'index.php/shop/create'; 
?>

<p style="margin-top: 30px">
	<a href="<?= $create_page_url ?>"><button type="button" class="btn btn-primary">Create New Shop</button></a>
</p>

<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white file"></i><span class="break"></span>Custom Shops</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Shop Name</th>
								  <th>Address</th>
								  <th>Link Fb</th>
								  <th>Shop Image Url</th>
								  <!-- <th>Shop Description</th> -->
								  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>

						  <?php 
						  	foreach ($query->result() as $row) {
						  		$edit_shop_url = base_url().'index.php/shop/create/'.$row->shop_id;
						  		// $view_shop_url = base_url().'index.php/shop/view/'.$row->item_id;
						  ?>

							<tr>
								<td><?= $row->shop_name ?></td>
								<td class="center"><?= $row->address ?></td>
								<td class="center"><?= $row->fb_link ?></td>
								<td class="center"><?= $row->shop_image_url ?></td>
								<!-- <td class="center">
									<span class="label label-success">Active</span>
								</td> -->
								<td class="center">
									<a class="btn btn-success" href="#">
										<i class="halflings-icon white eye-open"></i>  
									</a>
									<a class="btn btn-info" href="<?= $edit_shop_url ?>">
										<i class="halflings-icon white edit"></i>  
									</a>
									
								</td>
							</tr>

							<?php } ?>

						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->