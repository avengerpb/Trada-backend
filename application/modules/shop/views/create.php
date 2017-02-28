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
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>Shop Details</h2>
				<div class="box-icon">
					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">

			<?php 
				$form_location = base_url().'index.php/shop/create/'.$update_id;
			?>

					<form class="form-horizontal" method="post" action="<?= $form_location ?>">
					  <fieldset>
						<div class="control-group">
						  <label class="control-label" for="typeahead">Shop Name </label>
						  <div class="controls">
							<input type="text" class="span6" name="shop_name" value="<?= $shop_name ?>">
						  </div>
						</div>

								<!-- <div class="control-group">
								  <label class="control-label" for="typeahead">Shop ID </label>
								  <div class="controls">
									<input type="text" class="span3" name="shop_id" value="<?= $shop_id ?>">
								  </div>
								</div> -->

						<div class="control-group">
						  <label class="control-label" for="typeahead">Address </label>
							  <div class="controls">
								<input type="text" class="span6" name="address" value="<?= $address ?>">
							  </div>
						</div>
								        
						<!-- <div class="control-group hidden-phone">
						  <label class="control-label" for="textarea2">Shop Description</label>
						  <div class="controls">
							<textarea class="cleditor" id="textarea2" rows="3" name="shop_description"><?php echo $shop_description; ?></textarea>
						  </div>
						</div> -->

						<div class="form-actions">
						  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Save changes</button>
						  <button type="submit" class="btn" name="submit" value="Cancel">Cancel</button>
						</div>
					  </fieldset>
					</form>   

			</div>
		</div><!--/span-->

</div><!--/row-->
