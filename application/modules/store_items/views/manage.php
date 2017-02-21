<h1>Manage Items</h1>

<?php $create_item_url = base_url().'index.php/store_items/create'; ?>

<p style="margin-top: 30px">
	<a href="<?= $create_item_url ?>"><button type="button" class="btn btn-primary">Add New Items</button></a>
</p>

<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white tag"></i><span class="break"></span>Items Inventory</h2>
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
								  <th>Item ID</th>
								  <th>Shop ID</th>
								  <th>Item Name</th>
								  <th>Price</th>
								  <th>Item Image Url</th>
							  </tr>
						  </thead>   
						  <tbody>

						  <!-- <?php 
						  	foreach ($query->result() as $row) {
						  		$edit_item_image_url = base_url().'index.php/store_items/create/'.$row->item_id;
						  ?> -->

							<tr>
								<td><?= $row->item_id ?></td>
								<td class="center"><?= $row->shop_id ?></td>
								<td class="center"><?= $row->item_name ?></td>
								<td class="center"><?= $row->price ?></td>
								<td class="center"><?= $row->item_image_url ?></td>
								<td class="center">
									<span class="label label-success">Active</span>
								</td>
								<td class="center">
									<a class="btn btn-success" href="#">
										<i class="halflings-icon white zoom-in"></i>  
									</a>
									<a class="btn btn-info" href="<?= $edit_item_image_url ?>">
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