<ul class="nav navbar-nav">

<?php 
	$this->load->module('store_categories');
	foreach ($group_cate as $key => $value) {
		$group_cate_id = $key;
		$group_cate_name = $value;
?>

    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $group_cate_name ?> <span class="caret"></span></a>
      <ul class="dropdown-menu">

      	<?php 
      		$query = $this->store_categories->get_where_custom('group_cate_id', $group_cate_id);
      		foreach ($query->result() as $row) {
      			echo '<li><a href="#">'.$row->category_name.'</a></li>';
      		}
      	?>
        
      </ul>
    </li>
<?php } ?>
</ul>