<?php session_start() ?>

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
          <form>
            <div class="form-group mb-2">
              <label for="subject">Subject</label>
              <input type="text" class="form-control" id="subject" placeholder="Subject" required>
            </div>
            <div class="form-group mb-2">
              <label for="message">Message</label>
              <textarea type="text" rows="5" class="form-control" id="message" placeholder="Your Message" required></textarea>
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