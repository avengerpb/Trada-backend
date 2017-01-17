<!DOCTYPE html>
<html>
<head>
	<title>Sign Up page</title>
</head>
<body>
    <div id ="container">
        <?php
            echo form_open('user/signup_validation');

            form_input('email', $this->input->post('email'));
            form_input('user_name', $this->input->post('user_name'));
            form_password('password');
            form_password('cpassword');
            form_submit('signup_submit', 'Sign Up');
?>

    <div class="container">
        <div class="card card-container">
            <form class="form-signin">
            	<h1>Sign up</h1>
                <span id="reauth-email" class="reauth-email"></span>
                <?php
                    echo validation_errors();
                ?>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name='email'>
                <br>
                <input id="inputUserName" class="form-control" placeholder="User Name" required autofocus name='user_name'>
                <br>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name='password'>
                <br>
                <input type="password" id="inputPassword" class="form-control" placeholder="Confirm Password" required name='cpassword'>
                <br>

                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name='signup_submit'>Sign up</button>
                <br>
                <a href="<?php echo base_url()."user/login"; ?>" class="btn btn-default">Login</a>
            </form>

        </div>
    </div>

    </div>
</body>
</html>