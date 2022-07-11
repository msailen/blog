<?php
?>
<nav class="navbar navbar-dark bg-dark p-3 header">
  <div class="row">
    <div class="col-sm-6 col-md-6">
      <a class="navbar-brand" href="/">IIMS Blog</a>
    </div>
    <div class="col-sm-6 col-md-6 text-end">
      <?php
      if (isset($_SESSION['name'])) {
        echo "Welcome: " . $_SESSION['name'];
      }
      ?>
      <a class="btn navbar-item" href="/contact-us">Contact Us</a>
      <a class="btn btn-success btn-sm" href="/login">Login</a>
    </div>
  </div>
</nav>
<div class="wrapper ml-4 mr-4">