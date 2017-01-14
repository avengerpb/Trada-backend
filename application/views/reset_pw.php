<!DOCTYPE html>
<html>
<head>
	<title>Reset Password page!</title>
</head>
<body>
    <?php
       echo form_open('main/reset_password_validation');

        form_input('email');
        form_submit('email_submit', 'Get Password');
    ?>

    <div class="container">
        <div class="card card-container">
            <form class="form-signin">
            <h1>Reset Password</h1>
                <span id="reauth-email" class="reauth-email"></span>
                <?php
                    echo validation_errors();
                ?>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name='email'>
                <br>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name='email_submit'>Get Password</button>
                <br><br>
                <a href="<?php echo base_url()."main/signup"; ?>" class="btn btn-default">Sign Up</a>
                <br>
                <a href="<?php echo base_url()."main/login"; ?>" class="btn btn-default">Log In</a>
            </form>

        </div>
    </div>

</body>
</html>