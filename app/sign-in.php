<?php
    include 'bootstrap.php';
    include 'form-style.php';

    head("Sign-in", FORM_CSS);
?>  
  <body>

    <?php include 'navbar.php' ?>

    <div class="container">
        <div class="row">
            <div class="span6">
                <form class="form-signin" action="login.php" method="post" id="signin-form">
                    <h2 class="form-signin-heading">Please sign in</h2>
                    <input type="text" class="input-block-level" name="username" placeholder="Username">
                    <input type="password" class="input-block-level" name="password" placeholder="Password">
                    <button class="btn btn-large btn-default" type="submit">Sign in</button>
                </form>
            </div>
            <div class="span6">
                <div class="form-signin">
                    <h3>Don't have an account?</h3>
                    <button class="btn btn-large btn-default" id="register-button">Register</button>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script>

    $(document).ready(function() {

        $('#signin-form').validate({
            rules: {
                username: {
                    required: true,
                    maxlength: MAX_STRING_LENGTH
                },
                password: {
                    required: true,
                    maxlength: MAX_STRING_LENGTH
                }
            },
        });

        $('#register-button').click(function() {
            window.location.href = "register.php";
        });
    });

    </script>
 </body>
</html>
