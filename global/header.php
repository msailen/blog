<nav class="navbar navbar-dark bg-dark p-3 header">
  <div class="row">
    <div class="col-sm-12 col-md-6">
      <a class="navbar-brand" href="/">IIMS Blog</a>
    </div>
    <div class="col-sm-12 col-md-6 text-end">
      <?php
      if (isset($_SESSION['isAdmin'])) {
      ?>
        <a class="btn navbar-item" href="/messages.php">Messages</a>
      <?php
      }
      ?>
      <a class="btn navbar-item" href="/contact-us.php">Contact Us</a>
      <?php
      if (!isset($_SESSION['userId'])) {
      ?>
        <a class="btn btn-success btn-sm" href="/login.php">Login</a>
      <?php
      } else {
      ?>
        <a class="btn btn-success btn-sm" href="/logout.php">Logout</a>
      <?php
      }
      ?>
    </div>
  </div>
</nav>
<div class="wrapper ml-4 mr-4">