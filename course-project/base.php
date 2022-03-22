<?php 
  require_once('dbh.php');
  // $object = new Database();
    $database = new Database();
    $connection = $database->getInstance();

    // if (isset($_POST['logout'])) {
    //   $_SESSION['userId'] = '';
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    body{
        background-color: #cccccc;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li>
          <a 
            class="nav-link px-2 text-secondary"
            >
            Home
          </a>
        </li>
    </ul>

    <div style="float: right">
      <?php if (!(isset($_SESSION['userId'])) || $_SESSION['userId'] == ''): ?>
        <a href="login.php" type="button" class="btn btn-outline-light me-2">Login</a>
        <a href="signup.php" type="button" class="btn btn-warning">Sign-up</a>
      <?php else: ?>
        <a href="../login/login.php" type="button" name="logout" class="btn btn-info">logout</a>
      <?php endif; ?>
    </div>
  </nav>
</body>
</html>