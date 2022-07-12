<?php
session_start();
$error = false;
if (!$_SESSION['isAdmin']) {
  header("location: 404.php");
}
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/feedback.controller.php";
$feedbacks = Feedback::listFeedbacks();
if (!$feedbacks) {
  $error = "Failed To Fetch Messages";
  return;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Contact Us</title>
  <?php require_once "global/head.php"; ?>

</head>

<body>
  <?php require_once "global/header.php"; ?>

  <div class="row">
    <?php
    foreach ($feedbacks as $feedback) {
    ?>
      <div class="col-12 mb-2">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"> <?php echo $feedback['name'] . " [ " . $feedback['email'] . " ]" ?></h5>
            <span>
              <?php echo $feedback['created_at'] ?>
            </span>
            <div class="comment-text">
              <?php echo $feedback['message'] ?>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </div>

  <?php require_once "global/footer.php"; ?>

</body>

</html>