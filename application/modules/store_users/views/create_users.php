<h1><?= $headline ?></h1>
<?= validation_errors('<p style="color: red">','</p>') ?>

<?php 
	if (isset($flash)) {
		echo $flash;
	}

?>


<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>User Details</h2>
				<div class="box-icon">
					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">

			<?php 
				$form_location = base_url().'index.php/store_users/create_users/'.$update_id;
			?>

					<form class="form-horizontal" method="post" action="<?= $form_location ?>">
					  <fieldset>
						<div class="control-group"> 
							<label class="control-label" for="typeahead">Full Name </label> 
							<div class="controls"> 
								<input type="text" class="span6" name="full_name" value="<?= $full_name ?>"> 
							</div> 
						</div>

						<div class="control-group"> 
							<label class="control-label" for="typeahead">Email </label> 
							<div class="controls"> 
								<input type="text" class="span6" name="email" value="<?= $email ?>"> 
							</div> 
						</div>

						<div class="control-group"> 
							<label class="control-label" for="typeahead">Fb Link </label> 
							<div class="controls"> 
								<input type="text" class="span6" name="fb_link" value="<?= $fb_link ?>"> 
							</div> 
						</div>

						<div class="control-group"> 
							<label class="control-label" for="typeahead">User Name </label> 
							<div class="controls"> 
								<input type="text" class="span6" name="user_name" value="<?= $user_name ?>"> 
							</div> 
						</div>

						<div class="control-group"> 
							<label class="control-label" for="typeahead">Password </label> 
							<div class="controls"> 
								<input type="text" class="span6" name="password" value="<?= $password ?>"> 
							</div> 
						</div>

						<div class="control-group"> 
							<label class="control-label" for="typeahead">Level </label> 
							<div class="controls"> 
								<input type="text" class="span6" name="level" value="<?= $level ?>"> 
							</div> 
						</div>

						<div class="control-group"> 
							<label class="control-label" for="typeahead">Admin </label> 
							<div class="controls"> 
								<input type="text" class="span6" name="admin" value="<?= $admin ?>"> 
							</div> 
						</div>

						<div class="control-group"> 
							<label class="control-label" for="typeahead">Date of Birth </label> 
							<div class="controls"> 
								<input type="text" class="span6" name="dob" value="<?= $dob ?>"> 
							</div> 
						</div>

						<div class="control-group"> 
							<label class="control-label" for="typeahead">Location </label> 
							<div class="controls"> 
								<input type="text" class="span6" name="location" value="<?= $location ?>"> 
							</div> 
						</div>

						<div class="control-group"> 
							<label class="control-label" for="typeahead">User Image Url </label> 
							<div class="controls"> 
								<input type="text" class="span6" name="user_image_url" value="<?= $user_image_url ?>"> 
							</div> 
						</div>


						<div class="form-actions">
						  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
						  <button type="submit" class="btn" name="submit" value="Cancel">Cancel</button>
						</div>
					  </fieldset>
					</form>   

			</div>
		</div><!--/span-->

</div><!--/row-->
