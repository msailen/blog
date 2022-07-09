<!DOCTYPE html>
<html lang="en">

<head>
  <title>Home</title>
  <?php require_once "global/head.php"; ?>

</head>

<body>
  <?php require_once "global/header.php"; ?>

  <h6 class="m-3">Recent Blogs</h6>
  <div class="row">
    <div class="col-3">
      <div class="card">
        <a href="/blog-detail" class="a-link">
          <img class="card-img-top" src="images/default.png" alt="Preview">
          <div class="card-body">
            <h5 class="card-title">Apache Hadoop</h5>
            <p class="card-text">This is Apache Hadoop Content</p>
          </div>
        </a>
      </div>
    </div>
  </div>
  <?php require_once "global/footer.php"; ?>

</body>

</html>