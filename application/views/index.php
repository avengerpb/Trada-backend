<p>index page</p>
<a class="navbar-brand" href="<?php echo base_url().'user/signup'; ?>">signup</a>
<a class="navbar-brand" href="<?php echo base_url().'user/login'; ?>">login</a>
<a class="navbar-brand" href="<?php echo base_url().'user/logout'; ?>">logout</a>
<?php
	$user_name = $this->session->userdata('email/user_name')
?>
<a class="navbar-brand" href="<?php echo base_url().'user/profile/'.$user_name; ?>">profile</a>
