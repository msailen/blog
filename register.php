<?php
$error = false;
$emailExists = false;
$passwordMismatch = false;
session_start();
$formValue['name'] = '';
$formValue['email'] = '';
$formValue['password'] = '';
$formValue['confirmPassword'] = '';

//redirects to homepage if user session is active
if (isset($_SESSION['userId'])) {
  header("location: index.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $formValue['name'] = $_POST['name'];
  $formValue['email'] =  $_POST['email'];
  $formValue['password'] =  $_POST['password'];
  $formValue['confirmPassword'] =  $_POST['confirmPassword'];

  require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/user.controller.php";

  if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirmPassword'])) {
    if ($_POST['password'] !== $_POST['confirmPassword']) {
      $passwordMismatch = 'Password Mismatch. Please Try Again';
    }

    $user = User::checkEmailExist($_POST['email']);
    if ($user !== 0) {
      $emailExists = "Email Already Exists";
    }

    if (!$emailExists && !$passwordMismatch && !$error) {
      try {
        $userCount = User::getUserCount();
        $userCount = (int) $userCount;
        $payload['name'] = $_POST['name'];
        $payload['email'] = $_POST['email'];
        $payload['password'] = $_POST['password'];
        $payload['isAdmin'] = 0;
        if ($userCount === 0) $payload['isAdmin'] = 1;
        $userId = User::registerUser($payload);
        header("Location: login.php?status=success&msg=Registered Successfully");
      } catch (Exception $err) {
        $error = "Failed To Register";
      }
    }
  }
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

  <div class="row centered">
    <div class="col-12">
      <div class="card register-card">
        <div class="card-body">
          <h5 class="card-title text-center">Register</h5>
          <form autocomplete="off" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <span class="text-danger"><?php if (isset($error)) echo $error; ?></span>
            <div class="form-group mb-2">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" placeholder="Enter Name" required value="<?php echo $formValue['name']; ?>">
            </div>
            <div class="form-group mb-2">
              <label for="email">Email Address</label>
              <input type="email" class="form-control" name="email" placeholder="Enter email" required value="<?php echo $formValue['email']; ?>">
              <span class="text-danger"><?php if (isset($emailExists)) echo $emailExists; ?></span>
            </div>
            <div class="form-group mb-2">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" placeholder="Password" required value="<?php echo $formValue['password']; ?>">
              <span class="text-danger"><?php if (isset($passwordMismatch)) echo $passwordMismatch; ?></span>
            </div>
            <div class="form-group mb-2">
              <label for="confirmPassword">Retype Password</label>
              <input type="password" class="form-control" name="confirmPassword" placeholder="Retype Password" required value="<?php echo $formValue['confirmPassword']; ?>">
              <span class="text-danger"><?php if (isset($passwordMismatch)) echo $passwordMismatch; ?></span>
            </div>
            <div class="form-group mb-2">
              Already Registered ? <a href="/login.php">Login</a>
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