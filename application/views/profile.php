<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	echo $user_name; ?> <br> <?php
	echo $full_name; ?> <br> <?php
	echo $email; ?> <br> <?php
	echo $dob; ?> <br> <?php
	echo $fb_link; ?> <br> <?php

?>
<a class="navbar-brand" href="<?php echo base_url().'user/edit_profile/'; ?>">edit profile</a>