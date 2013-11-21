<?php
    include 'bootstrap.php';
    include 'form-style.php';

    head("Sign-in", FORM_CSS);
?>  
   <body>

    <?php include 'navbar.php' ?>

    <div class="container">

      <form class="form-signin" action="register-user.php" method="post">
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
 </body>
</html>