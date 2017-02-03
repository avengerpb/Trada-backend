<form method="post" action="<?php echo base_url() . "user/edit_profile_form"?>">

	<div class="form-group">
      <label class="control-label col-sm-2">Full name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control"  name="full_name" placeholder="Enter full name">
      </div>
    </div>
    <br><br>
	<div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter password">
      </div>
    </div>
	<br><br>
	<div class="form-group">
      <label class="control-label col-sm-2">dob:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control"  name="dob">
      </div>
    </div>
	<br><br>
	<div class="form-group">
      <label class="control-label col-sm-2">user_image_url:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control"  name="user_image_url">
      </div>
    </div>
	<br><br>
	<div class="form-group">
      <label class="control-label col-sm-2">fb_link:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control"  name="fb_link">
      </div>
    </div>
	<div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Update</button>
      </div>
    </div>
</form>