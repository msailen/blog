<?php
session_start();
$error = false;
$success = false;
$formValue['name'] = '';
$formValue['email'] = '';
$formValue['message'] = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $formValue['name'] = $_POST['name'];
  $formValue['email'] =  $_POST['email'];
  $formValue['message'] =  $_POST['message'];

  require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/feedback.controller.php";

  if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message']) && !$error) {
    $result = Feedback::addFeedback($formValue);
    if (!$result) {
      $error = "Failed To Send Your Message";
      return;
    }
    $success = "We have received your message. Thanks for contacting Us.";
  } else {
    $error = "All Fields Are Required";
  }
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

  <div class="row centered">
    <div class="col-12">
      <div class="card contact-us-card">
        <div class="card-body">
          <h5 class="card-title text-center">Contact Us</h5>
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <span class="text-danger"><?php if (isset($error)) echo $error; ?></span>
            <span class="text-success"><?php if (isset($success)) echo $success; ?></span>
            <div class="form-group mb-2">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" placeholder="Your Name" required>
            </div>
            <div class="form-group mb-2">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" placeholder="Your Email" required>
            </div>
            <div class="form-group mb-2">
              <label for="message">Message</label>
              <textarea type="text" rows="5" class="form-control" name="message" placeholder="Your Message" required></textarea>
            </div>
            <button type="submit" class="btn btn-success mt-2">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php require_once "global/footer.php"; ?>

</body>

</html>