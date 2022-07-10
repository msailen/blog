<!DOCTYPE html>
<html lang="en">
<?php
echo "Here";
?>

<head>
  <title>Page Not Found</title>
  <?php require_once "global/head.php"; ?>

</head>

<body>
  <?php require_once "global/header.php"; ?>

  <div class="row centered">
    <div class="col-12">
      <div class="card">
        <div class="card-body text-center">
          <h5>Oops Page Not Found</h5>
          <a type="button" class="btn btn-success" href="/">Go To Home</a>
        </div>
      </div>
    </div>
  </div>

  <?php require_once "global/footer.php"; ?>

</body>

</html>