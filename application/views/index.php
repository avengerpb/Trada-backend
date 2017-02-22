<p>index page</p>
<a class="navbar-brand"  href="<?php echo base_url().'user/signup'; ?>">signup</a>
<a class="navbar-brand" href="<?php echo base_url().'user/login'; ?>">login</a>
<?php
if($is_logged_in == 1){
?>
<a class="navbar-brand" href="<?php echo base_url().'user/logout'; ?>">logout</a>
<a class="navbar-brand" href="<?php echo base_url().'user/profile/'.$user_name; ?>">profile</a>
<?php
	}

	preg_match('/(?:http:\/\/)?(?:www.)?facebook.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[\w\-]*\/)*([\w\-]*)/',
    "https://www.facebook.com/duonggodfanclub/?notif_t=page_user_activity&notif_id=1487652095742563", $matches);
    $str = strstr($matches[0], '/');
    $str = str_replace("/", "", $str);
	print_r($str);
?>

<form action="<?php echo base_url() . "search/search_result"?>" method="post"> 
Search: <input type="text" name="search_phrase" /><br /> 
<input type="submit" value="Submit" /> 
</form> 

