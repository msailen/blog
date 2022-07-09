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
      <div class="card register-card">
        <div class="card-body">
          <h5 class="card-title text-center">Register</h5>
          <form>
            <div class="form-group mb-2">
              <label for="name">Name</label>
              <input type="email" class="form-control" id="name" placeholder="Enter Name" required>
            </div>
            <div class="form-group mb-2">
              <label for="email">Email Address</label>
              <input type="email" class="form-control" id="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" placeholder="Password" required>
            </div>
            <div class="form-group">
              Already Registered ? <a href="login">Login</a>
            </div>
            <button type="submit" class="btn btn-success mt-2">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php require_once "global/footer.php"; ?>

</body>

</html>