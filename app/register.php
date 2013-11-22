<?php
    include 'bootstrap.php';
    include 'form-style.php';

    head("Register", FORM_CSS);
?>  
   <body>

    <?php include 'navbar.php' ?>

    <div class="container">

      <form class="form-signin" action="register-user.php" method="post" id="register-form">
        <h2 class="form-signin-heading">Register</h2>

        <input type="text" class="input-block-level" name="username" placeholder="Username">
        <input type="password" class="input-block-level" name="password" placeholder="Password">

        <input type="text" class="input-block-level" name="houseNumber" placeholder="House Number">
        <input type="text" class="input-block-level" name="street" placeholder="Street">
        <input type="text" class="input-block-level" name="city" placeholder="City">
        <input type="text" class="input-block-level" name="state" placeholder="State">
        <input type="text" class="input-block-level" name="zip" placeholder="Zip">
        
        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->

    <?php include 'footer.php'; ?>

    <script>

    $(document).ready(function() {

        $('#register-form').validate({
            rules: {
                username: {
                    required: true,
                    maxlength: MAX_STRING_LENGTH
                },
                password: {
                    required: true,
                    maxlength: MAX_STRING_LENGTH
                },
                houseNumber: {
                    required: true,
                    digits: true
                },
                street: {
                    required: true,
                    maxlength: MAX_STRING_LENGTH
                },
                city: {
                    required: true,
                    maxlength: MAX_STRING_LENGTH
                },
                state: {
                    required: true,
                    regex: /^[a-zA-Z]{2}$/
                },
                zip: {
                    required: true,
                    regex: /^\d{5}$/
                }
            },
        });
    });

    </script>
  </body>
</html>
