<p>index page</p>
<a class="navbar-brand" href="<?php echo base_url().'user/signup'; ?>">signup</a>
<a class="navbar-brand" href="<?php echo base_url().'user/login'; ?>">login</a>
<a class="navbar-brand"><?php echo base_url().'user/profile/'.$user_name; ?></a>
<?php
if($is_logged_in == 1){
?>
<a class="navbar-brand" href="<?php echo base_url().'user/logout'; ?>">logout</a>
<a class="navbar-brand" href="<?php echo base_url().'user/profile/'.$user_name; ?>">profile</a>
<?php
	}
?>

