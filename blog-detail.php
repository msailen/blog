<?php
$comment = "";
$error = false;
$blogId = $_GET['id'];
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/blog.controller.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/comment.controller.php";

$blog_detail = Blog::getById($blogId);
$comments = Comment::getByBlog($blogId);
if (!$blog_detail) {
  header("Location: 404.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $comment = $_POST['comment'];
  if (!isset($_SESSION['userId'])) {
    $error = "You need to login to system to comment";
  }
  if (empty($_POST['comment'])) {
    $error = "Please Type Something";
  }
  if (!$error) {
    $payload['userId'] = $_SESSION['userId'];
    $payload['blogId'] = $blogId;
    $payload['content'] = $comment;
    $result = Comment::addComment($payload);
    if (!$result) {
      $error = "Failed to post comment";
    }
    header("Location: " . $_SERVER["PHP_SELF"] . "?id=$blogId");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Details</title>
  <?php require_once "global/head.php"; ?>

</head>

<body>
  <?php require_once "global/header.php"; ?>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body" style="min-height: 400px;">
          <h3 class="card-title text-center"><?php echo '"' . $blog_detail['title'] . '"' ?></h3>
          <h6 class="card-title"><?php echo "<b>Published On:</b> [ " . $blog_detail['created_at'] . " ]</u>" ?></h6>
          <hr />
          <div class="mt-4">
            <?php echo $blog_detail['content'] ?>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 mt-3">
      <div class="card comment-card">
        <div class="card-body">
          <h5 class="card-title text-center">Comments</h5>
          <div class="text-danger text-center"><?php if (isset($error)) echo $error; ?></div>
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=$blogId"); ?>">
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="comment" placeholder="Share Us Your View" value="<?php echo $comment; ?>" />
              <div class="input-group-append">
                <button type="submit" class="input-group-text btn btn-primary">Comment</button>
              </div>
            </div>
          </form>
          <?php
          if ($comments) {
            foreach ($comments as $comment) {
          ?>
              <div class="card card-alternative mb-2">
                <div class="card-body">
                  <h5 class="card-title"> <?php echo $comment['username'] ?></h5>
                  <span>
                    <?php echo $comment['created_at'] ?>
                  </span>
                  <div class="comment-text">
                    <?php echo $comment['content'] ?>
                  </div>
                </div>
              </div>
          <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <?php require_once "global/footer.php"; ?>

</body>

</html>