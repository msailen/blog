<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/user.controller.php";


if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirmPassword'])) {

  $response = [];

  if ($_POST['password'] !== $_POST['confirmPassword']) {
    $response['error'] = "Password Mismatch. Please Try Again";
    echo json_encode($response, JSON_PRETTY_PRINT);
    return;
  }
  $exists = User::checkEmailExist($_POST['email']);
  if ($exists !== 0) {
    $response['error'] = "Email Already Exists";
    echo json_encode($response, JSON_PRETTY_PRINT);
    return;
  }
  $_SESSION['name'] = "Ram";
  $userCount = User::getUserCount();
  $userCount = (int) $userCount;
  $payload['name'] = $_POST['name'];
  $payload['email'] = $_POST['email'];
  $payload['password'] = $_POST['password'];
  $payload['isAdmin'] = 0;
  if ($userCount === 0) $payload['isAdmin'] = 1;

  $response = User::registerUser($payload);
  return $response;
} else {
  $response = [];
  $response['error'] = "All Fields Are Required";
  echo json_encode($response, JSON_PRETTY_PRINT);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Register</title>
  <?php require_once "global/head.php"; ?>

</head>

<body>
  <?php require_once "global/header.php"; ?>
  <iframe name="content" class="d-none"></iframe>
  <div class="row centered">
    <div class="col-12">
      <div class="card register-card">
        <div class="card-body">
          <h5 class="card-title text-center">Register</h5>
          <form autocomplete="off" id="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group mb-2">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
            </div>
            <div class="form-group mb-2">
              <label for="email">Email Address</label>
              <input type="email" class="form-control" name="email" placeholder="Enter email" required>
            </div>
            <div class="form-group mb-2">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="form-group mb-2">
              <label for="confirmPassword">Retype Password</label>
              <input type="password" class="form-control" name="confirmPassword" placeholder="Retype Password" required>
            </div>
            <div class="alert alert-danger register-error mb-2" role="alert" style="display: none;">
            </div>
            <div class="form-group mb-2">
              Already Registered ? <a href="/login">Login</a>
            </div>
            <button type="submit" class="btn btn-success" name="submitButton">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php require_once "global/footer.php"; ?>

</body>

</html>