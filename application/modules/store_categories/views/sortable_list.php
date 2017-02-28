<style type="text/css">
	.sort{
		list-style: none;
		border: 1px #ccc solid;
		color: #333;
		padding: 10px;
		margin-bottom: 4px;
	}
</style>

<ul id="sortlist">
	<?php 
	  	$this->load->module('store_categories');
	  	foreach ($query->result() as $row) {
	  		$num_sub_cates = $this->store_categories->_count_sub_cates($row->category_id);
	  		$edit_category_url = base_url().'index.php/store_categories/create/'.$row->category_id;
	  		if ($row->group_cate_id == 0) {
	  			$group_category = '&nbsp;';
	  		} else {
	  			$group_category = $this->store_categories->_get_category_name($row->group_cate_id);
	  		}
	?>
	<li class="sort" id="<?= $row->category_id ?>"><i class="icon-sort"></i> <?=	$row->category_name ?>
		<?= $group_category ?>

		<?php 
			if ($num_sub_cates < 1) {
				echo '&nbsp;';
			} else {
				if ($num_sub_cates == 1) {
					$entity = 'Category';
				} else {
					$entity = 'Categories';
				}
				$sub_cate_url = base_url().'index.php/store_categories/manage/'.$row->category_id;
		?>
		<a class="btn btn-default" href="<?= $sub_cate_url ?>">
			<i class="halflings-icon white eye-open"></i> 
			<?php 
				echo $num_sub_cates.' Sub '.$entity;
			?> 
		</a>

		<a class="btn btn-info" href="<?= $edit_category_url ?>">
			<i class="halflings-icon white edit"></i>  
		</a>
		<?php } ?>
	</li>
	<?php } ?>
</ul>