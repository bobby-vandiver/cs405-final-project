<?php
    include 'bootstrap.php';
    include 'form-style.php';

    head("Sign-in", FORM_CSS);
?>  
  <body>

    <?php include 'navbar.php' ?>

    <div class="container">

      <form class="form-signin" action="login.php" method="post" id="signin-form">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" class="input-block-level" name="username" placeholder="Username">
        <input type="password" class="input-block-level" name="password" placeholder="Password">
        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->

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
    });

    </script>
 </body>
</html>
