<!DOCTYPE html>
<html lang="en">

<head>
  <title>Home</title>
  <?php require_once "global/head.php"; ?>

</head>

<body>
  <?php require_once "global/header.php"; ?>

  <div class="row">
    <div class="col-sm-12 col-md-6">
      <h6 class="m-3">Recent Blogs</h6>
    </div>
    <div class="col-sm-12 col-md-6 text-end">
      <a type="button" class="btn btn-success btn-sm" href="/add-blog">Create</a>
    </div>
    <div class="col-sm-12 col-md-4 col-lg-3">
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