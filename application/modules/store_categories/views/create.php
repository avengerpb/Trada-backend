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
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>Category Details</h2>
				<div class="box-icon">
					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">

			<?php 
				$form_location = base_url().'index.php/store_categories/create/'.$update_id;
			?>

					<form class="form-horizontal" method="post" action="<?= $form_location ?>">
					  <fieldset>
					  	<?php 
					  		if ($num_dropdown_options > 1) {
					  	?>
					  	<div class="control-group">
							<label class="control-label" for="typeahead">Group Category </label>
						  	<div class="controls">
								<?php 
									$additional_dd_code = 'id="selectError3"';
									echo form_dropdown('group_cate_id', $options, $group_cate_id, $additional_dd_code);
								?>
						  	</div>
						</div>	
						<?php } else {
								echo form_hidden('group_cate_id', 0);
							}
						?>

						<div class="control-group">
						  <label class="control-label" for="typeahead">Category Name </label>
						  <div class="controls">
							<input type="text" class="span6" name="category_name" value="<?= $category_name ?>">
						  </div>
						</div>
								        
						<div class="form-actions">
						  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Save changes</button>
						  <button type="submit" class="btn" name="submit" value="Cancel">Cancel</button>
						</div>
					  </fieldset>
					</form>   

			</div>
		</div><!--/span-->

</div><!--/row-->
