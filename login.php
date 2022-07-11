<?php
session_start();
if (isset($_SESSION['userId'])) {
  header("location: index.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/user.controller.php";

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $response = [];
    $result = User::loginUser($_POST['email'], $_POST['password']);
    print_r($_POST['email'], $result);

    // $_SESSION['userId'] = $result['id'];
    // $_SESSION['name'] = $result['name'];
    // $_SESSION['isAdmin'] = $result['isAdmin'];
    // header("Location: index.php");
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login</title>
  <?php require_once "global/head.php"; ?>

</head>

<body>
  <?php require_once "global/header.php"; ?>

  <div class="row centered">
    <div class="col-12">
      <div class="card login-card">
        <div class="card-body">
          <h5 class="card-title text-center">Login</h5>
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group mb-2">
              <label for="email">Email Address</label>
              <input type="email" class="form-control" name="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
              Not Registered Yet? <a href="/register.php">Register</a>
            </div>
            <button type="submit" class="btn btn-success mt-2">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php require_once "global/footer.php"; ?>

</body>

</html>