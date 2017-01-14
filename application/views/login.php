<!DOCTYPE html>
<html>
<head>
	<title>Login page!</title>
</head>
<body>
    <?php

    echo form_open('user/login_validation');

    form_input('email');
    form_password('password');
    form_submit('login_submit', 'Login');

    ?>

    <div class="container">
        <div class="card card-container">
            <form class="form-signin">
            <h1>Log in</h1> 
            <?php
                if ($this->session->userdata('is_logged_in')==1){
            ?>
            <p>You have aready logged in! please continue with our <a href="<?php echo base_url().'user/index';?>">home page</a>.<p>
            <?php
              } else {
            ?>
                <span id="reauth-email" class="reauth-email"></span>
                <?php
                echo validation_errors();
                ?>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name='email'>
                <br>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name='password'>
                <br>
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name='login_submit'>Log In</button>
                <a href="<?php echo base_url()."user/reset_pw"; ?> " class="">Forgot your password?</a>
                <br><br>
                <a href="<?php echo base_url()."user/signup"; ?>" class="btn btn-default">Sign Up</a>
            </form>

        </div>
    </div>

    <?php
        }
    ?>
</body>
</html>