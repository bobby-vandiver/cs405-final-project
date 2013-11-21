  <?php
    include 'bootstrap.php';
    
    $inline_css = '<style>body { padding-top: 60px; } </style>';

    head("Chico's Toy Store", $inline_css);
  ?>

  <body>

    <?php include 'navbar.php' ?>

    <div class="container">

      <h1>Bootstrap starter template</h1>
      <p>Use this document as a way to quick start any new project.<br> All you get is this message and a barebones HTML document.</p>

      <?php echo "<p>This is some hot PHP generated text.</p>" ?>

    </div> <!-- /container -->

    <?php include 'footer.php'; ?>

  </body>
</html>
