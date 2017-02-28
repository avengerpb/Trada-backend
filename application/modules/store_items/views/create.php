<h1><?= $headline ?></h1>
<?= validation_errors('<p style="color: red">','</p>') ?>

<?php 
	if (isset($flash)) {
		echo $flash;
	}

	if (is_numeric($update_id)) {
?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Options</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<?php 
				if ($item_image_url == '') {
			?>
				<a href="<?= base_url() ?>index.php/store_items/upload_image/<?= $update_id ?>"><button type="button" class="btn btn-primary">Upload Item Image</button></a>
			<?php } else { ?>
				<a href="<?= base_url() ?>index.php/store_items/delete_image/<?= $update_id ?>"><button type="button" class="btn btn-danger">Delete Item Image</button></a>
			<?php } ?>


			<a href="<?= base_url() ?>index.php/store_cate_item/update/<?= $update_id ?>"><button type="button" class="btn btn-primary">Update Item Categories</button></a>
			<a href="<?= base_url() ?>index.php/store_items/deleteconf/<?= $update_id ?>"><button type="button" class="btn btn-danger">Delete Item</button></a>
			<a href="<?= base_url() ?>index.php/store_items/view/<?= $update_id ?>"><button type="button" class="btn btn-default">View Item In Shop</button></a>
		</div>
	</div><!--/span-->
</div><!--/row-->
<?php } ?>


<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Details</h2>
				<div class="box-icon">
					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">

			<?php 
				$form_location = base_url().'index.php/store_items/create/'.$update_id;
			?>

					<form class="form-horizontal" method="post" action="<?= $form_location ?>">
					  <fieldset>
						<div class="control-group">
						  <label class="control-label" for="typeahead">Item Name </label>
						  <div class="controls">
							<input type="text" class="span6" name="item_name" value="<?= $item_name ?>">
						  </div>
						</div>

								<!-- <div class="control-group">
								  <label class="control-label" for="typeahead">Item ID </label>
								  <div class="controls">
									<input type="text" class="span3" name="item_id" value="<?= $item_id ?>">
								  </div>
								</div> -->

						<div class="control-group">
						  <label class="control-label" for="typeahead">Price </label>
							  <div class="controls">
								<input type="text" class="span3" name="price" value="<?= $price ?>">
							  </div>
						</div>
						
						<div class="control-group hidden-phone">
						  <label class="control-label" for="textarea2">Item Description</label>
						  <div class="controls">
							<textarea class="cleditor" id="textarea2" rows="3" name="item_description"><?php echo $item_description; ?></textarea>
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



<?php 
	if ($item_image_url != '') {
?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Image</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<img src="<?= $item_image_url ?>">
		</div>
	</div><!--/span-->
</div><!--/row-->
<?php } ?>