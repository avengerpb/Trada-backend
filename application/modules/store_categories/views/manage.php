<h1>Manage Categories</h1>
<?php 
	if (isset($flash)) {
		echo $flash;
	}

	$create_category_url = base_url().'index.php/store_categories/create'; 
?>

<p style="margin-top: 30px">
	<a href="<?= $create_category_url ?>"><button type="button" class="btn btn-primary">Add New Category</button></a>
</p>

<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white align-justify"></i><span class="break"></span>Existing Categories</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<?php 
							echo Modules::run('store_categories/_draw_sortable_list', $category_id);
						?>						            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->