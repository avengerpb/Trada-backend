<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	echo $user_name; ?> <br> <?php
	echo $full_name; ?> <br> <?php
	echo $email; ?> <br> <?php
	echo $dob; ?> <br> <?php
	echo $fb_link; ?> <br> <?php

	if($is_logged_in == 1 && $user_name == $email_user_name || $is_logged_in == 1 && $email == $email_user_name){
?>
<a class="navbar-brand" href="<?php echo base_url().'user/edit_profile/'.$user_name; ?>">edit profile</a>
<?php
	}
?>