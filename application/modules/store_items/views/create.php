<h1><?= $headline ?></h1>

<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Details</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="<?php echo base_url(); ?>store_items/create">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Item Name </label>
							  <div class="controls">
								<input type="text" class="span6" name="item_name" value="<?= $item_name ?>">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="typeahead">Item ID </label>
							  <div class="controls">
								<input type="text" class="span3" name="item_id" value="<?= $item_id ?>">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="typeahead">Price </label>
							  <div class="controls">
								<input type="text" class="span3" name="price" value="<?= $price ?>">
							  </div>
							</div>
							        
							<!-- <div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Item Description</label>
							  <div class="controls">
								<textarea class="cleditor" id="textarea2" rows="3"></textarea>
							  </div>
							</div> -->

							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Save changes</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->