<ul class="nav navbar-nav">

<?php 
	$this->load->module('store_categories');
	foreach ($category_name as $key => $value) {
		$category_id = $key;
		$category_name = $value;
?>

    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $category_name ?> <span class="caret"></span></a>
      <ul class="dropdown-menu">

      	<?php 
      		$query = $this->store_categories->get_where_custom('category_id', $category_id);
      		foreach ($query->result() as $row) {
      			echo '<li><a href="#">'.$row->category_name.'</a></li>';
      		}
      	?>
        
      </ul>
    </li>
<?php } ?>
</ul>