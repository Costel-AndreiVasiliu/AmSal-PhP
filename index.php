<?php
require_once("conectare.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AmSal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="d-flex flex-column min-vh-100">
    <style type="text/css">
      body { background: blanchedalmond; }
    </style>

    <?php
    if (isset($_SESSION['user_id'])) {
        // include 'header.php';
    }
    ?>

    <div class="container d-flex flex-column justify-content-start align-items-left">
        <img src="./img/logo_jpeg.jpeg" width="150" height="150">
    </div>

    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <?php
        if (isset($_SESSION['message'])) {
            echo "<div class='alert alert-info' role='alert'>" . $_SESSION['message'] . "</div>";
            unset($_SESSION['message']);
        }
        ?>
        <div class="row">
            <div class="col-12"> <h1>WELCOME to AmSal !</h1></div>
        </div>
        <div class="row">
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="col-12">
                    <p>Welcome, <?php echo $_SESSION['email']; ?>!</p>
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                        <a href="admin_dashboard.php"><button type="button" class="btn btn-primary">Go to Dashboard</button></a>
                    <?php else: ?>
                        <a href="contabil_dashboard.php"><button type="button" class="btn btn-primary">Go to Dashboard</button></a>
                    <?php endif; ?>
                    <a href="logout.php"><button type="button" class="btn btn-danger">Logout</button></a>
                </div>
            <?php else: ?>
                <div class="col-6">
                    <a href="login.php"> <button type="button" class="btn btn-primary">LOGIN</button> </a>
                </div>
                <div class="col-6">
                    <a href="register.php"><button type="button" class="btn btn-secondary">REGISTER</button> </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</html>
