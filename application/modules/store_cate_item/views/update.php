<h1><?= $headline ?></h1>
<?= validation_errors('<p style="color: red">','</p>') ?>

<?php 
	if (isset($flash)) {
		echo $flash;
	}
?>


<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>New Category</h2>
				<div class="box-icon">
					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">
			<p>Choose a group category and hit 'Submit'</p>

			<?php 
				$form_location = base_url().'index.php/store_cate_item/submit/'.$item_id;
			?>

					<form class="form-horizontal" method="post" action="<?= $form_location ?>">
					  <fieldset>
					  	<div class="control-group">
							<label class="control-label" for="typeahead">Group Category </label>
						  	<div class="controls">
								<?php 
									$additional_dd_code = 'id="selectError3"';
									echo form_dropdown('category_id', $options, $category_id, $additional_dd_code);
								?>
						  	</div>
						</div>	

						<!-- <div class="control-group">
						  <label class="control-label" for="typeahead">Category Name </label>
						  <div class="controls">
							<input type="text" class="span6" name="category_name" value="<?= $category_name ?>">
						  </div>
						</div>

						<div class="control-group hidden-phone">
						  <label class="control-label" for="textarea2">Category Description</label>
						  <div class="controls">
							<textarea class="cleditor" id="textarea2" rows="3" name="category_description"><?php echo $category_description; ?></textarea>
						  </div>
						</div> -->
								        
						<div class="form-actions">
						  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
						  <button type="submit" class="btn" name="submit" value="Finish">Finish</button>
						</div>
					  </fieldset>
					</form>   

			</div>
		</div><!--/span-->

</div><!--/row-->


<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>Assigned Categories For This Item</h2>
				<div class="box-icon">
					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">

				<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Count</th>
								  <th>Category Name</th>
								  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>

						  <?php 
						  	$count = 0;
						  	$this->load->module('store_categories');
						  	foreach ($query->result() as $row) {
						  		$count++;
						  		$delete_url = base_url().'index.php/store_cate_item/delete/'.$row->item_id;
						  		$group_cate_name = $this->store_categories->_get_group_cate_name($row->category_id);
						  		$category_name = $this->store_categories->_get_cate_name($row->category_id);
						  		$long_cate_name = $group_cate_name." > ".$category_name;
						  ?>

							<tr>
								<td class="center"><?= $count ?></td>
								<td class="center"><?= $long_cate_name ?></td>
								<td class="center">
									<a class="btn btn-info" href="<?= $delete_url ?>">
										<i class="halflings-icon white trash"></i> Remove Option
									</a>
									
								</td>
							</tr>

							<?php } ?>

						  </tbody>
					  </table>   

			</div>
		</div><!--/span-->

</div><!--/row-->
