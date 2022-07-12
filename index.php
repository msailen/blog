<?php
session_start();
$error = "";
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/blog.controller.php";
$blogs = Blog::listBlogs();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Home</title>
  <?php require_once "global/head.php"; ?>

</head>

<body>
  <?php require_once "global/header.php"; ?>

  <div class="row">
    <span class="text-danger"><?php if (isset($error)) echo $error; ?></span>
    <div class="col-sm-12 col-md-6">
      <h6 class="m-3">Recent Blogs</h6>
    </div>
    <?php
    if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
    ?>
      <div class="col-sm-12 col-md-6 text-end">
        <a type="button" class="btn btn-success btn-sm" href="/add-blog.php">Create</a>
      </div>
    <?php
    } else {
    ?>
      <div class="col-sm-12 col-md-6 text-end">
      </div>
    <?php
    }
    ?>
    <?php
    if ($blogs) {
      foreach ($blogs as $blog) {
    ?>
        <div class="col-sm-12 col-md-4 col-lg-3">
          <div class="card">
            <a href="<?php echo "/blog-detail.php" . "?id=" . $blog['id'] ?>" class="a-link">
              <img class="card-img-top" src="<?php echo $blog['preview'] ?>" onerror='this.onerror=null;this.src="images/default.png"' alt="Preview">
              <div class="card-body">
                <h5 class="card-title"><?php echo $blog['title']; ?></h5>
              </div>
            </a>
          </div>
        </div>
    <?php
      }
    }
    ?>
  </div>
  <?php require_once "global/footer.php"; ?>

</body>

</html>